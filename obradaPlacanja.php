<?php

require "classes.php";

Session::newInstance();


$placanjePodaci = new Placanje;

$ponuda = Session::getValue('zaRezervaciju');
$placanjePodaci->izborSobeIspis = Session::getValue('izborSobeIspis');
$izborSobe = Session::getValue('izborSobe');
$placanjePodaci->ukupnoPoDanu = $izborSobe * $ponuda->cena;
$placanjePodaci->cenaPoLezaju = $ponuda->cena;
$placanjePodaci->idPonude = $ponuda->id;
$placanjePodaci->hotel = $ponuda->hotel;
$placanjePodaci->ukupnoZaUplatu = $_POST['ukupnoZaUplatu'];
if(isset($_POST['datumDolaska'])){
	$d = $_POST['datumDolaska'];
	$date = new DateTime($d);
	$placanjePodaci->dolazak = $date->format('d.m.Y');
} else {
	$placanjePodaci->dolazak = date('d.m.Y');
}
$placanjePodaci->odlazak = $_POST['odlazakDatum'];
$placanjePodaci->brojNocenja = $_POST['nocenja'];
$placanjePodaci->ime = $_POST['ime'];
$placanjePodaci->prezime = $_POST['prezime'];
$placanjePodaci->email = $_POST['email'];
$placanjePodaci->brojKartice = $_POST['brojKartice'];
$placanjePodaci->vremePlacanja = date('d.m.Y H:i:s');
//provera podataka o placanju
$placanjePodaci->provera();
//unos podataka o placanju u bazu
$placanjePodaci->unesi();



// unos podataka klijenta u tabelu klijenata
$klijent = new Klijenti;
$idPlacanja = $placanjePodaci->poslednjiId();
$klijent->unesiKlijenta($placanjePodaci, $idPlacanja);


// kreiranje novog taba za racun PDF
//echo 	"<script>window.location = 'rezervacije.php';</script>";
echo "<script>window.location = ('racunPDF.php');</script>";









