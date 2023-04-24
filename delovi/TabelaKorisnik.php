
<meta charset="UTF-8">
<!-- Vrši prikaz podataka o hospitalizacijama za neprijavljenog korisnika.
Saradjuje sa klasama BaznaKonekcija, BaznaTabela, Hospitalizacija -->
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>
<img src="" width="100%" height="3" alt="" class="flt1 rp_topcornn" /> 

<table style="width:100%;style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0"  >

<tr>
<td style="width:5%;">
</td>

<td>
<font face="Trebuchet MS" color="darkblue" size="4px">
<b>Списак хоспитализација</br> </font>
<font face="Trebuchet MS" color="darkblue" size="2px">
<b>Основни узрок хоспитализације:</br> </font>
<form action="" method="GET">
<input type="text" name="filter" required />
<input type="submit" name="filtriraj" value="Филтрирај" />
<input type="submit" name="svi" value="СВИ" />

 </form> 
<font face="Trebuchet MS" color="darkblue" size="4px">
<form action="Stampa.php" method="GET">
<input type="text" name="filter" required />
<input type="submit" name="filtriraj" value="Штампај по филтеру" />
</form>

</td>
<td style="width:5%;">
</td>
</tr>


<tr>
<td style="width:5%;">
</td>

<td align="left">
<br/>
<font face="Trebuchet MS" color="darkblue" size="4px">

<?php

// PRETHODNI KOD PREUZIMA PODATKE I TO JE NA INDEX.PHP

	    if ($UkupanBrojZapisa>0) {
			//$rbvesti=0;
			// ------------ zaglavlje ----------------
			echo "<table style=\"width:92%; padding:0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"1\"  bgcolor=\"\">";
				echo "<tr>";
				echo "<td style=\"width:23%;\">";
				echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">Broj istorije bolesti</font><br/>";
				echo "</td>";
				echo "<td style=\"width:23%;\">";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">Osnovni uzrok hospitalizacije</font><br/>";
				echo "</td>";
				echo "<td style=\"width:23%;\">";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">Datum prijema</font><br/>";
				echo "</td>";
				echo "<td style=\"width:23%;\">";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">Datum otpusta</font><br/>";
				echo "</td>";
				echo "</tr>";
			
			for ($RBZapisa = 0; $RBZapisa < $UkupanBrojZapisa; $RBZapisa++) 
			{
			        				
				// CITANJE VREDNOSTI IZ MEMORIJSKE KOLEKCIJE $RESULT I DODELJIVANJE PROMENLJIVIM
				$BrojIstorijeBolesti=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 1);//mysql_result($result,$row,"REGISTARSKIBROJ");
				$OsnovniUzrokHospitalizacije=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 8);
				$DatumPrijema=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 4);
				$DatumOtpusta=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 13);
				
				// CRTANJE REDA TABELE SA PODACIMA
				echo "<tr>";
				echo "<td>";
				echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">$BrojIstorijeBolesti</font><br/>";
				echo "</td>";
				echo "<td>";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">$OsnovniUzrokHospitalizacije</font><br/>";
				echo "</td>";
				echo "<td>";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">$DatumPrijema</font><br/>";
				echo "</td>";
				echo "<td>";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">$DatumOtpusta</font><br/>";
				echo "</td>";
				echo "</tr>";
			
			}  //za for 
				echo "</table>";
				echo "<br/>";
				echo "<br/>";
		}   
		else 
		{
              echo "НЕМА ПОДАТАКА";
         } // ZA ELSE
           
           //mysql_close($db_handle);
		   $KonekcijaObject->disconnect();

?>



</td>

<td style="width:5%;">
</td>

</tr>
</table>

    