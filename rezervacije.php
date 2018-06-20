<?php
require "classes.php";
Session::newInstance();
$logedAs = Session::logedAs();
Session::setKey('prozor', false);
RezervacijaPrazno::prazno();
$izborSobeIspis = Session::getValue('izborSobeIspis');
$izborSobe = Session::getValue('izborSobe');
$ponuda = Session::getValue('zaRezervaciju');
$ukupnoPoDanu = $izborSobe * $ponuda->cena;

include ("header.php");
echo "<p id='uogovanIliNe'>{$logedAs}</p>"; ?>
    <div id="main_rezervacije">
      <form name="forma_rezervacija" id="rezervacija_stil" method="post" action="">
        <table>
          <tr>
            <td>Tip sobe:</td>
            <td><input type="text" name="brKreveta" value="<?=$izborSobeIspis?>"></td>
          </tr>
          <tr>
            <td>Cena po lezaju:</td>
            <td><input type="text" name="cenaPoLezaju"  value="<?=$ponuda->cena?>"> </td>
          </tr>
          <tr>
            <td>Za uplatu (po danu):</td>
            <td><input type="text" name="ukupnoPoDanu" value="<?=$ukupnoPoDanu?>"> </td>
          </tr>
          <tr>
            <td>Broj nocenja:</td>
            <td>
              <select name="nocenja" id="brojNocenja" onchange="odlazak()">
                  <option value="0">Izaberite broj nocenja</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="5">5</option>
                  <option value="7">7</option>
                  <option value="10">10</option>
                  <option value="14">14</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Dolazak:</td>
            <td><input type="date" name="datumDolaska" id="dolazakDatum" onchange="odlazak()"></td>
          </tr>

          <tr>
            <td>Odlazak:</td>
            <td><input type="text" name="odlazakDatum"></td>
          </tr>
          <tr>
            <td>Ukupno za uplatu:</td>
            <td><input type="text" name="ukupnoZaUplatu" > </td>
          </tr>
          <tr>
            <td>Ime:</td>
            <td><input type="text" name="ime" placeholder="Unesite Vase ime"></td>
          </tr>
          <tr>
            <td>Prezime:</td>
            <td><input type="text" name="prezime" placeholder="Unesite Vase prezime"></td>
          </tr>
          <tr>
            <td>E-mail:</td>
            <td><input type="email" name="email" placeholder="Unesite Vas e-mail"></td>
          </tr>
          <tr>
            <td>Vasa kartica:</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><input type="radio" name="visa">VISA</td>
            <td><input type="radio" name="mastercard">MasterCard</td>
          </tr>
          <tr>
            <td>Broj kartice</td>
            <td><input type="text" name="brojKartice" placeholder="YYYY-YYYY-YYYY-YYYY"></td>
          </tr>
          <tr>
            <td colspan="2"><input type="checkbox" name="usloviKoriscenja">Prihvatam uslove koriscenja sajta</td>
          </tr>
          <tr>
            <td colspan="2"><input type="submit" name="dugmePlacanje" value="Placanje" id="buttonPlacanje" onclick="placanje()"></td>
          </tr>
        </table>
      </form>
<?php
include ("footer.php");
