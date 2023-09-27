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
		$idPacijenta=$_POST['idPacijenta'];
	   
      // koristimo klasu za poziv procedure za konekciju
		require "klase/BaznaKonekcija.php";
		require "klase/BaznaTabela.php";
		$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
		$KonekcijaObject->connect();
		if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
		{	
			require "klase/DBPacijent.php";
			$PacijentObject = new Pacijent($KonekcijaObject, 'pacijent');
			$KolekcijaZapisa=$PacijentObject->DajKolekcijuPacijenataFiltrirano("BROJISTORIJEBOLESTI", $idPacijenta, "=", "DATUMRODJENJA");
			$UkupanBrojZapisa =$PacijentObject->DajUkupanBrojPacijenata($KolekcijaZapisa);
			require "klase/DBOsnovOsiguranja.php";
			$OsnovOsiguranjaObject = new OsnovOsiguranja($KonekcijaObject,'osnov_osiguranja');
			$KolekcijaZapisaOsnovaOsiguranja = $OsnovOsiguranjaObject->DajKolekcijuSvihOsnovaOsiguranja();
			$UkupanBrojZapisaOsiguranja = $OsnovOsiguranjaObject->DajUkupanBrojSvihOsnovaOsiguranja($KolekcijaZapisaOsnovaOsiguranja);
			if ($UkupanBrojZapisa>0) 
			{
				$row=0;  // prvi i jedini red ima taj idvesti 
				$BrojIstorijeBolesti=$PacijentObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 0);
				$JMBG=$PacijentObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 1);
				$ImeJednogRoditelja=$PacijentObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 2);
				$LBO=$PacijentObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 3);
				$OsnovOsiguranja=$PacijentObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 4);
				$ClanJePorodice=$PacijentObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 5);
				$Ime=$PacijentObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 6);
				$Prezime=$PacijentObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 7);
				$Telefon=$PacijentObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 8);
				$DatumRodjenja=$PacijentObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 9);
				$Drzavljanstvo=$PacijentObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 10);
				$Pol=$PacijentObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 11);
				$Adresa=$PacijentObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 12);
				
			}         
		} // od if uspeh konekcije

      $KonekcijaObject->disconnect(); 
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="sr-RS" xml:lang="sr-RS">
<meta charset="UTF-8">
<head>
<title>Општина Зрењанин</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<link rel="stylesheet" href="css/administrator.css">
<script src="JS/script.js" async></script>
<script src="JS/UnosPacijent.js" type="module" async></script>
</head>
<body>

<div class="main-administrator">
<!-------------------------- ZAGLAVLJE ------->
<?php include 'delovi/ZaglavljeAdministrator.php';?>



<!------- GLAVNI SADRZAJ desno ----------->  
<div><?php include 'delovi/FormaIzmeniPacijenta.php';?></div>




<!-- footer panel starts here -->

<?php include 'delovi/footer.php';?>

</div>
</body>
</html>