<?php
$uhrzeit = date('H:i');
$datum = date("d.m.Y");
$webbrowser = $_SERVER['HTTP_USER_AGENT'];
$ip = $_SERVER['REMOTE_ADDR'];
$inhalt = "Uhrzeit: " .$uhrzeit . "\n"
         . "Datum: " .$datum . "\n"
         . "Webbrowser: " . $webbrowser. "\n"
         . "IP-Adresse: " . $ip . "\n"
         . "\n\n"
;
$handle = fopen ("accesslog.txt", "a");
fwrite ($handle, $inhalt);
fclose ($handle);
