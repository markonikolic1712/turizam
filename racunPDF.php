<?php
require "classes.php";

// kreiranje PDF-a - iz baze dolazi id poslednjeg reda
// PDF se kreira u klasi Placanje
$placeno = new Placanje;
$poslednjiId = $placeno->poslednjiId();


$zastampu = $placeno->prikaziPonudu($poslednjiId);
$zastampu->stampaj($poslednjiId);



