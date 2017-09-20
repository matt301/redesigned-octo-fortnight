
<?php
include ('reserved/https_conn.php');
include('reserved/credenziali.php');

session_start();
$conn = new mysqli($mysql_server,$mysql_user,$mysql_pass,$mysql_db);

if($conn -> connect_error) die ("Connection Failed: ".$conn->connect_error);

//funzione che controlla la 'bontà' dei dati ricevuti in input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = str_replace("'" , "&#39;" , $data);
    return $data;
}

$user = test_input($_POST['email']);
$pass = test_input($_POST['password']);
$remeber = test_input(isset($_POST['rememberme']) ? $_POST['rememberme'] : 'n'); // = y se selezionato, altrimente é = n



$stmt = $conn->prepare("SELECT * FROM Utenti WHERE email=? ") ;
$stmt->bind_param("s", $user);

$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows>0) {
    $row = $result->fetch_assoc();
    if(password_verify($pass,$row["password"])) {
        $first_name = $row["nome"];
        $last_name = $row["cognome"];
        $_SESSION['username'] = $row['email'];



       //se autologin é selezionato //
        if ($remeber == 'y') {
            $cookie_name = 'username';
            $cookie_value = $user;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
        }

        $stmt = $conn->prepare("UPDATE Utenti SET online=1 WHERE email=?") ;
        $stmt->bind_param("s", $user);

        $stmt->execute();
        $stmt->get_result();


        header('Location:home.php');
    }
    else
        header('Location:cred_errore.php');

}
else
    header('Location:cred_errore.php');









