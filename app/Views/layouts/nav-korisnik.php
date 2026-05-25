<?php $korisnik = $_SESSION['korisnik'] ?? ''; ?>
<meta charset="UTF-8">
<nav class="nav-bar">
    <div class="logo"><font color="black" size="2px">Корисник: <b><?php echo htmlspecialchars($korisnik); ?></b></font></div>
    <div class="menu">

        <picture onclick="window.location.href='pacijent-lista-korisnik';">
            <source media="(max-width: 799px)" srcset="images/personS.png" />
            <source media="(min-width: 800px)" srcset="images/person.png" />
            <img src="images/person.png" alt="PatientList">
        </picture>

        <picture onclick="window.location.href='hospitalizacija-lista-korisnik';">
            <source media="(max-width: 799px)" srcset="images/hospitalizacijeListaS.png" />
            <source media="(min-width: 800px)" srcset="images/hospitalizacijeLista.png" />
            <img src="images/hospitalizacijeLista.png" alt="HospitalizationList">
        </picture>

        <div class="log-out">
            <picture id="M" onclick="window.location.href='/Hospitalizacija/';">
                <source media="(max-width: 799px)" srcset="images/logoutS.png" />
                <source media="(min-width: 800px)" srcset="images/logout.png" />
                <img src="images/logout.png" alt="LogOut" />
            </picture>
        </div>
    </div>
    <div class="mobile-menu-icon">&#9776;</div>
</nav>
