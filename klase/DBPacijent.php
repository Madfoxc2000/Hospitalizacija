<?php
class Pacijent extends Tabela{
//  Služi da omogući funkcije za unos i čitanje podataka iz tabele pacijent.
// ATRIBUTI
private $bazapodataka;
private $UspehKonekcijeNaDBMS;
//
// ATRIBUTI

private $BrojIstorijeBolesti;
private $JMBG;
private $ImeJednogRoditelja;
private $LBO;
private $OsnovOsiguranja;
private $ClanJePorodice;
private $Ime;
private $Prezime;
private $Telefon; 
private $DatumRodjenja; 
private $Odeljenje;
// metode

// ------- konstruktor - uzima se iz klase roditelja - Tabela

// ------- preostale metode

public function DajKolekcijuSvihPacijenata()
{
//Ucitava sve vrednosti iz eniteta pacijent
		$SQL = "select * from Pacijent";
		$this->UcitajSvePoUpitu($SQL);
		return $this->Kolekcija;
} // kraj metode

public function UcitajSveBrojeveBolesti()
{
//Ucitava sve vrednosti iz eniteta pacijent
		$SQL = "select BrojIstorijebolesti from Pacijent";
	    $this->UcitajSvePoUpitu($SQL);
		return $this->Kolekcija;
} // kraj metode
public function UcitajSveIdPacijenataPrijema()
{
//Ucitava sve vrednosti iz eniteta pacijent
		$SQL = "select BrojIstorijebolesti from prijem";
		$this->UcitajSvePoUpitu($SQL);
		return $this->Kolekcija;
} // kraj metode


public function DaLiPostojiPacijent($BrojIstorijeBolesti)
{
//Proverava da li postoji zapis u bazi u entitetu pacijent za zeljeni username i password	
	$postoji="";
	$SQLPacijent = "SELECT * FROM `".$this->OtvorenaKonekcija->KompletanNazivBazePodataka."`.`PACIJENT` WHERE BROJISTORIJEBOLESTI='$BrojIstorijeBolesti'";
    $this->UcitajSvePoUpitu($SQLPacijent);
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

public function DajDatumRodjenja($BrojIstorijeBolesti)
{
	//Vraca datum rodjenja kojeg cita iz entiteta pacijent za zeljeni Broj istorije bolesti 
	$SQLPacijent = "SELECT * FROM `".$this->OtvorenaKonekcija->KompletanNazivBazePodataka."`.`PACIJENT` WHERE BROJISTORIJEBOLESTI='$BrojIstorijeBolesti'";
    $this->UcitajSvePoUpitu($SQLPacijent);
	$this->PrebaciKolekcijuUListu($this->Kolekcija);
	if ($this->BrojZapisa>0)
	{
		// postoji zapis
		foreach ($this->ListaZapisa as $VrednostCvoraListe)
		{
			$DatumRodjenja=$VrednostCvoraListe[9];
			
		}
	}  			
	else 
	{
		$DatumRodjenja='Nema zapisa';
	}
	return $DatumRodjenja;
}

public function DajUkupanBrojPacijenata($KolekcijaZapisa)
{
	//Vraca ukupan broj zapisa u kolekciji za entitet pacijent
return $this->BrojZapisa;
}


 public function DodajNovogPacijenta($BrojIstorijeBolesti, $JMBG, $ImeJednogRoditelja, $LBO, $OsnovOsiguranja, $ClanJePorodice, $Ime, $Prezime, $Telefon, $DatumRodjenja, $Drzavljanstvo, $Pol, $Adresa,$Maloletan)
 {
	//insert upitom dodaje novog pacijenta
 	$SQL = "INSERT INTO `pacijent` (BrojIstorijeBolesti, JMBG, ImeJednogRoditelja,LBO, OsnovOsiguranja, ClanJePorodice, Ime, Prezime, Telefon, DatumRodjenja, Drzavljanstvo, Pol, Adresa, Maloletan) VALUES ('$BrojIstorijeBolesti', '$JMBG', '$ImeJednogRoditelja', '$LBO', '$OsnovOsiguranja', '$ClanJePorodice', '$Ime', '$Prezime', '$Telefon', '$DatumRodjenja','$Drzavljanstvo', '$Pol', '$Adresa','$Maloletan')";
	$greska=$this->IzvrsiAktivanSQLUpit($SQL);
	
 	return $greska;
 }

 public function ObrisiPacijenta($IdZaBrisanje)
 {
//Brise vrednost iz entiteta hospitalizacija na mestu gde se nalazi zadati ID
 	$SQL = "DELETE FROM `pacijent` where BROJISTORIJEBOLESTI='$IdZaBrisanje'" ;
 	$greska=$this->IzvrsiAktivanSQLUpit($SQL);
 	return $greska;
 }

public function IzmeniPacijenta($BrojIstorijeBolesti, $JMBG, $ImeJednogRoditelja, $LBO, $OsnovOsiguranja, $ClanJePorodice, $Ime, $Prezime, $Telefon, $DatumRodjenja, $Drzavljanstvo, $Pol, $Adresa, $Maloletan)
{
//Menja vrednosti u entitetu hospitalizacija na mestu gde se nalazi zadati ID
	$SQL = "UPDATE `pacijent` SET  BrojIstorijeBolesti='".$BrojIstorijeBolesti."',JMBG='".$JMBG."', ImeJednogRoditelja='".$ImeJednogRoditelja."', LBO='".$LBO."',OsnovOsiguranja='".$OsnovOsiguranja."',ClanJePorodice='".$ClanJePorodice."',Ime='".$Ime."',Prezime='".$Prezime."',Telefon='".$Telefon."',DatumRodjenja='".$DatumRodjenja."',Drzavljanstvo='".$Drzavljanstvo."',Pol='".$Pol."',Adresa='".$Adresa."',Maloletan='".$Maloletan."' WHERE BrojIstorijeBolesti='$BrojIstorijeBolesti'";
	$greska=$this->IzvrsiAktivanSQLUpit($SQL);
	
	return $greska;
}


public function DajKolekcijuPacijenataFiltrirano($filterPolje, $filterVrednost, $nacinFiltriranja, $Sortiranje)
//Vraca filtriranu kolekciju svih vrednosti iz entiteta hospitalizacija
{
if ($nacinFiltriranja=="like")
{
$SQL = "select * from `pacijent` WHERE $filterPolje like '%".$filterVrednost."%' ORDER BY $Sortiranje";
}
else
{
$SQL = "select * from `pacijent` WHERE $filterPolje ='".$filterVrednost."' ORDER BY $Sortiranje";
}
$this->UcitajSvePoUpitu($SQL);
return $this->Kolekcija; // uzima iz baznek klase vrednost atributa
}

}
?>