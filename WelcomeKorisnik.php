<?php
	   session_start();
     	   
	   // citanje vrednosti iz sesije
	   $korisnik=$_SESSION["korisnik"];
      
	  // ako nije prijavljen korisnik, vraca ga na pocetnu stranicu
				if (!isset($korisnik))
				{
					header ('Location:index.php');
				}	
?>

<!DOCTYPE html>
<!-- Prikazuje poruku dobrodošlice korisniku. -->
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="sr-RS" xml:lang="sr-RS">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<head>
<title>Болница</title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
<link rel="stylesheet" href="css/korisnik.css">
<script src="script.js" async></script>
</head>
<body>


<div class="main-korisnik">
	
	<!-------------------------- ZAGLAVLJE ------->
	<?php include 'delovi/ZaglavljeKorisnik.php';?>
	
	
	
	<!------- GLAVNI SADRZAJ desno ----------->
	<?php include 'delovi/PorukaWelcome.php';?>
	
	<!-- footer panel starts here -->
	
	<?php include 'delovi/footer.php';?>
	
	
</div>

</body>
</html>