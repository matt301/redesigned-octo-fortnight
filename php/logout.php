<?php
include ('reserved/https_conn.php');
include('reserved/credenziali.php');

session_start();
$conn = new mysqli($mysql_server,$mysql_user,$mysql_pass,$mysql_db);

if($conn -> connect_error) die ("Connection Failed: ".$conn->connect_error);

$stmt = $conn->prepare("UPDATE Utenti SET online=0 WHERE email=?") ;
$stmt->bind_param("s", $_SESSION['username']);

$stmt->execute();
$stmt->get_result();

$conn->close();

session_destroy();
setcookie('username', $_SESSION['username'], time() - 1, "/");

header("Location:../index.php");

?>