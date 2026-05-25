<?php $korisnik = $_SESSION['korisnik'] ?? ''; ?>
<div class="welcome-message-container">
    <picture class="card-image">
        <source media="(min-width: 601px)" srcset="images/welcome-message-pic.jpg" />
        <source media="(max-width: 600px)" srcset="images/welcome-message-picS.jpg" />
        <img src="images/welcome-message-pic.jpg" alt="Welcome" />
    </picture>
    <div class="card-body"><b><h1>Добродошли, <?php echo htmlspecialchars($korisnik); ?> !</h1></b></div>
</div>
