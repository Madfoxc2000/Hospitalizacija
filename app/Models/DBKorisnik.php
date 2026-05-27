<?php
class Korisnik extends Tabela {

    private $IDZaposlenia;
    private $Prezime;
    private $Ime;
    private $Uloga;
    private $Email;
    private $Telefon;
    private $Specijalizacija;
    private $KorisnickoIme;
    private $Sifra;
    private $Stari_IDZaposlenia;

    // Keširani red iz DaLiPostojiKorisnik — izbegava ponovni upit za svaki geter
    private $cachedUser = null;

    public function UcitajSveZaposlene()
    {
        $SQL = "SELECT * FROM zaposleni";
        $this->UcitajSvePoUpitu($SQL);
    }

    // Vraća true ako je korisničko ime već zauzeto.
    public function DaLiPostojiKorisnickoIme($username)
    {
        $conn = $this->OtvorenaKonekcija->konekcijaDB;
        $db   = $this->OtvorenaKonekcija->KompletanNazivBazePodataka;
        $stmt = mysqli_prepare($conn, "SELECT IDZaposlenog FROM `{$db}`.`ZAPOSLENI` WHERE KORISNICKOIME = ?");
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $exists = mysqli_stmt_num_rows($stmt) > 0;
        mysqli_stmt_close($stmt);
        return $exists;
    }

    // Vraća sve zaposlene sa datim statusucesca, sortirane po prezimenu.
    public function DajZaposlenePoStatusu($statusucesca)
    {
        $conn = $this->OtvorenaKonekcija->konekcijaDB;
        $db   = $this->OtvorenaKonekcija->KompletanNazivBazePodataka;
        $stmt = mysqli_prepare($conn,
            "SELECT IDZaposlenog, PREZIME, IME, SPECIJALIZACIJA, Telefon, EMAIL, KORISNICKOIME
             FROM `{$db}`.`ZAPOSLENI` WHERE statusucesca = ? ORDER BY PREZIME, IME"
        );
        mysqli_stmt_bind_param($stmt, 's', $statusucesca);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows   = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        mysqli_stmt_close($stmt);
        return $rows;
    }

    // Upisuje novi red zaposlenog. Vraća novi auto-increment ID, ili 0 pri grešci.
    public function RegistrujKorisnika(array $data)
    {
        $conn = $this->OtvorenaKonekcija->konekcijaDB;
        $db   = $this->OtvorenaKonekcija->KompletanNazivBazePodataka;
        $hash = password_hash($data['sifra'], PASSWORD_BCRYPT);
        $stmt = mysqli_prepare($conn,
            "INSERT INTO `{$db}`.`ZAPOSLENI`
             (PREZIME, IME, SPECIJALIZACIJA, Telefon, EMAIL, KORISNICKOIME, SIFRA, URLSLike, statusucesca)
             VALUES (?, ?, ?, ?, ?, ?, ?, NULL, ?)"
        );
        mysqli_stmt_bind_param($stmt, 'ssssssss',
            $data['prezime'],
            $data['ime'],
            $data['specijalizacija'],
            $data['telefon'],
            $data['email'],
            $data['korisnickoIme'],
            $hash,
            $data['statusucesca']
        );
        $ok    = mysqli_stmt_execute($stmt);
        $newId = $ok ? (int)mysqli_insert_id($conn) : 0;
        mysqli_stmt_close($stmt);
        return $newId;
    }

    // Dohvata jedan red po korisničkom imenu koristeći prepared statement. Vraća asocijativni niz ili null.
    private function fetchUserByUsername($username)
    {
        $conn = $this->OtvorenaKonekcija->konekcijaDB;
        $db   = $this->OtvorenaKonekcija->KompletanNazivBazePodataka;
        $stmt = mysqli_prepare($conn, "SELECT * FROM `{$db}`.`ZAPOSLENI` WHERE KORISNICKOIME = ?");
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row    = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $row ?: null;
    }

    // Zamenjuje plaintext SIFRA sa bcrypt hešom u bazi.
    private function rehashPassword($username, $newHash)
    {
        $conn = $this->OtvorenaKonekcija->konekcijaDB;
        $db   = $this->OtvorenaKonekcija->KompletanNazivBazePodataka;
        $stmt = mysqli_prepare($conn, "UPDATE `{$db}`.`ZAPOSLENI` SET SIFRA = ? WHERE KORISNICKOIME = ?");
        mysqli_stmt_bind_param($stmt, 'ss', $newHash, $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    public function DaLiPostojiKorisnik($loginusername, $loginpassword)
    {
        $user = $this->fetchUserByUsername($loginusername);
        if ($user === null) {
            return 'NE';
        }

        $stored = $user['SIFRA'];
        $info   = password_get_info($stored);

        if ($info['algo'] === 0) {
            // Lozinka je još u plaintext formatu — proveriti i transparentno migrirati na bcrypt
            if ($stored !== $loginpassword) {
                return 'NE';
            }
            $newHash = password_hash($loginpassword, PASSWORD_BCRYPT);
            $this->rehashPassword($loginusername, $newHash);
            $user['SIFRA'] = $newHash;
        } elseif (!password_verify($loginpassword, $stored)) {
            return 'NE';
        }

        $this->cachedUser = $user;
        return 'DA';
    }

    public function DajImePrijavljenogKorisnika($loginusername, $loginpassword)
    {
        $user = $this->cachedUser ?? $this->fetchUserByUsername($loginusername);
        return isset($user['IME']) ? $user['IME'] : 'NEPOZNAT Zaposleni';
    }

    public function DajPrezimePrijavljenogKorisnika($loginusername, $loginpassword)
    {
        $user = $this->cachedUser ?? $this->fetchUserByUsername($loginusername);
        return isset($user['PREZIME']) ? $user['PREZIME'] : 'NEPOZNAT Zaposleni';
    }

    public function DajImePrezimePrijavljenogKorisnika($loginusername, $loginpassword)
    {
        $user = $this->cachedUser ?? $this->fetchUserByUsername($loginusername);
        if ($user === null) return 'NEPOZNAT Zaposleni';
        return $user['PREZIME'] . ' ' . $user['IME'];
    }

    public function DajIDPrijavljenogKorisnika($loginusername, $loginpassword)
    {
        $user = $this->cachedUser ?? $this->fetchUserByUsername($loginusername);
        return isset($user['IDZaposlenog']) ? (int)$user['IDZaposlenog'] : 0;
    }

    public function DajUloguPrijavljenogKorisnika($loginusername, $loginpassword)
    {
        // statusucesca čuva 'Администратор' ili 'Корисник' — uloga za kontrolu pristupa
        $user = $this->cachedUser ?? $this->fetchUserByUsername($loginusername);
        return isset($user['statusucesca']) ? $user['statusucesca'] : 'NEPOZNAT Zaposleni';
    }
}
?>
