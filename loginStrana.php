<?php
require "classes.php";
Session::newInstance();
$logedAs = Session::logedAs();

include ("header.php");
echo "<p id='uogovanIliNe'>{$logedAs}</p>"; 
?>
    <div id="main_loginStrana">
<!-- // login forma -->
        <form action="" method="post" autocomplete="on">
          <fieldset  style="width: 350px">
            <legend>Log in</legend>
            <table>
              <tr>
                <td width="150px">Korisnicko ime:</td>
                <td><input type="text" name="username" maxlength="5" placeholder="unesite ime"></td>
              </tr>
              <tr>
                <td>Lozinka:</td>
                <td><input type="password" name="password" placeholder="unesite lozinku"></td>
              </tr>
              <tr>
                <td><input type="reset" value="Resetuj"></td>
                <td><input type="submit" name="dugmeLogin" value="Uloguj se">
                <input type="submit" id="logoutDugme" name="dugmeLogout" value="Izloguj se"></td>
              </tr>
            </table>
          </fieldset>
        </form>
      	<?php
// kada se pritise Uloguj se proverava se da li je unet username i password, zatim se oni proveravaju i ako su ok korisnik se uloguje
      Login::provera();
      
      if(isset($_SESSION['userStatus'])){
        if($_SESSION['userStatus'] == 1){
          $ponuda = new Administriranje;
          if(isset($_GET['id'])){
// prikazuje odabranu ponudu
            $ponuda = Administriranje::prikaziPonudu($_GET['id']);
// pocetak dela za administriranje - brisanje, unos, izmena ponuda, dodavanje slika
            $opcijeZaAdministriranje = new Administriranje;
            $opcijeZaAdministriranje->izvrsavanje();
          }
          $sve = Administriranje::prikaziSvePonude();

// rad sa fakturama - biranje koja ce se faktura prikazati, poziva se stampa ili brisanje fakture sa odgovarajucim Id-om
          $fakture = Placanje::prikaziSvePonude();
          if(isset($_GET['idFakture'])){
            $faktura = Placanje::prikaziPonudu($_GET['idFakture']);
            $radSaFakturama = new Placanje;
            $radSaFakturama->radSaFakturom($_GET['idFakture']);
          }
          ?>
    <div id="main_administriranje">
        <form action="" enctype="multipart/form-data" method="post">
          <table>
            <tr><td colspan="2">
              <select name="id" id="polje" onchange="if(this.value=='opcija') return; window.location='?id='+this.value" >
              <?php 
                echo "<option value='opcija'>Odaberite ponudu:</option>";
                foreach($sve as $jedna){
                  echo "<option ".($jedna->id==$ponuda->id?'selected':'')." value='{$jedna->id}'>{$jedna->hotel}</option>";
                  }
                ?>
                </select>
              </td>
            </tr>
              <tr>
                <td>Naziv:</td>
                 <td><input type="text" value="<?=$ponuda->hotel?>" name="hotel" /></td>
              </tr>
              <tr>
                <td>Cena:</td>
                <td><input type="text" value="<?=$ponuda->cena?>" name="cena" /></td>
              </tr>
              <tr>
                <td>Slika:</td>
                <td><input type="text" value="<?=$ponuda->slika?>" name="slika" /></td>
              </tr>
              <tr>
                <td colspan="2">
                  <input type="submit" value="Unos nove ponude" name="dugmeInsert" />
                  <input type="submit" value="Izmena" name="dugmeUpdate" />
                  <input type="submit" value="Brisanje" name="dugmeDelete" />
              </td>
              </tr>
              <tr>
                <td colspan="2">
                  <input type="file" name="novaSlika" id="Odaberite sliku"> 
                </td>
              </tr>
         </table>
        </form>
        <div id="slika">
          <img src="<?=$ponuda->slika?>" alt="">
        </div>
    </div><!-- end of main_administriranje -->
    <!-- administriranje faktura -->
    <div id="fakture_administriranje">
        <form action="" method="post">
            <select name="id" id="polje" onchange="if(this.value=='opcija') return; window.location='?idFakture='+this.value" >
              <?php 
                echo "<option value='opcija'>Odaberite fakturu po vremenu placanja:</option>";
                foreach($fakture as $jednaFaktura){
                  echo "<option ".($jednaFaktura->id==$faktura->id?'selected':'')." value='{$jednaFaktura->id}'>{$jednaFaktura->vremePlacanja}</option>";
                  }
                echo "</select>";
                if(isset($_GET['idFakture'])){
                ?>
        <div class="tabelaFaktura">
            <table class="tabelaFaktura">
              <tr>
                <td>Uplatilac:</td>
                <td><?=$faktura->prezime." ".$faktura->ime?></td>
              </tr>
              <tr>
                <td>Vreme placanja:</td>
                <td><?=$faktura->vremePlacanja?></td>
              </tr>
              <tr>
                <td>E-mail:</td>
                <td><?=$faktura->email?></td>
              </tr>
              <tr>
                <td>Cena po lezaju:</td>
                <td><?=$faktura->cenaPoLezaju." dinara"?></td>
              </tr>
            </table>
        </div>
        <div class="tabelaFaktura">
            <table class="tabelaFaktura">
              <tr>
                <td>Hotel:</td>
                <td><?=$faktura->hotel?></td>
              </tr>
              <tr>
                <td>Dolazak:</td>
                <td><?=$faktura->dolazak?></td>
              </tr>
              <tr>
                <td>Odlazak:</td>
                <td><?=$faktura->odlazak?></td>
              </tr>
              <tr>
                <td>Ukupan iznos:</td>
                <td><?=$faktura->ukupnoZaUplatu." dinara"?></td>
              </tr>
            </table>
        </div>
        <input type="submit" value="Obrisi fakturu" name="dugmeFakturaObrisi"  style="float: right; margin-right: 30px;"/>
        <input type="submit" value="Stampaj fakturu" name="dugmeFakturaStampaj" style="float: right; margin-right: 30px;" />
    <?php 
          }
        } 
      }
    ?>
        </form>
      </div><!-- end of administriranje faktura -->
<?php
include ("footer.php");