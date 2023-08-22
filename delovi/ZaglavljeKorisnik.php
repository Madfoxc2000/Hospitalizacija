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
<nav class="nav-bar-korisnik">
        <div class="logo"><font color="black" size="2px">Корисник: <b><?php echo $korisnik ;?></b></font></div>
    <ul class="menu">
        <li><a class="myButton" href="Stampa.php" >Штампа</a></li>
        <li><a class="myButton" href="HospitalizacijaListaKorisnik.php" >Листа</a></li>
        <li><a class="myButton" href="index.php" >Одјава</a></li>
    </ul>
    <div class="mobile-menu-icon">&#9776;</div>
</nav>