<?php
// Recupero file json e salvato in stringa
$listJasonString = file_get_contents('list.json');

// Trasformazione stringa in elemento PHP con aggiunta true per avere valori booleani
$list = json_decode($listJasonString, true);

// -------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------


/// Funzione per convertire stringhe true e false in booleani
function boolValue($taskValue) {
    if ($taskValue === "true") {
        return true;
    } elseif ($taskValue === "false") {
        return false;
    }
}

// Verifico se ricevo i dati nel post e aggiungo la task nel file json
if(isset($_POST['newTask'])){
    $newTask = $_POST['newTask'];
    
    // Converti i valori pinned e done in booleani
    $newTask['pinned'] = boolValue($newTask['pinned']);
    $newTask['done'] = boolValue($newTask['done']);

    // Verifica per contenuto vuoto
    if($newTask['task'] !== ""){
        $list[] = $newTask;
    }

    // Aggiornamento del file
    file_put_contents('list.json', json_encode($list));
}



// Verifico se ricevo i dati e cancello il dato nel file jason
if(isset($_POST['iToDelete'])){
    $iToDelete = $_POST['iToDelete'];
    array_splice($list, $iToDelete, 1);
    // aggiornamento del file
    file_put_contents('list.json', json_encode($list));
}



// Verifico per pinnnare le task
if(isset($_POST['taskToPin'])){
    $taskToPinI = $_POST['taskToPin'];
    // Contenuto della task
    $taskToPin = $list[$taskToPinI];
    // Modifica pinned toggle
    $taskToPin['pinned'] = !$taskToPin['pinned']; 

    // Rimozione task
    array_splice($list, $taskToPinI, 1);

    if ($taskToPin['pinned']) {
        // Se la task è pinnata, spostala all'inizio della lista
        array_unshift($list, $taskToPin);
    } else {
        // Se la task non è più pinnata, aggiungila alla fine della lista
        $list[] = $taskToPin;
    }

    // aggiornamento del file
    file_put_contents('list.json', json_encode($list));
 
}

// Verifico per aggiungere classe done
if(isset($_POST['taskDone'])){
    $taskDone = $_POST['taskDone'];
    // Modifica pinned toggle
    $list[$taskDone]['done'] = !$list[$taskDone]['done'];

    // aggiornamento del file
    file_put_contents('list.json', json_encode($list));
}

// -------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------


// Restituzione del file JSON
// Modifica dell'header del file per farlo interprestare come json
header('Content-Type: application/json');

// Stampa dell'elemento PHP in stringa
echo json_encode($list);