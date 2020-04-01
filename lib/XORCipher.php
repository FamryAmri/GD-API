<?php
	function cipher($plaintext, $key) {
		$key = text2ascii($key);
		$plaintext = text2ascii($plaintext);

		$keysize = count($key);
		$input_size = count($plaintext);

		$cipher = "";
		
		for ($i = 0; $i < $input_size; $i++)
			$cipher .= chr($plaintext[$i] ^ $key[$i % $keysize]);

		return $cipher;
	}

	function crack($cipher, $keysize) {
		$cipher = text2ascii($cipher);
		$occurences = $key = array();
		$input_size = count($cipher);

		for ($i = 0; $i < $input_size; $i++) {
			$j = $i % $keysize;
			if (++$occurences[$j][$cipher[$i]] > $occurences[$j][$key[$j]])
				$key[$j] = $cipher[$i];
		}

		return ascii2text(array_map(function($v) { return $v ^ 32; }, $key));
	}

 function plaintext($cipher, $key) {
		$key = text2ascii($key);
		$cipher = text2ascii($cipher);
		$keysize = count($key);
		$input_size = count($cipher);
		$plaintext = "";
		
		for ($i = 0; $i < $input_size; $i++)
			$plaintext .= chr($cipher[$i] ^ $key[$i % $keysize]);

		return $plaintext;
	}

	function text2ascii($text) {
		return array_map('ord', str_split($text));
	}

	function ascii2text($ascii) {
		$text = "";

		foreach($ascii as $char)
			$text .= chr($char);

		return $text;
	}
	
	function xorEncrypt ($plaintxt, $keys){
		$xor = cipher ($plaintxt, $keys);
		$xor = base64_encode ($xor);
		return $xor;
		}
	
	function xorDecrypt ($cipher, $keys){
		$cip = base64_decode ($cipher);
		$plaintext = plaintext ($cip, $keys);
		return $plaintext;
		}
		
	function rsGen (){
		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$rs = substr (str_shuffle ($str),0 ,10);
		return $rs;
		}
		
	function udidGen (){
		$str1 = array ("00000000", "ffffffff"); $str2 = "abcdef1234567890";
		$a = $str1[mt_rand (0, count ($str1) - 1)];
		$b = substr (str_shuffle ($str2), 0, 4);
		$c = substr (str_shuffle ($str2), 0, 4);
		$d = substr (str_shuffle ($str2), 0, 12);
		
		$udid = $a."-". $b."-". $c."-". $d;
		return $udid;
		}