<?php
$uloga = $_SESSION['uloga'] ?? '';
if ($uloga === 'Администратор') {
    include APP_DIR . '/Views/layouts/nav-administrator.php';
} elseif ($uloga === 'Лекар') {
    include APP_DIR . '/Views/layouts/nav-lekar.php';
} elseif ($uloga === 'Медицинска сестра') {
    include APP_DIR . '/Views/layouts/nav-medicinska-sestra.php';
} else {
    include APP_DIR . '/Views/layouts/nav-korisnik.php';
}
