
<meta charset="UTF-8">
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>
<img src="images/sredinagore.jpg" width="100%" height="3" alt="" class="flt1 rp_topcornn" /> 

<table style="width:100%;style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0"  bgcolor="#D8E7F4">
<tr>
<td style="width:5%;">
</td>

<td align="left">
<br/>
<b><font face="Trebuchet MS" color="darkblue" size="4px">  </font></b>
<table style="width:100%;" bgcolor="#D8E7F4" padding:0" align="center" cellspacing="0" cellpadding="0" border="0">

<tr>
<td style="width:3%;">
</td>
<td align="center">
<font color="#D8E7F4" size="1px">.</font>
</td>
<td style="width:3%;">
</td>
</tr>

<tr>
<td style="width:3%;">
</td>
<td align="center">
<b><font face="Trebuchet MS" color="darkblue" size="3px">Унос хоспитализациј</font></b></br>
</td>
<td style="width:3%;">
</td>
</tr>

<tr>
<td style="width:3%;">
</td>
<td align="center">
<font color="#D8E7F4" size="1px">.</font>
</td>
<td style="width:3%;">
</td>
</tr>

<tr>
<td style="width:3%;">
</td>

<td align="center">


<!------------------------FORMA ZA UNOS ------->
<table style="width:90%;" bgcolor="#D8E7F4" padding:0" align="center" cellspacing="0" cellpadding="0" border="0">
<form ACTION="./Logicki/AkcijaSnimi.php" METHOD="POST">

<tr>
<td align="right" valign="top">
<b><font face="Trebuchet MS" color="darkblue" size="2px">Број историје болести:&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="top">
<input name="BrojIstorijeBolesti" type="text" size="40" required />
<!-- Prosledjuemo promenljivu BrojIstorijeBolesti kroz metodu POST akciji AkcijaSnimi-->
</td>
</tr>

<tr>
<td align="right" valign="top">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="top">
</td>
</tr>

<tr>
<td align="right" valign="top">
<b><font face="Trebuchet MS" color="darkblue" size="2px">Назив здравствене установе:&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="top">
<input name="NazivZdravstveneUstanove" type="text" size="40" required />
</td>
</tr>

<tr>
<td align="right" valign="top">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="top">
</td>
</tr>

<tr>
<td align="right" valign="top">
<b><font face="Trebuchet MS" color="darkblue" size="2px">Одељење на пријему:&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="top">
<input name="OdeljenjeNaPrijemu" type="text" size="40" required />
</td>
</tr>

<tr>
<td align="right" valign="top">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="top">
</td>
</tr>
<tr>

<td align="right" valign="top">
<b><font face="Trebuchet MS" color="darkblue" size="2px">Датум пријема:&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="top">
<input name="DatumPrijema" type="text" size="40" required />
</td>
</tr>

<tr>
<td align="right" valign="top">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="top">
</td>
</tr>
<tr>

<tr>
<td align="right" valign="top">
<b><font face="Trebuchet MS" color="darkblue" size="2px">Упутна дијагноза:&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="top">
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
</td>
</tr>
<tr>
<td align="right" valign="top">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="top">
</td>
</tr>

<tr>
<td align="right" valign="top">
<b><font face="Trebuchet MS" color="darkblue" size="2px">Повреда:&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="top">
<input name="Povreda" type="text" size="40" required />
</td>
</tr>

<tr>
<td align="right" valign="top">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="top">
</td>
</tr>

<tr>
<td align="right" valign="top">
<b><font face="Trebuchet MS" color="darkblue" size="2px">Спољни узрок повреде:&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="top">
<input name="SpoljniUzrokPovrede" type="text" size="40"  />
</td>
</tr>

<tr>
<td align="right" valign="top">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="top">
</td>
</tr>

<tr>
<td align="right" valign="top">
<b><font face="Trebuchet MS" color="darkblue" size="2px">Основни узрок хоспитализација:&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="top">
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
</td>
</tr>

<tr>
<td align="right" valign="top">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="top">
</td>
</tr>

<tr>
<td align="right" valign="top">
<b><font face="Trebuchet MS" color="darkblue" size="2px">Пратеће дијагнозе:&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="top">
<input name="PrateceDijagnoze" type="text" size="40" />
</td>
</tr>

<tr>
<td align="right" valign="top">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="top">
</td>
</tr>

<tr>
<td align="right" valign="top">
<b><font face="Trebuchet MS" color="darkblue" size="2px">Шифра процедуре по номенклатури:&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="top">
<input name="SifraProcedurePoNomenklaturi" type="text" size="40" required />
</td>
</tr>

<tr>
<td align="right" valign="top">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="top">
</td>
</tr>

<tr>
<td align="right" valign="top">
<b><font face="Trebuchet MS" color="darkblue" size="2px">Тежина на пријему:&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="top">
<input name="TezinaNaPrijemu" type="text" size="40" />
</td>
</tr>

<tr>
<td align="right" valign="top">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="top">
</td>
</tr>

<tr>
<td align="right" valign="top">
<b><font face="Trebuchet MS" color="darkblue" size="2px">Број сати вентилаторне подршке:&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="top">
<input name="BrojSatiVentilatornePodrske" type="text" size="40"/>
</td>
</tr>

<tr>
<td align="right" valign="top">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="top">
</td>
</tr>

<tr>
<td align="right" valign="top">
<b><font face="Trebuchet MS" color="darkblue" size="2px">Датум отпуста:&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="top">
<input name="DatumOtpusta" type="text" size="40" required />
</td>
</tr>

<tr>
<td align="right" valign="top">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="top">
</td>
</tr>

<tr>
<td align="right" valign="top">
<b><font face="Trebuchet MS" color="darkblue" size="2px">Број дана хоспитализације:&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="top">
<input name="BrojDanaHospitalizacije" type="text" size="40" required />
</td>
</tr>

<tr>
<td align="right" valign="top">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="top">
</td>
</tr>

<tr>
<td align="right" valign="top">
<b><font face="Trebuchet MS" color="darkblue" size="2px">Одељење са којег је отпуст извршен:&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="top">
<input name="OdeljenjeSaKojegJeOtpustIzvrsen" type="text" size="40" required />
</td>
</tr>

<tr>
<td align="right" valign="top">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="top">
</td>
</tr>

<tr>
<td align="right" valign="top">
<b><font face="Trebuchet MS" color="darkblue" size="2px">Врсте отпуста:&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="top">
<input name="VrstaOtpusta" type="text" size="40" required />
</td>
</tr>

<tr>
<td align="right" valign="top">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="top">
</td>
</tr>

<tr>
<td align="right" valign="top">
<b><font face="Trebuchet MS" color="darkblue" size="2px">Обдукован:&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="top">
<input name="Obdukovan" type="text" size="40" />
</td>
</tr>

<tr>
<td align="right" valign="top">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="top">
</td>
</tr>

<tr>
<td align="right" valign="top">
<b><font face="Trebuchet MS" color="darkblue" size="2px">Основни узрок смрти:&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="top">
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
</td>
</tr>

<!-------------------------- prazan red ------->
<tr>
<td align="right" valign="top">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<td align="left" valign="top">
<font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
</td>
<tr>

<td>       
</td>
<td><input TYPE="submit" name="btnSnimiVozilo" value="Сними" TABINDEX=3/>
</td>
</form>
</table>

</td>
<td style="width:3%;">
</td>
</tr>

<tr>
<td style="width:3%;">
</td>
<td align="center">
<font color="#D8E7F4" size="1px">.</font>
</td>
<td style="width:3%;">
</td>
</tr>
</table>
</td>

<td style="width:5%;">
</td>

</tr>
</table>
<img src="images/sredinadole.jpg" width="100%" height="5" alt="" class="flt1" /> 
    