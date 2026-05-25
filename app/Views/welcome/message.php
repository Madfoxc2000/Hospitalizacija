<?php $korisnik = $_SESSION['korisnik'] ?? ''; ?>
<div class="d-flex justify-content-center align-items-start pt-3">
    <div class="card border-0 shadow-lg" style="max-width: 800px; width: 100%;">
        <picture>
            <source media="(min-width: 601px)" srcset="images/welcome-message-pic.jpg" />
            <source media="(max-width: 600px)" srcset="images/welcome-message-picS.jpg" />
            <img src="images/welcome-message-pic.jpg" class="card-img" alt="Welcome" style="object-fit:cover; max-height:420px;" />
        </picture>
        <div class="card-img-overlay d-flex align-items-end p-0">
            <div class="w-100 text-center py-3" style="background: rgba(0,0,0,0.6);">
                <h1 class="text-white mb-0">Добродошли, <?php echo htmlspecialchars($korisnik); ?>!</h1>
            </div>
        </div>
    </div>
</div>
