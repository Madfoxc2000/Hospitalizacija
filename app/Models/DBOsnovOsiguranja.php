<?php 
class OsnovOsiguranja extends Tabela {
    public function DajKolekcijuSvihOsnovaOsiguranja()
{
	$SQL = "select * from osnov_osiguranja";
	$this->UcitajSvePoUpitu($SQL);
	return $this->Kolekcija;
}


public function DajUkupanBrojSvihOsnovaOsiguranja($KolekcijaZapisa)
{
return $this->BrojZapisa;
}
}

?>