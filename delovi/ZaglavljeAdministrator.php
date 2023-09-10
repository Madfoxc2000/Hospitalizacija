
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
<nav class="nav-bar-administrator">
        <div class="logo"><h3>Корисник: <b><?php echo $korisnik ;?></b></h3></div>
    <div class="menu">
                <!-- <img src="images/addPatient.png" id="U" onclick="window.location.href='PacijentUnos.php';" alt="Hospitalizacije"> -->
                
                <picture onclick="window.location.href='PacijentUnos.php';">
                <source media="(max-width: 799px)" srcset="images/addPatientS.png"   />
                <source media="(min-width: 800px)" srcset="images/addPatient.png"  />
                <img src="images/addPatient.png" alt="AddPatient" />
                </picture>


                <div class="dropdown">
                    <picture id="M" >
                    <source media="(max-width: 799px)" srcset="images/folderPacijentiS.png"   />
                    <source media="(min-width: 800px)" srcset="images/folderPacijenti.png"  />
                    <img src="images/folderPacijenti.png" alt="ManagePatients">
                    </picture>
                    <div class="dropdown-content">
                    <span class="material-symbols-outlined nav"  onclick="window.location.href='PrimljeniPacijentiLista.php';">badge</span>
                    <span class="material-symbols-outlined nav" onclick="window.location.href='PacijentLista.php';">folder_shared</span>
                    </div>
                </div>

                <picture onclick="window.location.href='HospitalizacijaListaFilter.php';">
                <source media="(max-width: 799px)" srcset="images/hospitalizacijeListaS.png"   />
                <source media="(min-width: 800px)" srcset="images/hospitalizacijeLista.png"  />
                <img src="images/hospitalizacijeLista.png" alt="HospitalizationList">
                </picture>
    
    </div>
    <div class="log-out"> <picture id="M" onclick="window.location.href='index.php';">
                <source media="(max-width: 799px)" srcset="images/logoutS.png"   />
                <source media="(min-width: 800px)" srcset="images/logout.png"  />
                <img src="images/logout.png" alt="LogOut" />
                </picture></div>
    
</nav>

        <!-- <li><a class="myButton" href="Stampa.php" >Штампа</a></li> -->
        <!-- <li><a class="myButton" href="index.php" >Одјава</a></li> -->
        <!-- <li><span class="material-symbols-outlined nav" onclick="window.location.href='HospitalizacijaListaFilter.php';">clinical_notes</span></li> -->
        <!-- <li><span class="material-symbols-outlined nav" onclick="window.location.href='PacijentUnos.php';">person_add</span></li> -->
        <!--<li><span class="material-symbols-outlined nav" onclick="window.location.href='index.php';">logout</span></li> -->