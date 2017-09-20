<?php
include ('reserved/https_conn.php');
include('reserved/credenziali.php');
session_start();
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = str_replace("'" , "&#39;" , $data);
    return $data;
}
if(!isset($_SESSION['username']))
    header('Location:../index.php');

$conn = new mysqli($mysql_server,$mysql_user,$mysql_pass,$mysql_db);
if($conn -> connect_error) die ("Connection Failed: ".$conn->connect_error);

$stmt = $conn->prepare("SELECT from_usr,message,sent FROM chat ORDER BY sent DESC") ;
$stmt->execute();
$result = $stmt->get_result();
while($row = mysqli_fetch_array($result)) {
    $mittente = $row['from_usr'];
    $message = $row['message'];
    echo "<div class='msgln'>(".$row['sent'].") <b>".$mittente."</b>: ".test_input($message)."<br></div>";

}