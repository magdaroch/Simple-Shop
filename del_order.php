<?php
require_once __DIR__ . '/src/Order.php';
require_once __DIR__ . '/config.php';



if(Order::delete($conn, $_GET['id'])){
    header('Location: basket.php');
}  else {
    echo"cos nie działa";
    header('Location: basket.php');
}

