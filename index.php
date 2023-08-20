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
		
		if (isset($_GET["filtriraj"]))
			{
			// filtrirano
			$filterVrednost=$_GET["filter"];
			$filterPolje="OSNOVNIUZROKHOSPITALIZACIJE";
			$nacinFiltriranja="like";
			$Sortiranje="DATUMPRIJEMA DESC";
            $KolekcijaZapisa = $HospitalizacijaObject->DajKolekcijuHospitalizacijaFiltrirano($filterPolje, $filterVrednost, $nacinFiltriranja, $Sortiranje);
			}
			else
			{
			// prikaz svih - PRVO UCITAVANJE INDEX.PHP, dugme "SVI"
			$KolekcijaZapisa = $HospitalizacijaObject->DajKolekcijuSvihHospitalizacija();
			}
        		
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
<link rel="stylesheet"  href="css/style.css?v=1" media="screen">
</head>
<body>

<div class="main-index">
	
	<!-------------------------- ZAGLAVLJE ------->
	<?php include 'delovi/ZaglavljeIndex.php';?>
	
	<!-----VELIKA TABELA KOJA SADRZI SVE---->
	<!-----10% SADRZAJ 10%---->
	<!-- <table class="no-spacing"> -->
	
	<!-------------------------- DONJI DEO  ------->
	<!-- <tr style="padding:0px;"> -->
	
	<!-----LEVO PRAZNINA---->
	<!-- <td style="width:10%;">
	</td> -->
	
	<!------------------------------------------------------------------------------------------->
	<!---------------------- SREDINA DONJEG DELA SA SADRZAJEM pocinje ovde ---------------------->
	<!-- <td align="center" valign="middle" style="width:80%; padding:0" >
	
	<table style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0" background="images/pozadina.jpg">
	
	<tr>
	<td style="width:1%;">
	</td>
	
	
	<td style="width:1%;">
	</td>
	
	<td style="width:80%;padding:0" cellspacing="0" cellpadding="0" border="0" valign="top"> -->
	<!------- GLAVNI SADRZAJ desno ----------->
	
	<div><?php include 'delovi/TabelaIndex.php';?></div>
	
	
	<!--
	</td>
	<td style="width:1%;">
	</td>
	</tr>
	</table>
	
	</td> -->
	<!---------------------- SADRZAJ zavrsava ovde ---------------------->
	
	<!-----DESNO PRAZNINA---->
	<!-- <td style="width:10%;">
	</td>
	
	</tr> -->
	<!---------------------- DONJI DEO zavrsava ovde ---------------------->
	<!-- <tr style="padding:0px;">
	<td style="width:10%;"></td>
	<td align="center" valign="middle"></td>
	<td style="width:10%;"></td>
	</tr> -->
	<!--- DONJI DEO sa donjom ivicom zavrsava ovde  ------->
	<!-- footer panel starts here -->
	<!-- </table> -->
	<?php include 'delovi/footer.php';?>
</div>
</body>
</html>