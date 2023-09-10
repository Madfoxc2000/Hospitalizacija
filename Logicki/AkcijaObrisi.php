 <?php
        //Preuzima vrednost ID-ja za brisanje i poziva funkciju za brisanje kojoj prosledjuje parametar.
		//Saradjuje sa klasama BaznaKonekcija, BaznaTabela, BaznaParametriKonekcije
		session_start();  
	   // citanje vrednosti iz sesije - da bismo uvek proverili da li je to prijavljeni korisnik
	   $idkorisnika=$_SESSION["idkorisnika"];
	   
	   // preuzimanje vrednosti sa forme
	   $idHospitalizacije=$_POST['IdHospitalizacije'];
	   $m='mysqli';   
      // koristimo klasu za poziv procedure za konekciju
	  require dirname(__DIR__)."/klase/BaznaKonekcija.php";
	  require dirname(__DIR__)."/klase/BaznaTabela.php";
	  $xml=dirname(__DIR__)."/klase/BaznaParametriKonekcije.xml";
	  $KonekcijaObject = new Konekcija($xml);
	$KonekcijaObject->connect();
	if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
    {	
		require dirname(__DIR__)."/klase/BaznaTransakcija.php";
		$TransakcijaObject = new Transakcija($KonekcijaObject,$m);
		$TransakcijaObject->ZapocniTransakciju();

		require dirname(__DIR__)."/klase/DBHospitalizacija.php";
		$HospitalizacijaObject = new Hospitalizacija($KonekcijaObject, 'hospitalizacija');
		require dirname(__DIR__)."/klase/DBPrijem.php";
		$PrijemObject = new Prijem($KonekcijaObject, 'prijem');

		$IDPrijema = $PrijemObject->DajIDPrijemaHospitalizacije($idHospitalizacije);
		

		require dirname(__DIR__)."/klase/DBAktivnost.php";
		$AktivnostObject = new Aktivnost($KonekcijaObject, 'aktivnost');
		$KolekcijaZapisa1 = $AktivnostObject->DajSveAktivnostiPrijema($IDPrijema);
		$UkupanBrojAktivnosti = $AktivnostObject->DajUkupanBrojSvihAktivnosti($KolekcijaZapisa1);
		if ($UkupanBrojAktivnosti>0) 
		{   $IDAktivnosti="";
			for ($RBZapisa = 0; $RBZapisa < $UkupanBrojAktivnosti; $RBZapisa++) 
			{
			 $IDAktivnosti=$AktivnostObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisa1, $RBZapisa, 0)."|";
			 $AktivnostObject->ObrisiAktivnost($IDAktivnosti);
			}
		}             
		$UtvrdjenaGreska='';
		 $greska2=$PrijemObject->ObrisiPrijem($idHospitalizacije);
		 $greska1=$HospitalizacijaObject->ObrisiHospitalizaciju($idHospitalizacije);
		
		$TransakcijaObject->ZavrsiTransakciju($UtvrdjenaGreska);
	}
		
    $KonekcijaObject->disconnect();
	



	$greska.=$greska1.$greska2;
	if($greska){
		echo $greska;
	}
	else{
	// header ('Location:http://localhost/Hospitalizacija/HospitalizacijaListaFilter.php');	
	} 
 ?>

