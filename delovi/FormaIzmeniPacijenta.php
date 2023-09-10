<meta charset="UTF-8">
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>
    
<h1 class="form-header-pacijent">Измени пацијента</h1>

<form name="pacijentForm" id="pacijentForm"  ACTION="Logicki/AkcijaIzmeniPacijenta.php" METHOD="POST">

<div class="form-container-pacijent">


<div class="input-container">
    <label for="BrojIstorijeBolesti"> Број историје болести<span aria-label="required">*</span></label>
    <input type="text" name="BrojIstorijeBolesti" placeholder="XX123" value="<?php echo $BrojIstorijeBolesti; ?>" required>
    <span class="ValidationMessage" id = "BrojIstorijeBolestiMessage"></span>
</div>

<div class="input-container">
    <label for="JMBG">ЈМБГ<span aria-label="required">*</span></label>
    <input type="number" name="JMBG" placeholder="1234567891234" value="<?php echo $JMBG; ?>"  required>
    <span class="ValidationMessage" id = "JMBGMessage"></span>
</div>
            
<div class="input-container">
    <label for="Ime">Име<span aria-label="required">*</span></label>
    <input type="text" name="Ime" placeholder="Марко" value="<?php echo $Ime; ?>" required>
    <span class="ValidationMessage" id = "ImeMessage"></span>
</div>   


<div class="input-container">
    <label for="Prezime">Презиме:<span aria-label="required">*</span></label>
    <input type="text" name="Prezime" placeholder="Марковић" value="<?php echo $Prezime; ?>" required>
    <span class="ValidationMessage" id = "PrezimeMessage"></span>
</div>   

<div class="input-container">
    <label for="ImeJednogRoditelja">Име једног родитеља<span aria-label="required">*</span></label>
    <input type="text" name="ImeJednogRoditelja"  placeholder="Славко" value="<?php echo $ImeJednogRoditelja; ?>" required>
    <span class="ValidationMessage" id = "ImeJednogRoditeljaMessage"></span>
</div>

<div class="input-container">
    <label for="LBO">ЛБО<span aria-label="required">*</span></label>
    <input type="number" name="LBO" placeholder="11111111111" value="<?php echo $LBO; ?>" required>
    <span class="ValidationMessage" id = "LBOMessage"></span>
</div>


<div class="input-container">
    <label for="OsnovOsiguranja">Основ осигурања<span aria-label="required">*</span></label>
    <select name="OsnovOsiguranja" >
    <?php
    echo "<option value=\"$OsnovOsiguranja\">$OsnovOsiguranja</option>";
    // PREDSTAVLJANJE U OPTION KROZ FOR CIKLUS
	if ($UkupanBrojZapisaOsiguranja>0) 
	{					
		for ($RBZapisa = 0; $RBZapisa < $UkupanBrojZapisaOsiguranja; $RBZapisa++) 
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
    <input type="text" name="ClanJePorodice" placeholder="Славко" value="<?php echo $ClanJePorodice; ?>" required>
    <span class="ValidationMessage" id = "ClanJePorodiceMessage"></span>
</div>   


<div class="input-container">
    <label for="Telefon">Телефон:<span aria-label="required">*</span></label>
    <input type="tel" name="Telefon" placeholder="+381" value="<?php echo $Telefon; ?>" required>
    <span class="ValidationMessage" id = "TelefonMessage"></span>
</div>   

<div class="input-container">
    <label for="DatumRodjenja">Датум рођења:<span aria-label="required">*</span></label>
    <input type="date" name="DatumRodjenja"value="<?php echo $DatumRodjenja; ?>" required>
    <span class="ValidationMessage" id = "DatumRodjenjaMessage"></span>
</div>   

<div class="input-container">
    <label for="Drzavljanstvo">Држављанство</label>
    <input type="text" name="Drzavljanstvo" placeholder="Srpsko" value="<?php echo $Drzavljanstvo; ?>" >
    <span class="ValidationMessage" id="Drzavljanstvo"></span>
</div> 

<div class="input-container">
    <fieldset>
		<legend>Пол:</legend>
        <?php
            $Musko =" ";
            $Zensko=" ";
            $Drugo=" ";
           if($Pol == "Мушко"){
            $Musko="checked";
           }
           else if($Pol == "Женско"){
            $Zensko="checked";
           }
           else if($Pol == "Друго"){
            $Drugo="checked";
           }

           echo '<div>';
		   echo '<input type="radio"  name=\"Pol" value="Musko"';echo "$Musko>";
		   echo '<label>Мушко</label>';
		   echo '</div>';
		
		   echo '<div>';
		   echo '<input type="radio"  name="Pol" value="Zensko"';echo "$Zensko>";
	       echo'<label>Женско</label>';
		   echo'</div>';

           echo'<div>';
		   echo'<input type="radio"  name="Pol" value="Drugo"';  echo "$Drugo>";
		   echo'<label>Друго</label>';
		echo'</div>';
        ?>
	</fieldset>
</div>

<div class="input-container">
    <label for="Adresa">Адреса</label>
    <input type="text" name="Adresa" placeholder="" value="<?php echo  $Adresa; ?>" required>
    <span class="ValidationMessage" id = "Adresa"></span>
</div>

<div id="save-btn">
    <button type="submit" id="Enter" class="save-btn" name="btnSnimiVozilo" value="Сними">Сними</button>
</div>
</div>
</form>