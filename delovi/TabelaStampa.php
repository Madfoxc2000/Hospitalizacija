
<meta charset="UTF-8">
<!-- Omogućava tabelarni prikaz podataka na stranici prilagodjenoj za štampu.
Saradjuje sa klasama BaznaKonekcija, Hospitalizacija -->
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>
<img src="" width="100%" height="3" alt="" class="flt1 rp_topcornn" /> 

<table style="width:100%;style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0"  bgcolor="white">

<tr>
<td style="width:5%;">
</td>

<td>
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

	// PRETHODNI KOD PREUZIMA PODATKE I TO JE NA STAMPA.PHP

	    if ($UkupanBrojZapisa>0) {
			//$rbvesti=0;
			// ------------ zaglavlje ----------------
			echo "<table style=\"width:90%; padding:0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"1\"  bgcolor=\"white\">";
				echo "<tr>";
				echo "<td style=\"width:10%;\">";
				echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">Број историје болести</font><br/>";
				echo "</td>";
				echo "<td style=\"width:20%;\">";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">Основни узрок хоспитализације</font><br/>";
				echo "</td>";
				echo "<td style=\"width:50%;\">";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">Датум пријема</font><br/>";
				echo "</td>";
				echo "<td style=\"width:20%;\">";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">Датум отпуста</font><br/>";
				echo "</td>";
				echo "</tr>";
			
			for ($RBZapisa = 0; $RBZapisa < $UkupanBrojZapisa; $RBZapisa++) 
			{
			        				
				// CITANJE VREDNOSTI IZ MEMORIJSKE KOLEKCIJE $RESULT I DODELJIVANJE PROMENLJIVIM
				$BrojIstorijeBolesti=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 1);
				$OsnovniUzrokHospitalizacije=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 8);
				$DatumPrijema=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 4);
				$DatumOtpusta=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 13);
				
				// CRTANJE REDA TABELE SA PODACIMA
				echo "<tr>";
				echo "<td>";
				echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">$BrojIstorijeBolesti</font><br/>";
				echo "</td>";
				echo "<td>";
				echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">$OsnovniUzrokHospitalizacije</font><br/>";
				echo "</td>";
				echo "<td>";
				echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">$DatumPrijema</font><br/>";
				echo "</td>";
				echo "<td>";
				echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">$DatumOtpusta</font><br/>";
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

    