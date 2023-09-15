
<!DOCTYPE html>
<!-- Prikazuje formu za prijavu korisnika. -->
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="sr-RS" xml:lang="sr-RS">
<meta charset="UTF-8">
<head>
<title>Болница</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
<script src="JS/Prijava.js" type="module"></script>
</head>

<body>
<!-------------------------- ZAGLAVLJE ------->
<div class="main-prijava">
        <?php include 'delovi/ZaglavljePrijava.php';?>
   
        <div> <?php include 'delovi/FormaPrijava.php';?></div>
   
        <?php include 'delovi/footer.php';?>
</div>

<script> function updateKorisnickoMessage( message) {
    let KorisnickoMessage = document.getElementById("KorisnickoMessage");
    KorisnickoMessage.textContent = message;
}
</script>

<?php
session_start();

        if (isset($_SESSION['login_error'])) {
            // Display an alert with the error message
            $message = "Унети подаци се не поклапају са регистрованим корисницима";
            echo "<script>updateKorisnickoMessage('$message');</script>";
            // Clear the session variable
            unset($_SESSION['login_error']);
        }
        ?> 

</body>
</html>