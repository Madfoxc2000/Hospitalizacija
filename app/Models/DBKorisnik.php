<?php
class Korisnik extends Tabela{
//Klasa “Korisnik” služi da pruži funkcije koje omogućavaju manipulaciju podataka o korisnicima.
//Nasledjuje klasu tabela
// ATRIBUTI
private $IDZaposlenia; // auto increment u bazi podataka
private $Prezime;
private $Ime;
private $Uloga;
private $Email;
private $Telefon;
private $Specijalizacija;
private $KorisnickoIme;
private $Sifra;
private $Stari_IDZaposlenia; // potrebno zbog izmene

// metode

// ------- konstruktor - uzima se iz klase roditelja - Tabela

// ------- preostale metode

public function UcitajSveZaposlene()
{
//Ucitava sve vrednosti iz eniteta zaposleni 
		$SQL = "select * from zaposleni";
		$this->UcitajSvePoUpitu($SQL);
} // kraj metode

public function DaLiPostojiKorisnik($loginusername,$loginpassword)
{
//Proverava da li postoji zapis u bazi u entitetu zaposleni za zeljeni username i password
	$postoji="";
	$SQLZaposleni = "SELECT * FROM `".$this->OtvorenaKonekcija->KompletanNazivBazePodataka."`.`ZAPOSLENI` WHERE KORISNICKOIME='".$loginusername."' AND SIFRA='".$loginpassword."'";
    $this->UcitajSvePoUpitu($SQLZaposleni);
	$this->PrebaciKolekcijuUListu($this->Kolekcija);
	if ($this->BrojZapisa>0)
	{
		$postoji="DA";
	}  			
	else 
	{
		$postoji="NE";
	}
	return $postoji;
}

public function DajImePrijavljenogKorisnika($loginusername,$loginpassword)
{
//Vraca ime prijavljenog korisnika koje cita iz entinteta zaposleni za zeljeni username i password 
	$Zaposleni="";
	$SQLZaposleni = "SELECT * FROM `".$this->OtvorenaKonekcija->KompletanNazivBazePodataka."`.`Zaposleni` WHERE KORISNICKOIME='".$loginusername."' AND SIFRA='".$loginpassword."'";
    $this->UcitajSvePoUpitu($SQLZaposleni);
	$this->PrebaciKolekcijuUListu($this->Kolekcija);
	if ($this->BrojZapisa>0)
	{
		// postoji zapis
		foreach ($this->ListaZapisa as $VrednostCvoraListe)
		{
			$ime=$VrednostCvoraListe[2];
			
		}
	}  			
	else 
	{
		$ime='NEPOZNAT Zaposleni';
	}
	return $ime;
}


public function DajUloguPrijavljenogKorisnika($loginusername,$loginpassword)
{
//Vraca ulogu prijavljenog korisnika koje cita iz entinteta zaposleni za zeljeni username i password 
	$Zaposleni="";
	$SQLZaposleni = "SELECT * FROM `".$this->OtvorenaKonekcija->KompletanNazivBazePodataka."`.`Zaposleni` WHERE KORISNICKOIME='".$loginusername."' AND SIFRA='".$loginpassword."'";
    $this->UcitajSvePoUpitu($SQLZaposleni);
	$this->PrebaciKolekcijuUListu($this->Kolekcija);
	if ($this->BrojZapisa>0)
	{
		// postoji zapis
		foreach ($this->ListaZapisa as $VrednostCvoraListe)
		{
			$Uloga=$VrednostCvoraListe[10];
			
		}
	}  			
	else 
	{
		$Uloga='NEPOZNAT Zaposleni';
	}
	return $Uloga;
}

public function DajPrezimePrijavljenogKorisnika($loginusername,$loginpassword)
{
//Vraca ulogu prijavljenog korisnika koje cita iz entinteta zaposleni za zeljeni username i password 
	$Zaposleni="";
	$SQLZaposleni = "SELECT * FROM `".$this->OtvorenaKonekcija->KompletanNazivBazePodataka."`.`Zaposleni` WHERE KORISNICKOIME='".$loginusername."' AND SIFRA='".$loginpassword."'";
    $this->UcitajSvePoUpitu($SQLZaposleni);
	$this->PrebaciKolekcijuUListu($this->Kolekcija);
	if ($this->BrojZapisa>0)
	{
		// postoji zapis
		foreach ($this->ListaZapisa as $VrednostCvoraListe)
		{
			$prez=$VrednostCvoraListe[1];
			
		}
	}  			
	else 
	{
		$prez='NEPOZNAT Zaposleni';
	}
	return $prez;
}

public function DajImePrezimePrijavljenogKorisnika($loginusername,$loginpassword)
{
//Vraca ime i prezime prijavljenog korisnika koje cita iz entinteta zaposleni za zeljeni username i password 
	$Zaposleni="";
	$SQLZaposleni = "SELECT * FROM `".$this->OtvorenaKonekcija->KompletanNazivBazePodataka."`.`Zaposleni` WHERE KORISNICKOIME='".$loginusername."' AND SIFRA='".$loginpassword."'";
    $this->UcitajSvePoUpitu($SQLZaposleni);
	$this->PrebaciKolekcijuUListu($this->Kolekcija);
	if ($this->BrojZapisa>0)
	{
		// postoji zapis
		foreach ($this->ListaZapisa as $VrednostCvoraListe)
		{
			$prez=$VrednostCvoraListe[1];
			$ime=$VrednostCvoraListe[2];
			$Zaposleni=$prez.' '.$ime;
		}
	}  			
	else 
	{
		$Zaposleni='NEPOZNAT Zaposleni';
	}
	return $Zaposleni;
}

public function DajIDPrijavljenogKorisnika($loginusername,$loginpassword)
{
//Vraca ID prijavljenog korisnika koje cita iz entinteta zaposleni za zeljeni username i password 
	$id=0;
	$SQLZaposleni = "SELECT * FROM `".$this->OtvorenaKonekcija->KompletanNazivBazePodataka."`.`Zaposleni` WHERE KORISNICKOIME='".$loginusername."' AND SIFRA='".$loginpassword."'";
    $this->UcitajSvePoUpitu($SQLZaposleni);
	$this->PrebaciKolekcijuUListu($this->Kolekcija);
	if ($this->BrojZapisa>0)
	{
		// postoji zapis
		foreach ($this->ListaZapisa as $VrednostCvoraListe)
		{
			$id=$VrednostCvoraListe[0];
		}
	} 
	// else - ostaje 0

	return $id;
}
} // kraj klase
?>