<?php
//ini_set("display_errors", 0);
require "../classes.php";

Session::newInstanceVlasnici();
$logedAsVlasnik = Session::logedAsVlasnik();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Turizam</title>
        <link rel="stylesheet" type="text/css" href="../style.css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    </head>
    <body>
        <div id="wrapper">

            <div id="header">
                <img src="../images/logo.jpg" alt="logo">
                <div id="xml_nav">
                    <p>Strana za ažuriranje ponuda</p>
                </div>
            </div><!-- end of header -->
            <?php echo "<p id='uogovanIliNe'>{$logedAsVlasnik}</p>"; ?>
            <div id="main_loginStrana_xml">
                <!-- // login forma -->
                <form action="" method="POST" autocomplete="on">
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
                LoginVlasnici::proveraVlasnika();
                // $sesija = json_encode($_SESSION);
                // print_r($sesija);
                if (isset($_SESSION['userNameVlasnik'])) {
                    ?>
                    <div id="vlasnici_administriranje">
                        <table id="vlasnici_tabela">
                            <p>Unesite novu cenu za vaš apartman:</p>
                            <?php
                            // dohvata ponude iz baze po id-u vlasnika i prikazuje ih u formi za promenu cene
                            $apartmani = new ApartmaniVlasnika;
                            $idVlasnika = isset($_SESSION['idVlasnika']) ? $_SESSION['idVlasnika'] : 0;
                            // uzima podatke iz XML fajla i prikazuje ih
                            $apartmani->prikazApartmana($idVlasnika);
                            // kada se pritisne dugme Izmeni cenu upisuje se nova cena u XML fajl (ponude.xml), salje se id ponude i nova cena
                            if (isset($_POST['cena'])) {
                                $id = array_keys($_POST, "Izmeni cenu")[0];
                                $novaCena = $_POST['cena'];
                                $upis = new UpisUXML;
                                $upis->snimiXML($id, $novaCena);
                                header('Location: index.php');
                            }
                            ?>
                        </table>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div id="footer">
                <p><i>Copyright </i>&copy;<i> Marko</i></p>
            </div><!-- end of footer -->
        </div>
    </body>
</html>