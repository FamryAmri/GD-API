<?php
class GDLike {
	public $host;
	public $username;
	public $password;
	public $gjp = "";
	public $accountID;
	public $userID;
	public $udid = 0;
	public $uuid = 0;
	
	public function __construct ($i, $u=null,  $p=null){
		if (!empty ($u) || !empty ($p)){
		include __DIR__."/../config/config.php";
		
		$this->host = $i;
		$this->username = $u;
		$this->password = $p;
		$this->gjp = xorEncrypt ($p, 37526);
		
		$url = $this->host."/accounts/loginGJAccount.php";
		
		//in array postfields
		$postfields["userName"] = $this->username;
		$postfields["password"] = $this->password;
		$postfields["secret"] = "Wmfv3899gc9";
		$postfields["udid"] = "S". mt_rand(111111111,999999999) . mt_rand(11111111,99999999).mt_rand(111111111,999999999) . mt_rand(11111111,99999999).mt_rand(1,9);
		$postfields["sID"] = mt_rand(111111111,999999999) . mt_rand(11111111,99999999);
		
		$ch = curl_init ($url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $postfields);
		$response = curl_exec ($ch);
		curl_close ($ch);
		if ($response == "-1"){
			include __DIR__."/Exception/GDErrors.php";
			if ($config["display_errors"] == "On" || $config["display_errors"] == "on"){
					$err = new GDErrors ($this->host);
					GDErrors::GDLogin();
				} else {
					return "-1";
					}
			} else {
				$this->accountID = explode (",", $response)[0];
				$this->userID = explode (",", $response)[1];
				return "1";
				}
			} else {
				$this->host = $i;
				$this->accountID = 0;
				$this->userID = 0;
				$this->udid = udidGen();
				$this->uuid = 0;
			}
		}
	public function likeLevel ($i){
		include __DIR__."/../config/config.php";
		
		$levelID = $i;
			
		//postfields
		$postfields["gameVersion"] = $gameVersion;
		$postfields["binaryVersion"] = $binaryVersion;
		$postfields["accountID"] = $this->accountID;
		$postfields["gjp"] = $this->gjp;
		$postfields["rs"] = rsGen();
		$postfields["itemID"] = $i;
		$postfields["like"] = 1;
		$postfields["type"] = 1;
		$postfields["udid"] = $this->udid;
		$postfields["uuid"] = $this->uuid;
		$postfields["special"] = 0;
		$chk = $postfields["special"]. $postfields["itemID"]. $postfields["like"]. $postfields["type"]. $postfields["rs"]. $postfields["accountID"]. $postfields["udid"]. $postfields["uuid"]. "ysg6pUrtjn0J";
		$chk = sha1 ($chk);
		$postfields["chk"] = xorEncrypt ($chk, 58281);
		$postfields["secret"] = $secret;
		
		$url = $this->host."/likeGJItem211.php";
		
		$ch = curl_init ($url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $postfields);
		$res = curl_exec ($ch);
		return $res;
		}
	public function likeComment ($i, $c){
		include __DIR__."/../config/config.php";
		
		$levelID = $i;
		$commentID = $c;
		
		//postfields
		$postfields["gameVersion"] = $gameVersion;
		$postfields["binaryVersion"] = $binaryVersion;
		$postfields["accountID"] = $this->accountID;
		$postfields["gjp"] = $this->gjp;
		$postfields["rs"] = rsGen();
		$postfields["itemID"] = $commentID;
		$postfields["like"] = 1;
		$postfields["type"] = 1;
		$postfields["udid"] = $this->udid;
		$postfields["uuid"] = $this->uuid;
		$postfields["special"] = $levelID;
		$chk = $postfields["special"]. $postfields["itemID"]. $postfields["like"]. $postfields["type"]. $postfields["rs"]. $postfields["accountID"]. $postfields["udid"]. $postfields["uuid"]. "ysg6pUrtjn0J";
		$chk = sha1 ($chk);
		$postfields["chk"] = xorEncrypt ($chk, 58281);
		$postfields["secret"] = $secret;
		
		$url = $this->host."/likeGJItem211.php";
		
		$ch = curl_init ($url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $postfields);
		$res = curl_exec ($ch);
		return $res;
		}
	public function likeAccComment ($i, $k){
		include __DIR__."/../config/config.php";
		
		$accountID = $i;
		$commentID = $k;
			
		//postfields
		$postfields["gameVersion"] = $gameVersion;
		$postfields["binaryVersion"] = $binaryVersion;
		$postfields["accountID"] = $this->accountID;
		$postfields["gjp"] = $this->gjp;
		$postfields["rs"] = rsGen();
		$postfields["itemID"] = $commentID;
		$postfields["like"] = 1;
		$postfields["type"] = 1;
		$postfields["udid"] = $this->udid;
		$postfields["uuid"] = $this->uuid;
		$postfields["special"] = $accountID;
		$chk = $postfields["special"]. $postfields["itemID"]. $postfields["like"]. $postfields["type"]. $postfields["rs"]. $postfields["accountID"]. $postfields["udid"]. $postfields["uuid"]. "ysg6pUrtjn0J";
		$chk = sha1 ($chk);
		$postfields["chk"] = xorEncrypt ($chk, 58281);
		$postfields["secret"] = $secret;
		
		$url = $this->host."/likeGJItem211.php";
		
		$ch = curl_init ($url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $postfields);
		$res = curl_exec ($ch);
		return $res;
		}
	}