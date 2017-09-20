<?php
include ('reserved/https_conn.php');
include('reserved/credenziali.php');
session_start();
if(!isset($_SESSION['username']))
    header('Location:../index.php');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = str_replace("'" , "&#39;" , $data);
    return $data;
}

$id = test_input($_GET['id']);

$conn = new mysqli($mysql_server,$mysql_user,$mysql_pass,$mysql_db);
if($conn -> connect_error) die ("Connection Failed: ".$conn->connect_error);

$stmt = $conn->prepare("DELETE FROM Segnalazioni WHERE autore=? AND id=? ") ;
$stmt->bind_param("ss", $_SESSION['username'],$id);
$stmt->execute();
$result = $stmt->get_result();
header("Location:profilo.php");
?>