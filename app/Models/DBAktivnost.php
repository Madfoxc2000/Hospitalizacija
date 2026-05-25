<?php
class Aktivnost extends Tabela 
{
public function DodajNovuAktivnost($IdPrijem,$TipAktivnosti,$DatumIzvrsenja,$Opis)
{
//Unosi vrednosti u entitet hospitalizacija
    $SQL = "INSERT INTO `aktivnosthospitalizacije` (PrijemID,TipAktivnostiID,Datum,Opis) VALUES ('$IdPrijem', '$TipAktivnosti', '$DatumIzvrsenja', '$Opis')";
   $greska=$this->IzvrsiAktivanSQLUpit($SQL);
   
    return $greska;
}

public function DajKolekcijuSvihAktivnosti()
{
	$SQL = "select * from aktivnosthospitalizacije";
	$this->UcitajSvePoUpitu($SQL);
	return $this->Kolekcija;
}


public function DajUkupanBrojSvihAktivnosti($KolekcijaZapisa)
{
return $this->BrojZapisa;
}

public function DajSveAktivnostiPrijema($IdPrijem)  {

    $SQL = "select * from aktivnosthospitalizacije where PrijemID='$IdPrijem'";
    $this->UcitajSvePoUpitu($SQL);
    return $this->Kolekcija;
}


public function ObrisiAktivnost($IdZaBrisanje)
{
//Brise vrednost iz entiteta hospitalizacija na mestu gde se nalazi zadati ID
    $SQL = "DELETE  FROM `aktivnosthospitalizacije` where ID='$IdZaBrisanje'";
    $greska=$this->IzvrsiAktivanSQLUpit($SQL);
    return $greska;
}

}
?>