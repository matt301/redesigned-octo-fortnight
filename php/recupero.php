<?php
include ('reserved/https_conn.php');
include ("reserved/credenziali.php");
include ("PHPMailer/class.phpmailer.php");
include ("PHPMailer/class.smtp.php");
include ("reserved/SMTP_access.php");// file contentente le credenziali di accesso dell'account di posta

$conn = new mysqli($mysql_server,$mysql_user,$mysql_pass,$mysql_db);
if($conn -> connect_error) die ("Connection Failed: ".$conn->connect_error);

/* PARTE DELL’INVIO EMAIL.
Si controlla che l'email (=user) sia presente nel db. Estraggo quindi la password dell'utente e la  passo nel $_GET.
La stringa su cui cliccare è inviata per email, come conferma, e rinvia al file “nuova_password.php”.
*/
$done="";
if(isset($_POST['invia'])){


	$errore=0; //variabile di controllo errori (se rimane a 0 non ci sono errori)
	
	if($_POST['email']==""){
		$errore=1;
	}else{


        $stmt = $conn->prepare("SELECT password FROM Utenti WHERE email=? ") ;


        $stmt->bind_param("s", $_POST['email']);

        $stmt->execute();
        $result = $stmt->get_result();

		if($result->num_rows>0){
            $row = $result->fetch_assoc();
			//l’hash ci servirà per recuperare i dati utente e confermare la richiesta
			//la password nel database si presume criptata, con md5 o altro algoritmo

			$hash=$row['password'];
		}else{
            $errore=1;
            $done="L'email inserita non ha corrispondenze";
        }


		
	}	
	
	//se non ci sono stati errori, invio l’email all’utente con il link da confermare
	if($errore==0){


        $mittente = "recupero@trovatutto.it";
        $nomemittente = "TROVATUTTO";
        $destinatario = $_POST['email'];
        $ServerSMTP = "smtp.gmail.com"; //server SMTP
		

		$corpo_messaggio= "Clicca o copia nel browser il seguente indirizzo: http://webdev.dibris.unige.it/~S4094311/TROVATUTTO/php/nuova_password.php?hash=".$hash."";


        $msg = new PHPMailer;
        $msg->IsSMTP(); // Utilizzo della classe SMTP al posto del comando php mail()
        $msg->SMTPAuth = true; // Autenticazione SMTP
        $msg->SMTPKeepAlive = "true";
        $msg->Host = $ServerSMTP;
        $msg->Username = $SMTP_Username; // Nome utente SMTP autenticato
        $msg->Password = $SMTP_Password; // Password account email con SMTP autenticato


        $msg->From = $mittente;
        $msg->FromName = $nomemittente;
        $msg->Subject = "Recupero password";
        $msg->AddAddress($destinatario);
        $msg->Body = "$corpo_messaggio";

		//invio email

        if(!$msg->Send()) {
            $done = "Errore nella spedizione: ".$msg->ErrorInfo;
        } else {
            header("Location: linkProvv.php");
        }


	
	}


}
?>


<!-- FORM BASE
L'utente inserisce la sua email (che dovrà corrispondere a quella salvata nel database).
-->



<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../img/icon.jpg">

    <title>Recupera password</title>

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
        <h1 class="display-3">Recupera PASSWORD</h1>
        <p class="lead">Per recuperare la password inserire la propria mail e vi sarà inviato un link con le istruzioni per creare la nuova chiave di accesso</p>

        <form action="" method="post" id="recupero">

            <div >
                <label for="email">Email: </label>
                <input type="email" name="email" value="<?=@$_POST['email']?>" />
                <span style="color: red;" id="done"  ><?=$done?></span>
            </div>


            <br>
            <div >
                <input class="btn btn-lg btn-success" type="submit" name="invia" value="Invia" role="button" />

            </div>



        </form>
        <br>
        <p><a class="btn btn-lg btn-danger " href="../index.php">Indietro</a> </p>

    </div>


    <footer class="footer">
        <p>© Progetto Saw 2017</p>
    </footer>

</div> <!-- /container -->


</body></html>