 <?php
        //Preuzima vrednost ID-ja za brisanje i poziva funkciju za brisanje kojoj prosledjuje parametar.
		//Saradjuje sa klasama BaznaKonekcija, BaznaTabela, BaznaParametriKonekcije
		session_start();  
	   // citanje vrednosti iz sesije - da bismo uvek proverili da li je to prijavljeni korisnik
	   $idkorisnika=$_SESSION["idkorisnika"];
	   
	   // preuzimanje vrednosti sa forme
	   $idHospitalizacije=$_POST['IdHospitalizacije'];
	   
      // koristimo klasu za poziv procedure za konekciju
	  require dirname(__DIR__)."/klase/BaznaKonekcija.php";
	  require dirname(__DIR__)."/klase/BaznaTabela.php";
	  $xml=dirname(__DIR__)."/klase/BaznaParametriKonekcije.xml";
	  $KonekcijaObject = new Konekcija($xml);
	$KonekcijaObject->connect();
	if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
    {	
		require dirname(__DIR__)."/klase/DBHospitalizacija.php";
		$HospitalizacijaObject = new Hospitalizacija($KonekcijaObject, 'hospitalizacija');
		$greska=$HospitalizacijaObject->ObrisiHospitalizaciju($idHospitalizacije);
	}
		
    $KonekcijaObject->disconnect();
	
	header ('Location:http://localhost/Hospitalizacija/HospitalizacijaListaAdministrator.php');	
		
	  
      ?>

