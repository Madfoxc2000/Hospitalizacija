<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="sr-RS" xml:lang="sr-RS">
<meta charset="UTF-8">
<head>
<title>Болница Зрењанин</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
</head>
<body>
<table class="no-spacing" style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0">
    <?php include APP_DIR . '/Views/layouts/nav-stampa.php'; ?>
    <tr style="padding:0px;">
        <td style="width:10%;"></td>
        <td align="center" valign="middle" style="width:80%; padding:0">
            <table style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF">
                <tr>
                    <td style="width:1%;"></td>
                    <td style="width:80%; padding:0" valign="top">
                        <table style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0" bgcolor="white">
                        <tr><td style="width:5%;"></td><td></td><td style="width:5%;"></td></tr>
                        <tr>
                        <td style="width:5%;"></td>
                        <td align="left">
                        <br/>
                        <font face="Trebuchet MS" color="darkblue" size="4px">
                        <?php if ($ukupanBroj > 0): ?>
                        <table style="width:90%; padding:0" align="center" cellspacing="0" cellpadding="0" border="1" bgcolor="white">
                        <tr>
                            <td style="width:10%;"><font face="Trebuchet MS" size="3px">Број историје болести</font><br/></td>
                            <td style="width:20%;"><b><font face="Trebuchet MS" size="3px">Основни узрок хоспитализације</font><br/></td>
                            <td style="width:50%;"><b><font face="Trebuchet MS" size="3px">Датум пријема</font><br/></td>
                            <td style="width:20%;"><b><font face="Trebuchet MS" size="3px">Датум отпуста</font><br/></td>
                        </tr>
                        <?php foreach ($items as $row): ?>
                        <tr>
                            <td><font face="Trebuchet MS" size="2px"><?= htmlspecialchars($row['brojIstorijeBolesti']) ?></font><br/></td>
                            <td><font face="Trebuchet MS" size="2px"><?= htmlspecialchars($row['osnovniUzrokHospitalizacije']) ?></font><br/></td>
                            <td><font face="Trebuchet MS" size="2px"><?= htmlspecialchars($row['datumPrijema']) ?></font><br/></td>
                            <td><font face="Trebuchet MS" size="2px"><?= htmlspecialchars($row['datumOtpusta']) ?></font><br/></td>
                        </tr>
                        <?php endforeach; ?>
                        </table><br/><br/>
                        <?php else: ?>
                        НЕМА ПОДАТАКА
                        <?php endif; ?>
                        </font>
                        </td>
                        <td style="width:5%;"></td>
                        </tr>
                        </table>
                    </td>
                    <td style="width:1%;"></td>
                </tr>
            </table>
        </td>
        <td style="width:10%;"></td>
    </tr>
    <tr style="padding:0px;">
        <td style="width:10%;"></td>
        <td align="center" valign="middle"></td>
        <td style="width:10%;"></td>
    </tr>
    <?php include APP_DIR . '/Views/layouts/footer-stampa.php'; ?>
</table>
</body>
</html>
