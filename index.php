<?php
//Prikazuje stranicu koja se otvara prilikom pokretanja aplikacije.
// OVO JE SUSTINSKO ODJAVLJIVANJE KORISNIKA
session_start();
// remove all session variables
session_unset(); 
// destroy the session 
session_destroy(); 

// REALIZACIJA CITANJA SVIH I FILTRIRANIH PODATAKA

//KONEKCIJA KA SERVERU
	
// koristimo klasu za poziv procedure za konekciju
	require "klase/BaznaKonekcija.php";
	require "klase/BaznaTabela.php";
	$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
	$KonekcijaObject->connect();
	if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
    {	
		require "klase/DBHospitalizacija.php";
		$HospitalizacijaObject = new Hospitalizacija($KonekcijaObject, 'hospitalizacija');
		
			// prikaz svih - PRVO UCITAVANJE INDEX.PHP, dugme "SVI"
			$KolekcijaZapisa = $HospitalizacijaObject->DajPogledHospitalizacija();
			$UkupanBrojZapisa = $HospitalizacijaObject->DajUkupanBrojSvihHospitalizacija($KolekcijaZapisa);
	}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="sr-RS" xml:lang="sr-RS">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<head>
<title>Болница</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<link rel="stylesheet"  href="css/style.css" media="screen">
</head>
<body>
<div class="main-index">
	<!-------------------------- ZAGLAVLJE ------->
	<?php include 'delovi/ZaglavljeIndex.php';?>
	
	
	<!------- GLAVNI SADRZAJ desno ----------->
	
	<div><?php include 'delovi/TabelaIndex.php';?></div>
	
	
	<!-- footer panel starts here -->
	<!-- </table> -->
	<?php include 'delovi/footer.php';?>
</div>
</body>
</html>