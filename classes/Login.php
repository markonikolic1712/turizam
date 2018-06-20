<?php
require "Konekcija.php";

class Login {

	public static function provera(){
		if(isset($_POST['dugmeLogin']) && (!isset($_POST['username']) || !isset($_POST['password']))){
           		$administrator = false;
                die();
              } else if(isset($_POST['dugmeLogin']) && isset($_POST['username']) && isset($_POST['password'])){
                $username = $_POST['username'];
                $password = $_POST['password'];
                Login::logovanje($username, $password);
                $administrator = true;
                header("location: loginStrana.php");
              }
        if(isset($_POST['dugmeLogout'])){
            if(isset($_SESSION['userName'])) Session::unsetKey('userName');
            if(isset($_SESSION['userStatus'])) Session::unsetKey('userStatus');
                $administrator = false;
                header("location: loginStrana.php");
              }
		}

	public static function logovanje($username, $password){
		
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
		$query =  $pdo->query("select * from users where users = '{$username}' and password = '{$password}' limit 1");
		$user = $query->fetch(PDO::FETCH_OBJ);
		if(isset($user->users)){
			Session::newInstance();
			Session::setKey('userStatus', $user->status);
			Session::setKey('userName', $user->users);

			if(isset($_SESSION['userStatus']) || $_SESSION['userStatus']==1){
				echo '<p style="text-align: center">Ulogovani ste kao '.$user->users.'</p>';
				}
			} else {
				echo '<p style="text-align: center">Pogrešan unos korisničkog imena ili lozinke</p>';
			}
    	}
}
