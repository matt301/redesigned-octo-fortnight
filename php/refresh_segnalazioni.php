<script src="../js/ajax_segnalazioni.js"></script>
<?php
include ('reserved/https_conn.php');
    include('reserved/credenziali.php');

    session_start();


    $conn = new mysqli($mysql_server,$mysql_user,$mysql_pass,$mysql_db);
    if($conn -> connect_error) die ("Connection Failed: ".$conn->connect_error);

    if(isset($_GET['categoria'])) {
        $stmt = $conn->prepare("SELECT * FROM Segnalazioni WHERE categoria=? ORDER BY data_inserimento DESC ");
        $stmt->bind_param("s",$_GET['categoria']);
    }
    else{
        $stmt = $conn->prepare("SELECT * FROM Segnalazioni ORDER BY data_inserimento DESC ") ;
    }

    $stmt->execute();
    $result = $stmt->get_result();
    while($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
        $autore = $row['autore'];
        $titolo =  $row['titolo'];
        $subtitle =  $row['sottotitolo'];
        $categoria =  $row['categoria'];
        $address =$row['indirizzo'];
        $foto =  $row['foto'];
        echo "<div class=\"col-lg-3 col-md-6 mb-4\">
                  <div class=\"card\">
                      <img class=\"card-img-top\" src=\"../img/img-segnalazioni/".$foto."\" alt=\"immagine non disponibile\">
                      <div class=\"card-body\">
                          <h4 class=\"card-title\">".$titolo."</h4>
                          <p class=\"card-text\">".$subtitle."</p>
                          <p class=\"card-footer\" id=\"address\">".$address."</p>
                      </div>
                      <div class=\"card-footer\">
                        <a href=\"#\" class=\"btn btn-primary\" onclick=\"loadPost(".$id.")\">Scopri di più</a>   
                      </div>
                  </div>
              </div>";
    }



mysqli_close($conn);
?>


