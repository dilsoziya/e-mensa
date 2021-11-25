<?php
include "../db_config.php";
 const GET_PARAM_WUNSCH = 'wunsch';
 const GET_PARAM_BESCHREIBUNG = 'beschreibung';
 const GET_PARAM_NAME = 'name';
 const GET_PARAM_EMAIL = 'email';
/*
 echo $_GET[GET_PARAM_WUNSCH];
 echo $_GET[GET_PARAM_BESCHREIBUNG];
 echo $_GET[GET_PARAM_NAME];
 echo $_GET[GET_PARAM_EMAIL];*/

$name_vorhanden = 'anonym';
echo $_GET[GET_PARAM_NAME];
if(!isset($_GET[GET_PARAM_NAME])){
    $name_vorhanden = 'anonym';
}else{
    $name_vorhanden = $_GET[GET_PARAM_NAME];
}
echo $name_vorhanden;
$wunsch ="";
if(isset($_GET[GET_PARAM_WUNSCH])){
   $wunsch = $_GET[GET_PARAM_WUNSCH];
}
$beschreibung = "";
if(isset($_GET[GET_PARAM_BESCHREIBUNG])){
    $beschreibung = $_GET[GET_PARAM_BESCHREIBUNG];
}
$email = "";
if(isset($_GET[GET_PARAM_EMAIL])){
    $email = $_GET[GET_PARAM_EMAIL];
}

 $sql_wunschgericht = "INSERT INTO 
                            wunschgericht (wunschID, 
                                           name, 
                                           beschreibung, 
                                           ersellungsdat, 
                                           ersteller, 
                                           email)
                        VALUES  
                               (NULL,
                                '".$wunsch."',
                                '".$beschreibung."', 
                                NOW() , 
                                '".$name_vorhanden."', 
                                '".$email."'
                                ) ";

  $result_wunschgericht = mysqli_query($link, $sql_wunschgericht);
                    if(!$result_wunschgericht){
                        echo "Fehler wärend der Abfrage: ", mysqli_error($link);
                    }
  $sql_wunschgericht_select =
                    "SELECT *
                    FROM wunschgericht;";
  $result_wunschgericht_select = mysqli_query($link, $sql_wunschgericht_select);
    if(!$result_wunschgericht_select){
        echo "Fehler während der Abfrage: ", mysqli_error($link);
    }
    ?>
<form method="get">
    <label for="wunsch">Wunschgericht Name</label>
    <input name="wunsch" id="wunsch" placeholder="name"><br>
    <label for="beschreibung">Beschreibung</label>
    <input name="beschreibung" id="beschreibung" placeholder="beschreibung"><br>
    <label for="name">Ersteller Name</label>
    <input name="name" id="name" placeholder="ersteller"><br>
    <label for="email">Email</label>
    <input type="email" name="email"  id="email" placeholder="email"><br>
    <button type="submit">Wunsch abschicken</button>
</form>
    <table>
        <tr>
            <td >Nummer </td>
            <td >Name</td>
            <td >Beschreibung</td>
            <td>Erstellungdatum</td>
            <td>Ersteller</td>
            <td>Email</td>
        </tr>
        <tbody>
<?php
while($row = mysqli_fetch_assoc($result_wunschgericht_select)){
    echo
    "<tr>
        <td>". $row['wunschID'] . "</td>".
        "<td>". $row['name'] . "</td>".
         "<td>". $row['beschreibung'] . "</td>".
            "<td>". $row['ersellungsdat'] . "</td>".
    "<td>". $row['ersteller'] . "</td>".
    "<td>". $row['email'] . "</td>".
   " <tr>";
    ;
}
echo "</tbody></table>"
?>