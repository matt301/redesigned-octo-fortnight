<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>TROVATUTTO - Registrazione</title>
    <link rel="icon" type="icon/png" href="img/icon.png">

    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../css/grayscale.css" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">


    <script src="../js/maps.js"></script>

</head>
<body>
<div class=" container  text-center page-header"><h2>Registrazione</h2></div>
<div class="container">

    <form class="form-horizontal" action="regist2.php" method="post" name="modulo">
        <fieldset >

            <div class="form-group">
                <label for="nome" class="col-sm-2 col-lg-2 control-label">Nome</label>
                <div class="col-sm-8 col-lg-8">
                     <input required     type="text" class="form-control" name=nome id="nome" placeholder="Inserisci il nome...">
                </div>
            </div>
    
            <div class="form-group">
                <label for="cognome" class="col-sm-2 col-lg-2 control-label">Cognome</label>
                 <div class="col-sm-8 col-lg-8">
                    <input required type="text" class="form-control"  name="cognome" id="cognome" placeholder="Inserisci il cognome...">
                </div>
            </div>

            <div class="form-group">
                <label for="data_di_nascita" class="col-sm-2 col-lg-2 control-label">Data di nascita</label>
                <div class="col-sm-8 col-lg-8">
                    <input required type="date" class="form-control"    name="data_di_nascita" id="data_di_nascita" >
                </div>
            </div>
   
            <div class="form-group">
                <label for="ntel" class="col-sm-2 col-lg-2 control-label">Numero di Telefono</label>
                <div class="col-sm-8 col-lg-8">
                    <input type="text" class="form-control" name="ntel" id="ntel" placeholder="Inserisci il numero di tel...">
                </div>
            </div>
   
            <div class="form-group">
                <label for="via" class="col-sm-2 col-lg-2 control-label">Indirizzo (completo)</label>
                <div class="col-sm-8 col-lg-8">
                    <input required type="text" id='autocomplete' onFocus="geolocate()" class="form-control"  name="indirizzo" id="indirizzo" placeholder="Inserisci il tuo indirizzo completo...">
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-sm-2 col-lg-2 control-label">Email</label>
                <div class="col-sm-8 col-lg-8">
                    <input required type="email" class="form-control" name="email" id="email" placeholder="Inserisci l'indirizzo email...">
                </div>
            </div>
    
            <div class="form-group">
                <label for="pass" class="col-sm-2 col-lg-2 control-label">Password</label>
                <div class="col-sm-8 col-lg-8">
                    <input required type="password"class="form-control" name="password" id="password" placeholder="Inserisci la password...">
                </div>
            </div>
   



            <div class="form-group">
                <label for="stato" class="col-sm-2 col-lg-2 control-label">Nazione</label>
                <div class="col-sm-8 col-lg-8">
                    <select class="form-control" id="stato" name="stato">
                        <option>Italia</option>
                        <option>Francia</option>
                        <option>Germania</option>
                        <option>Inghilterra</option>
                        <option>Svizzera</option>
                        <option>Austria</option>
                        <option>Spagna</option>
                        <option>Portogallo</option>
                        <option>San Marino</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-8 col-lg-8 col-sm-offset-2">
                    <button type="submit" class="btn btn-default btn-group-justified">Invia</button>
                </div>
            </div>
        </fieldset>
    </form>
</div>

    <script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAH4MOCNUR_nOGJ1D0PY2ZiLDrfyX4ZRUY&libraries=places&callback=initAutocomplete">
    </script>
</body>
</html>