<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="sr-RS" xml:lang="sr-RS">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Болница Зрењанин</title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
</head>
<body>
<table class="no-spacing" style="width:100%;" cellspacing="0" cellpadding="0" border="0">
    <?php include APP_DIR . '/Views/layouts/nav-stampa.php'; ?>
    <tr>
        <td style="width:10%;"></td>
        <td style="width:80%; padding:0; vertical-align:top;">
            <?php include APP_DIR . '/Views/hospitalizacija/stampa.php'; ?>
        </td>
        <td style="width:10%;"></td>
    </tr>
    <tr>
        <td style="width:10%;"></td>
        <td></td>
        <td style="width:10%;"></td>
    </tr>
    <?php include APP_DIR . '/Views/layouts/footer-stampa.php'; ?>
</table>
</body>
</html>
