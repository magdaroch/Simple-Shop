<?php

//plik do którego będzie łączył się JS


require_once __DIR__ . '/src/Order.php';
require_once __DIR__ . '/config.php';


//plik zawsze zwraca JSONa
header('Content-Type: application/json');
//sprawdzamy w jaki sposob (typ) połączył się JS

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
        parse_str(file_get_contents('php://input'), $put_vars);
     
        Order::delete($conn, $toDel['id']);
        $confirmationDelete = ['statusToConfirm' => 'Ksiazka skasowana'];
    echo json_encode($confirmationDelete);
}