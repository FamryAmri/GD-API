<?php
class GDRegister {
	public function __construct ($h, $u, $p, $e){
		include __DIR__."/../config/config.php";
		$url = $h."/accounts/registerGJAccount.php";
		
		$username = $u;
		$password = $p;
		$email = $e;
		
		$post["userName"] = $username;
		$post["password"] = $password;
		$post["email"] = $email;
		$post["secret"] = "Wmfv3899gc9";
		
		$ch = curl_init ($url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
		$res = curl_exec ($ch);
		}
	}