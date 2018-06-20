<?php

class ApartmaniVlasnika {

    private $id;
    

    public function prikazApartmana($id) {
        $document = new DOMDocument();
        $document->load("ponude.xml");
        $root = $document->documentElement;
        $svePonude = $root->getElementsByTagName("ponuda");

        $apartmaniNiz = [];
        foreach ($svePonude as $jednaPonuda) {
            $ponuda = new PonudaXML;
            $ponuda->idVlasnika = $jednaPonuda->getElementsByTagName("idVlasnika")->item(0)->nodeValue;
            if ($id == $ponuda->idVlasnika) {
                $ponuda->id = $jednaPonuda->getAttribute("id");
                $ponuda->hotel = $jednaPonuda->getElementsByTagName("hotel")->item(0)->nodeValue;
                $ponuda->cena = $jednaPonuda->getElementsByTagName("cena")->item(0)->nodeValue;
                $apartmaniNiz[] = $ponuda;
            }
        }

        foreach ($apartmaniNiz as $apartman) {
            echo "<form action='' enctype='multipart/form-data' method='POST'>
                    <tr>
                      <td>Naziv:</td>
                      <td><input type='text' value='{$apartman->hotel}' name='hotel' disabled='true'/></td>
                    </tr>
                    <tr>
                      <td class='vlasnici_tabela_red'>Cena:</td>
                      <td  class='vlasnici_tabela_red'><input type='text' value=" . $apartman->cena . " name='cena' /></td>
                      <td><input class='vlasnici_tabela_dugme' type='submit' value='Izmeni cenu' name=" . $apartman->id . " /></td>
                    </tr>
                  </form>";
        }
    }
}
