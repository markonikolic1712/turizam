<?php

class UpisUXML {

    public $id;
    public $novaCena;

    public function snimiXML($id, $novaCena) {
        if(preg_match("/^[0-9]+$/", $novaCena)){
            $cenaZaUnos = $novaCena;
        } else {
            die("Pogresan unos");
        }
        $document = new DOMDocument();
        $document->load("ponude.xml");
        $root = $document->documentElement;
        $svePonude = $root->getElementsByTagName("ponuda");

        foreach ($svePonude as $jednaPonuda) {
            $ponuda = new PonudaXML;
            $ponuda->id = $jednaPonuda->getAttribute("id");
            if ($ponuda->id == $id) {
                $jednaPonuda->getElementsByTagName("cena")->item(0)->nodeValue = $cenaZaUnos;
            }
        }
        $document->save("ponude.xml");
    }
}
