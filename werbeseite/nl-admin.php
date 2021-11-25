<?php
$newsletter = include "nl-data.php";
const GET_SORT_NAME = 'sort_name';
const GET_SORT_EMAIL = 'sort_email';
const GET_SEARCH_NAME_EMAIL = 'suche_name_email';
session_start();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheet/tabelle_name_email.css">
    <title>Titel der Seite | Name der Website</title>
</head>
<body style="margin: 0; font-family: 'Bradley Hand ITC'">

    <div style="text-align: center;color: white;background-color: #f0922e; border: 2px solid #f0922e;">
        <h1>Admin Panel</h1>
    </div>
    <br>
    <div id="tabelle_name_email">
        <table >
            <thead>
            <tr>
                <th>Name </th>
                <th>Email </th>
                <th>Datenschutz </th>
                <th>Option</th>
            </tr>
            </thead>
            <tbody>

            <?php


            if(isset($_SESSION ['search']) && isset($_GET[GET_SEARCH_NAME_EMAIL])){
                $_SESSION['search']  = $_GET[GET_SEARCH_NAME_EMAIL];
            }
            $b = "";

            function search(){
                if(isset($_SESSION['search'])) {
                    if (is_array($_SESSION['search'])) {
                        $_SESSION['search'] = "";
                    }
                    return $_SESSION['search'];
                }
            }
            echo "<form method='get' >
                        <button name='sort_name' type='submit' value='name'>Name</button>
                        <button name='sort_email' type='submit' value='email'>Email</button>
                        <label for='suche_name_email'>Suche: </label>
                        <input name='suche_name_email' value='".search()."' ida='suche_name_email' type='text'>
                        <br>
                        <button> Suchen </button>
                        </form>";

            $searchResult = [];
            if(!empty($_GET[GET_SEARCH_NAME_EMAIL])) {
                $search = $_GET[GET_SEARCH_NAME_EMAIL];
                foreach ($newsletter as $key => $value) {
                    if (strpos(strtolower($value['name']), strtolower($search)) !== false) {
                        $searchResult[] = $value;
                    }
                }
            } else{
                $searchResult = $newsletter;
            }
            $_SESSION['search'] = $searchResult;
            if(isset($_GET[GET_SORT_EMAIL])){
                if($_GET[GET_SORT_EMAIL] === "email"){
                    $b = array_column($searchResult, 'email');
                    array_multisort($b, SORT_ASC, $searchResult);
                    sort($b);
                }
            }
            if(isset($_GET[GET_SORT_NAME])) {
                if($_GET[GET_SORT_NAME] === "name"){
                    $b = array_column($searchResult, 'name');
                    array_multisort($b,  SORT_ASC,$searchResult);
                    sort($b)   ;
                    natcasesort($b);
                }
            }

            foreach ($searchResult as $item => $value) {
                echo "</tr>";
                echo "<td>".$searchResult[$item]['name']  . "</td> " .
                    "<td>". $searchResult[$item]['email']  .  "</td> " .
                    "<td>".$searchResult[$item]['datenschutz'] .  "</td> " .
                    "<td>". $searchResult[$item]['option'] . "</td>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <div style="text-align: center;color: white;background-color: #f0922e; border: 2px solid #f0922e;">

    </div>

</body>
</html>