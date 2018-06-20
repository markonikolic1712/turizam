<?php
require "Konekcija.php";

class LoginVlasnici {


	public static function proveraVlasnika(){
		if(isset($_POST['dugmeLogin']) && (!isset($_POST['username']) || !isset($_POST['password']))){
                die();
              } else if(isset($_POST['dugmeLogin']) && isset($_POST['username']) && isset($_POST['password'])){
                $username = $_POST['username'];
                $password = $_POST['password'];
                LoginVlasnici::logovanjeVlasnka($username, $password);
                header("location: index.php");
              }
        if(isset($_POST['dugmeLogout'])){
            if(isset($_SESSION['userNameVlasnik'])){
            	Session::unsetKey('userNameVlasnik');
            	Session::unsetKey('idVlasnika');
                header("location: index.php");
              }
        }
	}



	public static function logovanjeVlasnka($username, $password){
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		if(!isset($_POST['username']) || !isset($_POST['password'])){
			die();
		}
		$username = str_replace("'", "", $username);
		$username = str_replace("-", "", $username);
		$username = str_replace(" ", "", $username);
		$username = str_replace("`", "", $username);
		$password = str_replace("'", "", $password);
		$password = str_replace("-", "", $password);
		$password = str_replace(" ", "", $password);
		$password = str_replace("`", "", $password);
		
		$pdo = Konekcija::getInstance();
		$query =  $pdo->query("select * from vlasnici where users = '{$username}' and password = '{$password}' limit 1");
		$user = $query->fetch(PDO::FETCH_OBJ);
		if(isset($user->users)){
			Session::newInstance();
			Session::setKey('userNameVlasnik', $user->users);
			Session::setKey('idVlasnika', $user->idVlasnika);

			if(isset($_SESSION['userNameVlasnik'])){
				echo '<p style="text-align: center">Ulogovani ste kao '.$user->users.'</p>';
				}
			} else {
				echo '<p style="text-align: center">Pogrešan unos korisničkog imena ili lozinke</p>';
			}
    }
}
