
<!-- Scrip per l'acquisizione dei dati dell'utente -->
<?php
    include ('reserved/https_conn.php');
    include('reserved/credenziali.php');
    session_start();
    if(!isset($_SESSION['username']))
        header('Location:../index.php');

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $conn = new mysqli($mysql_server,$mysql_user,$mysql_pass,$mysql_db);
    if($conn -> connect_error) die ("Connection Failed: ".$conn->connect_error);

    if(isset($_COOKIE['username'])) {
         $_SESSION['username'] = $_COOKIE['username'];
         $stmt = $conn->prepare("UPDATE Utenti SET online=1 WHERE email=?") ;
         $stmt->bind_param("s", $_SESSION['username']);

         $stmt->execute();
         $stmt->get_result();
    }

    // MODIFICA BIO
    if(isset($_POST['modifica_bio'])) {
        $changeBio = test_input($_POST['bio']);
        $stmt = $conn->prepare("UPDATE Utenti SET descrizione=? WHERE email=?") ;
        $stmt->bind_param("ss",$changeBio ,$_SESSION['username']);
        $stmt->execute();
        $stmt->get_result();
    }

    // MODIFICA PROFILO

    if(isset($_POST['modifica_info'])) {
        $changeName = test_input($_POST['changeName']);
        $changeSurname = test_input($_POST['changeSurname']);
        $changeTel = test_input($_POST['changeTel']);
        $changeDate = test_input($_POST['changeDate']);
        $changeAddress= test_input($_POST['changeAddress']);
        $stmt = $conn->prepare("UPDATE Utenti SET nome=?,cognome=?,data_di_nascita=?,n_tel=?,indirizzo=? WHERE email=?") ;
        $stmt->bind_param("ssssss", $changeName,$changeSurname,$changeDate,$changeTel,$changeAddress,$_SESSION['username']);
        $stmt->execute();
        $stmt->get_result();
    }



    $stmt = $conn->prepare("SELECT * FROM Utenti WHERE email=? ") ;

    $stmt->bind_param("s", $_SESSION['username']);

    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows>0) {
      $row = $result->fetch_assoc();
        $nome = $row['nome'];
        $cognome = $row['cognome'];
        $birthdate = $row['data_di_nascita'];
        $ntel = $row['n_tel'];
        $address = $row['indirizzo'];
        $email = $row['email'];
        $bio = $row['descrizione'];
}

?>
<!-- //fine script-->

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TROVATUTTO - Profilo</title>
    <link rel="icon" type="icon/png" href="../img/icon.png">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'> 
    <!-- Global CSS -->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.css">

    <!-- Theme CSS -->

    <link id="theme-style" rel="stylesheet" href="../css/profile-style.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="../js/ajax_segnalazioni.js" type="text/javascript"></script>

    <!-- Script ajax per editing profilo -->
    <script src="../js/edit_profilo.js"></script>

</head> 

<body>

<noscript> <div style="width:100%;top:90%;background-color:white;font-size: 40px; color: red; position: fixed; text-align:center ; z-index: 666 ">Abilitare Javascript per visualizzare correttamente il sito!</div> </noscript>

    <!-- ******HEADER****** --> 
    <header class='header'>
        <div class='container'>                       
            <img class='profile-image img-responsive pull-left' src='../img/avatar.png'  alt='Io' />
            <div class='profile-content pull-left'>
                <h1 class='name'><?=$nome ." ". $cognome?></h1>
                <h2 class='desc'>Utente</h2>   
                <ul class='social list-inline'>
                    <li><a href='https://www.twitter.com/' target="_blank"><i class='fa fa-twitter'></i></a></li>
                    <li><a href='https://www.facebook.com/' target="_blank"><i class='fa fa-facebook'></i></a></li>
                    <li><a href='https://www.linkedin.com/' target="_blank"><i class='fa fa-linkedin'></i></a></li>
                    <li><a href='https://www.github.com/' target="_blank"><i class='fa fa-github-alt'></i></a></li>
                                
                </ul> 
            </div><!--//profile-->
            <a class='btn btn-cta-primary pull-right' href='segnala.php' target='_top'><i class='fa fa-send'></i> Invia segnalazione</a>

        </div><!--//container-->
    </header><!--//header-->

    <div class='container sections-wrapper'>
        <div class='row'>
            <div class='primary col-md-8 col-sm-12 col-xs-12' >

                <!-- BIOGRAFIA -->

                <section class='about section'>
                    <div class='section-inner'>
                        <h2 class='heading'>About Me  <a onclick="editBio()" class="btn btn-xs btn-default  ">modifica</a></h2>
                        <div class='content' id="bio">

                            <p><?=$bio?></p>
                        </div>
                    </div>
                </section>



               <section class='latest section' >
                    <div class='section-inner' >
                        <h2  class='heading'>Mie segnalazioni</h2>
                        <div class='content'  >
                                               
                            <div class='item featured text-center' >

                                <a class='btn btn-lg btn-cta-secondary' href='home.php' target='_top'><i class='fa fa-home'></i> Home segnalazioni</a>
                            </div><!--//item-->


                            <hr class='divider' id="mie_segnalzioni"/>

                            <!-- Scarico le segnalazioni fatte dal proprietario del profilo -->
                            <?php
                                $stmt = $conn->prepare("SELECT * FROM Segnalazioni WHERE autore=? ORDER BY data_inserimento DESC") ;
                                $stmt->bind_param("s", $_SESSION['username']);

                                $stmt->execute();
                                $result = $stmt->get_result();
                                while($row = $result->fetch_assoc()) {
                                    $id = $row ['id'];
                                    $titolo = $row['titolo'];
                                    $subtitle = $row['sottotitolo'];
                                    $descr = $row['descrizione'];
                                    $img = $row['foto'];
                                    $categoria = $row['categoria'];
                                    $indirizzo = $row['indirizzo'];
                                    $data_ins = $row['data_inserimento'];

                                    echo "<div class='item row'>
                                               <a class='col-md-4 col-sm-4 col-xs-12' disabled>
                                                    <img  class='img-responsive project-image' src='../img/img-segnalazioni/" . $img . "' alt='" . $img . "' />
                                               </a>
                                               <div class='desc col-md-8 col-sm-8 col-xs-12'>
                                                    <h3 class='title'><a   disabled >" . $titolo . "</a></h3>
                                                    <p>" . $subtitle . "</p>
                                                    <p><a class='more-link' href=\"delete.php?id=".$id."\"><i class='fa fa-trash'></i> Elimina segnalazione</a></p>
                                               </div><!--//desc-->                          
                                          </div><!--//item-->";
                                }


                            ?>

                        </div><!--//content-->  
                    </div><!--//section-inner-->                 
                </section><!--//section-->
            </div><!--//primary-->


            <div class='secondary col-md-4 col-sm-12 col-xs-12'>
                 <aside class='info aside section'>
                    <div class='section-inner'>
                        <h2 class='heading '>Info personali </h2>
                        <div class='content' id="info" >
                            <ul class='list-unstyled'>
                                <li><i class='fa fa-life-saver'></i><span class='sr-only'>Nome e Cognome:</span><a href='#'><?=$nome." ".$cognome?></a></li>
                               <li><i class='fa fa-birthday-cake'></i><span class='sr-only'>Data di nascita:</span><a href='#'><?=$birthdate?></a></li>
                               <li><i class='fa fa-map-marker'></i><span class='sr-only'>Indirizzo</span><?=$address?></li>

                                <li><i class='fa fa-send'></i><span class='sr-only'>Email:</span><a href='#'><?=$email?></a></li>
                                <li><i class='fa fa-phone'></i><span class='sr-only'>Numero di telefono:</span><a href='#'><?=$ntel?></a></li>
                            </ul>
                        </div><!--//content-->  
                    </div>

                     <a onclick="editInfo()" class="btn btn-info center-block">Modifica informazioni</a>
                     <a class="btn btn-link center-block" href="modifica_pass.php">Modifica password</a>
                     <a class='btn btn-danger center-block' href='logout.php' target='_top'><i class='fa fa-ban'></i> Logout</a>


                 </aside><!--//aside-->
                

 
    <!-- Javascript -->
                <script type='text/javascript' src='../js/ajax_segnalazioni.js'></script>
    <script type='text/javascript' src='../vendor/jquery.js'></script>
    <script type='text/javascript' src='../vendor/bootstrap/js/bootstrap.js'></script>

</body>
</html> 

