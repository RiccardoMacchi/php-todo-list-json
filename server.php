<?php
// Recupero file json e salvato in stringa
$listJasonString = file_get_contents('list.json');

// Trasformazione stringa in elemento PHP
$list = json_decode($listJasonString);


$list[] = 'ciao';




// Restituzione del file JSON
// Modifica dell'header del file per farlo interprestare come json
header('Content-Type: application/json');

// Stampa dell'elemento PHP in stringa
echo json_encode($list);