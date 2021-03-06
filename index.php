<?php
include "db_config.php";
include "dateien/gerichte.php";
const POST_PARAM_NAME = 'form_name';
const POST_PARAM_EMAIL = 'form_email';
const POST_PARAM_OPTION = 'form_option';
const POST_PARAM_DATENSCHUTZ = 'checkbox';
$_SESSION['anmeldung_anzahl'] = 0;
$_SESSION['news'] = 0;
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-Mensa Werbeseite</title>
    <link rel="stylesheet" href="stylesheet/nav.css">
    <link rel="stylesheet" href="stylesheet/body.css">
    <link rel="stylesheet" href="stylesheet/main_pic.css">
    <link rel="stylesheet" href="stylesheet/main_rahmen.css">
    <link rel="stylesheet" href="stylesheet/text_box.css">
    <link rel="stylesheet" href="stylesheet/tabelle.css">
    <link rel="stylesheet" href="stylesheet/xyz_diagram.css">
    <link rel="stylesheet" href="stylesheet/formular.css">
    <link rel="stylesheet" href="stylesheet/footer_main.css">
    <link rel="stylesheet" href="stylesheet/wichtiges.css">
    <link rel="stylesheet" href="stylesheet/footer_linie.css">
    <link rel="stylesheet" href="stylesheet/fontawesome-free-5.15.4-web/css/all.css">
</head>
<body>
        <nav class="navi" >
            <input type="checkbox" id="check" >
            <label class="bars" for="check">
                <i class="fas fa-bars"></i>
            </label>
            <div id="logo" >
                <a>
                    <img alt="Bitte die Seite neu Laden. Es ist ein Fehler aufgetreten." id="logo_el"  src="img/logo.png">
                </a>
            </div>
            <ul class="navigation">
                <li>
                    <a id="elem1" href="#link_text_box">Ank&uuml;ndigung</a>
                </li>
                <li >
                    <a href="#tabelle">Speisen</a>
                </li>
                <li>
                    <a href="#link_diagram">Zahlen</a>
                </li>
                <li>
                    <a href="#link_form">Kontakt</a>
                </li>
                <li>
                    <a href="#link_text">Wichtig f??r uns.</a>
                </li>
            </ul>
        </nav>
        <!-- Hier wird hinter der menu leiste platz gemacht f??r das bild darunter-->
        <div class="main_rahmen">

        </div>
        <div class="main_pic">
            <img alt="Bitte die Seite neu Laden. Es ist ein Fehler aufgetreten." src="img/restaurant.png" class="pic_restaurant"  >
          <!--  <img src="img/restaurant.png" height="auto" width="100%">-->
        </div>
        <div class="text_box" id="link_text_box">
            <h1>Bald gibt es essen auch Online</h1>
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
        </div>
        <div id="tabelle">
            <h1>K??stlichkeiten, die Sie erwarten</h1>
            <table id="speisen">
                <tbody>
                <tr>
                    <td >Gerichte </td>
                    <td >Preis intern </td>
                    <td >Preis extern</td>
                    <td> Allergenen</td>
                   <!-- <td >Bilder</td>-->
                </tr>
                <?php
                    $sql_gericht = "SELECT GROUP_CONCAT(code), name, id, 
                    preis_extern, preis_intern FROM gericht JOIN gericht_hat_allergen gha 
                        ON gericht.id = gha.gericht_id GROUP BY name ASC LIMIT 5";
                    $result_gericht = mysqli_query($link, $sql_gericht);
                    if(!$result_gericht){
                        echo "Fehler w??rend der Abfrage: ", mysqli_error($link);
                    }
                    while ($row = mysqli_fetch_assoc($result_gericht)){
                        echo "<tr>";
                        echo '<td>',$row['name'], '</td><td>',
                               $row['preis_intern'], '</td> <td>'  ,
                               $row['preis_extern'] . '</td> <td>',
                               $row['GROUP_CONCAT(code)'] ."</td>"
                                ;
                        echo "</tr>";
                    }

                    /*foreach ($gericht as $key => $value){
                        echo
                         "<tr>" .
                         "<td >".$value['gericht']. "</td>".
                         "<td >".$value['preis_intern']. "</td>" .
                         "<td >".$value['preis_extern']. "</td>" .
                         "<td> <img class='td_img_center' height='50px' src=" . $value['img'] . "> </td>".
                         "</tr>";
                    }*/
                ?>
                </tbody>
            </table>
        </div>
        <div style="display: grid;justify-content: center">
            <h1 >Allergene</h1>
            <?php
            $sql_allergen = "SELECT code,name FROM allergen";
            $result_allergen = mysqli_query($link, $sql_allergen);
            if(!$result_allergen){
                echo "Fehler w??hrend der Abfrage: ", mysqli_error($link);
            }
            while($row = mysqli_fetch_assoc($result_allergen)){
                echo
                    "<li>". $row['code'] . " = ". $row['name'] . "</li>";

            }?>
        </div>
        <!--X-Y-Z Diagramm-->
            <div class="xyz_diagram" id="link_diagram">
                <h1> E-Mensa in Zahlen</h1>
                <a><?php
                    if(isset($_SESSION['zaehler'])) {
                        echo $_SESSION['zaehler'] += 1;
                    }else{
                        echo $_SESSION['zaehler'] = 1;
                    }
                    ?> Besuche</a>
                <a><?php
                    $t=0;
                    if(isset($_SESSION['anmeldung_anzahl'])){
                        $t = $_SESSION['anmeldung_anzahl'];
                        echo ++$t;
                    }
                    else if ($t === 0){
                       echo $t ;
                    }
                ?>
                </a>Anmeldungen zum Newsletter</a>
                <a><?php echo count($gericht)?> Speisen</a>
            </div>

        <img alt="Bitte die Seite neu Laden. Es ist ein Fehler aufgetreten." id="img_doenermann" src="img/doenermann.png" >
        <!--Kontaktformular-->
        <div class="cont_formular" id="link_form">
            <div class="formular" >
                <h1>Interesse geweckt? Wir informieren Sie!</h1>
                <img alt="Bitte die Seite neu Laden. Es ist ein Fehler aufgetreten." id="img_salsa" src="img/salsa.png" >
                <img alt="Bitte die Seite neu Laden. Es ist ein Fehler aufgetreten." id="img_taco" src="img/taco.png" >
                <form method="post">
                    <label for="form_name">Ihr Name</label> <br>
                    <input name="form_name" id="form_name" placeholder="Vorname" required>
                    <br>
                    <label for="form_email">Ihre E-Mail</label><br>
                    <input type="email" name="form_email" id="form_email" placeholder="E-Mail" required>
                    <br>
                    <label for="form_option">Newsletter bitte in:</label><br>
                    <select name="form_option" id="form_option" required>
                        <option >Deutsch</option>
                        <option >Englisch</option>
                    </select><br>
                    <br>

                    <input name="checkbox" id="checkbox"  type="checkbox" style="width: 20px" required>
                    <label for="checkbox">Den Datenschutzbestimmungen stimme ich zu</label>

                    <br><br><button >Zum Newsletter anmelden</button><br>
                    <img alt="Bitte die Seite neu Laden. Es ist ein Fehler aufgetreten." id="burger_menu" src="img/burger_menu.png">
                    <div style="">
                    <?php
                    if(isset($_POST[POST_PARAM_NAME]) && isset($_POST[POST_PARAM_EMAIL]) && isset($_POST[POST_PARAM_DATENSCHUTZ]) && isset($_POST[POST_PARAM_OPTION])){
                        $name = $_POST[POST_PARAM_NAME];
                        $email = $_POST[POST_PARAM_EMAIL];
                        $datenschutz = $_POST[POST_PARAM_DATENSCHUTZ];
                        $option = $_POST[POST_PARAM_OPTION];

                        if(strpos($email, "rcpt.at") ||strpos($email, "damnthespam.at") ||strpos($email, "wegwerfmail.de") || strpos($email, "@trashmail.de") || strpos($email, "trashmail.com") ){
                            echo "<style> #form_email{ border: 3px solid red } </style>";
                        }else{
                            /*
                            $inhalt =
                                "$".$name. " = [
                                     1 => ['name' => '" .$name . "'],
                                     2 => ['email' => '" .$email. "'],s
                                     3 => ['datenschutz' => '" .$datenschutz . "'],
                                     4 => ['option' =>'" . $option. "']
                                ];\n";
                            $handle = fopen ("nutzerdaten.php", "a");*/
                            ++$_SESSION['news'];

                            $inhalt =
                                '$newsletter'. "[". $_SESSION['news'] ."]"."['name']" . ' = "' . "$name" .'";'. "\n".
                                '$newsletter'. "[". $_SESSION['news'] ."]"."['email']" . ' = "' . "$email" .'";'."\n".
                                '$newsletter'. "[". $_SESSION['news'] ."]"."['datenschutz']" . ' = "' . "$datenschutz" .'";'."\n".
                                '$newsletter'. "[". $_SESSION['news'] ."]"."['option']" . ' = "' . "$option" .'"; '. "\n"
                                ."\n";
                            $handle = fopen ("werbeseite/nl-data.php", "a");
                            if(!$handle){
                                echo "<div style='background-color: red'>Fehlgeschlagen</div>";
                            }else{
                                /*Anmeldung zum Newsletter Aufgabe 1 M3*/
                                if(isset($_SESSION['anmeldung_anzahl'])){
                                 echo ++$_SESSION['anmeldung_anzahl'] ;
                                }else{
                                    echo $_SESSION['anmeldung_anzahl'] = 0;
                                }
                                echo "<div style='background-color: green;'>Die Newsletter Anmeldung war Erfolgreich</div>";
                                fwrite ($handle, $inhalt);
                                fclose ($handle);
                            }
                        }

                    }
                    ?>
                    </div> 
                    <br><br>
                </form>
            </div>
        </div>
        <h1 style="text-align: center">Haben Sie ein Wunschgericht? Dann klicken Sie <a href="werbeseite/wunschgericht.php">hier</a></h1>
      <br>

        <!-- Das ist uns wichtig-->
        <div class="text_wichtiges" id="link_text">
            <h1 >Das ist uns wichtig</h1>
            <div class ="text_aufzaehlung" >
                <ul>
                    <li>Beste frische saisonal Zutaten</li>
                    <li>Ausgewogene abwechslungsreiche Gerichte</li>
                    <li>Sauberkeit</li>
                </ul>
            </div>
        </div>
            <div style="text-align: center">
                <h1  >Wir freuen uns auf Ihren Besuch!</h1><br>

            </div>


        <div id="linie_footer"><hr  ></div>

        <footer class="footer_main">
            <a >E-Mensa GmbH</a>
            <a  id="footer_Name">Bariss Kacar</a>
            <a >Impressum</a>
        </footer>

<br>
<br>
</body>
</html>
