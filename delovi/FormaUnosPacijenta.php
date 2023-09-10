
<meta charset="UTF-8">
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>
    
<h1 class="form-header-pacijent">Унос пацијента</h1>

<form name="pacijentForm" id="pacijentForm"  ACTION="Logicki/AkcijaSnimiPacijenta.php" METHOD="POST">

<div class="form-container-pacijent">


<div class="input-container">
    <label for="BrojIstorijeBolesti"> Број историје болести<span aria-label="required">*</span></label>
    <input type="text" name="BrojIstorijeBolesti" placeholder="XX123" required>
    <span class="ValidationMessage" id = "BrojIstorijeBolestiMessage"></span>
</div>

<div class="input-container">
    <label for="JMBG">ЈМБГ<span aria-label="required">*</span></label>
    <input type="number" name="JMBG" placeholder="1234567891234" required>
    <span class="ValidationMessage" id = "JMBGMessage"></span>
</div>
            
<div class="input-container">
    <label for="Ime">Име<span aria-label="required">*</span></label>
    <input type="text" name="Ime" placeholder="Марко" required>
    <span class="ValidationMessage" id = "ImeMessage"></span>
</div>   


<div class="input-container">
    <label for="Prezime">Презиме:<span aria-label="required">*</span></label>
    <input type="text" name="Prezime" placeholder="Марковић" required>
    <span class="ValidationMessage" id = "PrezimeMessage"></span>
</div>   

<div class="input-container">
    <label for="ImeJednogRoditelja">Име једног родитеља<span aria-label="required">*</span></label>
    <input type="text" name="ImeJednogRoditelja"  placeholder="Славко" required>
    <span class="ValidationMessage" id = "ImeJednogRoditeljaMessage"></span>
</div>

<div class="input-container">
    <label for="LBO">ЛБО<span aria-label="required">*</span></label>
    <input type="number" name="LBO" placeholder="11111111111" required>
    <span class="ValidationMessage" id = "LBOMessage"></span>
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
<span class="ValidationMessage" id = "OsnovOsigurnanjaMessage"></span>
</div>   

<div class="input-container">
    <label for="ClanJePorodice">Члан је породице<span aria-label="required">*</span></label>
    <input type="text" name="ClanJePorodice" placeholder="Славко" required>
    <span class="ValidationMessage" id = "ClanJePorodiceMessage"></span>
</div>   


<div class="input-container">
    <label for="Telefon">Телефон:<span aria-label="required">*</span></label>
    <input type="tel" name="Telefon" placeholder="+381" required>
    <span class="ValidationMessage" id = "TelefonMessage"></span>
</div>   

<div class="input-container">
    <label for="DatumRodjenja">Датум рођења:<span aria-label="required">*</span></label>
    <input type="date" name="DatumRodjenja" required>
    <span class="ValidationMessage" id = "DatumRodjenjaMessage"></span>
</div>   

<div class="input-container">
    <label for="Drzavljanstvo">Држављанство</label>
    <input type="text" name="Drzavljanstvo" placeholder="Srpsko" >
    <span class="ValidationMessage" id="Drzavljanstvo"></span>
</div> 

<div class="input-container">
    <fieldset>
		<legend>Пол:</legend>
            <div>
			<input type="radio"  name="Pol" value="Мушко">
			<label>Мушко</label>
			</div>
		
			<div>
			<input type="radio"  name="Pol" value="Женско">
			<label>Женско</label>
			</div>

            <div>
			<input type="radio"  name="Pol" value="Друго" checked>
			<label>Друго</label>
			</div>
	</fieldset>
</div>

<div class="input-container">
    <label for="Adresa">Адреса</label>
    <input type="text" name="Adresa" placeholder="" required>
    <span class="ValidationMessage" id = "Adresa"></span>
</div>


<div id="save-btn">
    <button type="submit" id="Enter" class="save-btn" name="btnSnimiVozilo" value="Сними">Сними</button>
</div>
</div>
</form>
            