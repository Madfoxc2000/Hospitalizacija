<meta charset="UTF-8">
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>


   
<h1 class="form-header-hospitalizacija">Измена Хоспитализације</h1>

<form ACTION="./Logicki/AkcijaIzmeni.php" METHOD="POST">

<div class="form-container-pacijent">
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
    <input type="text" name="OdeljenjeNaPrijemu" required value="<?php echo $OdeljenjeNaPrijemu; ?>">
</div>   


<div class="input-container">
    <label for="DatumPrijema">Датум пријема:<span aria-label="required">*</span></label>
    <input type="text" name="DatumPrijema" required value="<?php echo $DatumPrijema; ?>">
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
    <label for="Povreda">Повреда:<span aria-label="required">*</span></label>
    <input type="text" name="Povreda" required value="<?php echo $Povreda; ?>">
</div>


<div class="input-container">
    <label for="SpoljniUzrokPovrede">Спољни узрок повреде:<span aria-label="required">*</span></label>
    <input type="text" name="SpoljniUzrokPovrede" required value="<?php echo $SpoljniUzrokPovrede; ?>">
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
    <label for="PrateceDijagnoze">Пратеће дијагнозе:<span aria-label="required">*</span></label>
    <input type="text" name="PrateceDijagnoze" required value="<?php echo $PrateceDijagnoze; ?>">
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
    <input type="text" name="DatumOtpusta" required value="<?php echo $DatumOtpusta; ?>">
</div> 
<div class="input-container">
    <label for="BrojDanaHospitalizacije">Број дана хоспитализације:<span aria-label="required">*</span></label>
    <input type="text" name="BrojDanaHospitalizacije" required value="<?php echo $BrojDanaHospitalizacije; ?>">
</div> 
<div class="input-container">
    <label for="OdeljenjeSaKojegJeOtpustIzvrsen">Одељење са којег је отпуст извршен::<span aria-label="required">*</span></label>
    <input type="text" name="OdeljenjeSaKojegJeOtpustIzvrsen" required value="<?php echo $OdeljenjeSaKojegJeOtpustIzvrsen; ?>">
</div> 
<div class="input-container">
    <label for="Obdukovan">Врсте отпуста:<span aria-label="required">*</span></label>
    <input type="text" name="Obdukovan" required value="<?php echo $VrstaOtpusta; ?>">
</div> 
<div class="input-container">
    <label for="TezinaNaPrijemu">Обдукован:<span aria-label="required">*</span></label>
    <input type="text" name="TezinaNaPrijemu" value="<?php echo $Obdukovan; ?>">
</div> 
<div class="input-container">
    <label for="OsnovniUzrokSmrti">Основни узрок смрти:<span aria-label="required">*</span></label>
	
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
<div id="save-btn">
    <button type="submit" class="signup-btn" name="btnSnimiVozilo" value="Измени">Измени</button>
</div>
</div>
</form>

