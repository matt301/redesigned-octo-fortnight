<?php
include ('reserved/https_conn.php');
include('reserved/credenziali.php');
session_start();
if(!isset($_SESSION['username']))
    header('Location:../index.php');

if(isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
}

$conn = new mysqli($mysql_server,$mysql_user,$mysql_pass,$mysql_db);
if($conn -> connect_error) die ("Connection Failed: ".$conn->connect_error);

$stmt = $conn->prepare("SELECT * FROM Utenti WHERE email=? ") ;

$error="";
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows>0) {
    $row = $result->fetch_assoc();
    $oldpassword= $row['password'];

}

if(isset($_POST['modifica_password'])){
    if(password_verify($_POST['old'],$oldpassword)){
        $stmt = $conn->prepare("UPDATE Utenti SET password=? WHERE email=? ");
        $newpassword = password_hash($_POST['new'],PASSWORD_BCRYPT);
        $stmt->bind_param("ss",$newpassword, $_SESSION['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        header("Location:profilo.php");

    }
    else $error = "La password inserita non corrisponde! ";
}

?>




<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../img/icon.jpg">

    <title>Modifica password</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/narrow-jumbotron.css" rel="stylesheet">
  </head>

  <body>

    <div class="container-fluid">
      <div class="header clearfix">
        <h3 class="text-muted">Trovatutto</h3>
      </div>
    <hr>
      <div class="jumbotron">
        <h1 class="display-3">Modifica PASSWORD</h1>
        <p class="lead">Per modificare la password inserisci quella vecchia e successivamente quella nuova</p>
          <form action="" method="post" id="modificaPass">

              <div >

                  <label for="old">Vecchia password: </label>
                  <input type="password" name="old""  /><br>
                  <label for="new">Nuova password: </label>
                  <input type="password" name="new" /><br>

                      <span class="h5" name="errore" id="errore" style="color: red"> <?=$error?></span>


              </div>


              <br>
              <div >
                  <input class="btn btn-lg btn-success" type="submit" name="modifica_password" value="Invia" role="button" />

              </div>

          </form>
          <br>

        <p><a class="btn btn-lg btn-danger" href="profilo.php" role="button">Annulla</a></p>
      </div>

   
      <footer class="footer">
        <p>© Progetto Saw 2017</p>
      </footer>

    </div> <!-- /container -->



</body></html>