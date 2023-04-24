
<meta charset="UTF-8">
<!-- Vrši tabelarni prikaz podataka o hospitalizacijiama za administratora. 
Saradjuje sa klasama BaznaKonekcija, BaznaTabela, Hospitalizacija,  -->
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>
<img src="" width="100%" height="3" alt="" class="flt1 rp_topcornn" /> 

<table style="width:100%;style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0"  bgcolor="#D8E7F4">
<tr>
<td style="width:5%;">
</td>

<td align="left">
<br/>
<font face="Trebuchet MS" color="darkblue" size="4px">
<b>Хоспитализације</br>
<?php

//KONEKCIJA KA SERVERU
// koristimo klasu za poziv procedure za konekciju
	require "klase/BaznaKonekcija.php";
	require "klase/BaznaTabela.php";
	$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
	$KonekcijaObject->connect();
	if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
    {	
		require "klase/DBHospitalizacija.php";
		$HospitalizacijaObject = new Hospitalizacija($KonekcijaObject, 'vozilo');
		
		// prikaz svih 
			$KolekcijaZapisa = $HospitalizacijaObject->DajKolekcijuSvihHospitalizacija();
			$UkupanBrojZapisa = $HospitalizacijaObject->DajUkupanBrojSvihHospitalizacija($KolekcijaZapisa);
			
	    if ($UkupanBrojZapisa>0) {
			//$rbvesti=0;
			// ------------ zaglavlje ----------------
			echo "<table style=\"width:100%; padding:0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"1\"  bgcolor=\"#D8E7F4\">";
				echo "<tr>";
				echo "<td style=\"width:25%;\">";
				echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">Број историје болести</font><br/>";
				echo "</td>";
				echo "<td style=\"width:25%;\">";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">Основни узрок хоспитализације</font><br/>";
				echo "</td>";
				echo "<td style=\"width:25%;\">";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">Датум пријема</font><br/>";
				echo "</td>";
				echo "<td style=\"width:25%;\">";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">Датум отпуста</font><br/>";
				echo "</td>";
				echo "<td>";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">Измена</font><br/>";
				echo "</td>";
				echo "<td>";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">Брисање</font><br/>";
				echo "</td>";
				echo "</tr>";
			
			for ($RBZapisa = 0; $RBZapisa < $UkupanBrojZapisa; $RBZapisa++) 
			{
			        				
				// CITANJE VREDNOSTI IZ MEMORIJSKE KOLEKCIJE $RESULT I DODELJIVANJE PROMENLJIVIM
		      				
				// CITANJE VREDNOSTI IZ MEMORIJSKE KOLEKCIJE $RESULT I DODELJIVANJE PROMENLJIVIM
				$ID=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisa, $RBZapisa, 0);
				$BrojIstorijeBolesti=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 1);//mysql_result($result,$row,"REGISTARSKIBROJ");
				$OsnovniUzrokHospitalizacije=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 8);
				$DatumPrijema=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 4);
				$DatumOtpusta=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 13);
				
				
				// CRTANJE REDA TABELE SA PODACIMA
				echo "<tr>";
				echo "<td>";

				echo "<form ACTION=\"HospitalizacijePogled.php\" METHOD=\"POST\">";
				echo "<input type=\"hidden\" name=\"IdHospitalizacije\" value=\"$BrojIstorijeBolesti\">";
				echo "<b><input TYPE=\"submit\" name=\"goButton\" value=\"$BrojIstorijeBolesti\" style =\"background: none;border: none;padding: 0;color: #069;\" /></font></b>";
				echo "</form>";

				echo "</td>";
				echo "<td>";
				echo "<b><font face=\"Trebuchet MS\" size=\"2px\">$OsnovniUzrokHospitalizacije</font><br/>";
				echo "</td>";
				echo "<td>";
				echo "<b><font face=\"Trebuchet MS\" size=\"2px\">$DatumPrijema</font><br/>";
				echo "</td>";
				echo "<td>";
				echo "<b><font face=\"Trebuchet MS\" size=\"2px\">$DatumOtpusta</font><br/>";
				echo "</td>";
				echo "<td>";
				echo "<form ACTION=\"HospitalizacijaIzmeni.php\" METHOD=\"POST\">";
				echo "<input type=\"hidden\" name=\"IdHospitalizacije\" value=\"$ID\">";
				echo "<b><font face=\"Trebuchet MS\" size=\"2px\"><input TYPE=\"submit\" name=\"izmenivozilo\" value=\"Измени\" /></font></b>";
				echo "</form>";
				echo "</td>";
				echo "<td>";
				echo "<form ACTION=\"Logicki\AkcijaObrisi.php\" METHOD=\"POST\">";
				echo "<input type=\"hidden\" name=\"IdHospitalizacije\" value=\"$ID\">";
				echo "<b><font face=\"Trebuchet MS\" size=\"2px\"><input TYPE=\"submit\" name=\"obrisiHospitalizaciju\" value=\"Обриши\"  onclick=\"return confirm('Da li ste sigurni da zelite da obrisete zapis?')\"/></font></b>";
				echo "</form>";
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
          
		  //mysql_close($db_handle);
		   $KonekcijaObject->disconnect();

?>



</td>

<td style="width:5%;">
</td>

</tr>
</table>

    