<?php
//Prikazuje listu hospitalizacija za korisnika.
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
// REALIZACIJA CITANJA SVIH I FILTRIRANIH PODATAKA

//KONEKCIJA KA SERVERU
	
// koristimo klasu za poziv procedure za konekciju
	require "klase/BaznaKonekcija.php";
	require "klase/BaznaTabela.php";
	$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
	$KonekcijaObject->connect();
	require "Logicki/OsnovneValidacije.php";
	$ValidacijaObjekt= new Validacije();
	if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
    {	
		require "klase/DBHospitalizacija.php";
		$HospitalizacijaObject = new Hospitalizacija($KonekcijaObject, 'hospitalizacija');
		
		if (isset($_GET["filtriraj"]))
			{
			// filtrirano
			$filterVrednost=$_GET["filter"];
			$greska3=$ValidacijaObjekt->DaLiIma7karaktera($filterVrednost,'Филтер вредност'); 
			$greska4=$ValidacijaObjekt->DaLiSuOdgovarajućiTipoviPodataka($filterVrednost, ' за филтрирање '); 
			$GreskaValidacije=$greska3.$greska4;
				if($GreskaValidacije){
					echo "<script>alert('.$GreskaValidacije.');</script>";
				}
				else{
			$filterPolje="OSNOVNIUZROKHOSPITALIZACIJE";
			$nacinFiltriranja="like";
			$Sortiranje="DATUMPRIJEMA DESC";
            $KolekcijaZapisa = $HospitalizacijaObject->DajKolekcijuHospitalizacijaFiltrirano($filterPolje, $filterVrednost, $nacinFiltriranja, $Sortiranje);
				}
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
<head>
<title>Болница</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
<link rel="stylesheet" href="css/filterListaKorisnik.css">
<script src="JS/script.js" async></script>
</head>
<body>

<div class="main-korisnik">
	<!-------------------------- ZAGLAVLJE ------->
	<?php include 'delovi/ZaglavljeKorisnik.php';?>
	
	
	<!------- GLAVNI SADRZAJ desno ----------->
	<div><?php include 'delovi/TabelaKorisnik.php';?></div>
	
	
	<!-- footer panel starts here -->
	
	<?php include 'delovi/footer.php';?>
</div>

</body>
</html>