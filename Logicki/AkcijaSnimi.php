 <?php
        //Preuzima vrednosti iz forme za unos hospitalizacije i poziva funkciju za kreiranje nove hospitalizacije.
		//Saradjuje sa klasam BaznaKonekcija, BaznaTabela, Pacijent, PoslovnaLogika, SPHospitalizacija , Prijem
		session_start();  
	   // citanje vrednosti iz sesije - da bismo uvek proverili da li je to prijavljeni korisnik
	   $idkorisnika=$_SESSION["idkorisnika"];
	   $IDPrijema = $_POST['IdPrijema'];
	   // preuzimanje vrednosti sa forme
	   $OsnovniUzrokHospitalizacije=$_POST['OsnovniUzrokHospitalizacije'];
	   $PrateceDijagnoze=$_POST['PrateceDijagnoze'];
	   $BrojSatiVentilatornePodrske=$_POST['BrojSatiVentilatornePodrske'];
	   $DatumOtpusta=$_POST['DatumOtpusta'];
	   $OdeljenjeSaKojegJeOtpustIzvrsen=$_POST['OdeljenjeSaKojegJeOtpustIzvrsen'];
	   $VrstaOtpusta=$_POST['VrstaOtpusta'];
	   $Obdukovan=$_POST['Obdukovan'];
	   $OsnovniUzrokSmrti=$_POST['OsnovniUzrokSmrti'];

	   if (empty($SpoljniUzrokPovrede)) {
		$SpoljniUzrokPovrede=NULL;	
										} 
	$m='mysqli';
      //KONEKCIJA KA SERVERU
		// koristimo klasu za poziv procedure za konekciju
		require dirname(__DIR__)."/klase/BaznaKonekcija.php";
		require dirname(__DIR__)."/klase/BaznaTabela.php";
		$xml=dirname(__DIR__)."/klase/BaznaParametriKonekcije.xml";
		$KonekcijaObject = new Konekcija($xml);
		$KonekcijaObject->connect();
		// uspesno realizovana konekcija ka DBMS i bazi podataka
	if ($KonekcijaObject->konekcijaDB) {

		require dirname(__DIR__)."/klase/BaznaTransakcija.php";
		$TransakcijaObject = new Transakcija($KonekcijaObject,$m);
		$TransakcijaObject->ZapocniTransakciju();	

		require dirname(__DIR__)."/klase/DBPrijem.php";
		$PrijemObject = new Prijem($KonekcijaObject,'Prijem');
		$DatumPrijema = $PrijemObject->DajDatumPrijema($IDPrijema);

		//Racuna broj dana izmedju dana na prijemu i broja dana kada je hospitalizacija unesena
    	require dirname(__DIR__)."/Logicki/PoslovnaLogika.php";
		$PoslovnaObject = new PoslovnaLogika();
		$daysDifference = $PoslovnaObject->DajBrojDana($DatumPrijema,$DatumOtpusta);

		require dirname(__DIR__)."/klase/DBStoredProcedure.php";
		$HospitalizacijaObject= new SPHospitalizacija($KonekcijaObject, 'hospitalizacija');
		$HospitalizacijaObject->BrojDanaHospitalizacije=$daysDifference;
		$HospitalizacijaObject->IDPrijema=$IDPrijema;
		$HospitalizacijaObject->OsnovniUzrokHospitalizacije=$OsnovniUzrokHospitalizacije;
		$HospitalizacijaObject->PrateceDijagnoze=$PrateceDijagnoze;
		$HospitalizacijaObject->BrojSatiVentilatornePodrske=$BrojSatiVentilatornePodrske;
		$HospitalizacijaObject->DatumOtpusta=$DatumOtpusta;
		$HospitalizacijaObject->OdeljenjeSaKojegJeOtpustIzvrsen=$OdeljenjeSaKojegJeOtpustIzvrsen;
		$HospitalizacijaObject->VrstaOtpusta=$VrstaOtpusta;
		$HospitalizacijaObject->Obdukovan=$Obdukovan;
		$HospitalizacijaObject->OsnovniUzrokSmrti=$OsnovniUzrokSmrti;
		$greska=$HospitalizacijaObject->DodajNovuHospitalizaciju();
		$greska1=$PrijemObject->ArhivirajPrijem($IDPrijema);
		$UtvrdjenaGreska =$greska.$greska1;

	  $TransakcijaObject->ZavrsiTransakciju($UtvrdjenaGreska);
	}
	// ZATVARANJE KONEKCIJE KA DBMS
	  $KonekcijaObject->disconnect();
	
	// prikaz uspeha aktivnosti	
	
	if ($greska) {
	echo "Greska $greska";	

     }	
	 else
	 {

		 header ('Location:http://localhost/Hospitalizacija/HospitalizacijaListaFilter.php');	
	 }
		
	  
      ?>

	