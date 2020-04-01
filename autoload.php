<?php
chdir (dirname (__FILE__));
include "lib/XORCipher.php";
include "config/php.ini.php";
spl_autoload_register ("AutoLoader");

function AutoLoader ($nameClass){
	$path = __DIR__."/src/";
	$explode = ".php";
	$read = $path. $nameClass .$explode;
	
if (!file_exists ($read)){
	echo "because the file is not exists ". $read;
 return false;
}
	
	include_once ($read);
	}
?>


