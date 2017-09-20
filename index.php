<?php
include ('php/reserved/https_conn.php');
session_start();
if(isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    header('Location:php/home.php');
}
?>

<!DOCTYPE html>
<html lang="it">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Progetto SAW 2017">
    <meta name="author" content="Rossi Matteo, Zignaigo Alessio">

    <title>TROVATUTTO</title>
    <link rel="icon" type="icon/png" href="img/icon.png">

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- Theme CSS -->
    <link href="css/grayscale.css" rel="stylesheet">
    <link href="css/login_style.css" rel="stylesheet">



</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<noscript> <div style="width:100%;top:90%;background-color:white;font-size: 40px; color: red; position: fixed; text-align:center ">Abilitare Javascript per visualizzare correttamente il sito!</div> </noscript>


<!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" >
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <i class="fa fa-search"></i> <span style="color: red;">Trova</span><span>Tutto</span>
                </a>
            </div>

            <!--  Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav ">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <!--<li>
                        <a class="page-scroll" href="#download">Download</a>
                    </li> -->

                    <li>
                        <a class="page-scroll" href="#contact">Contatti</a>
                    </li>
                    <li>
                        <!-- Login Starts Here -->
                        <div class="btn btn-success" >
                                <a href="#" id="loginButton"><span>Login</span><em></em></a>
                            <div style="clear:both"></div>
                            <div id="loginBox">
                                <form id="loginForm" action="php/login2.php" method="post" name="loginForm">
                                    <fieldset id="body">
                                        <fieldset>
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" placeholder="Email" required />
                                        </fieldset>
                                        <fieldset>
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" placeholder="Password" required />
                                        </fieldset>
                                        <input type="submit" id="login" value="Sign in" />
                                        <label for="checkbox"><input type="checkbox" name="rememberme" id="checkbox" value="y" />Ricordami</label>
                                    </fieldset>
                                    <span><a href="php/registrazione.php">Non sei registrato?</a></span>
                                    <span><a href="php/recupero.php?mode=pwd">Hai dimenticato la password?</a></span>
                                </form>
                            </div>
                        </div>
                        <!-- Login Ends Here -->
                    </li>
                </ul>

            </div>
            <!-- /.navbar-collapse -->

        </div>
        <!-- /.container -->
    </nav>


<!-- Intro Header -->
    <header class="intro">

    </header>
<div class="row">
    <div class="col-md-8 col-md-offset-2" align="center" id="centerpage">
        <a  href="#about" class="btn btn-circle page-scroll"> <i class="fa fa-angle-double-down animated"></i></a>
    </div>
</div>

    <!-- About Section -->
              

			
    <section id="about" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>About</h2>
                <p>Questo sito é il progetto per SAW-2017 dell'Università degli Studi di Genova sviluppato da Alessio Zignaigo e Matteo Rossi studenti del corso in questione.</p>
                <p>La piattaforma  ha la funzione di rappresentate uno strumento utile per la comunità. Qui si potrà segnalare eventuali oggetti trovati per strada o in ambienti pubblici al fine di semplificarne il ritrovamento da parte di coloro che li hanno persi.</p>
                <p>Questa piattaforma ha come base di funzionamento il buon senso non essendo controllata da nessun organo delle forze dell'ordine quindi non bisogna rispondere alle segnalazioni se non si è legittimi proprietari dell'oggetto o solo per scherzo.</p>
                
                <p>Vi ringraziamo per la collaborazione.</p>

                <a href="#contact" class="btn btn-circle page-scroll">
                    <i class="fa fa-angle-double-down animated"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Contatti</h2>
                <p>Se hai bisogno di ulteriori informazioni non esitare a contattarci tramite uno dei nostri contatti qui sotto</p>
                <p><a href="mailto:alessio.zignaigo@gmail.com">alessio.zignaigo@gmail.com</a>
                </p>
                 <p><a href="mailto:matteo.rossi18@gmail.com">matteo.rossi18@gmail.com</a>
                </p>
                <ul class="list-inline banner-social-buttons">

                    <li>
                        <a href="https://github.com/" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                    </li>
                    
                </ul>
            </div>
        </div>
        <br>
       <a href="#page-top" class="btn btn-circle page-scroll">
            <i class="fa fa-angle-double-up animated"></i>
        </a>

    </section>


    <!-- Map Section -->
    <div id="map"></div>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Progetto SAW &copy; 2017</p>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgr6PoumbDB5btD7KLlgrgXITJeaIh-3Y&sensor=false"></script>

    <!-- Theme JavaScript -->
    <script src="js/grayscale.min.js"></script>

    <!-- Sign In JavaScript -->
    <script src="js/login.js"></script>

</body>

</html>
