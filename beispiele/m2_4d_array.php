<?php
$famousMeals = [
    1 => ['name' => 'Currywurst mit Pommes',
         'winner'=> [2001,2003,2007,2010,2020]],
    2 => ['name' => 'Hähnchencrossies mit Paprikareis',
          'winner' => [2002,2004,2008]],
    3 => ['name' => 'Spaghetti Bolognese',
         'winner' => [2011,2012,2017]],
    4 => ['name' => 'Jägerschnitzel mit Pommes' ,
          'winner' => [2019]]
];


foreach ($famousMeals as $keys => $value){
    echo '<div style="float: left; margin-right: 7px;">'.
        $keys .'.'. "</div>"
        . $value['name']
        . '<br> <div style="margin-left: 20px; margin-bottom: 10px">';
    for($i = $keys;$i <= $keys;$i++){
        for($p = count($famousMeals[$i]['winner'])-1 ; $p >= 0; $p--){
           echo $famousMeals[$i]['winner'][$p] ;
           if($p !== 0){
                echo ",&nbsp;";
           }
    }
     echo "<br> </div>";
    }

}
function keinGewinner(array $famousMeals)
{
    $groesste = 0;
    $kleinste = 0;
    $buf = 0;
    $a[] = [];
    foreach ($famousMeals as $keys => $value) {
        for ($i = $keys; $i <= $keys; $i++) {
            for ($p = count($famousMeals[$i]['winner']) - 1; $p >= 0; $p--) {
                $winner = $famousMeals[$i]['winner'][$p];
                if ($groesste <= $winner) {
                    $groesste = $winner;
                }
                if ($kleinste >= $winner) {
                    $kleinste = $winner;

                } else if ($kleinste === 0) {
                    $kleinste = $winner;
                }

            }
        }
    }

    echo $kleinste . " ";
    echo $groesste . "<br>";
    for($zaehler = 2000;$zaehler <= $groesste;$zaehler++){
        $result = false;
        foreach ($famousMeals as $keys => $value) {
            if (in_array($zaehler, $famousMeals[$keys]['winner'])) {
                $result = true;
            }
        }
        if($result === false){
            $keine_gewinner[]  = $zaehler;
        }
    }
   sort($keine_gewinner);
   echo "In den folgenden Jahren gab es keine Gewinner: <br>";
   foreach ($keine_gewinner as $key){
       echo $key ;
       echo " ";
   }
}

keinGewinner($famousMeals);