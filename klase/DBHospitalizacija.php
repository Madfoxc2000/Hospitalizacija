<?php
class Hospitalizacija extends Tabela 
{
// ATRIBUTI
private $bazapodataka;
private $UspehKonekcijeNaDBMS;
//
public $BrojIstorijeBolesti;
public $NazivZdravstveneUstanove; 
public $OdeljenjeNaPrijemu;
public $DatumPrijema;
public $UputnaDijagnoza;
public $Povreda;
public $SpoljniUzrokPovrede;
public $OsnovniUzrokHospitalizacije;
public $PrateceDijagnoze;
public $SifraProcedurePoNomenklaturi;
public $TezinaNaPrijemu;
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

public function DajKolekcijuHospitalizacijaFiltrirano($filterPolje, $filterVrednost, $nacinFiltriranja, $Sortiranje)
//Vraca filtriranu kolekciju svih vrednosti iz entiteta hospitalizacija
{
if ($nacinFiltriranja=="like")
{
$SQL = "select * from `hospitalizacija` WHERE $filterPolje like '%".$filterVrednost."%' ORDER BY $Sortiranje";
}
else
{
$SQL = "select * from `hospitalizacija` WHERE $filterPolje ='".$filterVrednost."' ORDER BY $Sortiranje";
}
$this->UcitajSvePoUpitu($SQL);
return $this->Kolekcija; // uzima iz baznek klase vrednost atributa
}


public function DajUkupanBrojSvihHospitalizacija($KolekcijaZapisa)
{
//Vraca ukpan broj vrednosti iz entiteta hospitalizacija
return $this->BrojZapisa;
}

public function DodajNovuHospitalizaciju()
 {
//Unosi vrednosti u entitet hospitalizacija
 	$SQL = "INSERT INTO `hospitalizacija` (BrojIstorijeBolesti, NazivZdravstveneUstanove, OdeljenjeNaPrijemu, DatumPrijema, UputnaDijagnoza, Povreda, SpoljniUzrokPovrede,OsnovniUzrokHospitalizacije, PrateceDijagnoze, SifraProcedurePoNomenklaturi, TezinaNaPrijemu, BrojSatiVentilatornePodrske, DatumOtpusta, BrojDanaHospitalizacije, OdeljenjeSaKojegJeOtpustIzvrsen, VrstaOtpusta, Obdukovan, OsnovniUzrokSmrti, Maloletan) VALUES ('$this->BrojIstorijeBolesti', '$this->NazivZdravstveneUstanove', '$this->OdeljenjeNaPrijemu', '$this->DatumPrijema', '$this->UputnaDijagnoza', '$this->Povreda', '$this->SpoljniUzrokPovrede','$this->OsnovniUzrokHospitalizacije', '$this->PrateceDijagnoze', '$this->SifraProcedurePoNomenklaturi', '$this->TezinaNaPrijemu', '$this->BrojSatiVentilatornePodrske', '$this->DatumOtpusta', '$this->BrojDanaHospitalizacije', '$this->OdeljenjeSaKojegJeOtpustIzvrsen', '$this->VrstaOtpusta', '$this->Obdukovan', '$this->OsnovniUzrokSmrti', '$this->Maloletan')";
	$greska=$this->IzvrsiAktivanSQLUpit($SQL);
	
 	return $greska;
 }

 public function ObrisiHospitalizaciju($IdZaBrisanje)
 {
//Brise vrednost iz entiteta hospitalizacija na mestu gde se nalazi zadati ID
 	$SQL = "DELETE FROM `hospitalizacija` where ID='$IdZaBrisanje'" ;
 	$greska=$this->IzvrsiAktivanSQLUpit($SQL);
 	return $greska;
 }

public function IzmeniHospitalizaciju($ID,$BrojIstorijeBolesti, $NazivZdravstveneUstanove, $OdeljenjeNaPrijemu, $DatumPrijema, $UputnaDijagnoza, $Povreda, $SpoljniUzrokPovrede, $OsnovniUzrokHospitalizacije, $PrateceDijagnoze, $SifraProcedurePoNomenklaturi, $TezinaNaPrijemu, $BrojSatiVentilatornePodrske, $DatumOtpusta, $BrojDanaHospitalizacije, $OdeljenjeSaKojegJeOtpustIzvrsen, $VrstaOtpusta, $Obdukovan, $OsnovniUzrokSmrti)
{
//Menja vrednosti u entitetu hospitalizacija na mestu gde se nalazi zadati ID
	$SQL = "UPDATE `hospitalizacija` SET  BrojIstorijeBolesti='".$BrojIstorijeBolesti."',NazivZdravstveneUstanove='".$NazivZdravstveneUstanove."', OdeljenjeNaPrijemu='".$OdeljenjeNaPrijemu."', DatumPrijema='".$DatumPrijema."',UputnaDijagnoza='".$UputnaDijagnoza."',Povreda='".$Povreda."',SpoljniUzrokPovrede='".$SpoljniUzrokPovrede."',OsnovniUzrokHospitalizacije='".$OsnovniUzrokHospitalizacije."',PrateceDijagnoze='".$PrateceDijagnoze."',SifraProcedurePoNomenklaturi='".$SifraProcedurePoNomenklaturi."',TezinaNaPrijemu='".$TezinaNaPrijemu."',BrojSatiVentilatornePodrske='".$BrojSatiVentilatornePodrske."',DatumOtpusta='".$DatumOtpusta."',BrojDanaHospitalizacije='".$BrojDanaHospitalizacije."',OdeljenjeSaKojegJeOtpustIzvrsen='".$OdeljenjeSaKojegJeOtpustIzvrsen."',VrstaOtpusta='".$VrstaOtpusta."',Obdukovan='".$Obdukovan."',OsnovniUzrokSmrti='".$OsnovniUzrokSmrti."' WHERE ID='$ID'";
	$greska=$this->IzvrsiAktivanSQLUpit($SQL);
	
	return $greska;
}

// ostale metode 




}
?>