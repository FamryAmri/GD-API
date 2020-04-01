<?php
class GDProfile {
	public $accID;
	public $demon;
	public $stars;
	public $cp;
	public $coins;
	public $diamond;
	public $goldCoins;
	public $usrID;
	public $fullString;
	public $youtube;
	public $twitter;
	public $twitch;
	public $userName;
	public $icon;
	public $ship;
	public $ball;
	public $ufo;
	public $wave;
	public $robot;
	public $glow;
	public $color1;
	public $color2;
	
	public function __construct ($u, $a, $s = null){
		include __DIR__."/../config/config.php";
		$tar = $a;
		$host = $u;
		$ch = curl_init ($host."/getGJUserInfo20.php");
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, ["targetAccountID" => $tar, "secret" => $secret]);
		if ($s == true){
			if (curl_exec ($ch) == "1"){
				echo "Not Found";
				} else {
				echo "Found it";
				}
			}
		$this->fullString = curl_exec ($ch);
		$info = explode (":", curl_exec ($ch));
		$this->userName = $info[1];
		$this->usrID = $info[3];
		$this->coins = $info[7];
		$this->accID = $a;
		$this->demon = $info[17];
		$this->stars = $info[13];
		$this->diamond = $info[15];
		$this->goldCoins = $info[5];
		$this->cp = $info[19];
		$this->youtube = $info[27];
		$this->twitter = $info[53];
		$this->twitch = $info[55];
		$this->icon = $info[29];
		$this->ship = $info[31];
		$this->ball = $info[33];
		$this->ufo = $info[35];
		$this->wave = $info[37];
		$this->robot = $info[39];
		$this->glow = $info[41];
		$this->color1 = $info[9];
		$this->color2 = $info[11];
		}
	public function getArray (){
		print_r (explode (":", $this->fullString));
		}
	public function getFullString (){
		return $this->fullString;
		}
	public function getUserID (){
		return $this->usrID;
		}
	public function getAccountID (){
		return $this->accID;
		}
	public function getCoins (){
		return $this->coins;
		}
	public function getGoldCoins (){
		return $this->goldCoins;
		}
	public function getCP (){
		return $this->cp;
		}
	public function getDemon (){
		return $this->demon;
		}
	public function getStars (){
		return $this->stars;
		}
	public function getYouTube (){
		return $this->youtube;
		}
	public function getTwitter (){
		return $this->twitter;
		}
	public function getTwitch (){
		return $this->twitch;
		}
	public function getUsername (){
		return $this->userName;
		}
	public function getDiamonds (){
		return $this->diamond;
		}
	public function getIcon ($tpe = "icon"){
			switch ($tpe){
				case "ship":
				$iconID = $this->ship;
				break;
				case "ball":
				$iconID = $this->ball;
				break;
				case "ufo":
				$iconID = $this->ufo;
				break;
				case "robot":
				$iconID = $this->robot;
				break;
				default:
				$iconID = $this->icon;
				break;
			}
			if ($this->glow == 1){
				$glw = "&glow=1";
				}
			//Taken Api From GDBrowser.. Thanks, GDColon :)
		$icon = 'https://gdbrowser.com/icon/1?form='.$tpe.'&col1='.$this->color1.'&col2='.$this->color2.'&icon='.$iconID. $glw;
		return '<img src="'. $icon.'" alt="'.$icon.'"/>';
		}
	}