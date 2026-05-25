<!DOCTYPE html>
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
<div class="main-prijava">
    <?php include APP_DIR . '/Views/layouts/nav-prijava.php'; ?>
    <div><?php include APP_DIR . '/Views/auth/login.php'; ?></div>
    <?php include APP_DIR . '/Views/layouts/footer.php'; ?>
</div>
</body>
</html>
