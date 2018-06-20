<?php

class Administriranje extends RadSaBazom {

    public $id;
    public $hotel;
    public $cena;
    public $slika;
    
    public static $tabela = "ponuda";
    public static $imeKljuca = "id";

    public static function izvrsavanje(){

          if(isset($_POST['dugmeInsert'])){
            $ponuda = new Administriranje;
            $tmp_putanja = $_FILES['novaSlika']['tmp_name'];
            if(isset($_FILES['novaSlika'])){
              $upload = new Upload();
              $upload->uploaduj($_FILES['novaSlika']);
          }
            $nazivNoveSlike = $_FILES['novaSlika']['name'];
            $ponuda->hotel = $_POST['hotel'];
            $ponuda->cena = $_POST['cena'];
            $ponuda->slika = "images/" . $nazivNoveSlike;
            if($_FILES['novaSlika']['error'] == 0) $ponuda->unesi();
          }

          if(isset($_POST['dugmeUpdate'])){
            $ponuda = new Administriranje;
            $ponuda->id = ($_POST['id']);
            $ponuda->hotel = $_POST['hotel'];
            $ponuda->cena = $_POST['cena'];
            $ponuda->slika = $_POST['slika'];
            $ponuda->izmeni(($_POST['id']));
          }

          if(isset($_POST['dugmeDelete'])){
            $ponuda = new Administriranje;
            $ponuda->izbrisi($_POST['id']);
          }
    }
}