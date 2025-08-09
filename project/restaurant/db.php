<?php
$server="localhost";
$user="root";
$password="";
$dbname="restaurant_db";
$conn=new mysqli($server, $user, $password, $dbname); //create a new connection to pass all the parameters here
if(!$conn){
    echo "error: {:$conn->connect_error}";
}
?>