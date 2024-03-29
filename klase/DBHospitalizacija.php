<?php
class Hospitalizacija extends Tabela 
{
// ATRIBUTI
private $bazapodataka;
private $UspehKonekcijeNaDBMS;
//

public $OsnovniUzrokHospitalizacije;
public $PrateceDijagnoze;
public $SifraProcedurePoNomenklaturi;
public $BrojSatiVentilatornePodrske;
public $DatumOtpusta;
public $BrojDanaHospitalizacije;
public $OdeljenjeSaKojegJeOtpustIzvrsen;
public $VrstaOtpusta;
public $Obdukovan;
public $OsnovniUzrokSmrti;
public $Maloletan;
public $ID;
// METODE
//konstruktor
//Klasa Hospitalizacija predstavlja deo aplikacije zadužen da obezbedi funkcije za rad sa podacima o hospitalizacijama.
//Nasledjuje klasu tabela 
public function DajKolekcijuSvihHospitalizacija()
{
//Vraca kolekciju svih vrednosti iz entiteta hospitalizacija
$SQL = "select * from `hospitalizacija`";
$this->UcitajSvePoUpitu($SQL); // puni atribut bazne klase Kolekcija
return $this->Kolekcija; // uzima iz baznek klase vrednost atributa
}

public function DajKolekcijuHospitalizacijaFiltrirano($filterPolje, $filterVrednost, $nacinFiltriranja, $Sortiranje){
//Vraca filtriranu kolekciju svih vrednosti iz pogleda hospitalizacijaradnipogled
$SQL ="SELECT * FROM `hospitalizacijaradnipogled` WHERE $filterPolje ='".$filterVrednost."' ORDER BY $Sortiranje";
$this->UcitajSvePoUpitu($SQL);
return $this->Kolekcija; // uzima iz baznek klase vrednost atributa
}

public function DajKolekcijuHospitalizacijaFiltriranoIzmena($filterPolje, $filterVrednost, $nacinFiltriranja, $Sortiranje){
	//Vraca filtriranu kolekciju svih vrednosti iz pogleda hospitalizacijaradnipogled
	$SQL ="SELECT * FROM `hospitalizacija` WHERE $filterPolje ='".$filterVrednost."' ORDER BY $Sortiranje";
	$this->UcitajSvePoUpitu($SQL);
	return $this->Kolekcija; // uzima iz baznek klase vrednost atributa
}

public function DajPogledHospitalizacija() {
	$SQL ="SELECT * FROM `hospitalizacijapogled`";
	$this->UcitajSvePoUpitu($SQL);
	return $this->Kolekcija;
}
public function DajRadniPogledHospitalizacija() {
	$SQL ="SELECT * FROM `hospitalizacijaradnipogled`";
	$this->UcitajSvePoUpitu($SQL);
	return $this->Kolekcija;
}
public function DajUkupanBrojSvihHospitalizacija($KolekcijaZapisa)
{
//Vraca ukpan broj vrednosti iz entiteta hospitalizacija
return $this->BrojZapisa;
}

public function ObrisiHospitalizaciju($IdZaBrisanje)
 {
//Brise vrednost iz entiteta hospitalizacija na mestu gde se nalazi zadati ID
 	$SQL = "DELETE  FROM `hospitalizacija` where ID='$IdZaBrisanje'" ;
 	$greska=$this->IzvrsiAktivanSQLUpit($SQL);
 	return $greska;
 }

public function IzmeniHospitalizaciju($ID, $OsnovniUzrokHospitalizacije, $PrateceDijagnoze, $BrojSatiVentilatornePodrske, $DatumOtpusta, $BrojDanaHospitalizacije, $OdeljenjeSaKojegJeOtpustIzvrsen, $VrstaOtpusta, $Obdukovan, $OsnovniUzrokSmrti)
{
//Menja vrednosti u entitetu hospitalizacija na mestu gde se nalazi zadati ID
if ($OsnovniUzrokSmrti == "") {
    // konstruišite SQL upit sa postavljanjem na NULL
	$SQL = "UPDATE `hospitalizacija` SET OsnovniUzrokHospitalizacije='".$OsnovniUzrokHospitalizacije."',PrateceDijagnoze='".$PrateceDijagnoze."',BrojSatiVentilatornePodrske='".$BrojSatiVentilatornePodrske."',DatumOtpusta='".$DatumOtpusta."',BrojDanaHospitalizacije='".$BrojDanaHospitalizacije."',OdeljenjeSaKojegJeOtpustIzvrsen='".$OdeljenjeSaKojegJeOtpustIzvrsen."',VrstaOtpusta='".$VrstaOtpusta."',Obdukovan='".$Obdukovan."',OsnovniUzrokSmrti= NULL WHERE ID='$ID'";
}else{
	$SQL = "UPDATE `hospitalizacija` SET OsnovniUzrokHospitalizacije='".$OsnovniUzrokHospitalizacije."',PrateceDijagnoze='".$PrateceDijagnoze."',BrojSatiVentilatornePodrske='".$BrojSatiVentilatornePodrske."',DatumOtpusta='".$DatumOtpusta."',BrojDanaHospitalizacije='".$BrojDanaHospitalizacije."',OdeljenjeSaKojegJeOtpustIzvrsen='".$OdeljenjeSaKojegJeOtpustIzvrsen."',VrstaOtpusta='".$VrstaOtpusta."',Obdukovan='".$Obdukovan."',OsnovniUzrokSmrti='".$OsnovniUzrokSmrti."' WHERE ID='$ID'";
}
	$greska=$this->IzvrsiAktivanSQLUpit($SQL);
	
	return $greska;
}
// ostale metode 
}
?>