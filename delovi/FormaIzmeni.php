<meta charset="UTF-8">
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>


   
<h1 class="form-header-hospitalizacija">Измена Хоспитализације</h1>

<form ACTION="./Logicki/AkcijaIzmeni.php" METHOD="POST">

<div class="form-container-hospitalizacija">
<?php echo "<input type=\"hidden\" name=\"IdHospitalizacije\" value=\"$idHospitalizacije\">";
?>

<div class="input-container">
    <label for="BrojIstorijeBolesti"> Број историје болести<span aria-label="required">*</span></label>
    <input type="text" name="BrojIstorijeBolesti" required value="<?php echo $BrojIstorijeBolesti; ?>">
</div>

<div class="input-container">
    <label for="NazivZdravstveneUstanove">Назив здравствене установе:<span aria-label="required">*</span></label>
    <input type="text" name="NazivZdravstveneUstanove" required value="<?php echo $NazivZdravstveneUstanove; ?>">
</div>
            
<div class="input-container">
    <label for="OdeljenjeNaPrijemu">Одељење на пријему:<span aria-label="required">*</span></label>
	<select name="OdeljenjeNaPrijemu">		
    <?php
	echo "<option value=\"$OdeljenjeNaPrijemu\">$OdeljenjeNaPrijemu</option>";
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
    <input type="date" name="DatumPrijema" required value="<?php echo $DatumPrijema; ?>">
</div>   

<div class="input-container">
    <label for="UputnaDijagnoza">Упутна дијагноза:<span aria-label="required">*</span></label>
    <select name="UputnaDijagnoza" >		
	<?php  	 
	echo "<option value=\"$UputnaDijagnoza\">$UputnaDijagnoza</option>";
	if ($UkupanBrojZapisa1>0) 
	{					
		for ($RBZapisa = 0; $RBZapisa < $UkupanBrojZapisa1; $RBZapisa++) 
			{
				$Sifra=$MKBObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa1, $RBZapisa, 0);		
				$Naziv=$MKBObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa1, $RBZapisa, 1);															
				 echo "<option value=\"$Sifra\">$Sifra</option>";			
			} //for
										
	};	
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
    <label for="SpoljniUzrokPovrede">Спољни узрок повреде:<span aria-label="required">*</span></label>
	<select name="SpoljniUzrokPovrede" id="UzrokPovrede" required disabled>		
	<?php
	 echo "<option value=\"$SpoljniUzrokPovrede\">$SpoljniUzrokPovrede</option>";	
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
	<?php  	 
	echo "<option value=\"$OsnovniUzrokHospitalizacije\">$OsnovniUzrokHospitalizacije</option>";
	if ($UkupanBrojZapisa1>0) 
	{					
		for ($RBZapisa = 0; $RBZapisa < $UkupanBrojZapisa1; $RBZapisa++) 
			{
				$Sifra=$MKBObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa1, $RBZapisa, 0);		
				$Naziv=$MKBObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa1, $RBZapisa, 1);															
				 echo "<option value=\"$Sifra\">$Sifra</option>";			
			} //for
										
	};	
	?>
</select>
</div>   


<div class="input-container">
    <label for="PrateceDijagnoze">Пратеће дијагнозе:</label>
    <input type="text" name="PrateceDijagnoze" value="<?php echo $PrateceDijagnoze; ?>">
</div>   

<div class="input-container">
    <label for="SifraProcedurePoNomenklaturi">Шифра процедуре по номенклатури:<span aria-label="required">*</span></label>
    <input type="text" name="SifraProcedurePoNomenklaturi" required value="<?php echo $SifraProcedurePoNomenklaturi; ?>">
</div>   


<div class="input-container">
    <label for="TezinaNaPrijemu">Тежина на пријему:<span aria-label="required">*</span></label>
    <input type="text" name="TezinaNaPrijemu"   value="<?php echo $TezinaNaPrijemu; ?>">
</div>   

<div class="input-container">
    <label for="BrojSatiVentilatornePodrske">Број сати вентилаторне подршке:<span aria-label="required">*</span></label>
    <input type="text" name="BrojSatiVentilatornePodrske"  value="<?php echo $BrojSatiVentilatornePodrske; ?>">
</div> 
<div class="input-container">
    <label for="DatumOtpusta">Датум отпуста:<span aria-label="required">*</span></label>
    <input type="date" name="DatumOtpusta" required value="<?php echo $DatumOtpusta; ?>">
</div> 
<div class="input-container">
    <label for="BrojDanaHospitalizacije">Број дана хоспитализације:<span aria-label="required">*</span></label>
    <input type="text" name="BrojDanaHospitalizacije" required value="<?php echo $BrojDanaHospitalizacije; ?>">
</div> 
<div class="input-container">
    <label for="OdeljenjeSaKojegJeOtpustIzvrsen">Одељење са којег је отпуст извршен:<span aria-label="required">*</span></label>
    <select name="OdeljenjeSaKojegJeOtpustIzvrsen">		
    <?php
	echo "<option value=\"$OdeljenjeSaKojegJeOtpustIzvrsen\">$OdeljenjeSaKojegJeOtpustIzvrsen</option>";		
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
    <label for="VrstaOtpusta">Врсте отпуста:<span aria-label="required">*</span></label>
	<select name="VrstaOtpusta" id="VrstaOtpusta">		
	<?php
	echo "<option value=\"$VrstaOtpusta\">$VrstaOtpusta</option>";
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
    <!-- <input type="text" name="Obdukovan" value="<?php// echo $Obdukovan; ?>"> -->
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
	<?php
	 echo "<option value=\"$OsnovniUzrokSmrti\">$OsnovniUzrokSmrti</option>";
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
    <button type="submit" class="signup-btn" name="btnSnimiVozilo" value="Измени">Измени</button>
</div>
</div>
</form>

