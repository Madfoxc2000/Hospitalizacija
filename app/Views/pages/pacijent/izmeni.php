<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="sr-RS" xml:lang="sr-RS">
<meta charset="UTF-8">
<head>
<title>Болница</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<link rel="stylesheet" href="css/administrator.css">
<script src="JS/script.js" async></script>
<script src="JS/IzmeniPacijenta.js" defer></script>
</head>
<body>
<div class="main-administrator">
    <?php include APP_DIR . '/Views/layouts/nav-administrator.php'; ?>
    <div><?php include APP_DIR . '/Views/pacijent/izmeni.php'; ?></div>
    <?php include APP_DIR . '/Views/layouts/footer.php'; ?>
</div>
</body>
</html>
