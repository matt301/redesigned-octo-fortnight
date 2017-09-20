<?php
include ('reserved/https_conn.php');
include('reserved/credenziali.php');
session_start();
$conn = new mysqli($mysql_server,$mysql_user,$mysql_pass,$mysql_db);
if($conn -> connect_error) die ("Connection Failed: ".$conn->connect_error);

if(isset($_SESSION['username'])){
    $message = $_POST['text'];

    $s = $conn->prepare("INSERT INTO chat(from_usr,message) VALUE(?,?)") ;
    $s->bind_param("ss", $_SESSION['username'],$message);

    $s->execute();
    $s->get_result();
}
?>