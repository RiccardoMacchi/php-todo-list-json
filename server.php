<?php
// Recupero file json e salvato in stringa
$listJasonString = file_get_contents('list.json');

// Trasformazione stringa in elemento PHP
$list = json_decode($listJasonString);

// Verifico se ricevo i dati nel post e aggiunto la task nel file json
if(isset($_POST['newTask'])){
    $newTask = $_POST['newTask'];
    $list[] = $newTask;
    // aggiornamento del file
    file_put_contents('list.json', json_encode($list));
}
// Verifico se ricevo i dati e cancello il dato nel file jason
if(isset($_POST['iToDelete'])){
    $iToDelete = $_POST['iToDelete'];
    array_splice($list, $iToDelete, 1);
    // aggiornamento del file
    file_put_contents('list.json', json_encode($list));
}

// Restituzione del file JSON
// Modifica dell'header del file per farlo interprestare come json
header('Content-Type: application/json');

// Stampa dell'elemento PHP in stringa
echo json_encode($list);