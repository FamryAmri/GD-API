<?php
//Error handler
class GDErrors {
	public static $host;
	public static $config;
	
	public function __construct ($h2, $i = "On"){
		self::$host = $h2;
		self::$config = $i;
		}
	public static function GDLogin (){
		$str = "because cannot to connect to Host ". self::$host;
		if (self::$config == "On" || self::$config == "on"){
			throw new ErrorException ($str);
			}
		}
	public static function GDLevel (){
		$str = "because cannot find the level";
		if (self::$config == "On" || $config == "on"){
			throw new ErrorException ($str);
			}
		}
	public static function GDProfile (){
		$str = "because cannot find that user";
		if (self::$config == "On" || self::$config == "on"){
			throw new ErrorException ($str);
			}
		}
	public static function GDAccPostComment (){
		$str = "because cannot post into account comment, maybe that host is problem";
		if (self::$config == "On" || self::$config == "on"){
			throw new ErrorException ($str);
			}
		}
	public static function GDPostComment ($m){
		$str = "because cannot post into level comment, ". $m." is Invalid or that host is problem";
		if (self::$config == "On" || self::$config == "on"){
				throw new ErrorException ($str);
				}
		}
	}
		