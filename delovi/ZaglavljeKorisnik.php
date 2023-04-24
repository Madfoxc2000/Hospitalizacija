<?php
	  if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(session_id() == '') {
    session_start();
}
   
	   // citanje vrednosti iz sesije
	   $korisnik=$_SESSION["korisnik"];
      		
?>
<meta charset="UTF-8">
<style>
.dropbtn {
  background-color:#003366;
  color: white;
  font-size: 18px;
  border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

a {
  color: hotpink;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #D8E7F4;}
</style>
<tr>
<td style="width:10%;">
</td>
<td align="center" valign="middle"> 
<?php include 'delovi/Baner.php';?>
</td>
<td style="width:10%;">
</td>
</tr>

<tr>
<td style="width:10%;">
</td>
<td>
<table style="width:100%;" bgcolor="#003366">
<tr>
<td style="width:1%;">
</td>
<td align="left" valign="middle" style="width:25%;">
<font face="Trebuchet MS" color="white" size="2px">Корисник: <b><?php echo $korisnik ;?></b></font>
</td>
<td style="width:50%;">
</td>
<td align="middle">
<div class="dropdown">
  <div class="dropdown-content">
  </div>
</div>
<font face="Trebuchet MS"  size="4px"><a style="text-decoration:none;" href="Stampa.php">Штампа</a> </font>
<font face="Trebuchet MS"  size="4px"><a style="text-decoration:none;" href="HospitalizacijaListaKorisnik.php">Листа</a> </font>
<font face="Trebuchet MS"  size="4px"><a style="text-decoration:none;" href="index.php">Одјава</a> </font>
</tr>
</table>
</td>
<td style="width:10%;">
</td>
</tr>
