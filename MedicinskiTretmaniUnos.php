
<?php
// Prikazuje formu za izmenu sa podacima koje učitava prethodno.
// Saradjuje sa klasama BaznaKonekcija, BaznaTabela, Hospitalizacija, MKB,
	   session_start();
       // kad idemo preko poziva sa URL promenljivom, onda ovako citamo:
	   //$korisnik=$_GET['korisnik'];
	   
	    // citanje vrednosti iz sesije
	   $korisnik=$_SESSION["korisnik"];
	   
	   // ako nije prijavljen korisnik, vraca ga na pocetnu stranicu
	   if (!isset($korisnik))
	   {
		header ('Location:index.php');
	   }  
	   
	    // preuzimanje vrednosti sa forme iz hidden polja
		$IdPrijema=$_POST['IdPrijema'];
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="sr-RS" xml:lang="sr-RS">
<meta charset="UTF-8">
<head>
<title>Болница</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<link rel="stylesheet" href="css/tretman.css">
<script src="JS/UnosAktivnosti.js" type="module"  async></script>
</head>
<body>
<!-------------------------- ZAGLAVLJE ------->
<div class="main-container">
	<?php include 'delovi/ZaglavljeAdministrator.php';?>
	

	<?php include 'delovi/FormaMedicinskiTretmani.php';?>

	<!-- footer panel starts here -->
	
	<?php include 'delovi/footer.php';?>
	<script src="JS/script.js" ></script>
</div>
</body>
</html>