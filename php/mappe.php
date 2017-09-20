
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
        $data = str_replace("'" , "&#39;" , $data);
        return $data;
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

    $id = $_GET['ID'];
    $stmt = $conn->prepare("SELECT * FROM Segnalazioni WHERE id=?") ;
    $stmt->bind_param("i", $id);

    $stmt->execute();
    $result = $stmt->get_result();

    while($row = mysqli_fetch_array($result)) {
        $controllo = $row['id'];
        if ($controllo==$id){
            $autore = test_input($row['autore']);
            $titolo =  test_input($row['titolo']);
            $subtitle =  test_input($row['sottotitolo']);
            $categoria =  test_input($row['categoria']);
            $descrizione =  test_input($row['descrizione']);
            $indirizzo =  test_input($row['indirizzo']);
            $foto =  test_input($row['foto']);
            $data_ins =  test_input($row['data_inserimento']);
        }
    }


echo "
    <!DOCTYPE html>
    <html lang=\"it\">

    <head>

        <meta charset=\"utf-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <meta name=\"description\" content=\"\">
        <meta name=\"author\" content=\"\">


        <link rel=\"icon\" type=\"icon/png\" href=\"../img/icon.png\">
        <title>TROVATUTTO - Segnalazione</title>

        <!-- Bootstrap core CSS -->
        <link href=\"../vendor/bootstrap/css/css_home/bootstrap.css\" rel=\"stylesheet\"/>

        <!-- Custom styles for this template -->
        <link href=\"../css/heroic-features.css\" rel=\"stylesheet\"/>


        <!-- Script AJAX per scaricare le segnalazioni dal DB -->
        <script src=\"../js/ajax_segnalazioni.js\" type=\"application/javascript\"></script>

        <style>
        #map {
        height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
     
        #floating-panel {
        
       
        z-index: 5;
        background-color: #fff;
        
        border: 2px double   #999;
        text-align: center;
        
        line-height: 30px;
        
        }
        </style>

    </head>

    <body>
    
    
    <noscript> <div style=\"width:100%;top:90%;background-color:white;font-size: 40px; color: red; position: fixed; text-align:center \">Abilitare Javascript per visualizzare correttamente il sito!</div> </noscript>
    
     <!-- Navigation -->
        <nav class=\"navbar navbar-expand-lg navbar-dark bg-dark fixed-top\">
          <div class=\"container\">
            <a class=\"navbar-brand\" href=\"home.php\">
                <img src=\"../img/logo.png\"/>
            </a>

            <div>
              <ul class=\"navbar-nav ml-auto\">
                <li class=\"nav-item active \">
                    <a class=\"nav-link\" href=\"profilo.php\">
                        <img src=\"../img/user-pic.png\" alt=\"profilo\"><b>"." ".$nome." ".$cognome." </b></a>
                </li>

              </ul>
            </div>
          </div>
        </nav>

    <div class='container' id='pagina'>
        <header class=\"my-5\">
            <nav>
                <ul class=\"pager\">
                    <li class=\"\"><a href=\"#\" onclick=\"loadPost(".$id.")\"><span class=\"glyphicon glyphicon-arrow-left\" aria-hidden=\"true\"></span> Indietro</a></li>
                </ul>
            </nav>
        </header>
            
        <div id=\"floating-panel\" class='my-3'>
            <input class='' id=\"address\" type=\"text\" value=\"".$indirizzo."\">
    
        </div>
        <div class=\"row text-center my-3\" style='height: 500px' id='map'></div>
     
       

    </div>


        <script>
            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 15,
                    center: {lat: 44.4264000, lng: 8.9151900} //Coordinate Genova
                });
                var geocoder = new google.maps.Geocoder();


                 geocodeAddress(geocoder, map);

            }

            function geocodeAddress(geocoder, resultsMap) {
                var address = document.getElementById('address').value;
                geocoder.geocode({'address': address}, function(results, status) {
                    if (status === 'OK') {
                        resultsMap.setCenter(results[0].geometry.location);
                        var contentString = '<div class=\"container my-5\">'+  
                                                 '<div class=\"row\">'+
                                                    '<div class=\"col-sm-12\">'+
                                                        '<div class=\"page-it\">'+
                                                            '<h3>".$titolo ."</h3>'+
                                                            '<p>Creata da <span class=\"glyphicon glyphicon-user\"></span> <a href=\"#\">".$autore."</a> il <span class=\"glyphicon glyphicon-time\"></span> ".$data_ins."</p>'+
                                                        '</div>'+
                                                    '</div>'+
                                                 '</div>'+
                                                 '<div class=\"row text-center\">'+
                                                    '<div class=\"col-sm-8\">'+                                                
                                                         '<!-- Image -->'+
                                                    '<figure class=\"m-2 text-center\">'+
                                                    '<img class=\"card-img-top\" src=\"../img/img-segnalazioni/".$foto."\" alt=\"".$foto."\">'+
            
                                                    '</figure>'+
                                                    '<hr>'+
                                                    '<p>".$subtitle."</p>' +   
                                                 '</div>'+          
                                             '</div>';
                        
                        var infowindow = new google.maps.InfoWindow({
                            content: contentString
                         });
                        var marker = new google.maps.Marker({
                            map: resultsMap,
                            position: results[0].geometry.location,
                            animation: google.maps.Animation.DROP,
                            title: \"Segnalazione\"
                        });
                        marker.addListener('click',function() {
                            infowindow.open(map, marker);
                            if (marker.getAnimation() !== null) {
                              marker.setAnimation(null);
                            } else {
                              marker.setAnimation(google.maps.Animation.BOUNCE);
                            }
                    
                        });
                        
                     
                    } else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    } 
                });
            }
        </script>
        <script async defer
                src=\"https://maps.googleapis.com/maps/api/js?key=AIzaSyAH4MOCNUR_nOGJ1D0PY2ZiLDrfyX4ZRUY&callback=initMap&language=it&region=ITA\">
        </script>


      </body>
</html>";
