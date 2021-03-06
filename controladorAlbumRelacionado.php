<?php
ini_set('max_execution_time', 300);
class album{
	private $API_KEY;
	private $id;
	private $titulo;
	private $artista;
	private $type;
	private $deluxe;
	private $year;
	private $genres;
	private $time;

	public function __construct(){
		$api_file = fopen("API_KEY_Lastfm.txt", "r");
		$this->API_KEY = fread($api_file, filesize("API_KEY_Lastfm.txt"));
		fclose($api_file);
	}

	public function getApiKey(){
		return $this->API_KEY;
	}

	public function getID(){
		return $this->id;
	}

	public function getTitulo(){
		return $this->titulo;
	}

	public function getArtista(){
		return $this->artista;
	}

	public function getType(){
		return $this->type;
	}

	public function getGenres(){
		return $this->genres;
	}

	public function getYear(){
		return $this->year;
	}

	public function getDeluxe(){
		return $this->deluxe;
	}

	public function showTitle(){
		echo $this->titulo;
	}

	public function set($id, $titulo, $artista){
		$this->id = $id;
		$this->titulo = $titulo;
		$this->artista = $artista;
	}

	public function getImage(){
		$link = "http://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=" . $this->API_KEY . "&artist=" . $this->artista . "&album=" . $this->titulo . "&format=json";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $link);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'CdBase');

		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, JSON_FORCE_OBJECT);

		$image_link = $response["album"]["image"][4]["#text"];

		return $image_link;
	}

	public function IsEqual($album1){
		if ($album1->getID() == $this->getID()) {
			return true;
		}
		else {
			return false;
		}
	}

	public function addAlbumtoBd(){
		include 'php/connect_db.php';

		$year = $this->getYear();
		$deluxe = $this->getdeluxe();
		$type = $this->getType();
		$artist = $this->getArtista();
		$titulo = $this->getTitulo();
		$style=$this->getGenres();
		$time=$this->time;

		$sql_order = "INSERT INTO album(name, artist, style,length, type, deluxe, year) VALUES ('$titulo', '$artist', '$style','$time', '$type', '$deluxe', '$year')";
		$conn->query($sql_order);
	}

	public function isDeluxe($album_name){
		$result = false;

		if (strpos($album_name, "Deluxe") != false) {
			$result = true;
		}

		if (strpos($album_name, "deluxe") != false) {
			$result = true;
		}

		if (strpos($album_name, "DELUXE") != false) {
			$result = true;
		}

		if (strpos($album_name, "Limited") != false) {
			$result = true;
		}

		if (strpos($album_name, "limited") != false) {
			$result = true;
		}

		if (strpos($album_name, "LIMITED") != false) {
			$result = true;
		}

		if (strpos($album_name, "Special") != false) {
			$result = true;
		}

		if (strpos($album_name, "special") != false) {
			$result = true;
		}

		if (strpos($album_name, "SPECIAL") != false) {
			$result = true;
		}

		$this->deluxe = $result;

		return $result;
	}

	public function isContained($var1, $var2){
		if (strpos($var1, $var2) !== false) {
			return true;
		}
		else {
			return false;
		}
	}

	public function setGenress($listas){
		$tagss = "";
		$max = count($listas);
		$style = array(
				"alternative","punk","rock","blues",
				"classical","country","folk","dance",
				"electronic","easy","gospel","religious",
				"rap","holiday","instrumental","jazz",
				"latin","metal","moods","pop","rnb",
				"soundtrack","world"
			);

		for ($i=0;$i<$max;$i++) {
			if ($listas[$i]["name"] === "60s") {
				$tagss.="60s"."-";
			}
			else {
				if ($listas[$i]["name"] === "70s") {
					$tagss.="70s"."-";
				}
				else {
					if ($listas[$i]["name"] === "80s") {
						$tagss.="80s"."-";
					}
					else {
						if ($listas[$i]["name"] === "90s") {
							$tagss.="90s"."-";
						}
						else {
							foreach ($style as $styleSelected) {
								if ($this->isContained($listas[$i]["name"], $styleSelected)) {
									$tagss.=$styleSelected."-";
								}
							}
						}
					}
				}
			}
		}

		if ($tagss === "") {
			$tagss = "Other";
		}

		return $tagss;
	}

	public function getTypeandYear($artista, $albumtitle){
		$pos = strpos($albumtitle, "(");
		$titulo = "";

		if ($pos === false) {
			$titulo = $albumtitle;
		}
		else {
			$titulo = substr($albumtitle, 0, $pos - 1);
		}

		$fmt = 'json';
		$url = "http://musicbrainz.org/ws/2/release/?query=artist:" . urlencode($artista) . "&fmt=".$fmt;

		//get the ID
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'CdBase');
		$response = curl_exec($ch);

		curl_close($ch);
		$response = json_decode($response, JSON_FORCE_OBJECT);
		$i = 0;

		while ($response["releases"][$i]["title"] != $titulo && $i <(count($response["releases"])-1)) {
			$i++;
		}

		if ($response["releases"][$i]["title"] == $titulo) {
			$this->type = $response["releases"][$i]["media"][0]["format"];
			$this->deluxe = $this->isDeluxe($albumtitle);
			$this->year=substr($response["releases"][$i]["release-events"][0]["date"], 0, 4);
		}
		else {
			$this->type = null;
			$this->year=null;
			$this->deluxe=null;
		}
	}

	public function getminutes(){
		return  (int)((int)$this->time/ 60);
	}

	public function getseconds(){
		return   (int)$this->time - ($this->getminutes() * 60);
	}

	public function getTimeAlbum(){
		$url = "http://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=" . $this->API_KEY . "&artist=" . $this->artista . "&album=" . $this->titulo . "&format=json";


		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'CdBase');

		$response = curl_exec($ch);

		curl_close($ch);
		$response = json_decode($response, JSON_FORCE_OBJECT);

		$song_list = $response["album"]["tracks"]["track"];
		$time_total=0;

		for ($i = 0; $i < count($song_list); $i++) {
			$time_total =$time_total+(int)((int)$song_list[$i]["duration"]);
		}

		$this->time = $time_total;
	}

	public function createAlbumRand($artista1){
		$url = "http://ws.audioscrobbler.com/2.0/?method=artist.gettopalbums&artist=" . $artista1 . "&api_key=" . $this->API_KEY . "&format=json";

		//get the ID
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'CdBase');

		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, JSON_FORCE_OBJECT);

		$numer = rand(0, count($response["topalbums"]["album"]));

		$this->id = $response["topalbums"]["album"][$numer]["mbid"];

		//get the title
		$this->titulo = $response["topalbums"]["album"][$numer]["name"];

		//get the artist
		$this->artista = $response["topalbums"]["album"][$numer]["artist"]["name"];

		$this->genres = $this->setGenress($response["album"]["tags"]["tag"]);
		$this->getTypeandYear($this->artista, $this->titulo);
		$this->getTimeAlbum();
		$this->addAlbumtoBd();

		if ($this->getTitulo() == null) {
			return $this->createAlbumRand($artista1);
		}

		return $this;
	}

	public function createAlbumSearched($artista1, $albumtitle){
		$url = "http://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=" . $this->API_KEY . "&artist=" . urlencode($artista1) . "&album=" . urlencode($albumtitle) . "&format=json";

		//get the ID
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'CdBase');

		$response = curl_exec($ch);

		curl_close($ch);
		$response = json_decode($response, JSON_FORCE_OBJECT);


		$this->id = $response["album"]["mbid"];

		//get the title
		$this->titulo = $response["album"]["name"];

		//get the artist
		$this->artista = $response["album"]["artist"];
		$this->genres=$this->setGenress($response["album"]["tags"]["tag"]);
		$this->getTypeandYear($this->artista, $this->titulo);
		$this->getTimeAlbum();
		$this->addAlbumtoBd();

		return $this;
	}

	public function printSongs(){
		$url = "http://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=" . $this->API_KEY . "&artist=" . $this->artista . "&album=" . $this->titulo . "&format=json";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'CdBase');

		$response = curl_exec($ch);

		curl_close($ch);
		$response = json_decode($response, JSON_FORCE_OBJECT);

		$song_list = $response["album"]["tracks"]["track"];

		for ($i = 0; $i < count($song_list); $i++) {
			$time_min = (int)((int)$song_list[$i]["duration"] / 60);
			$time_sec = (int)$song_list[$i]["duration"] - ($time_min * 60);

			echo "<div class=\"songs\">" . $song_list[$i]["name"] . " - " . $time_min . ":" . $time_sec . "\n</div>\n";
		}
	}

	public function createAlbumRandByTag($tag){
		$url = "http://ws.audioscrobbler.com/2.0/?method=tag.gettopalbums&tag=" . $tag . "&api_key=" . $this->API_KEY . "&format=json";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'CdBase');

		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, JSON_FORCE_OBJECT);

		$top_albums_tag = $response["albums"]["album"];

		$rand_num = rand(0, count($top_albums_tag));

		$this->titulo = $top_albums_tag[$rand_num]["name"];
		$this->artista = $top_albums_tag[$rand_num]["artist"]["name"];
		$this->id = $top_albums_tag[$rand_num]["mbid"];
		$this->getTypeandYear($this->artista, $this->titulo);
		$this->getTimeAlbum();
		$this->addAlbumtoBd();

		if ($this==null) {
			return createAlbumRandByTag($tag);
		}
		else {
			return $this;
		}
	}

	public function createAlbumByTitle($title_search){
		$url = "http://ws.audioscrobbler.com/2.0/?method=album.search&album=" . $title_search . "&api_key=" . $this->API_KEY . "&format=json";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'CdBase');

		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, JSON_FORCE_OBJECT);

		$this->titulo = $response["results"]["albummatches"]["album"][1]["name"];
		$this->artista = $response["results"]["albummatches"]["album"][1]["artist"];
		$this->id = $response["results"]["albummatches"]["album"][1]["mbid"];
		$this->getTypeandYear($this->artista, $this->titulo);
		$this->getTimeAlbum();
		$this->addAlbumtoBd();

		if ($this == null) {
			return createAlbumByTitle($title_search);
		}
		else {
			return $this;
		}
	}
}

?>
