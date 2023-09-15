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
		$IdHospitalizacije=$_POST['IdHospitalizacije'];
	   
      // koristimo klasu za poziv procedure za konekciju
		require "klase/BaznaKonekcija.php";
		require "klase/BaznaTabela.php";
		$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
		$KonekcijaObject->connect();
		if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
		{	
			require "klase/DBHospitalizacija.php";
			$HospitalizacijaObject = new Hospitalizacija($KonekcijaObject, 'pacijent');
			$KolekcijaZapisa=$HospitalizacijaObject->DajKolekcijuHospitalizacijaFiltriranoIzmena("ID", $IdHospitalizacije, "=", "DATUMOTPUSTA");
			$UkupanBrojZapisa =$HospitalizacijaObject->DajUkupanBrojSvihHospitalizacija($KolekcijaZapisa);
			require "klase/DBMKB.php";
			$MKBObject = new MKB($KonekcijaObject, 'mkb');
			$KolekcijaZapisa1 =$MKBObject->DajKolekcijuSvihSifri();
			$UkupanBrojZapisa1 =$MKBObject->DajUkupanBrojSvihSifri($KolekcijaZapisa);
			require "klase/DBOdeljenje.php";
			$OdeljenjeObject = new Odeljenje($KonekcijaObject,'odeljenje');
			$KolekcijaZapisaOdeljenja = $OdeljenjeObject->DajKolekcijuSvihOdeljenja();
			$UkupanBrojZapisaOdeljenja = $OdeljenjeObject->DajUkupanBrojSvihOdeljenja($KolekcijaZapisaOdeljenja);
			// IZDVAJANJE PODATAKA KORISTECI KLASU mkb
			require "klase/DBOtpust.php";
			$VrstaOtpustaObject = new VrstaOtpusta($KonekcijaObject, 'vrsta_otpusta');
			$KolekcijaZapisaOtpusta =$VrstaOtpustaObject->DajKolekcijuSvihOtpusta();
			$UkupanBrojZapisaOtpusta =$VrstaOtpustaObject->DajUkupanBrojSvihOtpusta($KolekcijaZapisaOtpusta);	
			if ($UkupanBrojZapisa>0) 
			{
				$row=0;  // prvi i jedini red ima taj idvesti 
				$IDPrijema=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 1);
				$OsnovniUzrokHospitalizacije=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 2);
				$PrateceDijagnoze=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 3);
				$BrojSatiVentilatornePodrske=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 4);
				$DatumOtpusta=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 5);
				$BrojDanaHospitalizacije=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 6);
				$OdeljenjeSaKojegJeOtpustIzvrsen=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 7);
				$VrstaOtpusta=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 8);
				$Obdukovan=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 9);
				$OsnovniUzrokSmrti=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 10);
				
			}         
		} // od if uspeh konekcije

      $KonekcijaObject->disconnect(); 
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="sr-RS" xml:lang="sr-RS">
<meta charset="UTF-8">
<head>
<title>Болница</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
<link rel="stylesheet" href="css/administrator.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<script src="JS/script.js" async></script>
<script src="JS/UnosHospitalizacije.js" type="module" async></script>
</head>
<body>

<div class="main-administrator">
<!-------------------------- ZAGLAVLJE ------->
<?php include 'delovi/ZaglavljeAdministrator.php';?>



<!------- GLAVNI SADRZAJ desno ----------->  
<div><?php include 'delovi/FormaIzmeni.php';?></div>




<!-- footer panel starts here -->

<?php include 'delovi/footer.php';?>
</div>
</body>
</html>