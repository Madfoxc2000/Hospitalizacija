<?php
session_start();  
// citanje vrednosti iz sesije - da bismo uvek proverili da li je to prijavljeni korisnik
$idkorisnika=$_SESSION["idkorisnika"];
$IdPrijema = $_POST["IdPrijema"];
$TipAktivnosti= $_POST["TipAktivnosti"];
$DatumIzvrsenja= $_POST["DatumIzvrsenja"];
$Opis= $_POST["Opis"];

    require dirname(__DIR__)."/klase/BaznaKonekcija.php";
    require dirname(__DIR__)."/klase/BaznaTabela.php";
    $xml=dirname(__DIR__)."/klase/BaznaParametriKonekcije.xml";
    $KonekcijaObject = new Konekcija($xml);
    $KonekcijaObject->connect();
    if ($KonekcijaObject->konekcijaDB) // uspesno realizovana
    {
        require dirname(__DIR__)."/klase/DBAktivnost.php";
        $AktivnostObject = new Aktivnost($KonekcijaObject, 'aktivnost');
        $greska=$AktivnostObject->DodajNovuAktivnost($IdPrijema,$TipAktivnosti,$DatumIzvrsenja,$Opis);
    }

    $KonekcijaObject->disconnect();
	
	// prikaz uspeha aktivnosti	
	
	if ($greska) {
	echo "Greska $greska";	

     }	
	 else
	 {
		 header ('Location:http://localhost/Hospitalizacija/PrimljeniPacijentiLista.php');	
	 }
		
?>