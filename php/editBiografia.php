<?php
include ('reserved/https_conn.php');
include('reserved/credenziali.php');
session_start();
if(!isset($_SESSION['username']))
    header('Location:../index.php');

$conn = new mysqli($mysql_server,$mysql_user,$mysql_pass,$mysql_db);
if($conn -> connect_error) die ("Connection Failed: ".$conn->connect_error);

?>
<form action="" method="post" name="form_editBio">
    <textarea class="form-text"name="bio" maxlength="500" style="width: 100%" ></textarea>
         <input type="submit" class="btn btn-success" name="modifica_bio" value="Invia">
</form>
