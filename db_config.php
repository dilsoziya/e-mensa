<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
$link=mysqli_connect("localhost", // Host der Datenbank
    "root",                 // Benutzername zur Anmeldung
    "1997sirab",            // Passwort
    "emensawerbeseite"     // Auswahl der Datenbanken (bzw. des Schemas)

);

if (!$link) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}

