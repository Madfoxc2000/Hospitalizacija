<div class="form-container-tretman">
<h1 class="form-header-hospitalizacija">Унос Активности</h1>
<form name="aktivnosForm" id="aktivnostForm" ACTION="./Logicki/AkcijaSnimiAktivnost.php" METHOD="POST">
<input type="hidden" name="IdPrijema" value="<?php echo $IdPrijema; ?>">
<div class="input-container">
    <label for="TipAktivnosti">Тип Активности<span aria-label="required">*</span></label>
    <select name="TipAktivnosti" >
    <option value="">изаберите</option>
    <?php
    	require dirname(__DIR__)."/klase/BaznaKonekcija.php";
        require dirname(__DIR__)."/klase/BaznaTabela.php";
        $xml=dirname(__DIR__)."/klase/BaznaParametriKonekcije.xml";
        $objKonekcija = new Konekcija($xml);
        $objKonekcija->connect();
	// IZDVAJANJE PODATAKA KORISTECI KLASU mkb
	require "klase/DBTipAktivnosti.php";
	$TipAktivnostiObject = new TipAktivnosti($objKonekcija, 'aktivnost');
	$KolekcijaZapisaAktivnosti =$TipAktivnostiObject->DajKolekcijuSvihTipovaAktivnosti();
	$UkupanBrojZapisaAktivnosti =$TipAktivnostiObject->DajUkupanBrojSvihTipovaAktivnosti($KolekcijaZapisaAktivnosti);	
	// PREDSTAVLJANJE U OPTION KROZ FOR CIKLUS
	if ($UkupanBrojZapisaAktivnosti>0) 
	{					
		for ($RBZapisa = 0; $RBZapisa < $UkupanBrojZapisaAktivnosti; $RBZapisa++) 
			{
				$Sifra=$TipAktivnostiObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaAktivnosti, $RBZapisa, 0);		
				$Naziv=$TipAktivnostiObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaAktivnosti, $RBZapisa, 1);																
				 echo "<option value=\"$Sifra\">$Sifra $Naziv</option>";			
			} //for
										
	} // $num_rowsTipoviVozila
	?>
    </select>
	<span class="TipAktivnostiMessage" id = "TipAktivnostiMessage"></span>
</div>   

<div class="input-container">
    <label for="DatumIzvrsenja">Датум извршења:<span aria-label="required">*</span></label>
    <input type="date" name="DatumIzvrsenja" required>
	<span class="ValidationMessage" id = "DatumIzvrsenjaMessage"></span>
</div>   

<div class="input-container">
    <label for="Opis">Опис<span aria-label="required">*</span></label>
    <textarea name="Opis"  cols="30" rows="4"></textarea>
	<span class="ValidationMessage" id = "OpisMessage"></span>
</div>
<div id="save-btn">
    <button type="submit" id="Enter" class="save-btn" name="btnSnimiVozilo" value="Сними">Сними</button>
</div>
</div>

</form>