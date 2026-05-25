<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="sr-RS" xml:lang="sr-RS" data-bs-theme="dark">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Болница</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
<link rel="stylesheet" href="css/filterListaAdministrator.css">
<script src="JS/script.js" async></script>
<script src="JS/PacijentListaKorisnik.js" defer></script>
</head>
<body>
<div class="main-administrator">
    <?php include APP_DIR . '/Views/layouts/nav-korisnik.php'; ?>
    <div><?php include APP_DIR . '/Views/pacijent/lista-korisnik.php'; ?></div>
    <?php include APP_DIR . '/Views/layouts/footer.php'; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
