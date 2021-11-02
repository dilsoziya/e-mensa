<?php
/**
 * Praktikum DBWT. AUTOREN:
 * BARIS, KACAR, 3280180
 * JONATHAN, BEHRENS,
 */
const GET_PARAM_MIN_STARS = 'search_min_stars';
const GET_PARAM_SEARCH_TEXT = 'search_text';
const GET_PARM_SHOW_DESCRIPTION = 'show_description';
session_start();
$status = "einblenden";

/**
 * List of all allergens.
 */


$en = [
   'name' => 'Sweet potato pockets filled with cream cheese and herbs',
    'description' => 'The sweet potatoes are carefully cut open and the cream cheese is poured in.',
    'allergene' => 'allergens to the meal',
    'filter' => 'filter',
    'rating' => 'Reviews Total:'
];

$allergens = [
    11 => 'Gluten',
    12 => 'Krebstiere',
    13 => 'Eier',
    14 => 'Fisch',
    17 => 'Milch'
];

$meal = [
    'name' => 'Süßkartoffeltaschen mit Frischkäse und Kräutern gefüllt',
    'description' => 'Die Süßkartoffeln werden vorsichtig aufgeschnitten und der Frischkäse eingefüllt.',
    'price_intern' => 2.90,
    'price_extern' => 3.90,
    'allergens' => [11, 13],
    'amount' => 42             // Number of available meals
];

$ratings = [
    [   'text' => 'Die Kartoffel ist einfach klasse. Nur die Fischstäbchen schmecken nach Käse. ',
        'author' => 'Ute U.',
        'stars' => 2 ],
    [   'text' => 'Sehr gut. Immer wieder gerne',
        'author' => 'Gustav G.',
        'stars' => 4 ],
    [   'text' => 'Der Klassiker für den Wochenstart. Frisch wie immer',
        'author' => 'Renate R.',
        'stars' => 4 ],
    [   'text' => 'Kartoffel ist gut. Das Grüne ist mir suspekt.',
        'author' => 'Marta M.',
        'stars' => 3 ]
];

$states = array(
    'visible' => 'hidden' ,
    'hidden' => 'visible' ,
);

$showRatings = [];

if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {
    $searchTerm = $_GET[GET_PARAM_SEARCH_TEXT];
    foreach ($ratings as $rating) {
        if (strpos(strtolower($rating['text']), strtolower($searchTerm)) !== false) { // Aufgabe 3 b) Groß und kleinschreibung wird nicht mehr beachtet
                $showRatings[] = $rating;
        }
    }

}
else if (!empty($_GET[GET_PARAM_MIN_STARS])) {
    $minStars = $_GET[GET_PARAM_MIN_STARS];
    foreach ($ratings as $rating) {
        if ($rating['stars'] >= $minStars) {
            $showRatings[] = $rating;
        }
    }
} else {
    $showRatings = $ratings;
}

function calcMeanStars (array $ratings){
    $sum = (float)0;            // 3d logischer fehler
    foreach ($ratings as $rating) {
        $sum += $rating['stars'] / count($ratings);
    }
    return (float)$sum;
}


/**Prüfen ob Deutsche oder Englische Sprache*/
$uri =  $_SERVER['REQUEST_URI'];
$url_comp = parse_url($uri); // holt sich den link
parse_str($url_comp['query'],$sprache); // nimmt nur die query



?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8"/>
        <title>Gericht: <?php echo $meal['name']; ?></title>
        <style type="text/css">
            * {
                font-family: Arial, serif;
            }
            .rating {
                color: darkgray;
            }
        </style>
    </head>
    <body>
    <form method="get">
        <a id="de" href="meal.php?sprache=de">Deutsch</a>
        <a id="en" href="meal.php?sprache=en">Englisch</a>
    </form>
        <?php
        if(isset($sprache['sprache'])){
            $_SESSION['sprache'] = $sprache['sprache'];
        }
        if( $_SESSION['sprache'] === 'de') {
             echo '<h1>Gericht: ' . $meal['name'] . '</h1>';
        }else {
             echo '<h1>Meal: ' . $en['name'] . '</h1>';
        }
       ?>
        <!-- Aufgabe 3 e-->
        <form method="get">
            <p> <?php
                if(isset($_GET[GET_PARM_SHOW_DESCRIPTION])){
                    $show_description = $_GET[GET_PARM_SHOW_DESCRIPTION]; // übergibt den wert
                        if( $_SESSION['status'] === 0){
                            $_SESSION['status'] = 1;
                        } else {
                            $_SESSION['status'] = 0;
                        }
                }
                if($_SESSION['status'] === 0 ){ // macht nur echo wenn 1
                        if(isset($sprache['sprache'])){
                            $_SESSION['sprache'] = $sprache['sprache'];
                        }
                        if($_SESSION['sprache'] === 'de') {
                            echo ' Gericht: ' . $meal['description'] ;
                        }else {
                            echo 'Meal: ' . $en['description'] ;
                        }
                    $status = 'ausblenden';
                }
                ?>
            </p>
            <input id="show_description" type="submit" name="show_description" value="<?php echo $status ; ?>">
        </form>

        <?php
        if(isset($sprache['sprache'])){
            $_SESSION['sprache'] = $sprache['sprache'];
        }
        if($_SESSION['sprache'] === 'de') {
            echo '<h4> Allergene zum Gericht </h4>';
        }else {
            echo '<h4>Meal: ' . $en['allergene'] . '</h4>';
        }
        ?>
        <ul>
            <?php // Aufgabe 3 - 3) b)
            for($i =  0;$i < count($meal['allergens']);$i++){
                $te = (string) $meal['allergens'][$i];
                echo "<li>". $allergens["$te"] . "</li>";
            };
            ?>
        </ul>
        <h4>Preise</h4>
    <?php
        //Aufgabe 3 h)
        $res =   number_format($meal['price_intern'],2 ,'.' , ',');
        $res2 =   number_format($meal['price_extern'],2 ,'.' , ',');
        $euro_anhangen = $res . "€";
        $euro_anhangen_2 = $res2 ."€";
        echo "Preis intern: " . $euro_anhangen . "<br>";
        echo "Preis extern: " . $euro_anhangen_2;
    ?>
        <?php
            if(isset($sprache['sprache'])){
                $_SESSION['sprache'] = $sprache['sprache'];
            }
            if($_SESSION['sprache'] === 'de') {
                echo "<h1>Bewertungen (Insgesamt:".  calcMeanStars($ratings) .")";
            }else {
                echo "<h1>" . $en['rating'] . calcMeanStars($ratings) .") </h1>";
            }
        ?>
         </h1>
        <form method="get">
            <label for="search_text">Filter:</label>
            <input id="search_text" type="text" name="search_text" value="<?php if(isset($_GET[GET_PARAM_SEARCH_TEXT])){echo $_GET[GET_PARAM_SEARCH_TEXT];}; ?>"> <!-- Aufgabe 3 f-->
            <input type="submit" value="Suchen">
        </form>
        <table class="rating">
            <thead>
            <tr>
                <td>Text</td>
                <td>Sterne</td>
                <td>Autor</td>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach ($showRatings as $rating) {
                    echo "<tr><td class='rating_text'>{$rating['text']}</td>
                              <td class='rating_stars'>{$rating['stars']}</td>
                              <td class='rating_autors'>{$rating['author']} </td> <!-- 3a autor mit ausgeben-->
                          </tr>
                          ";
                    }

             ?>
            </tbody>

        </table>
    </body>
</html>