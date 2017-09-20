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

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = str_replace("'" , "&#39;" , $data);
    return $data;
}

$stmt = $conn->prepare("SELECT * FROM Utenti WHERE email=? ") ;


$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows>0) {
    $row = $result->fetch_assoc();
    $nome = $row['nome'];
    $cognome = $row['cognome'];
}

?>

<!DOCTYPE html>
    <html lang="it">

      <head>

          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <meta name="description" content="">
          <meta name="author" content="">


          <link rel="icon" type="icon/png" href="../img/icon.png">
          <title>TROVATUTTO - HOME</title>

          <!-- Bootstrap core CSS -->
          <link href="../vendor/bootstrap/css/css_home/bootstrap.css" rel="stylesheet"/>


          <!-- Custom styles for this template -->
          <link href="../css/heroic-features.css" rel="stylesheet"/>

          <!-- Script AJAX per scaricare le segnalazioni dal DB -->
          <script src="../js/ajax_segnalazioni.js" type="application/javascript"></script>

      </head>

      <body  onload="loadXMLDoc()">

      <noscript> <div style="width:100%;top:90%;background-color:white;font-size: 40px; color: red; position: fixed; text-align:center ">Abilitare Javascript per visualizzare correttamente il sito!</div> </noscript>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
          <div class="container">
            <a class="navbar-brand" href="home.php" >
                <img src="../img/logo.png" alt="trovatutto"/>
            </a>

            <div>
              <ul class="navbar-nav ml-auto">
                <li class="nav-item active ">
                    <a class="nav-link" href="profilo.php">
                        <img src="../img/user-pic.png"  alt="profilo"><b><?=" ".$nome." ".$cognome?> </b>
                    </a>
                </li>

              </ul>
            </div>
          </div>
        </nav>

        <!-- Page Content -->

        <div class="container" id="pagina">




            <!-- CHAT -->

                <div id="wrapper" class="my-5 rounded border-dark bg-secondary">
                    <div id="menu">
                        <p class="welcome">
                            Welcome, <b><?php echo $nome." ".$cognome; ?></b>
                        </p>


                    </div>

                    <form name="message" action="" class="col-lg-12">
                        <input name="usermsg" type="text" id="usermsg" class="border-dark bg-light" placeholder="Inserisci il tuo messaggio..." />
                        <input onclick="window.location.reload();" class="btn border-dark btn-primary" name="submitmsg" type="submit" id="submitmsg"  value="Send" />
                    </form>

                    <div id="chatbox" class="border-dark bg-light">
                        <?php
                        $stmt = $conn->prepare("SELECT from_usr, message, sent FROM chat ORDER BY sent DESC ") ;
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while($row = mysqli_fetch_array($result)) {
                            $mittente = $row['from_usr'];
                            $message = $row['message'];
                            echo "<div class='msgln'>(".$row['sent'].") <b>".$mittente."</b>: ".test_input($message)."<br></div>";

                        }
                        ?>
                    </div>


                </div>

            <!-- /CHAT -->



          <!-- Jumbotron Header -->
          <div class="jumbotron my-5">
            <h1 class="display-3">Segnalazioni</h1>
              <p class="lead">In questa pagina troverete tutti gli articoli ritrovati sia tabulati con foto e una piccola descrizione sia inseriti nella mappa nel luogo in cui sono stati rinvenuti al fine di rendere più facile il riconoscimento. </p>
              <button class="btn btn-success btn-lg"  onclick="loadXMLDoc()">Visualizza tutte le segnalazioni</button>
              <label class="h5" for="categoria">Cerca per categoria:</label>
              <select  class="btn btn-secondary btn-lg" id="categoria" name="categoria" onchange="loadCategoria(document.getElementById('categoria').value)" >
                    <option selected></option>
                    <option>Effetti personali</option>
                    <option>Dispositivi elettronici</option>
                    <option>Libri</option>
                    <option>Gioielli</option>
                    <option>Vestiario</option>
                    <option>Documenti</option>
                    <option>Animale</option>
                    <option >Altro</option>
            </select>

          </div>



          <!-- Contenitore segnalazioni -->
          <div class="row text-center" id="contenitore">

              <!-- I div  contenenti le segnalazioni sono generati dinamicamente -->
              <!-- /////////////////////////////////-->
              <!-- /////////////////////////////////-->
              <!-- /////////////////////////////////-->

          </div>
        </div>
        <hr>
        <!-- /.container -->

        <!-- Footer -->
        <footer class="py-4 bg-dark ">
          <div class="container">
            <p class="m-0 text-center text-white">Progetto SAW &copy; 2017</p>
          </div>
          <!-- /.container -->
        </footer>


        <!-- Bootstrap core JavaScript -->
        <script src="../vendor/jquery/jquery.js"></script>
        <script  src="../vendor/popper/popper.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Scrip CHAT -->
        <script type="text/javascript" src="../js/chat.js"></script>


      </body>

    </html>
