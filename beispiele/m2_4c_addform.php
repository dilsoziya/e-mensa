<?php
const GET_PARAM_A = 'a';
const GET_PARAM_B = 'b';
const GET_PARAM_ADD =  'addieren';
const GET_PARAM_MULT = 'multi';

include "m2_4a_standardparameter.php";

?>

<form method="get">
    <label for="a">Eingabe A:</label> <br>
    <input name="a" type="text" id="a">
    <br>
    <br>
    <label for="b">Eingabe B:</label> <br>
    <input name="b" type="text" id="b">
    <br>
    <br>
    <input name="addieren" type="submit" value="addieren">
    <input name="multi" type="submit" value="multiplizieren">
</form>


<?php
if(!empty(GET_PARAM_A) && !empty(GET_PARAM_B)){
    if(isset($_GET[GET_PARAM_A]) && isset($_GET[GET_PARAM_B])){
        $a = $_GET[GET_PARAM_A];
        $b = $_GET[GET_PARAM_B];
        if(isset($_GET[GET_PARAM_MULT])){
            if($_GET[GET_PARAM_MULT] == 'multiplizieren'){
                echo $c = $a / $b;

            }
        }
        if(isset($_GET[GET_PARAM_ADD])){
        if($_GET[GET_PARAM_ADD] == 'addieren'){
            echo add($a, $b);

        }
        }
    }
}


