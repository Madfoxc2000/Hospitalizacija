
<meta charset="UTF-8">
<!-- Vrši prikaz podataka o hospitalizacijama za neprijavljenog korisnika.
Saradjuje sa klasama BaznaKonekcija, BaznaTabela, Hospitalizacija -->
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>
<div class="popup" id="popup">
  <div class="popup-content">
    <p>Да ли сте сигурни да желите да обришете запис?</p>
    <button id="confirmDelete">Да</button>
    <button id="cancelDelete">Nе</button>
  </div>
</div>
<div class="administrator-table-content">

	<h1 >Списак пацијената</h1>
	<div class="table-form-container">

	<div class="filter-form-container">
	
		<form  class="filter-form-upper" action="" method="GET">
		<label for="filter">Број историје болести:</label>
		<input type="text" name="filter" />
		<button type="submit" name="filtriraj" value="Филтрирај">Филтрирај</button>
		<button type="submit" name="svi" value="СВИ">СВИ</button>
		 </form>
	</div>
	
	
	
		<div class="table-container-main">
			
			<?php
			
			// PRETHODNI KOD PREUZIMA PODATKE I TO JE NA INDEX.PHP
			
					if ($UkupanBrojZapisa>0) {
						//$rbvesti=0;
						// ------------ zaglavlje ----------------
						echo "<table class =\"table-spisak-hospitalizacija-korisnik\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\"  bgcolor=\"\">";
								echo "<tr>";
								echo "<th id=\"th1\">";
								echo "<b><font face=\"Trebuchet MS\" >Број историје болести</font><br/>";
								echo "</th>";
								echo "<th id=\"th2\">";
								echo "<b><font face=\"Trebuchet MS\">Име</font><br/>";
								echo "</th>";
								echo "<th id=\"th3\">";
								echo "<b><font face=\"Trebuchet MS\">Презиме</font><br/>";
								echo "</th>";
								echo "<th id=\"th4\">";
								echo "<b><font face=\"Trebuchet MS\">Датум рођења</font><br/>";
								echo "</th>";
								echo "<th id=\"thHiden\">";
								echo "<b><font></font><br/>";
								echo "</th>";
								echo "</tr>";
								echo "</table>";
								echo "<div class=\"table-container\">";
								echo "<table class =\"table-spisak-hospitalizacija-korisnik\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\"  bgcolor=\"\">";
						for ($RBZapisa = 0; $RBZapisa < $UkupanBrojZapisa; $RBZapisa++)
						{
			
							// CITANJE VREDNOSTI IZ MEMORIJSKE KOLEKCIJE $RESULT I DODELJIVANJE PROMENLJIVIM
							$BrojIstorijeBolesti=$PacijentObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 0);
							$Ime=$PacijentObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 6);
							$Prezime=$PacijentObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 7);
							$DatumRodjenja=$PacijentObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 9);
							$ID = $BrojIstorijeBolesti;
							$IDupdate = $BrojIstorijeBolesti."update";
							$IDprijem = $BrojIstorijeBolesti."prijem";
							// CRTANJE REDA TABELE SA PODACIMA
							echo "<tr>";
							echo "<td id=\"th1\">";
							echo "<b><font>$BrojIstorijeBolesti</font><br/>";
							echo "</td>";
							echo "<td id=\"th2\">";
							echo "<b><font>$Ime</font><br/>";
							echo "</td>";
							echo "<td id=\"th3\">";
							echo "<b><font>$Prezime</font><br/>";
							echo "</td>";
							echo "<td id=\"th4\">";
							echo "<b><font>$DatumRodjenja</font><br/>";
							echo "</td>";
							echo "<td id=\"th5\">";
							echo "<form ACTION=\"PacijentIzmeni.php\" id=\"$IDupdate\" METHOD=\"POST\">";
							echo "<input type=\"hidden\" name=\"idPacijenta\" value=\"$ID\">";
							echo "<span class=\"material-symbols-outlined\" update=\"$IDupdate\">edit_document</span>";
							echo "</form>";
							echo "<form id=\"$ID\" class =\"deleteForm\" ACTION=\"Logicki\AkcijaObrisiPacijenta.php\" METHOD=\"POST\">";
							echo "<input type=\"hidden\" name=\"idPacijenta\" value=\"$ID\">";
							echo "<span class=\"material-symbols-outlined delete-button\" data-submit-form=\"$ID\">delete</span>";
							echo "</form>";
							echo "<form  ACTION=\"PacijentPrijem.php\" id=\"$IDprijem\" METHOD=\"POST\">";
							echo "<input type=\"hidden\" name=\"idPacijenta\" value=\"$ID\">";
							echo "<span class=\"material-symbols-outlined\" prijem=\"$IDprijem\">bedroom_child</span>";
							echo "</form>";
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
</div>