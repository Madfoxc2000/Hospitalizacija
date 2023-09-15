
<meta charset="UTF-8">
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>


   
<h1 class="form-header-hospitalizacija">Унос отпуста</h1>

<form name="hospitalizacijaForm" id="hospitalizacijaForm" ACTION="./Logicki/AkcijaSnimi.php" METHOD="POST">

<div class="form-container-hospitalizacija">

<input type="hidden" name="IdPrijema" value="<?php echo $IDPrijema?>">
<div class="input-container">
    <label for="OsnovniUzrokHospitalizacije">Основни узрок хоспитализација:<span aria-label="required">*</span></label>
    <select name="OsnovniUzrokHospitalizacije" >		
	<option value="">изаберите</option>
	<?php
	require dirname(__DIR__)."/klase/BaznaKonekcija.php";
	require dirname(__DIR__)."/klase/BaznaTabela.php";
	$xml=dirname(__DIR__)."/klase/BaznaParametriKonekcije.xml";
	$objKonekcija = new Konekcija($xml);
	$objKonekcija->connect();
	require "klase/DBMKB.php";
	$MKBObject = new MKB($objKonekcija, 'mkb');
	$KolekcijaZapisa =$MKBObject->DajKolekcijuSvihSifri();
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
	<span class="ValidationMessage" id = "OsnovniUzrokHospitalizacijeMessage"></span>
</div>   


<div class="input-container">
    <label for="PrateceDijagnoze">Пратеће дијагнозе:<span aria-label="required">*</span></label>
    <input type="text" name="PrateceDijagnoze" placeholder="LOO L99" >
	<span class="ValidationMessage" id = "PrateceDijagnozeMessage"></span>
</div>   

<div class="input-container">
    <label for="BrojSatiVentilatornePodrske">Број сати вентилаторне подршке:</label>
    <input type="number" name="BrojSatiVentilatornePodrske" placeholder="10">
</div> 

<div class="input-container">
    <label for="DatumOtpusta">Датум отпуста:<span aria-label="required">*</span></label>
    <input type="date" name="DatumOtpusta" required>
	<span class="ValidationMessage" id = "DatumOtpustaMessage"></span>
</div> 

<div class="input-container">
    <label for="OdeljenjeSaKojegJeOtpustIzvrsen">Одељење са којег је отпуст извршен:<span aria-label="required">*</span></label>
    <select name="OdeljenjeSaKojegJeOtpustIzvrsen">		
	<option value="">изаберите</option>
    <?php
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
			} //for
										
	} // $num_rowsTipoviVozila
    ?>
    </select>
	<span class="ValidationMessage" id = "OdeljenjeSaKojegJeOtpustIzvrsenMessage"></span>
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
<span class="ValidationMessage" id = "VrstaOtpustaMessage"></span>
</div> 
<div class="input-container-radio">
	<fieldset>
		<legend>Обдукован:</legend>
		<div>
			<input type="radio" id ="Obdukovan" name="Obdukovan" value="Да" disabled>
			<label>Да</label>
			</div>
		
			<div>
			<input type="radio" id ="NeObdukovan" name="Obdukovan" value="Не"  disabled >
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
	<span class="ValidationMessage" id = "OsnovniUzrokSmrtiMessage"></span>
</div> 
<div id="save-btn">
    <button type="submit" id="Enter" class="save-btn" name="btnSnimiVozilo" value="Сними">Сними</button>
</div>
</div>
</form>


