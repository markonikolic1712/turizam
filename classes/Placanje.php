<?php

require "PDF/fpdf181/fpdf.php";

class Placanje extends RadSaBazom {

    public $id;
    public $ime;
    public $prezime;
    public $hotel;
    public $cenaPoLezaju;
    public $izborSobeIspis;
    public $ukupnoPoDanu;
    public $ukupnoZaUplatu;
    public $dolazak;
    public $odlazak;
    public $brojNocenja;
    public $email;
    public $brojKartice;
    public $idPonude;
    public $vremePlacanja;

    
    public static $tabela = "placanja";
    public static $imeKljuca = "id";
    
    public function provera(){
    	foreach ($this as $key => $value) {
    		if($key == 'brojKartice' || $key == 'hotel' || $key == 'vremePlacanja') continue;
    		$value = str_replace("'", "", $value);
			$value = str_replace("-", "", $value);
			$value = str_replace(" ", "", $value);
            $value = str_replace("Č", "C", $value);
            $value = str_replace("č", "c", $value);
            $value = str_replace("Ć", "C", $value);
            $value = str_replace("ć", "c", $value);
            $value = str_replace("Đ", "Dj", $value);
            $value = str_replace("đ", "dj", $value);
            $value = str_replace("Ž", "Z", $value);
            $value = str_replace("ž", "z", $value);
            $value = str_replace("Š", "S", $value);
            $value = str_replace("Š", "s", $value);
			$this->$key = $value;
    	}
    	return $this;
    }

    public static function radSaFakturom($idFakture){

        if(isset($_POST['dugmeFakturaObrisi'])){
            $faktura = new Placanje;
            $faktura->izbrisi($idFakture);
            header("location: loginStrana.php");
          }

        if(isset($_POST['dugmeFakturaStampaj'])){
            $faktura = new Placanje;
            $faktura->stampaj($idFakture);
          }
    }

    public function stampaj($idFakture){
        $this->id = $idFakture;
        $placeno = new Placanje;
        $zastampu = $placeno->prikaziPonudu($this->id);
        $brojFakture = explode(" ", $zastampu->vremePlacanja)[0]."/".$this->id;
        // KREIRANJE PDF-a
        // pravljenje strane A4 - širine 219mm
        // podrazumevana margina je 10mm, prostor za pisanje je 189mm
        ob_start();
        $pdf = new FPDF('p', 'mm','A4');
        $pdf->AddPage();
        //podešavanje fonta
        $pdf->SetFont('Arial','B',14);
        // problem ČĆĐ
        // utf8_decode('')
        // ćelija - Cell( sirina, visina, unos teksta, border(0,1), end line(0-continue,1-new line), [align](L-default, C, R) )
        // unosi se jedna po jedna ćelija
        $pdf->Cell(189, 20, '', 0, 1, 'C');
        $pdf->Cell(189, 10, iconv('UTF-8', 'windows-1252','UGOVOR - POTVRDA O ARANŽMANU'), 1, 1, 'C');
        $pdf->Cell(189, 10, '', 0, 1, 'C');
        $pdf->Cell(189, 8, iconv('UTF-8', 'windows-1252','DETALJI O ARANŽMANU'), 1, 1, 'C');
        $pdf->Cell(130, 10, '', 0, 0, 'R');
        $pdf->Cell(59, 10, "ugovarac:", 0, 1, 'L');
        $pdf->Cell(130, 10, 'ime:', 0, 0, 'R');
        $pdf->Cell(59, 10, $zastampu->ime, 1, 1, 'R');
        $pdf->Cell(130, 10, 'prezime:', 0, 0, 'R');
        $pdf->Cell(59, 10, $zastampu->prezime, 1, 1, 'R');
        $pdf->Cell(130, 10, 'e-mail:', 0, 0, 'R');
        $pdf->Cell(59, 10, $zastampu->email, 1, 1, 'R');
        $pdf->Cell(130, 10, '', 0, 0, 'R');
        $pdf->Cell(59, 10, iconv('UTF-8', 'windows-1252','smeštaj:'), 0, 1, 'L');
        $pdf->Cell(130, 10, 'hotel:', 0, 0, 'R');
        $pdf->Cell(59, 10, iconv('UTF-8', 'windows-1252',$zastampu->hotel), 1, 1, 'R');
        $pdf->Cell(130, 10, 'tip sobe:', 0, 0, 'R');
        $pdf->Cell(59, 10, iconv('UTF-8', 'windows-1252',$zastampu->izborSobeIspis), 1, 1, 'R');
        $pdf->Cell(130, 10, 'dolazak dana:', 0, 0, 'R');
        $pdf->Cell(59, 10, $zastampu->dolazak, 1, 1, 'R');
        $pdf->Cell(130, 10, 'odlazak dana:', 0, 0, 'R');
        $pdf->Cell(59, 10, $zastampu->odlazak, 1, 1, 'R');
        $pdf->Cell(130, 10, iconv('UTF-8', 'windows-1252','broj nocenja:'), 0, 0, 'R');
        $pdf->Cell(59, 10, $zastampu->brojNocenja, 1, 1, 'R');
        $pdf->Cell(130, 10, 'ukupno po danu:', 0, 0, 'R');
        $pdf->Cell(59, 10, $zastampu->ukupnoPoDanu, 1, 1, 'R');
        $pdf->Cell(130, 10, 'ukupno za uplatu:', 0, 0, 'R');
        $pdf->Cell(59, 10, $zastampu->ukupnoZaUplatu, 1, 1, 'R');
        $pdf->Cell(189, 10, '', 0, 1, 'C');
        $pdf->Cell(189, 8, iconv('UTF-8', 'windows-1252','DETALJI O PLACANJU'), 1, 1, 'C');
        $pdf->Cell(130, 10, 'broj fakture:', 0, 0, 'R');
        $pdf->Cell(59, 10, $brojFakture, 1, 1, 'R');
        $pdf->Cell(130, 10, 'placeno sa racuna:', 0, 0, 'R');
        $pdf->Cell(59, 10, $zastampu->brojKartice, 1, 1, 'R');
        $pdf->Cell(130, 10, 'vreme placanja:', 0, 0, 'R');
        $pdf->Cell(59, 10, $zastampu->vremePlacanja, 1, 1, 'R');
        $pdf->Output();
        ob_end_flush();
    }


}