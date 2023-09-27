<h1>Све хоспитализације пацијента</h1>
<?php
// Omogućava tabelarni prikaz podataka za pogled “pacijentpogled”.
// Saradjuje sa klasama BaznaKonekcija, SPHospitalizacija
	   $BrojIstorijeBolesti=$_POST['IdHospitalizacije'];
       require dirname(__DIR__)."/klase/BaznaKonekcija.php";
       $xml=dirname(__DIR__)."/klase/BaznaParametriKonekcije.xml";
	    $KonekcijaObject = new Konekcija($xml);
	    $KonekcijaObject->connect();
        if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
        {
            require dirname(__DIR__)."/klase/DBStoredProcedure.php";	
            $DBSPObject = new SPHospitalizacija($KonekcijaObject, 'hospitalizacija');
            $KolekcijaZapisa = $DBSPObject->DajKolekcijuSvihHospitalizacijaPacijent($BrojIstorijeBolesti);
            $UkupanBrojZapisa = $DBSPObject->DajUkupanBrojSvihHospitalizacija($KolekcijaZapisa);
            if ($UkupanBrojZapisa>0) {
                //$rbvesti=0;
                // ------------ zaglavlje ----------------
                echo "<table class =\"table-pacijent\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"1\"  bgcolor=\"\">";
                    echo "<tr>";
                    echo "<th style=\"width:20%;\">";
                    echo "<font>Број историје болести</font><br/>";
                    echo "</th>";
                    echo "<th style=\"width:20%;\">";
                    echo "<b><font>Основни узрок хоспитализације</font><br/>";
                    echo "</th>";
                    echo "<th style=\"width:20%;\">";
                    echo "<b><font>Број дана хоспитализације</font><br/>";
                    echo "</th>";
                    echo "<th style=\"width:20%;\">";
                    echo "<b><font>Презиме</font><br/>";
                    echo "</th>";
                    echo "<th>";
                    echo "<b><font>Име</font><br/>";
                    echo "</th>";
                    echo "</tr>";
                
                for ($RBZapisa = 0; $RBZapisa < $UkupanBrojZapisa; $RBZapisa++) 
                {
                                        
                    // CITANJE VREDNOSTI IZ MEMORIJSKE KOLEKCIJE $RESULT I DODELJIVANJE PROMENLJIVIM
                                  
                    // CITANJE VREDNOSTI IZ MEMORIJSKE KOLEKCIJE $RESULT I DODELJIVANJE PROMENLJIVIM
                    $BrojIstorijeBolesti=$DBSPObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 0);//mysql_result($result,$row,"REGISTARSKIBROJ");
                    $OsnovniUzrokHospitalizacije=$DBSPObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 1);
                    $BrojDanaHospitalizacije=$DBSPObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 2);
                    $Ime=$DBSPObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 3);
                    $Prezime=$DBSPObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 4);
                    
                    // CRTANJE REDA TABELE SA PODACIMA
                    echo "<td>";
                    echo "<b><font face=\"Trebuchet MS\" size=\"2px\">$BrojIstorijeBolesti</font><br/>";
                    echo "</td>";
                    echo "<td>";
                    echo "<b><font face=\"Trebuchet MS\" size=\"2px\">$OsnovniUzrokHospitalizacije</font><br/>";
                    echo "</td>";
                    echo "<td>";
                    echo "<b><font face=\"Trebuchet MS\" size=\"2px\">$BrojDanaHospitalizacije</font><br/>";
                    echo "</td>";
                    echo "<td>";
                    echo "<b><font face=\"Trebuchet MS\" size=\"2px\">$Prezime</font><br/>";
                    echo "</td>";
                    echo "<td>";
                    echo "<b><font face=\"Trebuchet MS\" size=\"2px\">$Ime</font><br/>";
                    echo "</td>";
                    echo "</tr>";
    
                    
                    
                }  //za for 
                    echo "</table>";
                    echo "<br/>";
                    echo "<br/>";
                                }   else {
                                          echo "НЕМА ПОДАТАКА";
                                       } // ZA ELSE
               } // ZA IF DB SELECTED
        else
        {
            echo "Nije uspostavljena konekcija ka bazi podataka!";
        }
            
        $KonekcijaObject->disconnect();
?>