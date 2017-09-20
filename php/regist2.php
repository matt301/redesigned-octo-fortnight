<?php
include ('reserved/https_conn.php');
include('reserved/credenziali.php');

session_start();
$conn = new mysqli($mysql_server,$mysql_user,$mysql_pass,$mysql_db);

if($conn -> connect_error) die ("Connection Failed: ".$conn->connect_error);

//Funzione che controlla la bontà dei dati ricevuti in input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = str_replace("'" , "&#39;" , $data);
    return $data;
}

// Acquisizione dati dal form di registrazione
$nome = test_input($_POST['nome']);
$cognome = test_input($_POST['cognome']);
$data = test_input($_POST['data_di_nascita']);
$ntel = test_input($_POST['ntel']);
$address = test_input($_POST['indirizzo']);
$email = test_input($_POST['email']);
$pass = test_input($_POST['password']);

$pass_hash = password_hash($pass, PASSWORD_BCRYPT); // criptazione password

$stmt = $conn->prepare("INSERT INTO Utenti(email,password,nome,cognome,data_di_nascita,n_tel,indirizzo) VALUES (?,?,?,?,?,?,?)");
$stmt->bind_param("sssssss", $email,$pass_hash,$nome,$cognome,$data,$ntel,$address);



if ($stmt->execute() === TRUE) {
    $_SESSION['username'] = $email;
    header('Location:profilo.php');
}
else {
    header('Location:utente_doppio.php');
}

$conn->close();