<meta charset="UTF-8">
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>


   
<h1 class="form-header-hospitalizacija">Измена Хоспитализације</h1>

<form ACTION="./Logicki/AkcijaIzmeni.php" METHOD="POST">

<div class="form-container-hospitalizacija">
<?php echo "<input type=\"hidden\" name=\"IdHospitalizacije\" value=\"$IdHospitalizacije\">";
	  echo "<input type=\"hidden\" name=\"IDPrijema\" value=\"$IDPrijema\">";?>

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
<span class="ValidationMessage" id = "OsnovniUzrokHospitalizacijeMessage"></span>
</div>   

<div class="input-container">
    <label for="PrateceDijagnoze">Пратеће дијагнозе:</label>
    <input type="text" name="PrateceDijagnoze" value="<?php echo $PrateceDijagnoze; ?>">
	<span class="ValidationMessage" id = "PrateceDijagnozeMessage"></span>
</div>   

<div class="input-container">
    <label for="BrojSatiVentilatornePodrske">Број сати вентилаторне подршке:<span aria-label="required">*</span></label>
    <input type="text" name="BrojSatiVentilatornePodrske"  value="<?php echo $BrojSatiVentilatornePodrske; ?>">
</div>

<div class="input-container">
    <label for="DatumOtpusta">Датум отпуста:<span aria-label="required">*</span></label>
    <input type="date" name="DatumOtpusta" required value="<?php echo $DatumOtpusta; ?>">
	<span class="ValidationMessage" id = "DatumOtpustaMessage"></span>
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
	<span class="ValidationMessage" id = "OdeljenjeSaKojegJeOtpustIzvrsenMessage"></span>
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
<span class="ValidationMessage" id = "VrstaOtpustaMessage"></span>
</div> 
<div class="input-container">
	<fieldset>
		<legend>Обдукован:</legend>
		<div>
			<input type="radio" id ="Obdukovan" name="Obdukovan" value="Да" >
			<label>Да</label>
			</div>
		
			<div>
			<input type="radio" id ="NeObdukovan" name="Obdukovan" value="Не" checked >
			<label>Не</label>
			</div>
	</fieldset>
</div> 

<div class="input-container">
    <label for="OsnovniUzrokSmrti">Основни узрок смрти:</label>
	<select name="OsnovniUzrokSmrti" id="OsnovniUzrokSmrti"  disabled>		
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
	<span class="ValidationMessage" id = "OsnovniUzrokSmrtiMessage"></span>
</div> 
<div id="save-btn">
    <button type="submit" class="signup-btn" name="btnSnimiVozilo" value="Измени">Измени</button>
</div>
</div>
</form>

