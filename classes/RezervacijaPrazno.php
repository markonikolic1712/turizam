<?php
Session::newInstance();


class RezervacijaPrazno {

	static function prazno(){
		$pdo = Konekcija::getInstance();
		if(!isset($_SESSION['zaRezervaciju'])){
			$q = $pdo->query("select * from ponuda where id = 1");
			$red = $q->fetch(PDO::FETCH_OBJ);
			$red->cena = "";
			Session::setKey('zaRezervaciju', $red);
			Session::setKey('izborSobeIspis', "");
			Session::setKey('izborSobe', "");
		}
		$izborSobeIspis = Session::getValue('izborSobeIspis');
		$izborSobe = Session::getValue('izborSobe');
		$ponuda = Session::getValue('zaRezervaciju');
	}
}



