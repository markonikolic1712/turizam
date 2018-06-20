<?php

class Klijenti extends RadSaBazom {

    public $idKlijenta;
    public $ime;
    public $prezime;
    public $email;
    public $brojKartice;
    public $idPlacanja;
    public static $tabela = "klijenti";
    public static $imeKljuca = "idKlijenta";

    public function unesiKlijenta($klijent, $idPlacanja) {
        $zaUnos = new Klijenti;
        $zaUnos->ime = $klijent->ime;
        $zaUnos->prezime = $klijent->prezime;
        $zaUnos->email = $klijent->email;
        $zaUnos->brojKartice = $klijent->brojKartice;
        $zaUnos->idPlacanja = $idPlacanja;
        $zaUnos->unesi();
    }

}

?>