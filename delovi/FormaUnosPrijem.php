<meta charset="UTF-8">
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>

<h1 class="form-header-hospitalizacija">Пријем пацијента</h1>

<form name="prijemForm" id="prijemForm" ACTION="./Logicki/AkcijaSnimiPrijem.php" METHOD="POST">
<input type="hidden" name="idPacijenta" value="<?php echo $idPacijenta ;?>">
<div class="form-container-hospitalizacija">
<div class="input-container">
    <label for="OdeljenjeNaPrijemu">Одељење на пријему:<span aria-label="required">*</span></label>
    <select name="OdeljenjeNaPrijemu">	
	<option value="">изаберите</option> 	
    <?php
    // KONEKTOVANJE NA BAZU
    require dirname(__DIR__)."/klase/BaznaKonekcija.php";
	require dirname(__DIR__)."/klase/BaznaTabela.php";
	$xml=dirname(__DIR__)."/klase/BaznaParametriKonekcije.xml";
	$objKonekcija = new Konekcija($xml);
	$objKonekcija->connect();
    require "klase/DBOdeljenje.php";
	$OdeljenjeObject = new Odeljenje($objKonekcija,'odeljenje');
	$KolekcijaZapisaOdeljenja = $OdeljenjeObject->DajKolekcijuSvihOdeljenja();
	$UkupanBrojZapisa = $OdeljenjeObject->DajUkupanBrojSvihOdeljenja($KolekcijaZapisaOdeljenja);
	if ($UkupanBrojZapisa>0) 
	{					
		for ($RBZapisa = 0; $RBZapisa < $UkupanBrojZapisa; $RBZapisa++) 
			{
				$Oznaka=$OdeljenjeObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaOdeljenja, $RBZapisa, 0);		
                $Naziv=$OdeljenjeObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaOdeljenja, $RBZapisa, 1);															
			
                echo "<option value=\"$Oznaka\">$Oznaka $Naziv</option>";			
			} 
										
	} // $num_rowsTipoviVozila
    ?>
    </select>
	<span class="ValidationMessage" id = "OdeljenjeNaPrijemuMessage"></span>
</div>   


<div class="input-container">
    <label for="UputnaDijagnoza">Упутна дијагноза:<span aria-label="required">*</span></label>
    <select name="UputnaDijagnoza" >		
	<option value="">изаберите</option>
	<?php
	// IZDVAJANJE PODATAKA KORISTECI KLASU mkb
	require "klase/DBMKB.php";
	$MKBObject = new MKB($objKonekcija, 'mkb');
	$KolekcijaZapisa =$MKBObject->DajKolekcijuSvihSifri();
	$UkupanBrojZapisa =$MKBObject->DajUkupanBrojSvihSifri($KolekcijaZapisa);	
	// PREDSTAVLJANJE U OPTION KROZ FOR CIKLUS
	if ($UkupanBrojZapisa>0) 
	{					
		for ($RBZapisa = 0; $RBZapisa < $UkupanBrojZapisa; $RBZapisa++) 
			{
				$Sifra=$MKBObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 0);		
				$Naziv=$MKBObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 1);																
				 echo "<option value=\"$Sifra\">$Sifra $Naziv</option>";			
			} //for
										
	} // $num_rowsTipoviVozila
	
	?>
</select>
	<span class="ValidationMessage" id = "UputnaDijagnozaMessage"></span>
</div>

<div class="input-container">
    <label for="TezinaNaPrijemu">Тежина на пријему:</label>
    <input type="number" name="TezinaNaPrijemu" placeholder="1000">
	<span class="ValidationMessage" id = "TezinaNaPrijemuMessage"></span>
</div> 

<div class="input-container">
    <label for="DatumPrijema">Датум пријема:<span aria-label="required">*</span></label>
    <input type="date" name="DatumPrijema" required>
	<span class="ValidationMessage" id = "DatumPrijemaMessage"></span>
</div>   


<div class="input-container">
    <fieldset>
		<legend>Повреда:</legend>
		<div>
			<input type="radio" id ="Povredjen" name="Povreda" value="Да" >
			<label>Да</label>
			</div>
		
			<div>
			<input type="radio" id ="NePovredjen" name="Povreda" value="Не" checked >
			<label>Не</label>
			</div>
	</fieldset>
</div>


<div class="input-container">
    <label for="SpoljniUzrokPovrede">Спољни узрок повреде:</label>
	<select name="SpoljniUzrokPovrede" id="UzrokPovrede"  disabled>		
	<option value="">изаберите</option>
	<?php
	// IZDVAJANJE PODATAKA KORISTECI KLASU mkb
	require "klase/DBSpoljniUzrokPovrede.php";
	$SpoljniUzrokPovredeObject = new SpoljniUzrokPovrede($objKonekcija, 'spoljasnji_uzrok_povrede');
	$KolekcijaZapisaUzroka =$SpoljniUzrokPovredeObject->DajKolekcijuSvihSpoljnihUzroka();
	$UkupanBrojZapisaUzroka =$SpoljniUzrokPovredeObject->DajUkupanBrojSvihSpoljnihUzroka($KolekcijaZapisaUzroka);	
	// PREDSTAVLJANJE U OPTION KROZ FOR CIKLUS
	if ($UkupanBrojZapisaUzroka>0) 
	{					
		for ($RBZapisa = 0; $RBZapisa < $UkupanBrojZapisaUzroka; $RBZapisa++) 
			{
				$Sifra=$SpoljniUzrokPovredeObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaUzroka, $RBZapisa, 0);		
				$Naziv=$SpoljniUzrokPovredeObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaUzroka, $RBZapisa, 1);																
				 echo "<option value=\"$Sifra\">$Sifra $Naziv</option>";			
			} //for
										
	} // $num_rowsTipoviVozila
	
	?>
</select>
	<span class="ValidationMessage" id = "SpoljniUzrokPovredeMessage"></span>
</div>   

<div id="save-btn">
    <button type="submit" id="Enter" class="save-btn" name="btnSnimiVozilo" value="Сними">Сними</button>
</div>
</div>
</form>