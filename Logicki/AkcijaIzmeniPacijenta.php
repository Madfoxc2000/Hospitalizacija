<?php
        //Preuzima vrednosti iz forme za izmenu hospitalizacije a zatim poziva funkciju za izmenu i prosledjuje preuzete vrednosti.
		//Saradjuje sa klasama BaznaKonekcija, BaznaTabela, Hospitalizacija, 
		session_start();  
	   // citanje vrednosti iz sesije -  da bismo uvek proverili da li je to prijavljeni korisnik
	   $idkorisnika=$_SESSION["idkorisnika"];
	//  $idHospitalizacije=$_POST['IdHospitalizacije'];
	   
	   // preuzimanje vrednosti sa forme
	   $BrojIstorijeBolesti=$_POST['BrojIstorijeBolesti'];
	   $JMBG=$_POST['JMBG'];
	   $Ime=$_POST['Ime'];
	   $Prezime=$_POST['Prezime'];
	   $ImeJednogRoditelja=$_POST['ImeJednogRoditelja'];
	   $LBO=$_POST['LBO'];
	   $OsnovOsiguranja=$_POST['OsnovOsiguranja'];
	   $ClanJePorodice=$_POST['ClanJePorodice'];
	   $Telefon=$_POST['Telefon'];
	   $DatumRodjenja=$_POST['DatumRodjenja'];
	   $Drzavljanstvo=$_POST['Drzavljanstvo'];
	   $Pol=$_POST['Pol'];
	   $Adresa=$_POST['Adresa'];
	
	   require dirname(__DIR__)."/Logicki/PoslovnaLogika.php";
	   $PoslovnaObject = new PoslovnaLogika();
	   $Maloletan=$PoslovnaObject->DaLiJeMaloletan($DatumRodjenja);//Prosledjujemo datum rodjenja pacijenta radi poredjenja

	   // koristimo klasu za poziv procedure za konekciju
	require dirname(__DIR__)."/klase/BaznaKonekcija.php";
	require dirname(__DIR__)."/klase/BaznaTabela.php";
	$xml=dirname(__DIR__)."/klase/BaznaParametriKonekcije.xml";
	$KonekcijaObject = new Konekcija($xml);
	$KonekcijaObject->connect();
	if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
    {	
		require dirname(__DIR__)."/klase/DBPacijent.php";
		$PacijentObject = new Pacijent($KonekcijaObject, 'Pacijent');
		$greska=$PacijentObject->IzmeniPacijenta($BrojIstorijeBolesti, $JMBG, $ImeJednogRoditelja, $LBO, $OsnovOsiguranja, $ClanJePorodice, $Ime, $Prezime, $Telefon, $DatumRodjenja, $Drzavljanstvo, $Pol, $Adresa, $Maloletan);
	}
	else
	{
		echo "Nije uspostavljena konekcija ka bazi podataka!";
	}
		
    $KonekcijaObject->disconnect();
	   
	// prikaz uspeha aktivnosti	
	//echo "Ukupno procesirano $retval zapisa";
	//echo "Greska $greska";	
	
	header ('Location:http://localhost/Hospitalizacija/PacijentLista.php');	
		
	  
      ?>

