<?php
class VrstaOtpusta extends Tabela{
    public function DajKolekcijuSvihOtpusta()
    {
        $SQL = "select * from vrsta_otpusta";
        $this->UcitajSvePoUpitu($SQL);
        return $this->Kolekcija;
    }
    
    
    public function DajUkupanBrojSvihOtpusta($KolekcijaZapisa)
    {
    return $this->BrojZapisa;
    }    
}

?>