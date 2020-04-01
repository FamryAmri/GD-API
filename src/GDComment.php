<?php
class GDComment {
	protected $username;
	protected $password;
	protected $gjp;
	public $usrID;
	protected $accID;
	public $host;
	public $page = 0;
	
	private function getServerIp (){
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		        $ip = $_SERVER['HTTP_CLIENT_IP'];
		    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		    }elseif(!empty($_SERVER["REMOTE_ADDR"])){
		        $ip = $_SERVER['REMOTE_ADDR'];
		    }
	    return $ip;
	}
	
//Copied From XORCipher :v
	public function plaintext($cipher, $key) {
		$key = $this->text2ascii($key);
		$cipher = $this->text2ascii($cipher);
		$keysize = count($key);
		$input_size = count($cipher);
		$plaintext = "";
		
		for ($i = 0; $i < $input_size; $i++)
			$plaintext .= chr($cipher[$i] ^ $key[$i % $keysize]);

		return $plaintext;
	}

	private function text2ascii($text) {
		return array_map('ord', str_split($text));
	}

	private function ascii2text($ascii) {
		$text = "";

		foreach($ascii as $char)
			$text .= chr($char);

		return $text;
		}
//Until here

	public function __construct ($h, $u, $p, $s = null){
		include __DIR__."/../config/config.php";
		$this->host = $h;
		$this->username = $u;
		$this->password = $p;
		$udid = "S" . mt_rand(111111111,999999999) . mt_rand(111111111,999999999) . mt_rand(111111111,999999999) . mt_rand(111111111,999999999) . mt_rand(1,9); 
		$sid = mt_rand(111111111,999999999) . mt_rand(11111111,99999999);
		$ch = curl_init ();
		curl_setopt ($ch, CURLOPT_URL, $this->host."/accounts/loginGJAccount.php");
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, ["secret" => "Wmfv3899gc9", "userName" => $this->username, "password" => $this->password, "udid" => $udid, "sID" => $sid]);
		$info = explode (",", curl_exec ($ch));
		$this->usrID = $info[1];
		$this->accID = $info[0];
		if (curl_exec ($ch) == "-1"){
			include __DIR__."/Exception/GDErrors.php";
			$err = new GDErrors ($this->host);
			GDErrors::GDLogin();
			}
		$convert = $this->plaintext ($this->password, 37526);
		$pass = base64_encode ($convert);
		$this->gjp = $pass;
		}
		
	public function postAccComment ($t, bool $bool = false){
		include __DIR__."/../config/config.php";
		$comment = base64_encode($t);
		$ch = curl_init ($this->host."/uploadGJAccComment20.php");
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, ["userName" => $this->username, "gjp" => $this->gjp, "comment" => $comment, "accountID" => $this->accID, "secret" => $secret]);
		$res = curl_exec ($ch);
		if ($res == "-1"){
			include __DIR__."/Exception/GDErrors.php";
			$err = new GDErrors ($this->host);
			if ($bool = false){
				GDErrors::GDAccPostComment();
				} elseif ($bool = true){
					echo $res;
					}
			} else {
				echo $res;
				}
		}
		
	public function postComment (string $t, int $l, $bool = false){
		include __DIR__."/../config/config.php";
		$comment = base64_encode ($t);
		$levelID = $l;
		
		$chk = "";
		$percent = 0;
		$chk = $this->username. $comment. $levelID. $percent. "0xPT6iUrtws0J";
		$chk = sha1($chk);
		$chk = $this->plaintext ($chk, 29481);
		$chk = base64_encode ($chk);
		//$chk = "UA4BDAQBC1IPVQUMVw0AUAoCWlAAAFFZUwBYBg0JVFoCWwlWC1cPAQ==";
		
		$ch = curl_init ($this->host."/uploadGJComment21.php");
		$headers = array ("X-FORWARDED-FOR: ". $this->getServerIp());
		curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, ["userName" => $this->username, "gjp" => $this->gjp,"chk" => $chk, "accountID" => $this->accID, "gameVersion" => $gameVersion, "binaryVersion" => $binaryVersion, "comment" => $comment, "levelID" => $levelID, "percent" => $percent, "secret" => $secret]);
		if (curl_exec($ch) == "-1"){
			include __DIR__."/Exception/GDErrors.php";
			$err = new GDErrors ($this->host);
				if ($bool = false){
					GDErrors::GDPostComment ($levelID);
				} elseif ($bool = true){
					return curl_exec ($ch)."/". $chk."/". $gameVersion."/". $this->gjp."\/". $comment."/". $secret."/". $this->accID."/". $this->username;
				}
			} else {
				return curl_exec ($ch);
				}
		}
		
	public function getGJP(){
		return $this->gjp;
		}
		
	public function fetchComment ($i, $m = 0, $c = 0){
		include __DIR__."/../config/config.php";
		$url = $this->host."/getGJComments21.php";
		$levelID = $i;
		$ch = curl_init ($url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, ["secret" => $secret, "levelID" => $levelID, "gameVersion" => $gameVersion, "binaryVersion" => $binaryVersion, "mode" => $m, "page" => $c, "count" => 10]);
		$arr = explode ("#", curl_exec ($ch))[0];
		$arr = explode ("|", $arr);
			foreach ( $arr as $fetch){
				$count = $count + 1;
				$arrs = explode ("~", $fetch);
				if ($arrs[3] !== NULL){
				$timeArr = array ("second", "seconds", "minute", "minutes", "hour", "hours", "day", "days", "week", "weeks", "month", "months", "year", "years");
				foreach ($timeArr as $times){
				if (strpos ($arrs[11], $times)){
						$postAt = $arrs[11];
					} else {
						$postAt = $arrs[11]." ago";
						}
					}
					$percent = $arrs[9]."%";
				$arrCom[] = ["Username" => $arrs[14], "Comment" => base64_decode ($arrs[1]), "PostAt" => $postAt, "likes" => $arrs[5], "UserID" => $arrs[3], "commentID" => explode (":", $arrs[13])[0], "percent" => $percent];
					}
			}
			if (explode("#", curl_exec ($ch))[0] !== NULL){
				return $arrCom;
			} else {
				return [];
			}
		}

	public function setAccountID (int $a){
		$this->accID = $a;
		}
		
	public function setPage (int $m){
		$this->page = $m;
		}
		
	public function setUserID (int $m){
		$this->usrID = $m;
		}
		
	private function getPage (){
		return $this->page;
		}
		
	public function fetchAccComment (){
		include __DIR__."/../config/config.php";
		$url = $this->host."/getGJAccountComments20.php";
		$accounts = $this->accID;
		$page = $this->getPage ();
		$ch = curl_init ($url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, [
															"gameVersion" => $gameVersion, 
															"binaryVersion" => $binaryVersion, 
															"secret" => $secret,
															"accountID" => $accounts,
															"page" => $page,
															"total" => 10]);

		$result = curl_exec ($ch);
		$result = explode ("#", $result)[0];
			$result = explode ("|", $result);
				foreach ( $result as $info){
					$info = explode ("~", $info);
					if (strpos ($this->host, "boomlings.com")){
						$comment[] = array ("ID" => $info[7], "AccComment" => base64_decode ($info[1]), "Likes" => $info[3], "postAt" => $info[5]);
					} else {
						$comment[] = array ("ID" => $info[13], "AccComment" => base64_decode ($info[1]), "Likes" => $info[5], "postAt" => $info[11]);
					}
				}
				if ($info[7] == NULL){
						return [];
					} else {
						return $comment;
					}
		}
		
	public function fetchCommentHistory ($m = 0){
		include __DIR__."/../config/config.php";
		$host = $this->host."/getGJCommentHistory.php";
		
		$userID = $this->usrID;
		$page = $this->getPage ();
		
		$pst = ["gameVersion" => $gameVersion, "binaryVersion" => $binaryVersion, "userID" => $userID, "total" => 10, "secret" => $secret, "mode" => $m, "page" => $page];
		
		$ch = curl_init ($host);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $pst);
		
		$result = curl_exec ($ch);
		$result2 = explode ("#", $result)[0];
		$all = explode ("|", $result2);
		
		foreach ( $all as $i ){
			$info = explode ("~", $i);
			if (strpos ($this->host, "boomlings.com")){
				$arrComment[] = array ("LevelID" => $info[3], "Username" => $info[14], "AccountID" => $info[26], "UserID" => $info[5], "commentInfo" => array ("ID" => explode (":", $info[13])[0], "comment" => base64_decode ($info[1]), "postAt" => $info[11]));
			} else {
				$arrComment[] = array ("LevelID" => $info[1], "Username" => $info[22], "AccountID" => $info[36]);
			}
		}
		
		if ($arrComment[0]["LevelID"] !==NULL){
			return $arrComment;
		} else {
			return [];
			}
		}
	}