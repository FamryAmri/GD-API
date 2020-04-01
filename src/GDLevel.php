<?php
class GDLevel {
	protected $levelID;
	public $levelName;
	public $levelData;
	public $songID;
	public $description;
	public $fullString;
	public $object;
	public $SecString;
	public $downloads;
	public $userID;
	public $updateDate;
	public $uploadDate;
	public $stars;
	public $levelVersion;
	public $gameVersion;
	public $likes;
	public $coins;
	public $original;
	public $levelLength;
	public $coinsVerify;
	
	public function __construct ($h, $i, $n = null){
		include __DIR__."/../config/config.php";
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $h."/downloadGJLevel22.php");
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, ["levelID" => $i, "secret" => $secret]);
		$info = explode (":", curl_exec ($ch));
		
		$this->fullString = curl_exec ($ch);
		$this->levelID = $info[1];
		$this->levelData = $info[7];
		$this->levelName = $info[3];
		$this->description = $info[5];
		$this->songID = $info[49];
		$this->object = $info[37];
		$this->SecString = $info[65];
		$this->downloads = $info[17];
		$this->userID = $info[11];
		$this->uploadDate = $info[45];
		$this->updateDate = $info[47];
		$this->stars = $info[15];
		$this->audioTrack = $info[19];
		$this->levelVersion = $info[9];
		$this->gameVersion = $info[21];
		$this->likes = $info[23];
		$this->levelLength = $info[39];
		$this->original = $info[41];
		$this->coins = $info[53];
		$this->coinsVerify = $info[55];
		
		if($n == 1){
			if (curl_exec($ch) == "-1"){
				return "Not Found";
				} elseif (empty(curl_exec ($ch))){
					return "Error";
					} else {
						return "Found It";
						}
				}
		}
	public function downloadLevel ($p){
		file_put_contents ($p, $this->levelData);
		}
	public function getLevelName (){
		return $this->levelName;
		}
	public function getDescription(){
		return base64_decode ($this->description);
		}
	public function getFullString ($s = null){
		switch ($s){
			default:
		if ($this->fullString == "-1"){
			return "Not Found";
			} else {
				return $this->fullString;
				}
			break;
			case true:
		if ($this->fullString == "-1"){
			return "Not Found";
			} else {
				print_r (explode (":", $this->fullString));
				}
				break;
			}
		}
	public function getLevelID (){
		return $this->levelID;
		}
	public function getObject (){
		return $this->object;
		}
	public function getPassword (){
		$get = explode ("#", $this->SecString)[0];
		$get = xorDecrypt($get, 26364);
		$get = explode ("=", $get)[0];
		$get = substr ($get, 1);
		return $get;
		}
	public function getUserID (){
		return $this->userID;
		}
	public function getPopularity (){
		$arr = array ("download" => $this->downloads, "likes" => $this->likes);
		return $arr;
		}
	public function getInfo (){
		switch ($this->levelLength){
			case 0:
				$lvl = "Tiny";
				break;
			case 1:
				$lvl = "Short";
				break;
			case 2:
				$lvl = "Medium";
				break;
			case 3:
				$lvl = "Long";
				break;
			case 4:
				$lvl = "XL";
				break;
			default:
				$lvl = "Unknown";
				break;
			}
		if ($this->original == 0){
			$ori = "This level is original";
			} else {
			$ori = $this->original;
			}
		$arr = array ("uploaded" => $this->uploadDate, "updated" => $this->updateDate, "levelVersion" => $this->levelVersion, "gameVersion" => $this->gameVersion, "object" => $this->object, "original" => $ori, "levelLength" => $lvl);
		return $arr;
		}
	}
	