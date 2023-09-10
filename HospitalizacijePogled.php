<?php
// Tabelarno prikazuje podatke dobijene iz pogleda.
				// CITANJE VREDNOSTI O KORISNIKU IZ SESIJE
				session_start();
				// kad idemo preko poziva sa URL promenljivom, onda ovako citamo:   
				// citanje vrednosti iz sesije
				 
	   $korisnik=$_SESSION["korisnik"];
	   
	   // ako nije prijavljen korisnik, vraca ga na pocetnu stranicu
	   if (!isset($korisnik))
	   {
		header ('Location:index.php');
	   }
	   
				
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="sr-RS" xml:lang="sr-RS">
<meta charset="UTF-8">
<head>
<title>Општина Зрењанин</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<link rel="stylesheet" href="css/administrator.css" media="screen">
<script src="JS/script.js" async></script>
</head>
<body>

<div class="main-administrator">
	
	<!-------------------------- ZAGLAVLJE ------->
	<?php include 'delovi/ZaglavljeAdministrator.php';?>
	
	
	
	<!------- GLAVNI SADRZAJ desno ----------->
	<div><?php include 'delovi\TabelaPogled.php';?></div>
	
	
	<!-- footer panel starts here -->
	<?php include 'delovi/footer.php';?>
</div>



</body>
</html>