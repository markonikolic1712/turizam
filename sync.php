<?php
   
require "classes.php";


$document = new DOMDocument();
$document->load("http://192.168.0.109/turizam/xml/ponude.xml");
//$document->load("xml/ponude.xml");
$root = $document->documentElement;
$svePonude = $root->getElementsByTagName("ponuda");
$pdo = Konekcija::getInstance();
foreach ($svePonude as $jednaPonuda) {
    $unosId = $jednaPonuda->getAttribute("id");
    $unosCena = $jednaPonuda->getElementsByTagName("cena")->item(0)->nodeValue;
    $query = "update ponuda set cena = " . $unosCena . " where id = " . $unosId;
    $pdo->exec($query);
}
