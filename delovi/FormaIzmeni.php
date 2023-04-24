
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
<b><font face="Trebuchet MS" color="darkblue" size="3px">IZMENA HOSPITALIZACIJE</font></b></br>
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
<form ACTION="./Logicki/AkcijaIzmeni.php" METHOD="POST">
<?php echo "<input type=\"hidden\" name=\"IdHospitalizacije\" value=\"$idHospitalizacije\">";
?>
<tr>
<td align="right" valign="top">
<b><font face="Trebuchet MS" color="darkblue" size="2px">Број историје:&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="top">
<input name="BrojIstorijeBolesti" type="text" size="40" required value="<?php echo $BrojIstorijeBolesti; ?>"/>
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
<b><font face="Trebuchet MS" color="darkblue" size="2px">Назив здравствене установе :&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="top">
<input name="NazivZdravstveneUstanove" type="text" size="40" required value="<?php echo $NazivZdravstveneUstanove; ?>"/>
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
<input name="OdeljenjeNaPrijemu" type="text" size="40" required value="<?php echo $OdeljenjeNaPrijemu; ?>" />
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
<input name="DatumPrijema" type="text" size="40" required value="<?php echo $DatumPrijema; ?>"/>
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
<b><font face="Trebuchet MS" color="darkblue" size="2px">Упутна дијагноза:&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="top">
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
<input name="Povreda" type="text" size="40" required value="<?php echo $Povreda; ?>"/>
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
<input name="SpoljniUzrokPovrede" type="text" size="40" value="<?php echo $SpoljniUzrokPovrede; ?>"/>
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
<b><font face="Trebuchet MS" color="darkblue" size="2px">Основни узрок хоспитализације:&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="top">
<input name="OsnovniUzrokHospitalizacije" type="text" size="40" required value="<?php echo $OsnovniUzrokHospitalizacije; ?>"/>
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
<input name="PrateceDijagnoze" type="text" size="40"  value="<?php echo $PrateceDijagnoze; ?>"/>
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
<input name="SifraProcedurePoNomenklaturi" type="text" size="40" required value="<?php echo $SifraProcedurePoNomenklaturi; ?>"/>
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
<input name="TezinaNaPrijemu" type="text" size="40" value="<?php echo $TezinaNaPrijemu; ?>"/>
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
<input name="BrojSatiVentilatornePodrske" type="text" size="40" value="<?php echo $BrojSatiVentilatornePodrske; ?>"/>
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
<input name="DatumOtpusta" type="text" size="40" required value="<?php echo $DatumOtpusta; ?>"/>
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
<input name="BrojDanaHospitalizacije" type="text" size="40" required value="<?php echo $BrojDanaHospitalizacije; ?>"/>
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
<input name="OdeljenjeSaKojegJeOtpustIzvrsen" type="text" size="40" required value="<?php echo $OdeljenjeSaKojegJeOtpustIzvrsen; ?>"/>
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
<b><font face="Trebuchet MS" color="darkblue" size="2px">Врста отпуста:&nbsp;&nbsp;</font><br/></b>
</td>
<td align="left" valign="top">
<input name="VrstaOtpusta" type="text" size="40" required value="<?php echo $VrstaOtpusta; ?>"/>
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
<input name="Obdukovan" type="text" size="40"  value="<?php echo $Obdukovan; ?>"/>
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
<input name="OsnovniUzrokSmrti" type="text" size="40" value="<?php echo $OsnovniUzrokSmrti; ?>"/>
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
<td><input TYPE="submit" name="btnSnimiVozilo" value="Измени" TABINDEX=3/>
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
    