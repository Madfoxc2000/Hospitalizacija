<?php
class TipAktivnosti extends Tabela{

    
    public function DajKolekcijuSvihTipovaAktivnosti()
    {
        $SQL = "select * from tipaktivnosti";
        $this->UcitajSvePoUpitu($SQL);
        return $this->Kolekcija;
    }
    
    
    public function DajUkupanBrojSvihTipovaAktivnosti($KolekcijaZapisa)
    {
    return $this->BrojZapisa;
    }

}
?>