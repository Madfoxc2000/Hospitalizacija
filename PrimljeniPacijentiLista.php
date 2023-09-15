
<?php
				session_start();
				// kad idemo preko poziva sa URL promenljivom, onda ovako citamo:   
				// citanje vrednosti iz sesije
				 
	   $korisnik=$_SESSION["korisnik"];
	   
	   // ako nije prijavljen korisnik, vraca ga na pocetnu stranicu
	   if (!isset($korisnik))
	   {
		header ('Location:index.php');
	   }

    require "klase/BaznaKonekcija.php";
	require "klase/BaznaTabela.php";
	$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
	$KonekcijaObject->connect();
	if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
    {	
		require "klase/DBPrijem.php";
		$PrijemObject = new Prijem($KonekcijaObject, 'Prijem');
        if (isset($_GET["filtriraj"]))
        {
        $filterVrednost=$_GET["filter"];
        $filterPolje="BROJISTORIJEBOLESTI";
        $nacinFiltriranja="like";
        $Sortiranje="DATUMPRIJEMA DESC";
        $KolekcijaZapisa = $PrijemObject->DajKolekcijuPrijemaFiltrirano($filterPolje, $filterVrednost, $nacinFiltriranja, $Sortiranje);
        }

        else
        {
        // prikaz svih - PRVO UCITAVANJE INDEX.PHP, dugme "SVI"
        $KolekcijaZapisa = $PrijemObject->DajKolekcijuAktivnihPrijema();
        // }
        }
            
        $UkupanBrojZapisa = $PrijemObject->DajUkupanBrojSvihPrijema($KolekcijaZapisa);
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="sr-RS" xml:lang="sr-RS">
<meta charset="UTF-8">
<head>
<title>Болница</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
<link rel="stylesheet" href="css/filterListaAdministrator.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<script src="JS/script.js" async></script>
<script src="JS/ValidacijaFiltera.js" type="module" async></script>
<script src="JS/PrimljeniLista.js" async></script>
</head>
<body>
<!-------------------------- ZAGLAVLJE ------->
<div class="main-administrator">
	<?php include 'delovi/ZaglavljeAdministrator.php';?>
	
	<!------- GLAVNI SADRZAJ desno ----------->
	<div><?php include 'delovi/TabelaPrimljeni.php';?></div>
	
	
	<!-- footer panel starts here -->
	<?php include 'delovi/footer.php';?>
</div>
</body>
</html>