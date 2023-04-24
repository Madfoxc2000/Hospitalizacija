 <?php
        //Preuzima vrednosti iz forme za unos pacijenta i poziva funkciju za kreiranje novog pacijenta.
        //Saradjuje sa klasama BaznaKonekcija, BaznaTabela, BaznaParametriKonekcije, 
        //BaznaTransakcija, Odeljenje
		session_start();  
	   // citanje vrednosti iz sesije - da bismo uvek proverili da li je to prijavljeni korisnik
	   $idkorisnika=$_SESSION["idkorisnika"];
	   
     $BrojIstorijeBolesti=$_POST['BrojIstorijeBolesti']; 
     $JMBG=$_POST['JMBG'];
     $ImeJednogRoditelja=$_POST['ImeJednogRoditelja'];
     $LBO=$_POST['LBO'];
     $OsnovOsiguranja=$_POST['OsnovOsiguranja'];
     $ClanJePorodice=$_POST['ClanJePorodice'];
     $Ime=$_POST['Ime'];
     $Prezime=$_POST['Prezime'];
     $Telefon=$_POST['Telefon']; 
     $DatumRodjenja=$_POST['DatumRodjenja']; 
     $Odeljenje=$_POST['Odeljenje']; 
     $m='mysqli';
     require dirname(__DIR__)."/Logicki/OsnovneValidacije.php";
     require dirname(__DIR__)."/klase/BaznaKonekcija.php";
     require dirname(__DIR__)."/klase/BaznaTabela.php";
     $ValidacijaObjekt= new Validacije();
     $greska3=$ValidacijaObjekt->DaLiJeVeliko($Ime,'имена'); 
     $greska4=$ValidacijaObjekt->DaLiJeVeliko($ImeJednogRoditelja,'имена једног родитеља '); 
     $greska5=$ValidacijaObjekt->DaLiJeVeliko($ClanJePorodice,'члана породице'); 
     $greska6=$ValidacijaObjekt->DaLiIma13brojeva($JMBG);
     $greska7=$ValidacijaObjekt->DaLiSuSamoBrojevi($JMBG,'ЈМБГ');
     $greska9=$ValidacijaObjekt->DaLiSuSamoBrojevi($Telefon,'Телефон');
     $xml=dirname(__DIR__)."/klase/BaznaParametriKonekcije.xml";
     $KonekcijaObject = new Konekcija($xml);
	   $KonekcijaObject->connect();
      require dirname(__DIR__)."/klase/DBPacijent.php";
		$PacijentObject= new Pacijent($KonekcijaObject, 'Pacijent');
      $KolekcijaZapisa=$PacijentObject->UcitajSveBrojeveBolesti();
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
      $greska8=$ValidacijaObjekt->DaLiJeJedinstvenBrojBolesti($SviBrojeviBolesti,$BrojIstorijeBolesti);

      $greskaValidacije=$greska3."<br>".$greska4."<br>".$greska5."<br>".$greska6."<br>".$greska7."<br>".$greska8;
      
   if($greskaValidacije){
      echo $greskaValidacije;
    }
   else{
      if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
         { 
       require dirname(__DIR__)."/klase/BaznaTransakcija.php";
      $TransakcijaObject = new Transakcija($KonekcijaObject,$m);
      $TransakcijaObject->ZapocniTransakciju();
      $greska1=$PacijentObject->DodajNovogPacijenta($BrojIstorijeBolesti, $JMBG, $ImeJednogRoditelja, $LBO, $OsnovOsiguranja, $ClanJePorodice, $Ime, $Prezime, $Telefon, $DatumRodjenja, $Odeljenje);
     // inkrement broja pacijenata kroz klasu DBOdeljenje
     require dirname(__DIR__)."/klase/DBOdeljenje.php";
     $OdeljenjeObject = new Odeljenje($KonekcijaObject, 'odeljenje');
     $greska2=$OdeljenjeObject->InkrementirajBrojPacijenata($Odeljenje);
     $UtvrdjenaGreska=$greska1.$greska2;
     $TransakcijaObject->ZavrsiTransakciju($UtvrdjenaGreska);
      $KonekcijaObject->disconnect();
      }
     
      if ($UtvrdjenaGreska) {
         echo "Greska $UtvrdjenaGreska";	
           }	
          else
          {
            header ('Location:http://localhost/Hospitalizacija/HospitalizacijaListaAdministrator.php');	
          }
   }
?>