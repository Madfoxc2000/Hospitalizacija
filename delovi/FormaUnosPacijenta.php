
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
<b><font face="Trebuchet MS" color="darkblue" size="3px">Унос пацијента</font></b></br>
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
    
    <form ACTION="Logicki/AkcijaSnimiPacijenta.php" METHOD="POST">
    
    <tr>
    <td align="right" valign="top">
    <b><font face="Trebuchet MS" color="darkblue" size="2px">Број историје болести:&nbsp;&nbsp;</font><br/></b>
    </td>
    <td align="left" valign="top">
    <input name="BrojIstorijeBolesti" type="text" size="40" required />
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
    <b><font face="Trebuchet MS" color="darkblue" size="2px">ЈМБГ:&nbsp;&nbsp;</font><br/></b>
    </td>
    <td align="left" valign="top">
    <input name="JMBG" type="text" size="40" required />
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
    <b><font face="Trebuchet MS" color="darkblue" size="2px">Име једног родитеља:&nbsp;&nbsp;</font><br/></b>
    </td>
    <td align="left" valign="top">
    <input name="ImeJednogRoditelja" type="text" size="40" required />
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
    <b><font face="Trebuchet MS" color="darkblue" size="2px">ЛБО:&nbsp;&nbsp;</font><br/></b>
    </td>
    <td align="left" valign="top">
    <input name="LBO" type="text" size="40" required />
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
    <b><font face="Trebuchet MS" color="darkblue" size="2px">Основ осигурања:&nbsp;&nbsp;</font><br/></b>
    </td>
    <td align="left" valign="top">
    <input name="OsnovOsiguranja" type="text" size="40" required />
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
    <b><font face="Trebuchet MS" color="darkblue" size="2px">Члан је породице:&nbsp;&nbsp;</font><br/></b>
    </td>
    <td align="left" valign="top">
    <input name="ClanJePorodice" type="text" size="40" required />
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
    <b><font face="Trebuchet MS" color="darkblue" size="2px">Име:&nbsp;&nbsp;</font><br/></b>
    </td>
    <td align="left" valign="top">
    <input name="Ime" type="text" size="40" required />
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
    <b><font face="Trebuchet MS" color="darkblue" size="2px">Презиме:&nbsp;&nbsp;</font><br/></b>
    </td>
    <td align="left" valign="top">
    <input name="Prezime" type="text" size="40" required />
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
    <b><font face="Trebuchet MS" color="darkblue" size="2px">Телефон:&nbsp;&nbsp;</font><br/></b>
    </td>
    <td align="left" valign="top">
    <input name="Telefon" type="text" size="40" required />
    </td>
    </tr>

    <tr>
    <td align="left" valign="top">
    <font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
    </td>
    </tr>
    
    <tr>
    <td align="right" valign="top">
    <b><font face="Trebuchet MS" color="darkblue" size="2px">Датум рођења:&nbsp;&nbsp;</font><br/></b>
    </td>
    <td align="left" valign="top">
    <input name="DatumRodjenja" type="text" size="40" required />
    </td>
    </tr>
    <tr>
    <td align="left" valign="top">
    <font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
    </td>
    </tr>
    <tr>
    <td align="right" valign="top">
    <b><font face="Trebuchet MS" color="darkblue" size="2px">Одељење:&nbsp;&nbsp;</font><br/></b>
    </td>
    <td align="left" valign="top">
    <input name="Odeljenje" type="text" size="40" required />
    </td>
    </tr>
    <tr>
    <td align="left" valign="top">
    <font face="Trebuchet MS" color="#D8E7F4" size="2px">.</font><br/>
    </td>
    </tr>
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
            