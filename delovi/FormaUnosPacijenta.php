
<meta charset="UTF-8">
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>
    
<h1 class="form-header-pacijent">Унос пацијента</h1>

<form name="pacijentForm" ACTION="Logicki/AkcijaSnimiPacijenta.php" METHOD="POST" onsubmit="return validateForm()">

<div class="form-container-pacijent">


<div class="input-container">
    <label for="BrojIstorijeBolesti"> Број историје болести<span aria-label="required">*</span></label>
    <input type="text" name="BrojIstorijeBolesti" placeholder="XX123" required>
</div>

<div class="input-container">
    <label for="JMBG">ЈМБГ<span aria-label="required">*</span></label>
    <input type="number" name="JMBG" placeholder="1234567891234" required>
</div>
            
<div class="input-container">
    <label for="Ime">Име<span aria-label="required">*</span></label>
    <input type="text" name="Ime" placeholder="Марко" required>
</div>   


<div class="input-container">
    <label for="Prezime">Презиме:<span aria-label="required">*</span></label>
    <input type="text" name="Prezime" placeholder="Марковић" required>
</div>   

<div class="input-container">
    <label for="ImeJednogRoditelja">Име једног родитеља<span aria-label="required">*</span></label>
    <input type="text" name="ImeJednogRoditelja" placeholder="Славко" required>
</div>

<div class="input-container">
    <label for="LBO">ЛБО<span aria-label="required">*</span></label>
    <input type="text" name="LBO" placeholder="11111111111" required>
</div>


<div class="input-container">
    <label for="OsnovOsiguranja">Основ осигурања<span aria-label="required">*</span></label>
    <select name="OsnovOsiguranja" >		
	<option value="">изаберите</option>
    <?php
    // KONEKTOVANJE NA BAZU
    require dirname(__DIR__)."/klase/BaznaKonekcija.php";
	require dirname(__DIR__)."/klase/BaznaTabela.php";
	$xml=dirname(__DIR__)."/klase/BaznaParametriKonekcije.xml";
	$objKonekcija = new Konekcija($xml);
	$objKonekcija->connect();

    require "klase/DBOsnovOsiguranja.php";
	$OsnovOsiguranjaObject = new OsnovOsiguranja($objKonekcija,'osnov_osiguranja');
	$KolekcijaZapisaOsnovaOsiguranja = $OsnovOsiguranjaObject->DajKolekcijuSvihOsnovaOsiguranja();
	$UkupanBrojZapisa = $OsnovOsiguranjaObject->DajUkupanBrojSvihOsnovaOsiguranja($KolekcijaZapisaOsnovaOsiguranja);
    
    // PREDSTAVLJANJE U OPTION KROZ FOR CIKLUS
	if ($UkupanBrojZapisa>0) 
	{					
		for ($RBZapisa = 0; $RBZapisa < $UkupanBrojZapisa; $RBZapisa++) 
			{
				$Oznaka=$OsnovOsiguranjaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaOsnovaOsiguranja, $RBZapisa, 0);		
                $Naziv=$OsnovOsiguranjaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaOsnovaOsiguranja, $RBZapisa, 1);															
			
                echo "<option value=\"$Oznaka\">$Oznaka $Naziv</option>";			
			} 
										
	} 
     ?>
</select>
</div>   

<div class="input-container">
    <label for="ClanJePorodice">Члан је породице<span aria-label="required">*</span></label>
    <input type="text" name="ClanJePorodice" placeholder="Славко" required>
</div>   


<div class="input-container">
    <label for="Telefon">Телефон:<span aria-label="required">*</span></label>
    <input type="tel" name="Telefon" placeholder="+381" required>
</div>   

<div class="input-container">
    <label for="DatumRodjenja">Датум рођења:<span aria-label="required">*</span></label>
    <input type="date" name="DatumRodjenja" required>
</div>   


<div class="input-container">
    <label for="Odeljenje">Одељење:<span aria-label="required">*</span></label>
    <select name="Odeljenje">		
	<option value="">изаберите</option>
    <?php

    require "klase/DBOdeljenje.php";
	$OdeljenjeObject = new Odeljenje($objKonekcija,'odeljenje');
	$KolekcijaZapisaOdeljenja = $OdeljenjeObject->DajKolekcijuSvihOdeljenja();
	$UkupanBrojZapisa = $OdeljenjeObject->DajUkupanBrojSvihOdeljenja($KolekcijaZapisaOdeljenja);
    
    // PREDSTAVLJANJE U OPTION KROZ FOR CIKLUS
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

<div id="save-btn">
    <button type="submit" class="save-btn" name="btnSnimiVozilo" value="Сними">Сними</button>
</div>
</div>
</form>
            