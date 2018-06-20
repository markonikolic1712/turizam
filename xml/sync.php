<?php
   
require "../classes.php";

// while(true){

$document = new DOMDocument();
//$document->load("http://polaznik.com/g6marko/turizam/xml/ponude.xml");
$document->load("ponude.xml");
$root = $document->documentElement;
$svePonude = $root->getElementsByTagName("ponuda");
$pdo = Konekcija::getInstance();
foreach ($svePonude as $jednaPonuda) {
    $unosId = $jednaPonuda->getAttribute("id");
    $unosCena = $jednaPonuda->getElementsByTagName("cena")->item(0)->nodeValue;
    $query = "update ponuda set cena = " . $unosCena . " where id = " . $unosId;
    $pdo->exec($query);
}


// sleep(3);
// }