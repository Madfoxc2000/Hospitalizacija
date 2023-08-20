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
		$idHospitalizacije=$_POST['IdHospitalizacije'];
	   
      // koristimo klasu za poziv procedure za konekciju
		require "klase/BaznaKonekcija.php";
		require "klase/BaznaTabela.php";
		$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
		$KonekcijaObject->connect();
		if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
		{	
			require "klase/DBHospitalizacija.php";
			$HospitalizacijaObject = new Hospitalizacija($KonekcijaObject, 'vozilo');
			$KolekcijaZapisa=$HospitalizacijaObject->DajKolekcijuHospitalizacijaFiltrirano("ID", $idHospitalizacije, "=", "DATUMPRIJEMA");
			$UkupanBrojZapisa =$HospitalizacijaObject->DajUkupanBrojSvihHospitalizacija($KolekcijaZapisa);
			require "klase/DBMKB.php";
			$MKBObject = new MKB($KonekcijaObject, 'mkb');
			$KolekcijaZapisa1 =$MKBObject->DajKolekcijuSvihSifri();
			$UkupanBrojZapisa1 =$MKBObject->DajUkupanBrojSvihSifri($KolekcijaZapisa);
			if ($UkupanBrojZapisa>0) 
			{
				$row=0;  // prvi i jedini red ima taj idvesti 
				$BrojIstorijeBolesti=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 1);
				$NazivZdravstveneUstanove=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 2);
				$OdeljenjeNaPrijemu=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 3);
				$DatumPrijema=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 4);
				$UputnaDijagnoza=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 5);
				$Povreda=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 6);
				$SpoljniUzrokPovrede=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 7);
				$OsnovniUzrokHospitalizacije=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 8);
				$PrateceDijagnoze=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 9);
				$SifraProcedurePoNomenklaturi=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 10);
				$TezinaNaPrijemu=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 11);
				$BrojSatiVentilatornePodrske=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 12);
				$DatumOtpusta=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 13);
				$BrojDanaHospitalizacije=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 14);
				$OdeljenjeSaKojegJeOtpustIzvrsen=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 15);
				$VrstaOtpusta=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 16);
				$Obdukovan=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 17);
				$OsnovniUzrokSmrti=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 18);
				
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
<script src="script.js" async></script>
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