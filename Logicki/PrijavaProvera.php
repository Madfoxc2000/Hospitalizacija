<?php
//Proverava unete kredencijale za korisnika koji pokusa da se uloguje.
//Saradjuje sa klasama Konekcija, Tabela, Korisnik
session_start();
       $loginUserName=$_POST['korisnickoIme'];
       $loginPassword=$_POST['sifra'];

	// zato sto se prilikom require uradi copy paste u ovaj fajl, 
// onda se putanja do parametra gleda u odnosu na lokaciju ovog fajla 
	require dirname(__DIR__)."/klase/BaznaKonekcija.php";
	require dirname(__DIR__)."/klase/BaznaTabela.php";
	require dirname(__DIR__)."/klase/DBKorisnik.php";

$korisnik='NEPOZNAT KORISNIK';
$xml=dirname(__DIR__)."/klase/BaznaParametriKonekcije.xml";
$KonekcijaObject = new Konekcija($xml);
$KonekcijaObject->connect();
if ($KonekcijaObject->konekcijaDB)
    {	
		$objKorisnik = new Korisnik($KonekcijaObject, 'KORISNIK');
		$postojiKorisnik=$objKorisnik->DaLiPostojiKorisnik($loginUserName,$loginPassword);
		$ulogaKorisnik=$objKorisnik->DajUloguPrijavljenogKorisnika($loginUserName,$loginPassword);
		if ($postojiKorisnik=="DA")
		{ 
			// rad sa sesijama
			$_SESSION["prez"] = $objKorisnik->DajPrezimePrijavljenogKorisnika($loginUserName,$loginPassword);
			$_SESSION["ime"] = $objKorisnik->DajImePrijavljenogKorisnika($loginUserName,$loginPassword);
			$_SESSION["idkorisnika"] = $objKorisnik->DajIDPrijavljenogKorisnika($loginUserName,$loginPassword);
			$_SESSION["korisnik"] = $objKorisnik->DajImePrezimePrijavljenogKorisnika($loginUserName,$loginPassword);
			// ucitavanje pocetne personalizovane stranice
			if($ulogaKorisnik=='Администратор'){
			header ('Location:http://localhost/Hospitalizacija/WelcomeAdministrator.php');	
			}
			else{
				header ('Location:http://localhost/Hospitalizacija/WelcomeKorisnik.php');	
			}
		}
		else
		{ 
			$_SESSION['login_error'] = "Invalid username or password";
			// neuspeh izaziva ponovo ucitavanje stranice za prijavu
			 header ('Location:http://localhost/Hospitalizacija/Prijava.php');	
		}
	}
	else
	{
		echo "Neuspeh konekcije na bazu podataka!";
	}
	
?>
