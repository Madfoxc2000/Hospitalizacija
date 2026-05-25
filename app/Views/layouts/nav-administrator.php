<?php $korisnik = $_SESSION['korisnik'] ?? ''; ?>
<nav class="nav-bar-administrator">
    <div class="logo"><h3>Корисник: <b><?php echo htmlspecialchars($korisnik); ?></b></h3></div>
    <div class="menu">

        <picture onclick="window.location.href='pacijent-unos';">
            <source media="(max-width: 799px)" srcset="images/addPatientS.png" />
            <source media="(min-width: 800px)" srcset="images/addPatient.png" />
            <img src="images/addPatient.png" alt="AddPatient" />
        </picture>

        <div class="dropdown">
            <picture id="M">
                <source media="(max-width: 799px)" srcset="images/folderPacijentiS.png" />
                <source media="(min-width: 800px)" srcset="images/folderPacijenti.png" />
                <img src="images/folderPacijenti.png" alt="ManagePatients">
            </picture>
            <div class="dropdown-content">
                <span class="material-symbols-outlined nav" onclick="window.location.href='primljeni-pacijenti';">badge</span>
                <span class="material-symbols-outlined nav" onclick="window.location.href='pacijent-lista';">folder_shared</span>
            </div>
        </div>

        <picture onclick="window.location.href='hospitalizacija-lista-filter';">
            <source media="(max-width: 799px)" srcset="images/hospitalizacijeListaS.png" />
            <source media="(min-width: 800px)" srcset="images/hospitalizacijeLista.png" />
            <img src="images/hospitalizacijeLista.png" alt="HospitalizationList">
        </picture>

    </div>
    <div class="log-out">
        <picture id="M" onclick="window.location.href='/Hospitalizacija/';">
            <source media="(max-width: 799px)" srcset="images/logoutS.png" />
            <source media="(min-width: 800px)" srcset="images/logout.png" />
            <img src="images/logout.png" alt="LogOut" />
        </picture>
    </div>
</nav>
