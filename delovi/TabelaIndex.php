
<meta charset="UTF-8">
<!-- Vrši prikaz podataka o hospitalizacijama za prijavljenog korisnika.
Saradjuje sa klasama BaznaKonekcija, BaznaTabela, Hospitalizacija -->
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>
<div class="main-index-table-content">
	<h1>Списак хоспитализација</h1>
	<?php
	// PRETHODNI KOD PREUZIMA PODATKE I TO JE NA INDEX.PHP
	
			if ($UkupanBrojZapisa>0) {
				//$rbvesti=0;
				// ------------ zaglavlje ----------------
				echo "<table class =\"table-spisak-hospitalizacija\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"1\"  bgcolor=\"\">";
					echo "<tr>";
					echo "<th style=\"width:23%;\">";
					echo "<font face=\"Trebuchet MS\" >Број историје болести</font><br/>";
					echo "</th>";
					echo "<th style=\"width:23%;\">";
					echo "<b><font face=\"Trebuchet MS\">Основни узрок хоспитализације</font><br/>";
					echo "</th>";
					echo "<th style=\"width:23%;\">";
					echo "<b><font face=\"Trebuchet MS\">Датум пријема</font><br/>";
					echo "</th>";
					echo "<th style=\"width:23%;\">";
					echo "<b><font face=\"Trebuchet MS\">Датум отпуста</font><br/>";
					echo "</th>";
					echo "</tr>";
	
				for ($RBZapisa = 0; $RBZapisa < $UkupanBrojZapisa; $RBZapisa++)
				{
	
					// CITANJE VREDNOSTI IZ MEMORIJSKE KOLEKCIJE $RESULT I DODELJIVANJE PROMENLJIVIM
					$BrojIstorijeBolesti=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 0);
					$DatumPrijema=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 1);
					$DatumOtpusta=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 2);
					$OsnovniUzrokHospitalizacije=$HospitalizacijaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 3);
					// CRTANJE REDA TABELE SA PODACIMA
					echo "<tr>";
					echo "<td>";
					echo "<font face=\"Trebuchet MS\">$BrojIstorijeBolesti</font><br/>";
					echo "</td>";
					echo "<td>";
					echo "<b><font face=\"Trebuchet MS\">$OsnovniUzrokHospitalizacije</font><br/>";
					echo "</td>";
					echo "<td>";
					echo "<b><font face=\"Trebuchet MS\">$DatumPrijema</font><br/>";
					echo "</td>";
					echo "<td>";
					echo "<b><font face=\"Trebuchet MS\">$DatumOtpusta</font><br/>";
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
</div>
</td>
<td style="width:5%;">
</td>

</tr>
</table>

    