<?php
//Prikazuje formu za unos pacijenata.
	   session_start();
       // kad idemo preko poziva sa URL promenljivom, onda ovako citamo:
	   //$korisnik=$_GET['korisnik'];
	   
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
<title>Општина Зрењанин</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
<link rel="stylesheet" href="css/administrator.css" media="screen">
<script src="script.js" async></script>
<script src="UnosPacijent.js" async></script>
</head>
<body>


<!-------------------------- ZAGLAVLJE ------->
<div class="main-administrator">
	<?php include 'delovi/ZaglavljeAdministrator.php';?>
	
	<!------- GLAVNI SADRZAJ desno ----------->
	<div><?php include 'delovi/FormaUnosPacijenta.php';?></div>
	
	<!-- footer panel starts here -->
	
	<?php include 'delovi/footer.php';?>
</div>


</body>
</html>