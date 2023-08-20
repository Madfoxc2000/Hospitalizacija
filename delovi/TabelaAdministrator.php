
<meta charset="UTF-8">
<!-- Vrši tabelarni prikaz podataka o hospitalizacijiama za administratora. 
Saradjuje sa klasama BaznaKonekcija, BaznaTabela, Hospitalizacija,  -->
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>
<div class="administrator-table-content">
	<h1>Хоспитализације</h1>
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
			echo "<table class =\"table-spisak-hospitalizacija\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"1\"  bgcolor=\"\">";
			echo "<tr>";
			echo "<th style=\"width:23%;\">";
			echo "<font face=\"Trebuchet MS\" >Broj istorije bolesti</font><br/>";
			echo "</th>";
			echo "<th style=\"width:23%;\">";
			echo "<b><font face=\"Trebuchet MS\">Osnovni uzrok hospitalizacije</font><br/>";
			echo "</th>";
			echo "<th style=\"width:23%;\">";
			echo "<b><font face=\"Trebuchet MS\">Datum prijema</font><br/>";
			echo "</th>";
			echo "<th style=\"width:23%;\">";
			echo "<b><font face=\"Trebuchet MS\">Datum otpusta</font><br/>";
			echo "</th>";
			echo "<th>";
			echo "<b><font face=\"Trebuchet MS\">Измена</font><br/>";
			echo "</th>";
			echo "<th>";
			echo "<b><font face=\"Trebuchet MS\">Брисање</font><br/>";
			echo "</th>";
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

</div>

</td>

<td style="width:5%;">
</td>

</tr>
</table>

    