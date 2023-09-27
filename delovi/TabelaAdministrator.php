
<meta charset="UTF-8">
<!-- Vrši tabelarni prikaz podataka o hospitalizacijiama za administratora. 
Saradjuje sa klasama BaznaKonekcija, BaznaTabela, Hospitalizacija,  -->
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>
<div class="popup" id="popup">
  <div class="popup-content">
    <p>Да ли сте сигурни да желите да обришете запис?</p>
    <button id="confirmDelete">Да</button>
    <button id="cancelDelete">Nе</button>
  </div>
</div>
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
			echo "<table class =\"table-spisak-hospitalizacija-administrator\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"1\"  bgcolor=\"\">";
			echo "<tr>";
			echo "<th style=\"width:23%;\">";
			echo "<font>Број историје болести</font><br/>";
			echo "</th>";
			echo "<th style=\"width:23%;\">";
			echo "<b><font>Основни узрок хоспитализације</font><br/>";
			echo "</th>";
			echo "<th style=\"width:23%;\">";
			echo "<b><font>Датум пријема</font><br/>";
			echo "</th>";
			echo "<th style=\"width:23%;\">";
			echo "<b><font>Датум отпуста</font><br/>";
			echo "</th>";
			echo "<th>";
			echo "<b><font>Измена</font><br/>";
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
				echo "<b><font size=\"2px\">$OsnovniUzrokHospitalizacije</font><br/>";
				echo "</td>";
				echo "<td>";
				echo "<b><font  size=\"2px\">$DatumPrijema</font><br/>";
				echo "</td>";
				echo "<td>";
				echo "<b><font size=\"2px\">$DatumOtpusta</font><br/>";
				echo "</td>";
				echo "<td>";
				echo "<form ACTION=\"HospitalizacijaIzmeni.php\" METHOD=\"POST\">";
				echo "<input type=\"hidden\" name=\"IdHospitalizacije\" value=\"$ID\">";
				echo "<b><input TYPE=\"submit\" class=\"table-button\" name=\"izmenivozilo\" value=\"Измени\" /></font></b>";
				echo "</form>";
				echo "<form id=\"$ID\" class =\"deleteForm\" ACTION=\"Logicki\AkcijaObrisi.php\" METHOD=\"POST\" onsubmit=\"return showConfirmationPopup();\">";
				echo "<input type=\"hidden\" name=\"IdHospitalizacije\" value=\"$ID\">";
				echo "<b><input TYPE=\"submit\"  class=\"table-button delete-button\" name=\"obrisiHospitalizaciju\" data-submit-form=\"$ID\" value=\"Обриши\"/></font></b>";
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






    