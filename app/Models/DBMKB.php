<?php
class MKB extends Tabela{
    //Klasa “MKB” omogućava funkcije za iščitavanje vrednosti MKB šifri koje se koriste u comobox-evima.
    // ATRIBUTI
    private $bazapodataka;
    private $UspehKonekcijeNaDBMS;
    //
    private $Sifra;
    private $Naziv;

    public function DajKolekcijuSvihSifri()
    {
        $SQL = "select * from mkb";
	     $this->UcitajSvePoUpitu($SQL);
        return $this->Kolekcija;
    }


    public function DajUkupanBrojSvihSifri($KolekcijaZapisa)
    {
    return $this->BrojZapisa;
    }



}


?>  