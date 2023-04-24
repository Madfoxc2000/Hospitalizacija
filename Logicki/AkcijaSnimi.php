 <?php
        //Preuzima vrednosti iz forme za unos hospitalizacije i poziva funkciju za kreiranje nove hospitalizacije.
		//Saradjuje sa klasam BaznaKonekcija, BaznaTabela, Pacijent, PoslovnaLogika, SPHospitalizacija 
		session_start();  
	   // citanje vrednosti iz sesije - da bismo uvek proverili da li je to prijavljeni korisnik
	   $idkorisnika=$_SESSION["idkorisnika"];
	   
	   // preuzimanje vrednosti sa forme
	   $BrojIstorijeBolesti=$_POST['BrojIstorijeBolesti'];
	   $NazivZdravstveneUstanove=$_POST['NazivZdravstveneUstanove'];
	   $OdeljenjeNaPrijemu=$_POST['OdeljenjeNaPrijemu'];
	   $DatumPrijema=$_POST['DatumPrijema'];
	   $UputnaDijagnoza=$_POST['UputnaDijagnoza'];
	   $Povreda=$_POST['Povreda'];
	   $SpoljniUzrokPovrede=$_POST['SpoljniUzrokPovrede'];
	   $OsnovniUzrokHospitalizacije=$_POST['OsnovniUzrokHospitalizacije'];
	   $PrateceDijagnoze=$_POST['PrateceDijagnoze'];
	   $SifraProcedurePoNomenklaturi=$_POST['SifraProcedurePoNomenklaturi'];
	   $TezinaNaPrijemu=$_POST['TezinaNaPrijemu'];
	   $BrojSatiVentilatornePodrske=$_POST['BrojSatiVentilatornePodrske'];
	   $DatumOtpusta=$_POST['DatumOtpusta'];
	   $BrojDanaHospitalizacije=$_POST['BrojDanaHospitalizacije'];
	   $OdeljenjeSaKojegJeOtpustIzvrsen=$_POST['OdeljenjeSaKojegJeOtpustIzvrsen'];
	   $VrstaOtpusta=$_POST['VrstaOtpusta'];
	   $Obdukovan=$_POST['Obdukovan'];
	   $OsnovniUzrokSmrti=$_POST['OsnovniUzrokSmrti'];
	   $Maloletan;
	   $Datum;
      //KONEKCIJA KA SERVERU
// koristimo klasu za poziv procedure za konekciju
require dirname(__DIR__)."/klase/BaznaKonekcija.php";
require dirname(__DIR__)."/klase/BaznaTabela.php";
$xml=dirname(__DIR__)."/klase/BaznaParametriKonekcije.xml";
$KonekcijaObject = new Konekcija($xml);
	$KonekcijaObject->connect();
	if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
    {	require dirname(__DIR__)."/klase/DBPacijent.php";
		$PacijentObject = new Pacijent($KonekcijaObject,'pacijent');
		$date=$PacijentObject->DajDatumRodjenja( $BrojIstorijeBolesti);//Uzimamo datum rodjenja radi utvrdjivanja da li je pacijent  maloletan
		require dirname(__DIR__)."/Logicki/PoslovnaLogika.php";
		$PoslovnaObject = new PoslovnaLogika($KonekcijaObject,'pacijent');
		echo $date;
		$Maloletan=$PoslovnaObject->DaLiJeMaloletan($date);//Prosledjujemo datum rodjenja pacijenta radi poredjenja
		require dirname(__DIR__)."/klase/DBStoredProcedure.php";
		$HospitalizacijaObject= new SPHospitalizacija($KonekcijaObject, 'hospitalizacija');
		$HospitalizacijaObject->BrojIstorijeBolesti=$BrojIstorijeBolesti;
		$HospitalizacijaObject->OdeljenjeNaPrijemu=$OdeljenjeNaPrijemu;
		$HospitalizacijaObject->NazivZdravstveneUstanove=$NazivZdravstveneUstanove;
		$HospitalizacijaObject->DatumPrijema=$DatumPrijema;
		$HospitalizacijaObject->UputnaDijagnoza=$UputnaDijagnoza;
		$HospitalizacijaObject->Povreda=$Povreda;
		$HospitalizacijaObject->SpoljniUzrokPovrede=$SpoljniUzrokPovrede;
		$HospitalizacijaObject->OsnovniUzrokHospitalizacije=$OsnovniUzrokHospitalizacije;
		$HospitalizacijaObject->PrateceDijagnoze=$PrateceDijagnoze;
		$HospitalizacijaObject->SifraProcedurePoNomenklaturi=$SifraProcedurePoNomenklaturi;
		$HospitalizacijaObject->TezinaNaPrijemu=$TezinaNaPrijemu;
		$HospitalizacijaObject->BrojSatiVentilatornePodrske=$BrojSatiVentilatornePodrske;
		$HospitalizacijaObject->DatumOtpusta=$DatumOtpusta;
		$HospitalizacijaObject->BrojDanaHospitalizacije=$BrojDanaHospitalizacije;
		$HospitalizacijaObject->OdeljenjeSaKojegJeOtpustIzvrsen=$OdeljenjeSaKojegJeOtpustIzvrsen;
		$HospitalizacijaObject->VrstaOtpusta=$VrstaOtpusta;
		$HospitalizacijaObject->Obdukovan=$Obdukovan;
		$HospitalizacijaObject->OsnovniUzrokSmrti=$OsnovniUzrokSmrti;
		$HospitalizacijaObject->Maloletan=$Maloletan;
		$greska=$HospitalizacijaObject->DodajNovuHospitalizaciju();
        	
		} // od if db selected

      // ZATVARANJE KONEKCIJE KA DBMS
	  $KonekcijaObject->disconnect();
	
	// prikaz uspeha aktivnosti	
	
	if ($greska) {
	echo "Greska $greska";	
     }	
	 else
	 {
	 
		header ('Location:http://localhost/Hospitalizacija/HospitalizacijaListaAdministrator.php');	
	 }
		
	  
      ?>

