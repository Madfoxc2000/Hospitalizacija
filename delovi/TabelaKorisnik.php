
<meta charset="UTF-8">
<!-- Vrši prikaz podataka o hospitalizacijama za neprijavljenog korisnika.
Saradjuje sa klasama BaznaKonekcija, BaznaTabela, Hospitalizacija -->
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>


	<h1>Списак хоспитализација</h1>
	<div class="table-form-container">

	<div class="filter-form-container">
	
		<form  class="filter-form-upper" action="" method="GET">
		<label for="filter">Основни узрок хоспитализације:</label>
		<input type="text" name="filter" />
		<button type="submit" name="filtriraj" value="Филтрирај">Филтрирај</button>
		<button type="submit" name="svi" value="СВИ">СВИ</button>
		 </form>
	
	
		<form class="filter-form-lower" action="Stampa.php" method="GET">
		<input type="text" name="filter" required />
		<button type="submit" name="filtriraj" value="Штампај по филтеру">Штампај по филтеру</button>
		</form>
	</div>
	
	
	
		<div class="table-container-main">
			
			<?php
			
			// PRETHODNI KOD PREUZIMA PODATKE I TO JE NA INDEX.PHP
			
					if ($UkupanBrojZapisa>0) {
						//$rbvesti=0;
						// ------------ zaglavlje ----------------
						echo "<table class =\"table-spisak-hospitalizacija-korisnik\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"1\"  bgcolor=\"\">";
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
								echo "</table>";
								echo "<div class=\"table-container\">";
								echo "<table class =\"table-spisak-hospitalizacija-korisnik\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"1\"  bgcolor=\"\">";
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
							echo "<font>$BrojIstorijeBolesti</font><br/>";
							echo "</td>";
							echo "<td>";
							echo "<b><font>$OsnovniUzrokHospitalizacije</font><br/>";
							echo "</td>";
							echo "<td>";
							echo "<b><font>$DatumPrijema</font><br/>";
							echo "</td>";
							echo "<td>";
							echo "<b><font>$DatumOtpusta</font><br/>";
							echo "</td>";
							echo "</tr>";
							
							// CRTANJE REDA TABELE SA PODACIMA fejk
							echo "<tr>";
							echo "<td>";
							echo "<font>$BrojIstorijeBolesti</font><br/>";
							echo "</td>";
							echo "<td>";
							echo "<b><font>$OsnovniUzrokHospitalizacije</font><br/>";
							echo "</td>";
							echo "<td>";
							echo "<b><font>$DatumPrijema</font><br/>";
							echo "</td>";
							echo "<td>";
							echo "<b><font>$DatumOtpusta</font><br/>";
							echo "</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<td>";
							echo "<font>$BrojIstorijeBolesti</font><br/>";
							echo "</td>";
							echo "<td>";
							echo "<b><font>$OsnovniUzrokHospitalizacije</font><br/>";
							echo "</td>";
							echo "<td>";
							echo "<b><font>$DatumPrijema</font><br/>";
							echo "</td>";
							echo "<td>";
							echo "<b><font>$DatumOtpusta</font><br/>";
							echo "</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<td>";
							echo "<font>$BrojIstorijeBolesti</font><br/>";
							echo "</td>";
							echo "<td>";
							echo "<b><font>$OsnovniUzrokHospitalizacije</font><br/>";
							echo "</td>";
							echo "<td>";
							echo "<b><font>$DatumPrijema</font><br/>";
							echo "</td>";
							echo "<td>";
							echo "<b><font>$DatumOtpusta</font><br/>";
							echo "</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<td>";
							echo "<font>$BrojIstorijeBolesti</font><br/>";
							echo "</td>";
							echo "<td>";
							echo "<b><font>$OsnovniUzrokHospitalizacije</font><br/>";
							echo "</td>";
							echo "<td>";
							echo "<b><font>$DatumPrijema</font><br/>";
							echo "</td>";
							echo "<td>";
							echo "<b><font>$DatumOtpusta</font><br/>";
							echo "</td>";
							echo "</tr>";
							
			
						}  //za for
							echo "</table>";
					}
					else
					{
						  echo "НЕМА ПОДАТАКА";
					 } // ZA ELSE
			
					   //mysql_close($db_handle);
					   $KonekcijaObject->disconnect();
			
			?>
				</div>
		</div>
	
		</div>





    