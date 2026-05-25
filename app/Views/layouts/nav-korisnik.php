<?php $korisnik = $_SESSION['korisnik'] ?? ''; ?>
<nav class="navbar navbar-dark py-0 sticky-top" style="background-color: rgba(66,135,245,0.2); height: 10vh;">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 small">Корисник: <b><?php echo htmlspecialchars($korisnik); ?></b></span>
        <div class="d-flex gap-3 align-items-center">

            <picture style="cursor:pointer;" onclick="window.location.href='pacijent-lista-korisnik';">
                <source media="(max-width: 799px)" srcset="images/personS.png" />
                <source media="(min-width: 800px)" srcset="images/person.png" />
                <img src="images/person.png" alt="PatientList" class="rounded nav-icon-hover" />
            </picture>

            <picture style="cursor:pointer;" onclick="window.location.href='hospitalizacija-lista-korisnik';">
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
