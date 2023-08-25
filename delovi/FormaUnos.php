
<meta charset="UTF-8">
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>


   
<h1 class="form-header-hospitalizacija">Унос Хоспитализације</h1>

<form ACTION="./Logicki/AkcijaSnimi.php" METHOD="POST">

<div class="form-container-hospitalizacija">


<div class="input-container">
    <label for="BrojIstorijeBolesti"> Број историје болести<span aria-label="required">*</span></label>
    <input type="text" name="BrojIstorijeBolesti" placeholder="XX123" required>
</div>

<div class="input-container">
    <label for="NazivZdravstveneUstanove">Назив здравствене установе:<span aria-label="required">*</span></label>
    <input type="text" name="NazivZdravstveneUstanove" placeholder="Клинички" required>
</div>
            
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
	$UkupanBrojZapisaOdeljenja = $OdeljenjeObject->DajUkupanBrojSvihOdeljenja($KolekcijaZapisaOdeljenja);
    
    // PREDSTAVLJANJE U OPTION KROZ FOR CIKLUS
	if ($UkupanBrojZapisaOdeljenja>0) 
	{					
		for ($RBZapisa = 0; $RBZapisa < $UkupanBrojZapisaOdeljenja; $RBZapisa++) 
			{
				$Oznaka=$OdeljenjeObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaOdeljenja, $RBZapisa, 0);		
                $Naziv=$OdeljenjeObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaOdeljenja, $RBZapisa, 1);															
			
                echo "<option value=\"$Oznaka\">$Oznaka $Naziv</option>";			
			} //for
										
	} // $num_rowsTipoviVozila
    ?>
    </select>
</div>   


<div class="input-container">
    <label for="DatumPrijema">Датум пријема:<span aria-label="required">*</span></label>
    <input type="date" name="DatumPrijema" required>
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
</div>

<div class="input-container">
    <fieldset>
		<legend>Повреда:</legend>
		<div>
			<input type="radio" id ="Povredjen" name="Povreda" value="1">
			<label>Да</label>
			</div>
		
			<div>
			<input type="radio" id ="NePovredjen" name="Povreda" value="2" checked>
			<label>Не</label>
			</div>
	</fieldset>
</div>


<div class="input-container">
    <label for="SpoljniUzrokPovrede">Спољни узрок повреде:</label>
	<select name="SpoljniUzrokPovrede" id="UzrokPovrede" disabled>		
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
</div>   

<div class="input-container">
    <label for="OsnovniUzrokHospitalizacije">Основни узрок хоспитализација:<span aria-label="required">*</span></label>
    <select name="OsnovniUzrokHospitalizacije" >		
	<option value="">изаберите</option>
	<?php
		
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
</div>   


<div class="input-container">
    <label for="PrateceDijagnoze">Пратеће дијагнозе:<span aria-label="required">*</span></label>
    <input type="text" name="PrateceDijagnoze" placeholder="LOO L99" >
</div>   

<div class="input-container">
    <label for="SifraProcedurePoNomenklaturi">Шифра процедуре по номенклатури:<span aria-label="required">*</span></label>
    <input type="text" name="SifraProcedurePoNomenklaturi" placeholder="СФ320" required>
</div>   


<div class="input-container">
    <label for="TezinaNaPrijemu">Тежина на пријему:</label>
    <input type="text" name="TezinaNaPrijemu" placeholder="1000">
</div>   

<div class="input-container">
    <label for="BrojSatiVentilatornePodrske">Број сати вентилаторне подршке:</label>
    <input type="text" name="BrojSatiVentilatornePodrske" placeholder="10">
</div> 
<div class="input-container">
    <label for="DatumOtpusta">Датум отпуста:<span aria-label="required">*</span></label>
    <input type="date" name="DatumOtpusta" required>
</div> 
<div class="input-container">
    <label for="BrojDanaHospitalizacije">Број дана хоспитализације:<span aria-label="required">*</span></label>
    <input type="text" name="BrojDanaHospitalizacije" required>
</div> 
<div class="input-container">
    <label for="OdeljenjeSaKojegJeOtpustIzvrsen">Одељење са којег је отпуст извршен:<span aria-label="required">*</span></label>
    <select name="OdeljenjeSaKojegJeOtpustIzvrsen">		
	<option value="">изаберите</option>
    <?php
		$KolekcijaZapisaOdeljenja = $OdeljenjeObject->DajKolekcijuSvihOdeljenja();
		$UkupanBrojZapisa = $OdeljenjeObject->DajUkupanBrojSvihOdeljenja($KolekcijaZapisaOdeljenja);
	if ($UkupanBrojZapisa>0) 
	{					
		for ($RBZapisa = 0; $RBZapisa < $UkupanBrojZapisa; $RBZapisa++) 
			{
				$Oznaka=$OdeljenjeObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaOdeljenja, $RBZapisa, 0);		
                $Naziv=$OdeljenjeObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaOdeljenja, $RBZapisa, 1);															
			
                echo "<option value=\"$Oznaka\">$Oznaka $Naziv</option>";			
			} //for
										
	} // $num_rowsTipoviVozila
    ?>
    </select>
</div> 
<div class="input-container">
    <label for="VrstaOtpusta">Врста отпуста:<span aria-label="required">*</span></label>
    <select name="VrstaOtpusta" id="VrstaOtpusta">		
	<option value="">изаберите</option>
	<?php
	// IZDVAJANJE PODATAKA KORISTECI KLASU mkb
	require "klase/DBOtpust.php";
	$VrstaOtpustaObject = new VrstaOtpusta($objKonekcija, 'vrsta_otpusta');
	$KolekcijaZapisaOtpusta =$VrstaOtpustaObject->DajKolekcijuSvihOtpusta();
	$UkupanBrojZapisaOtpusta =$VrstaOtpustaObject->DajUkupanBrojSvihOtpusta($KolekcijaZapisaOtpusta);	
	// PREDSTAVLJANJE U OPTION KROZ FOR CIKLUS
	if ($UkupanBrojZapisaOtpusta>0) 
	{					
		for ($RBZapisa = 0; $RBZapisa < $UkupanBrojZapisaOtpusta; $RBZapisa++) 
			{
				$Sifra=$VrstaOtpustaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaOtpusta, $RBZapisa, 0);		
				$Naziv=$VrstaOtpustaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaOtpusta, $RBZapisa, 1);																
				 echo "<option value=\"$Sifra\">$Sifra $Naziv</option>";			
			} //for
										
	} // $num_rowsTipoviVozila
	
	?>
</select>
</div> 
<div class="input-container">
	<fieldset>
		<legend>Обдукован:</legend>
		<div>
			<input type="radio" id ="Obdukovan" name="Obdukovan" value="1" disabled>
			<label>Да</label>
			</div>
		
			<div>
			<input type="radio" id ="NeObdukovan" name="Obdukovan" value="2" checked disabled>
			<label>Не</label>
			</div>
	</fieldset>
</div> 
<div class="input-container">
    <label for="OsnovniUzrokSmrti">Основни узрок смрти:</label>
	<select name="OsnovniUzrokSmrti" id="OsnovniUzrokSmrti" disabled>		
	<option value="">изаберите</option>
	<?php
	$UkupanBrojZapisa =$MKBObject->DajUkupanBrojSvihSifri($KolekcijaZapisa);	
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
</div> 
<div id="save-btn">
    <button type="submit" class="save-btn" name="btnSnimiVozilo" value="Сними">Сними</button>
</div>
</div>
</form>


