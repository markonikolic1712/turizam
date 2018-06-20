<?php
require "Konekcija.php";

class Ponuda {
	public $id;
	// public $konekcija;
	// public $svePonude;
	// public $ponuda;
	public $hotel;
	public $cena;
	public $slika;

	public function izlaz(){
		$pdo = Konekcija::getInstance();
		$upit = $pdo->query("select * from ponuda");
		$svePonude = $upit->fetchAll(PDO::FETCH_OBJ);
		// dobija se niz objekata - stdClass Object
		
		foreach ($svePonude as $ponuda) {
			?>
				<div class="ponuda">
	         		 <img src="<?=$ponuda->slika?>" alt="<?=$ponuda->hotel?>">
			        <form name="sobe" action="obrada.php" method="post">
			          <input type="hidden" name="id" value="<?=$ponuda->id?>">
			          <span>Hotel "<?=$ponuda->hotel?>"</span><br>
			          <span>Cena po lezaju: </span>
			          <input type="text" name="cena" size="5" value="<?=$ponuda->cena?>"><br>
			          <span>Tip sobe:</span>
			            <select name="izborSobe" >
			              <option value="0">Odaberite tip sobe</option>
			              <option value="1">jednokrevetna</option>
			              <option value="2">dvokrevetna</option>
			              <option value="3">trokrevetna</option>
			              <option value="4">cetvorokrevetna</option>
			            </select>
			            <input id="rezervisi1" name="dugmeRezervacija" type="submit" value="Rezervisi">
			          </form>
     			</div>
			<?php
		}
	}
}

