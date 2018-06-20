<?php
// prihvatanje podataka sa index.php strane i popunjavanje nekih polja na strani rezervacije
// popunjavanje nekih polja u sesiji
// uklanjanje iskacuceg prozora pomocu - Session::setKey('prozor', false);
// smestanje objekta sa podacima iz ponude u sesiju
require "classes.php";
Session::newInstance();
Session::setKey('prozor', false);

class Obrada{

	 function obradaRezervacije(){
		$pdo = Konekcija::getInstance();
		if(isset($_POST['dugmeRezervacija'])){
			$id = $_POST['id'];
			$q = $pdo->query("select * from ponuda where id = {$id}");
			$red = $q->fetch(PDO::FETCH_OBJ);
			Session::setKey('zaRezervaciju', $red);

			$izborSobe = $_POST['izborSobe'];
			switch($izborSobe){
					case 1:
						$izborSobeIspis = "jednokrevetna";
						break;
					case 2:
						$izborSobeIspis = "dvokrevetna";
						break;
					case 3:
						$izborSobeIspis = "trokrevetna";
						break;
					case 4:
						$izborSobeIspis = "cetvorokrevetna";
						break;
					default:
						$izborSobeIspis = "Niste izabrali tip sobe";
				}
			Session::setKey('izborSobeIspis', $izborSobeIspis);
			Session::setKey('izborSobe', $izborSobe);
			$_SESSION['prozor']=="start";
			if(isset($_SESSION['zaRezervaciju'])){
				Session::setKey('prozor', true);
			}
			header("location: index.php");
		}
	}
}

$o = new Obrada;
$o->obradaRezervacije();


