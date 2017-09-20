<script src='../js/ajax_segnalazioni.js'></script>

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

    $stmt->bind_param("s", $_SESSION['username']);


    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows>0) {
        $row = $result->fetch_assoc();
        $nome = $row['nome'];
        $cognome = $row['cognome'];
    }


    $ID = $_GET['id'];

    $query = "SELECT * FROM Segnalazioni WHERE `ID`=$ID";
    $result = mysqli_query($conn,$query);
    while($row = mysqli_fetch_array($result)) {
        $controllo = $row['id'];
        if ($controllo==$ID){
            $autore = $row['autore'];
            $titolo =  $row['titolo'];
            $subtitle =  $row['sottotitolo'];
            $categoria =  $row['categoria'];
            $descrizione =  $row['descrizione'];
            $indirizzo =  $row['indirizzo'];
            $foto =  $row['foto'];
            $data_ins =  $row['data_inserimento'];
        }
    }



echo
   "
<!-- Page Content -->
    <div class=\"container my-5\">

        <div class=\"row\">
            <div class=\"col-sm-12\">
                <div class=\"page-it\">
                     <h1>".$titolo."</h1>
                     <p>Creata da <span class=\"glyphicon glyphicon-user\"></span> <a href=\"profilo_pubblico.php?email=".$autore."\">".$autore."</a> il <span class=\"glyphicon glyphicon-time\"></span> ".$data_ins."</p>
                </div>
            </div>
        </div>



        <!-- /.row -->

        <div class=\"row\">
             <div class=\"col-sm-8\">
                 <!-- Image -->
                 <figure class=\"m-2\">
                    <img class=\"card-img-top\" src=\"../img/img-segnalazioni/".$foto."\" alt=\"".$foto."\">
            
                 </figure>


                 <p class=\"lead\">".$subtitle."</p>
                 <hr>
                 <p>".$descrizione."</p>
                 <hr>
     
             </div>
    
        </div>
        
        <div class=\"row\">
             <div class=\"col-sm-8\">
             <span>Visualizza sulla mappa:  </span>
             <a href='mappe.php?ID=".$ID."'>".$indirizzo."</a>
             </div>

         </div>
         <hr>
 
        
        <!-- Pager -->
        <div class=\"row\">
            <div class=\"col-sm-8\">
                 <nav>
                     <ul class=\"pager\">
                        <li class=\"previous\"><a href=\"home.php\"><span class=\"glyphicon glyphicon-arrow-left\" aria-hidden=\"true\"></span>  Indietro</a></li>
                     
                     </ul>
                 </nav>
             </div>

        </div>
    </div>
    <!-- /.container -->";
?>