<?php
//do not change any code over here
//just read it
chdir (dirname (__FILE__));
include "config.php";

//openssl
if ($config["CA"] == "On" || $config["CA"] == "on"){
	ini_set ("curl.cainfo", $config["pathCA"]);
	ini_set ("openssl.cafile", $config["pathCA"]);
	}

//500 external errors if you script is error
ini_set ("display_errors", $config["display_errors"]);

//logs function
function setLogs ($i, $p = "off"){
	if ($p == "On" || $p == "on"){
	      if (file_exists ("../logs/library.logs")){
	            $logs = file_get_contents ("../logs/library.logs")."\n";
	      } else {
	            $logs = $i;
	            $i = "";
	      }
	      if (function_exists (file_put_contents)){
	           file_put_contents ("../logs/library.logs", $logs. $i);
	      } else {
	           throw new ErrorException ("because file_put_contents() function has been block or deactive. if you want to run code.please turn off logs configuration");
	      }
	}
}
