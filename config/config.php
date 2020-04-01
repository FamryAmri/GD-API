<?php
//Don't change anything in variables secret ($secret)
$secret = "Wmfd2893gb7";
$gameVersion = "21";
$binaryVersion = "35";

//Configuration of Library including php.ini
$config["display_errors"] = "On"; #if turn off they will be happen to 500 external errors
														#if your code is incorrect something
														
$config["logs"] = "Off"; //make large storage like cache
$config["CA"] = "On"; //recommended Turn On
$config["pathCA"] = "../ssl/cacert.pem"; //to path certificate 