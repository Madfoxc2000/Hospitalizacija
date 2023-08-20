
<meta charset="UTF-8">
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>


   
<h1 class="form-header-hospitalizacija">Унос Хоспитализације</h1>

<form ACTION="./Logicki/AkcijaSnimi.php" METHOD="POST">

<div class="form-container-pacijent">


<div class="input-container">
    <label for="BrojIstorijeBolesti"> Број историје болести<span aria-label="required">*</span></label>
    <input type="text" name="BrojIstorijeBolesti" required>
</div>

<div class="input-container">
    <label for="NazivZdravstveneUstanove">Назив здравствене установе:<span aria-label="required">*</span></label>
    <input type="text" name="NazivZdravstveneUstanove" required>
</div>
            
<div class="input-container">
    <label for="OdeljenjeNaPrijemu">Одељење на пријему:<span aria-label="required">*</span></label>
    <input type="text" name="OdeljenjeNaPrijemu" required>
</div>   


<div class="input-container">
    <label for="DatumPrijema">Датум пријема:<span aria-label="required">*</span></label>
    <input type="text" name="DatumPrijema" required>
</div>   

<div class="input-container">
    <label for="UputnaDijagnoza">Упутна дијагноза:<span aria-label="required">*</span></label>
    <select name="UputnaDijagnoza" >		
	<option value="">изаберите</option>
	<?php
	// KONEKTOVANJE NA BAZU
	require dirname(__DIR__)."/klase/BaznaKonekcija.php";
	require dirname(__DIR__)."/klase/BaznaTabela.php";
	$xml=dirname(__DIR__)."/klase/BaznaParametriKonekcije.xml";
	$objKonekcija = new Konekcija($xml);
	$objKonekcija->connect();
	
	// IZDVAJANJE PODATAKA KORISTECI KLASU TIP VOZILA
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
				 echo "<option value=\"$Sifra\">$Sifra</option>";			
			} //for
										
	} // $num_rowsTipoviVozila
	
	?>
</select>
</div>

<div class="input-container">
    <label for="Povreda">Повреда:<span aria-label="required">*</span></label>
    <input type="text" name="Povreda" required>
</div>


<div class="input-container">
    <label for="SpoljniUzrokPovrede">Спољни узрок повреде:<span aria-label="required">*</span></label>
    <input type="text" name="SpoljniUzrokPovrede" required>
</div>   

<div class="input-container">
    <label for="OsnovniUzrokHospitalizacije">Основни узрок хоспитализација:<span aria-label="required">*</span></label>
    <select name="OsnovniUzrokHospitalizacije" >		
	<option value=""></option>
	<?php
	if ($UkupanBrojZapisa>0) 
	{					
		for ($RBZapisa = 0; $RBZapisa < $UkupanBrojZapisa; $RBZapisa++) 
			{
				$Sifra=$MKBObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 0);		
				$Naziv=$MKBObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 1);															
				 echo "<option value=\"$Sifra\">$Sifra</option>";			
			} //for
										
	} // $num_rowsTipoviVozila
	
	?>
	</select>
</div>   


<div class="input-container">
    <label for="PrateceDijagnoze">Пратеће дијагнозе:<span aria-label="required">*</span></label>
    <input type="text" name="PrateceDijagnoze" required>
</div>   

<div class="input-container">
    <label for="SifraProcedurePoNomenklaturi">Шифра процедуре по номенклатури:<span aria-label="required">*</span></label>
    <input type="text" name="SifraProcedurePoNomenklaturi" required>
</div>   


<div class="input-container">
    <label for="TezinaNaPrijemu">Тежина на пријему:<span aria-label="required">*</span></label>
    <input type="text" name="TezinaNaPrijemu" required>
</div>   

<div class="input-container">
    <label for="BrojSatiVentilatornePodrske">Број сати вентилаторне подршке:<span aria-label="required">*</span></label>
    <input type="text" name="BrojSatiVentilatornePodrske" required>
</div> 
<div class="input-container">
    <label for="DatumOtpusta">Датум отпуста:<span aria-label="required">*</span></label>
    <input type="text" name="DatumOtpusta" required>
</div> 
<div class="input-container">
    <label for="BrojDanaHospitalizacije">Број дана хоспитализације:<span aria-label="required">*</span></label>
    <input type="text" name="BrojDanaHospitalizacije" required>
</div> 
<div class="input-container">
    <label for="OdeljenjeSaKojegJeOtpustIzvrsen">Одељење са којег је отпуст извршен::<span aria-label="required">*</span></label>
    <input type="text" name="OdeljenjeSaKojegJeOtpustIzvrsen" required>
</div> 
<div class="input-container">
    <label for="Obdukovan">Врсте отпуста:<span aria-label="required">*</span></label>
    <input type="text" name="Obdukovan" required>
</div> 
<div class="input-container">
    <label for="TezinaNaPrijemu">Обдукован:<span aria-label="required">*</span></label>
    <input type="text" name="TezinaNaPrijemu" required>
</div> 
<div class="input-container">
    <label for="OsnovniUzrokSmrti">Основни узрок смрти:<span aria-label="required">*</span></label>
	<select name="OsnovniUzrokSmrti" >		
	<option value=""></option>
	<?php
	if ($UkupanBrojZapisa>0) 
	{					
		for ($RBZapisa = 0; $RBZapisa < $UkupanBrojZapisa; $RBZapisa++) 
			{
				$Sifra=$MKBObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 0);		
				$Naziv=$MKBObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 1);															
				 echo "<option value=\"$Sifra\">$Sifra</option>";			
			} //for
										
	} // $num_rowsTipoviVozila
	
	?>
	</select>
</div> 
<div id="save-btn">
    <button type="submit" class="signup-btn" name="btnSnimiVozilo" value="Сними">Сними</button>
</div>
</div>
</form>


