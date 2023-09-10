<?php
        //Preuzima vrednost ID-ja za brisanje i poziva funkciju za brisanje kojoj prosledjuje parametar.
		//Saradjuje sa klasama BaznaKonekcija, BaznaTabela, BaznaParametriKonekcije
		session_start();  
	   // citanje vrednosti iz sesije - da bismo uvek proverili da li je to prijavljeni korisnik
	   $idkorisnika=$_SESSION["idkorisnika"];
	   
	   // preuzimanje vrednosti sa forme
	   $idPacijenta=$_POST['idPacijenta'];
	   
      // koristimo klasu za poziv procedure za konekciju
	  require dirname(__DIR__)."/klase/BaznaKonekcija.php";
	  require dirname(__DIR__)."/klase/BaznaTabela.php";
	  $xml=dirname(__DIR__)."/klase/BaznaParametriKonekcije.xml";
	  $KonekcijaObject = new Konekcija($xml);
	$KonekcijaObject->connect();


	require dirname(__DIR__)."/Logicki/OsnovneValidacije.php";
	$ValidacijaObjekt= new Validacije();
	require dirname(__DIR__)."/klase/DBPacijent.php";
	$PacijentObject = new Pacijent($KonekcijaObject, 'pacijent');

   //Prikuplja kolekciju svih primljenih pacijenata
   $KolekcijaZapisa=$PacijentObject->UcitajSveIdPacijenataPrijema();
   $UkupanBrojZapisa = $PacijentObject->DajUkupanBrojPacijenata($KolekcijaZapisa);
   $SviBrojeviBolesti='';
   if ($UkupanBrojZapisa>0) 
   {	
	  $Sifra1='';
	  $t=0;
	  for ($RBZapisa = 0; $RBZapisa < $UkupanBrojZapisa; $RBZapisa++) 
		 {
			$Sifra=$PacijentObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 0);	
			$SviBrojeviBolesti.=$Sifra; 														
		 } //for
							  
   } 
   $greska1=$ValidacijaObjekt->DaLiJePacijentPrimljen($SviBrojeviBolesti,$idPacijenta);
  	if($greska1){
		echo $greska1;
	 }

	else{
	
	if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
    {	
			$greska=$PacijentObject->ObrisiPacijenta($idPacijenta);
			$KonekcijaObject->disconnect();
	}
    if($greska){
		echo $greska;
    }
    else{
	header ('Location:http://localhost/Hospitalizacija/PacijentLista.php');	
    }	
	}
      ?>
