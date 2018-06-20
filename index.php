<?php
require "classes.php";
Session::newInstance();
$logedAs = Session::logedAs();

include ("header.php");
echo "<p id='uogovanIliNe'>{$logedAs}</p>"; 
?>
<div id="main">
<?php
    $ponuda = new Ponuda;
    $ponuda->izlaz();
      if(isset($_SESSION['prozor'])){
	       if($_SESSION['prozor'] == true){ 
	               echo '<div class="product_dugme"><a href="rezervacije.php">Produzite na stranu za rezervacije&nbsp;&gt;&gt;</a></div>';
	               }
            }
include ("footer.php");
