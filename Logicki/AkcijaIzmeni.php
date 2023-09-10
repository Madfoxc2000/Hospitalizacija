 <?php
        //Preuzima vrednosti iz forme za izmenu hospitalizacije a zatim poziva funkciju za izmenu i prosledjuje preuzete vrednosti.
		//Saradjuje sa klasama BaznaKonekcija, BaznaTabela, Hospitalizacija, 
		session_start();  
	   // citanje vrednosti iz sesije -  da bismo uvek proverili da li je to prijavljeni korisnik
	   $idkorisnika=$_SESSION["idkorisnika"];
	   $IdHospitalizacije=$_POST['IdHospitalizacije'];
	   $IDPrijema=$_POST['IDPrijema'];
	   $OsnovniUzrokHospitalizacije=$_POST['OsnovniUzrokHospitalizacije'];
	   $PrateceDijagnoze=$_POST['PrateceDijagnoze'];
	//    $SifraProcedurePoNomenklaturi=$_POST['SifraProcedurePoNomenklaturi'];
	   $BrojSatiVentilatornePodrske=$_POST['BrojSatiVentilatornePodrske'];
	   $DatumOtpusta=$_POST['DatumOtpusta'];
	   $BrojDanaHospitalizacije=$_POST['BrojDanaHospitalizacije'];
	   $OdeljenjeSaKojegJeOtpustIzvrsen=$_POST['OdeljenjeSaKojegJeOtpustIzvrsen'];
	   $VrstaOtpusta=$_POST['VrstaOtpusta'];
	   $Obdukovan=$_POST['Obdukovan'];
	   $OsnovniUzrokSmrti=$_POST['OsnovniUzrokSmrti'];


	   // koristimo klasu za poziv procedure za konekciju
	require dirname(__DIR__)."/klase/BaznaKonekcija.php";
	require dirname(__DIR__)."/klase/BaznaTabela.php";
	$xml=dirname(__DIR__)."/klase/BaznaParametriKonekcije.xml";
	$KonekcijaObject = new Konekcija($xml);
	$KonekcijaObject->connect();
	if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
    {	
		
		require dirname(__DIR__)."/klase/DBPrijem.php";
		$PrijemObject = new Prijem($KonekcijaObject,'Prijem');
		$DatumPrijema = $PrijemObject->DajDatumPrijema($IDPrijema);

    	require dirname(__DIR__)."/Logicki/PoslovnaLogika.php";
		$PoslovnaObject = new PoslovnaLogika();
		$BrojDanaHospitalizacije = $PoslovnaObject->DajBrojDana($DatumPrijema,$DatumOtpusta);
		
		require dirname(__DIR__)."/klase/DBHospitalizacija.php";
		$HospitalizacijaObject = new Hospitalizacija($KonekcijaObject, 'hospitalizacija');
		$greska=$HospitalizacijaObject->IzmeniHospitalizaciju($IdHospitalizacije, $OsnovniUzrokHospitalizacije, $PrateceDijagnoze, $BrojSatiVentilatornePodrske, $DatumOtpusta, $BrojDanaHospitalizacije, $OdeljenjeSaKojegJeOtpustIzvrsen, $VrstaOtpusta, $Obdukovan, $OsnovniUzrokSmrti);
	}
	else
	{
		echo "Nije uspostavljena konekcija ka bazi podataka!";
	}
		
    $KonekcijaObject->disconnect();
	   
	// prikaz uspeha aktivnosti	
	//echo "Ukupno procesirano $retval zapisa";
	//echo "Greska $greska";	
	
	header ('Location:http://localhost/Hospitalizacija/HospitalizacijaListaFilter.php');	
		
	  
      ?>

