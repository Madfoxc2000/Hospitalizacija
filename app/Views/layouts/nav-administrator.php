<?php $korisnik = $_SESSION['korisnik'] ?? ''; ?>
<nav class="navbar navbar-dark py-0 sticky-top" style="background-color: rgba(66,135,245,0.2); height: 10vh;">
    <div class="container-fluid">
        <span class="navbar-brand mb-0"><h3 class="mb-0">Корисник: <b><?php echo htmlspecialchars($korisnik); ?></b></h3></span>
        <div class="d-flex gap-3 align-items-center">

            <picture style="cursor:pointer;" onclick="window.location.href='pacijent-unos';">
                <source media="(max-width: 799px)" srcset="images/addPatientS.png" />
                <source media="(min-width: 800px)" srcset="images/addPatient.png" />
                <img src="images/addPatient.png" alt="AddPatient" class="rounded nav-icon-hover" />
            </picture>

            <div class="dropdown">
                <picture id="M" style="cursor:pointer;">
                    <source media="(max-width: 799px)" srcset="images/folderPacijentiS.png" />
                    <source media="(min-width: 800px)" srcset="images/folderPacijenti.png" />
                    <img src="images/folderPacijenti.png" alt="ManagePatients">
                </picture>
                <div class="dropdown-content">
                    <span class="material-symbols-outlined nav" onclick="window.location.href='primljeni-pacijenti';">badge</span>
                    <span class="material-symbols-outlined nav" onclick="window.location.href='pacijent-lista';">folder_shared</span>
                </div>
            </div>

            <picture style="cursor:pointer;" onclick="window.location.href='hospitalizacija-lista-filter';">
                <source media="(max-width: 799px)" srcset="images/hospitalizacijeListaS.png" />
                <source media="(min-width: 800px)" srcset="images/hospitalizacijeLista.png" />
                <img src="images/hospitalizacijeLista.png" alt="HospitalizationList" class="rounded nav-icon-hover" />
            </picture>

            <picture style="cursor:pointer;" onclick="window.location.href='/Hospitalizacija/';">
                <source media="(max-width: 799px)" srcset="images/logoutS.png" />
                <source media="(min-width: 800px)" srcset="images/logout.png" />
                <img src="images/logout.png" alt="LogOut" class="rounded nav-icon-hover" />
            </picture>

        </div>
    </div>
</nav>
