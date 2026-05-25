<?php
class SpoljniUzrokPovrede extends Tabela{
    public function DajKolekcijuSvihSpoljnihUzroka()
    {
        $SQL = "select * from spoljasnji_uzrok_povrede";
        $this->UcitajSvePoUpitu($SQL);
        return $this->Kolekcija;
    }
    
    public function DajUkupanBrojSvihSpoljnihUzroka($KolekcijaZapisa)
    {
    return $this->BrojZapisa;
    }
    }
?>