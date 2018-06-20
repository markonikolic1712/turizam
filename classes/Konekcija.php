<?php
 
class Konekcija {
	private static $konekcija;
	public static function getInstance(){
		if(!self::$konekcija){
			try {
					self::$konekcija = new PDO("mysql:host=".Config::DBHOST.";dbname=".Config::DBNAME,Config::DBUSER,Config::DBPASS);
					if(!self::$konekcija) throw new ConnectionException;
				} catch (Exception $ex) {
					echo "<p style='text-align:center; color:red; margin-top:100px; border:2px solid red;  padding:10px'>Doslo je do problema pri konektovanju sa bazom.</p>";
					die();
				}
		}
		return self::$konekcija;
	}
}