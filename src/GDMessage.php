<?php
class GDMessage {
	protected $host;
	protected $username;
	private static $password;
	private static $gjp;
	public $messages;
	public $accID;
	public $usrID;
	
	public function cipher($plaintext, $key) {
		$key = $this->text2ascii($key);
		$plaintext = $this->text2ascii($plaintext);

		$keysize = count($key);
		$input_size = count($plaintext);

		$cipher = "";
		
		for ($i = 0; $i < $input_size; $i++)
			$cipher .= chr($plaintext[$i] ^ $key[$i % $keysize]);

		return $cipher;
		}

	public function crack($cipher, $keysize) {
		$cipher = $this->text2ascii($cipher);
		$occurences = $key = array();
		$input_size = count($cipher);

		for ($i = 0; $i < $input_size; $i++) {
			$j = $i % $keysize;
			if (++$occurences[$j][$cipher[$i]] > $occurences[$j][$key[$j]])
				$key[$j] = $cipher[$i];
				}

		return $this->ascii2text(array_map(function($v) { return $v ^ 32; }, $key));
		}

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
	public function __construct ($h, $u, $p){
		include __DIR__."/../config/config.php";
		$this->username = $u;
		$this->host = $h;
		self::$password = $p;
		$gjp = $this->plaintext (self::$password, 37526);
		$gp = base64_encode ($gjp);
		self::$gjp = $gp;
		$udid = "S" . mt_rand(111111111,999999999) . mt_rand(111111111,999999999) . mt_rand(111111111,999999999) . mt_rand(111111111,999999999) . mt_rand(1,9); 
		$sid = mt_rand(111111111,999999999) . mt_rand(11111111,99999999);
		$ch = curl_init ($this->host."/accounts/loginGJAccount.php");
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, ["udid" => $udid, "sID" => $sid,"userName" => $u, "password" => $p, "secret" => "Wmfv3899gc9"]);
		$res = curl_exec ($ch);
		if ($res == "-1"){
			include __DIR__."/Exception/GDErrors.php";
			$err = new GDErrors ($h);
			GDErrors::GDLogin();
			} elseif ($res == "-12"){
				echo "Banned?";
				}
			$res = explode (",", $res);
		$this->accID = $res[0];
		$this->usrID = $res[1];
		}
	public function getMessage ($pgm = 0){
		include __DIR__."/../config/config.php";
		$url = $this->host."/getGJMessages20.php";
		$ch = curl_init ($url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, ["accountID" => $this->accID, "page" => $pgm, "getSent" => 0, "gjp" => self::$gjp, "secret" => $secret]);
		$res = curl_exec ($ch);
		if ($res == "-1"){
				return "Nothing here";
			} else {
				$info = explode ("#", $res)[0];
				$info = explode ("|", $info);
					foreach ($info as $fetch){
						$msg = explode (":", $fetch);
						$arr[] = ["username" => $msg[1], "userID" => $msg[3], "accountID" => $msg[5], "msg" => array("subject" => str_replace ("☆", "", base64_decode ($msg[9])), "messageID" => $msg [7], "sentDate" => $msg[15])];
						}
					return $arr;
				}
		}
	public function readMessage (int $mk){
		include __DIR__."/../config/config.php";
		$url = $this->host."/downloadGJMessage20.php";
		$ch = curl_init ($url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, ["accountID" => $this->accID, "secret" => $secret, "gjp" => self::$gjp, "messageID" => $mk]);
		$res = curl_exec ($ch);
		$info = explode (":", $res);
		$message = $this->cipher (base64_decode($info[15]), 14251);
		//return $info;
		return ["username" => $info[1], "userID" => $info[3], "accountID" => $info[5], "msg" => ["subject" => str_replace ("☆", "", base64_decode ($info[9])), "message" => $message, "sentDate" => $info[17]]];
		}
	public function deleteMessage (int $o){
		include __DIR__."/../config/config.php";
		$messageID = $o;
		$post = ["accountID" => $this->accID, "gjp" => self::$gjp, "messageID" => $messageID, "secret" => $secret];
		$ch = curl_init ($this->host."/deleteGJMessages20.php");
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
		echo curl_exec ($ch);
		}
	public function sendMessage (string $m, string $s, int $t){
		include __DIR__."/../config/config.php";
		
		$message = $this->cipher ($s, 14251);
		$message = base64_encode ($message);
		
		$subject = base64_encode ($m);
		$toAccount = $t;
		$ch = curl_init ($this->host."/uploadGJMessage20.php");
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, ["toAccountID" => $toAccount, "accountID" => $this->accID, "gjp" => self::$gjp, "body" => $message, "subject" => $subject, "secret" => $secret]);
		return curl_exec ($ch);
		}
	}