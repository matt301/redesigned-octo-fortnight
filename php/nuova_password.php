<?php

include ('reserved/https_conn.php');
include ("reserved/credenziali.php");
include ("PHPMailer/class.phpmailer.php");
include ("PHPMailer/class.smtp.php");
include ("reserved/SMTP_access.php");

$conn = new mysqli($mysql_server,$mysql_user,$mysql_pass,$mysql_db);
if($conn -> connect_error) die ("Connection Failed: ".$conn->connect_error);

//funzione che crea una password random
function random($lunghezza){
	$caratteri_disponibili ="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	$codice = "";
	for($i = 0; $i<$lunghezza; $i++){
		$codice = $codice.substr($caratteri_disponibili,rand(0,strlen($caratteri_disponibili)-1),1);
	}
	return $codice;
}



//il controllo del get evita errori di pagina
if(isset($_GET['hash'])) {

    $password_old = $_GET['hash'];


    $password = random(8); //nuova password di 8 caratteri
    $password_hashed = password_hash($password, PASSWORD_BCRYPT);

    //controllo che i valori dell’hash corrispondano ai valori salvati nel database
    $stmt = $conn->prepare("SELECT * FROM Utenti WHERE password=? ");
    $stmt->bind_param("s", $password_old);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];


        //salvo la nuova password al posto della vecchia
        $stmt = $conn->prepare("UPDATE Utenti SET password=? WHERE password=? ");
        $stmt->bind_param("ss", $password_hashed, $password_old);

        $stmt->execute();
        $result = $stmt->get_result();

        $mittente = "progetto.saw@gmail.com";
        $nomemittente = "TROVATUTTO";
        $destinatario = $email;
        $ServerSMTP = "smtp.gmail.com"; //server SMTP


        $corpo_messaggio = "Ecco la tua nuova password: " . $password . "
		Ora puoi accedere all'area http://webdev.dibris.unige.it/~S4094311/TROVATUTTO/";


        $msg = new PHPMailer;
        $msg->IsSMTP(); // Utilizzo della classe SMTP al posto del comando php mail()
        $msg->SMTPAuth = true; // Autenticazione SMTP
        $msg->SMTPKeepAlive = "true";
        $msg->Host = $ServerSMTP;
        $msg->Username = $SMTP_Username; // Nome utente SMTP autenticato
        $msg->Password = $SMTP_Password; // Password account email con SMTP autenticato

        $msg->From = $mittente;
        $msg->FromName = $nomemittente;
        $msg->Subject = "Nuova password provvisoria";
        $msg->AddAddress($destinatario);
        $msg->Body = "$corpo_messaggio";

        //invio email

        if (!$msg->Send()) {
            echo "Errore nella spedizione: " . $msg->ErrorInfo;
        } else {
            header("Location:provv.php");
        }

    }



} // Chiusura {if(isset($_GET['hash']))}

?>