<?php
    include ('reserved/https_conn.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>TROVATUTTO - Segnalazione</title>
    <link rel="icon" type="icon/png" href="img/icon.png">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.4/semantic.min.css">

    <!-- Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.4/semantic.min.js"></script>
    <script src="../vendor/jquery/jquery.fajax.js"></script>

    <script src="../js/maps.js"></script>


</head>
<body>
<div class="container page-header text-center" >
    <h1>INVIA SEGNALAZIONE</h1>
    <a class="btn btn-cta-primary btn-primary   " href="home.php">Indietro</a>
</div></br>
	<div class="container">

		<div class="ui form">
			<form action="segnala2.php" method="post" enctype="multipart/form-data">


				<div class="field">
					<label>Titolo</label>
					<input type="text" name="titolo" placeholder="Inserisci il titolo della segnalazione" required>
				</div>

				<div class="field">
					<label>Sottotitolo</label>
					<input type="text" name="sottotitolo" placeholder="Inserisci il riassunto della segnalazione">
				</div>

                <div class="field">
                    <label>Categoria</label>
                    <select class="form-control" id="categoria" name="categoria" >
                        <option selected>Altro</option>
                        <option>Effetti personali</option>
                        <option>Dispositivi elettronici</option>
                        <option>Libri</option>
                        <option>Gioielli</option>
                        <option>Vestiario</option>
                        <option>Documenti</option>
                        <option>Animale</option>


                    </select>
                </div>
			
				<div class="field">
					<label>Descrizione</label>
				 	<textarea type="text" name="descrizione" placeholder="Inserisci la descrizione dell'oggetto" ></textarea>
				</div>
                <div class="field">
                    <label>Luogo (Inidirizzo completo)</label>
                    <input type="text" id="autocomplete" name="indirizzo" placeholder="Inserisci l'indirizzo del luogo di ritrovamento" required></input>
                </div>

				<div class="field">
				    <label for="foto" style="color: #fff" class="ui grey button">Allega foto</label>
				    <input type="file" name="foto" id="foto" style="display:flex">
				</div>

				<div class="field">
					<button type="submit" class="ui green fluid big submit button">Invia segnalazione</button>
				</div>
			</form>
			<div class="ui hidden message">
				<div class="header">Segnalazione completata!</div>
				<p>La tua segnalazione è stata inviata con successo!</p>
			</div>
			
		</div>

	</div>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAH4MOCNUR_nOGJ1D0PY2ZiLDrfyX4ZRUY&libraries=places&callback=initAutocomplete">
</script>
	
</body>
</html>
