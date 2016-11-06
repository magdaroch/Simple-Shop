<?php
/**
 * Created by PhpStorm.
 * User: Magda
 * Date: 2016-11-06
 * Time: 12:07
 */
$serverName = 'localhost';
$userName = 'root';
$password = "coderslab";
$database = "Simple_shop";

$conn =  new mysqli($serverName, $userName, $password, $database);

if($conn->connect_error){
    die("conect error: ".$conn->connect_error);
}