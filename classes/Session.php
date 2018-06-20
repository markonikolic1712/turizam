<?php
class Session {

	private function __construct(){
		session_start();
	}

	private static $sesija;

	public static function newInstance(){
		if(!self::$sesija){
			self::$sesija = new Session;
		}
		return self::$sesija;
	}

	static function setKey($k, $v){
			$_SESSION[$k] = $v;
		}

	static function getValue($k){
			return $_SESSION[$k];
		}

	static function getUsername(){
			if(isset($_SESSION)){
			 	$username = array_keys($_SESSION)[0];
			 	$password = $_SESSION[$username];
			}
			return $username;
		}

	static function getPassword(){
			if(isset($_SESSION)){
			 	$username = array_keys($_SESSION)[0];
			 	$password = $_SESSION[$username];
			}
			return $password;
		}

	static function unsetKey($k){
			unset($_SESSION[$k]);
		}

	static function logout(){
			if(isset($_SESSION)){
				session_unset();
				session_destroy();
			}
			return;
		}

	static function logedAs(){
		if(isset($_SESSION['userName'])){
			 	$userName = $_SESSION['userName'];
			 	$logedAs = "ulogovani ste kao: ".$userName;
			} else {
				$logedAs = "niste ulogovani";
			}
			return $logedAs;
	}

	public static function newInstanceVlasnici(){
		if(!self::$sesija){
			self::$sesija = new Session;
		}
                
		return self::$sesija;
	}

	static function logedAsVlasnik(){
		if(isset($_SESSION['userNameVlasnik'])){
			 	$userName = $_SESSION['userNameVlasnik'];
			 	$logedAsVlasnik = "ulogovani ste kao: ".$userName;
			} else {
				$logedAsVlasnik = "niste ulogovani";
			}
			return $logedAsVlasnik;
	}
}




