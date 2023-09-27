<h1>Списак активних пацијената</h1>
	<div class="table-form-container">
   
	<div class="filter-form-container pacijent">
		<form  class="filter-form-upper" id="filter-form-upper" action="" method="GET">
		<label for="filter">Број историје болести:</label>
		<input type="text" id="filter" name="filter"/>
		<button type="submit" name="filtriraj" value="Филтрирај">Филтрирај</button>
		<span class="ValidationMessage" id = "filterMessage"></span>
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
						echo "<b><font face=\"Trebuchet MS\">Одељење на пријему</font><br/>";
						echo "</th>";
						echo "<th id=\"th3\">";
						echo "<b><font face=\"Trebuchet MS\">Упутна дијагноза</font><br/>";
						echo "</th>";
						echo "<th id=\"th4\">";
						echo "<b><font face=\"Trebuchet MS\">Датум пријема</font><br/>";
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
							$ID=$PrijemObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 0);//mysql_result($result,$row,"REGISTARSKIBROJ");
							$BrojIstorijeBolesti=$PrijemObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 1);//mysql_result($result,$row,"REGISTARSKIBROJ");
                            $OdeljenjeNaPrijemu=$PrijemObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 2);
                            $UputnaDijagnoza=$PrijemObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 3);
							$DatumPrijema=$PrijemObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 5);
							$IDtretman = $ID."tretman";
							// CRTANJE REDA TABELE SA PODACIMA
							echo "<tr>";
							echo "<td id=\"th1\">";
							echo "<b><font>$BrojIstorijeBolesti</font>";
							echo "</td>";
							echo "<td id=\"th2\">";
							echo "<b><font>$OdeljenjeNaPrijemu</font>";
							echo "</td>";
							echo "<td id=\"th3\">";
							echo "<b><font>$UputnaDijagnoza</font>";
							echo "</td>";
							echo "<td id=\"th4\">";
							echo "<b><font>$DatumPrijema</font>";
							echo "</td>";
							echo "<td id=\"th5\">";
                            echo "<form  ACTION=\"MedicinskiTretmaniUnos.php\" id=\"$IDtretman\" METHOD=\"POST\">";
							echo "<input type=\"hidden\" name=\"IdPrijema\" value=\"$ID\">";
							echo "<span class=\"material-symbols-outlined\" tretman=\"$IDtretman\">prescriptions</span>";
							echo "</form>";
							echo "<form  ACTION=\"HospitalizacijaUnos.php\" id=\"$ID\" METHOD=\"POST\">";
							echo "<input type=\"hidden\" name=\"IdPrijema\" value=\"$ID\">";
							echo "<span class=\"material-symbols-outlined\" otpust=\"$ID\">tab_move</span>";
							echo "</form>";
							echo "</td>";
							echo "</tr>";
                            	
						}  //za for
                        echo "</table>";
						echo "</div>";
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

