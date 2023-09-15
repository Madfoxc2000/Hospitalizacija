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
<nav class="nav-bar">
        <div class="logo"><font color="black" size="2px">Корисник: <b><?php echo $korisnik ;?></b></font></div>
    <div class="menu">

         <picture onclick="window.location.href='PacijentListaKorisnik.php';">
                <source media="(max-width: 799px)" srcset="images/personS.png"   />
                <source media="(min-width: 800px)" srcset="images/person.png"  />
                <img src="images/person.png" alt="HospitalizationList">
                </picture>

        <picture onclick="window.location.href='HospitalizacijaListaKorisnik.php';">
                <source media="(max-width: 799px)" srcset="images/hospitalizacijeListaS.png"   />
                <source media="(min-width: 800px)" srcset="images/hospitalizacijeLista.png"  />
                <img src="images/hospitalizacijeLista.png" alt="HospitalizationList">
                </picture>
        
        <div class="log-out">
             <picture id="M" onclick="window.location.href='index.php';">
                <source media="(max-width: 799px)" srcset="images/logoutS.png"   />
                <source media="(min-width: 800px)" srcset="images/logout.png"  />
                <img src="images/logout.png" alt="LogOut" />
                </picture>
        </div>
    </div>
    <div class="mobile-menu-icon">&#9776;</div>
</nav>