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
$titolo = test_input($_POST['titolo']);
$subtitle = test_input($_POST['sottotitolo']);
$categoria = test_input($_POST['categoria']);
$descrizione = test_input($_POST['descrizione']);
$indirizzo = test_input($_POST['indirizzo']);


//Gestione Immagini

$tmp_name = $_FILES['foto']['tmp_name'];
$nome_foto=$_FILES['foto']['name'];
$tipo_foto = $_FILES['foto']['type'];
$size_foto = $_FILES['foto']['size'];

$uploaddir = '../img/img-segnalazioni/';


//se esiste già una foto con il nome selezionato lo modifico
$target_file = '../img/img-segnalazioni/' . $_FILES['foto']['name'];
if (file_exists($target_file)) {
    $nome_foto = rand(0,10000).".jpg";
}
//se non é stata caricata alcuna foto mostra immagine "nofoto.jpg"
if (!isset($_FILES['foto']) || !is_uploaded_file($_FILES['foto']['tmp_name'])) {
    $nome_foto = "nofoto.jpg";
}

move_uploaded_file($tmp_name, $uploaddir.$nome_foto);

//Fine Gestione Immagini


$stmt = $conn->prepare("INSERT INTO Segnalazioni(autore,titolo,sottotitolo,categoria,descrizione,indirizzo,foto) VALUES (?,?,?,?,?,?,?)");
$stmt->bind_param("sssssss", $_SESSION['username'],$titolo,$subtitle,$categoria,$descrizione,$indirizzo,$nome_foto);



if ($stmt->execute() === TRUE) {

    header('Location:profilo.php');
}
else {
    echo "Errore di inserimento sul database" ;
}

$conn->close();
