<?php
//Prikazuje listu hospitalizacija za administratora.
				// CITANJE VREDNOSTI O KORISNIKU IZ SESIJE
				session_start();
				// kad idemo preko poziva sa URL promenljivom, onda ovako citamo:   
				// citanje vrednosti iz sesije
				 
	   $korisnik=$_SESSION["korisnik"];
	   
	   // ako nije prijavljen korisnik, vraca ga na pocetnu stranicu
	   if (!isset($korisnik))
	   {
		header ('Location:index.php');
	   }
	   
				
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="sr-RS" xml:lang="sr-RS">
<meta charset="UTF-8">
<head>
<title>Болница</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
<script src="script.js" async></script>
</head>
<body>
<!-- 
<table class="no-spacing" style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0" style="border-spacing: 0;"> -->

<!-------------------------- ZAGLAVLJE ------->
<div class="main-administrator">
	<?php include 'delovi/ZaglavljeAdministrator.php';?>
	
	
	<!-------------------------- DONJI DEO  ------->
	<!-- <tr style="padding:0px;">
	<td style="width:10%;">
	</td> -->
	
	<!------------------------------------------------------------------------------------------->
	<!---------------------- SREDINA DONJEG DELA SA SADRZAJEM pocinje ovde ---------------------->
	<!-- <td align="center" valign="middle">
	<table style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0" bgcolor="#003366">
	<tr>
	<td style="width:1%;">
	</td>
	
	
	<td style="width:2%;">
	</td>
	
	<td style="padding:0" cellspacing="0" cellpadding="0" border="0" valign="top"> -->
	
	<!------- GLAVNI SADRZAJ desno ----------->
	<div><?php include 'delovi/TabelaAdministrator.php';?></div>
	<!-- </td>
	
	<td style="width:2%;">
	</td>
	
	</tr>
	</table>
	
	</td> -->
	<!---------------------- SADRZAJ zavrsava ovde ---------------------->
	
	<!-- <td style="width:10%;">
	</td>
	</tr> -->
	<!---------------------- DONJI DEO zavrsava ovde ---------------------->
	
	
	<!-- <tr style="padding:0px;">
	<td style="width:10%;"></td>
	<td align="center" valign="middle"></td>
	<td style="width:10%;"></td>
	</tr> -->
	<!--- DONJI DEO sa donjom ivicom zavrsava ovde  ------->
	<!-- footer panel starts here -->
	<?php include 'delovi/footer.php';?>
</div>
<!-- 
</table> -->

</body>
</html>