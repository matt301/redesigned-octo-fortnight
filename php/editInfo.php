<?php
include ('reserved/https_conn.php');
include('reserved/credenziali.php');
session_start();
if(!isset($_SESSION['username']))
    header('Location:../index.php');

$conn = new mysqli($mysql_server,$mysql_user,$mysql_pass,$mysql_db);
if($conn -> connect_error) die ("Connection Failed: ".$conn->connect_error);

$stmt = $conn->prepare("SELECT * FROM Utenti WHERE email=? ") ;
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows>0) {
    $row = $result->fetch_assoc();
    $nome = $row['nome'];
    $cognome = $row['cognome'];
    $data = $row['data_di_nascita'];
    $ntel = $row['n_tel'];
    $address = $row['indirizzo'];
    $email = $row['email'];

}

?>


<form action="" method="post" nome="form_editInfo">
<ul class='list-unstyled'>
   <li><i class='fa fa-life-saver'></i><span class='sr-only'>Nome:</span><input type="text" name="changeName" value="<?=$nome?>"></li>
    <li><i class='fa fa-life-saver'></i><span class='sr-only'>Cognome:</span><input type="text" name="changeSurname" value="<?=$cognome?>"></li>
    <li><i class='fa fa-birthday-cake'></i><span class='sr-only'>Data di nascita:</span><input type="date" name="changeDate" value="<?=$data?>"></li>
    <li><i class='fa fa-map-marker'></i><span class='sr-only'>Indirizzo</span><input type="text" name="changeAddress" value="<?=$address?>"></li>

    <li><i class='fa fa-send'></i><span class='sr-only'>Email:</span><input disabled type="email"  value="<?=$email?>"></li>
    <li><i class='fa fa-phone'></i><span class='sr-only'>Numero di telefono:</span><input type="text" name="changeTel" value="<?=$ntel?>"></li>
    <li> <input class="btn btn-success" type="submit" name="modifica_info" value="Invia"></li>
</ul>

</form>
