<?php
class GDSong {
	public $songID;
	public $download;
	public $name;
	public $creator;
	public $size;
	public $fullString;
	
	public function __construct ($i2, $i, $s = null){
		include __DIR__."/../config/config.php";
		$host = $i2."/getGJSongInfo.php";
		$ch = curl_init ($host);
		$post["songID"] = $i;
		$post["secret"] = $secret;
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
		if ($s == true){
			if (curl_exec ($ch) == "-1" OR curl_exec ($ch) == ""){
					echo "Not Found";
				} else {
					echo "Found It";
				}
			}
		$info = explode ("~|~", curl_exec ($ch));
		$this->fullString = curl_exec ($ch);
		$this->songID = $info[1];
		$this->name = $info[3];
		$this->creator = $info[7];
		$this->download = $info[13];
		$this->size = $info[9];
		}
	public function getArray (){
		print_r (explode ("~|~", $this->fullString));
		}
	public function result (){
		return $this->fullString;
		}
	public function getDownloadLink (){
		// I don't want to use urldecode() function because somestring are not completed
		$downloadLink = str_replace ("%3A", ":", $this->download);
		$downloadLink = str_replace ("%2F", "/", $downloadLink);
		return $downloadLink;
		}
	public function getTitle (){
		return $this->name;
		}
	public function getCreator (){
		return $this->creator;
		}
	public function getSize (){
		if ($this->size == 0){
				$sizeSong = "N/A";
			} else {
				$sizeSong = round ($this->size / 1024 / 1024, 2);
			}
		return $sizeSong;
		}
	public function downloadSong (){
		$downloadLink = $this->getDownloadLink();
		$ch = curl_init ($downloadLink);
		$name = $this->creator."_-_". $this->name.".mp3";
		header ("content-type: audio/mpeg");
		header('Content-Disposition: attachment; filename="'. $name.'"');
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		echo curl_exec ($ch);
		}
	}