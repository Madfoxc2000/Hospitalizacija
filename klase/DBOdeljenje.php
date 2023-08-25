<?php
class Odeljenje extends Tabela{
//Klasa “Odeljenje” omogućava funkciju za inkrement broja pacijenta na odeljenju.
//Nasledjuje klasu Tabela
// ATRIBUTI
private $bazapodataka;
private $UspehKonekcijeNaDBMS;
//
// ATRIBUTI

private $Oznaka;
private $Naziv;
private $BrojPacijenata;

public function InkrementirajBrojPacijenata($ID)
{
    // izdvajanje stare vrednosti broja pacijenata za to odeljenje
	$KriterijumFiltriranja="Oznaka='".$ID."'";
	$StaraVrednostUkBrPacijenata=$this->DajVrednostJednogPoljaPrvogZapisa ('UkupanBrojPacijenata', $KriterijumFiltriranja, 'UkupanBrojPacijenata'); 
	
	// izracunavanje nove vrednosti
	$NovaVrednostUkBrPacijenata=$StaraVrednostUkBrPacijenata + 1;
	
	// izvrsavanje izmene
    $SQL = "UPDATE `".$this->NazivBazePodataka."`.`Odeljenje` SET UkupanBrojPacijenata=".$NovaVrednostUkBrPacijenata." WHERE Oznaka='".$ID."'";
	$greska= $this->IzvrsiAktivanSQLUpit($SQL);

	return $greska;
}
// ------- konstruktor - uzima se iz klase roditelja - Tabela
public function DajKolekcijuSvihOdeljenja()
{
	$SQL = "select * from odeljenje";
	$this->UcitajSvePoUpitu($SQL);
	return $this->Kolekcija;
}


public function DajUkupanBrojSvihOdeljenja($KolekcijaZapisa)
{
return $this->BrojZapisa;
}
}
?>