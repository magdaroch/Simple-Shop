<a href="index_login.php">Powrot do strony glownej</a> <br><br>
<?php
session_start();
require_once __DIR__ . '/src/Message.php';
require_once __DIR__ . '/config.php';
$message = Message::loadAllRecivedMassagesByUserId($conn, $userId);
foreach($message as $row){
    $row->showMessage();
    echo "<br>";
}