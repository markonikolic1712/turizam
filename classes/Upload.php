<?php


class Upload{

	public $temp_slika;

	public function uploaduj($temp_slika){
		
	      	  $errors = false;
              $nazivNoveSlike = $temp_slika['name'];
              $velicina = $temp_slika['size'];
              $tmp_putanja = $temp_slika['tmp_name'];
              $tip_fajla = $temp_slika['type'];
            
            if($velicina > 2097152 || $velicina == 0){
               $errors = true;
               echo ('Fajl mora biti manji od 2 MB');
             } else if($velicina < 2048){
               $errors = true;
               echo ('Fajl je suvise mali');
             }
            
            if(!$errors){
               move_uploaded_file($tmp_putanja,"images/".$nazivNoveSlike);
              } else {
                echo ("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pokusajte ponovo<hr>");
              }
		}
}

?>


