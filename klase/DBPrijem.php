<?php
class Prijem extends Tabela{
    public function DodajNoviPrijem($idPacijenta,$Odeljenje,$TezinaNaPrijemu,$DatumPrijema,$Povreda,$SpoljniUzrokPovrede,$UputnaDijagnoza)
    {
        if (empty($SpoljniUzrokPovrede)){
        $SQL = "INSERT INTO `prijem` (BrojIstorijeBolesti,OdeljenjeNaPrijemu,UputnaDijagnoza,TezinaNaprijemu,DatumPrijema,Povreda) VALUES ('$idPacijenta','$Odeljenje','$UputnaDijagnoza','$TezinaNaPrijemu','$DatumPrijema','$Povreda')";
        }
    //Unosi vrednosti u entitet prijem
        else{
        $SQL = "INSERT INTO `prijem` (BrojIstorijeBolesti,OdeljenjeNaPrijemu,UputnaDijagnoza,TezinaNaprijemu,DatumPrijema,Povreda,SpoljniUzrokPovrede) VALUES ('$idPacijenta','$Odeljenje','$UputnaDijagnoza','$TezinaNaPrijemu','$DatumPrijema','$Povreda','$SpoljniUzrokPovrede')";
            }
        $greska=$this->IzvrsiAktivanSQLUpit($SQL);
       
        return $greska;
    }
    
    public function DajKolekcijuAktivnihPrijema()
    //Vraca filtriranu kolekciju svih prijema koji nisu arhivirani
    {

    $SQL = "select * from `prijem` WHERE `Arhiviran` is NULL ORDER BY `DatumPrijema`";
    
    $this->UcitajSvePoUpitu($SQL);
    return $this->Kolekcija; // uzima iz baznek klase vrednost atributa
    }

    public function DajUkupanBrojSvihPrijema($KolekcijaZapisa)
    {
    //Vraca uukpan broj vrednosti iz entiteta prijem
    return $this->BrojZapisa;
    }

    public function ArhivirajPrijem($ID) {
    $SQL ="UPDATE `prijem` SET Arhiviran = 1 WHERE ID='$ID'";
    $greska=$this->IzvrsiAktivanSQLUpit($SQL);
	return $greska;
    }
    

    public function ObrisiPrijem($IdZaBrisanje)
    {
   //Brise vrednost iz entiteta hospitalizacija na mestu gde se nalazi zadati ID
        $SQL = "DELETE  FROM `prijem` where ID='$IdZaBrisanje'";
        $greska=$this->IzvrsiAktivanSQLUpit($SQL);
        return $greska;
    }

   
    public function DajDatumPrijema($ID)
    //Vraca filtriranu kolekciju svih vrednosti iz entiteta hospitalizacija
    {
    $SQL = "select `datumprijema` from `prijem` WHERE `ID` = '$ID'";    
    $this->UcitajSvePoUpitu($SQL);
	$this->PrebaciKolekcijuUListu($this->Kolekcija);
    if ($this->BrojZapisa>0)
	{
		// postoji zapis
		foreach ($this->ListaZapisa as $VrednostCvoraListe)
		{
			$DatumPrijema=$VrednostCvoraListe[0];
			
		}
	}  			
	else 
	{
		$DatumPrijema='Nema zapisa';
	}
	return $DatumPrijema;
}
// public function DajIDPrijemaHospitalizacije($ID){
// //Vraca datum rodjenja kojeg cita iz entiteta pacijent za zeljeni Broj istorije bolesti 
// $SQLPrijem = "SELECT * FROM `".$this->OtvorenaKonekcija->KompletanNazivBazePodataka."`.`hospitalizacija` WHERE IDPrijema='$ID'";
// $this->UcitajSvePoUpitu($SQLPrijem);
// $this->PrebaciKolekcijuUListu($this->Kolekcija);
// if ($this->BrojZapisa>0)
// {
//     // postoji zapis
//     foreach ($this->ListaZapisa as $VrednostCvoraListe)
//     {
//         $IDPrijema=$VrednostCvoraListe[0];
        
//     }
// }  			
// else 
// {
//     $IDPrijema='Nema zapisa';
// }
// return   $IDPrijema;
// }

public function DajIDPrijemaHospitalizacije($ID){
    //Vraca ID prijema za prosledjeni ID hospitalizacije
    $SQLPrijem = "SELECT * FROM `".$this->OtvorenaKonekcija->KompletanNazivBazePodataka."`.`hospitalizacija` WHERE ID='$ID'";
    $this->UcitajSvePoUpitu($SQLPrijem);
    $this->PrebaciKolekcijuUListu($this->Kolekcija);
    if ($this->BrojZapisa>0)
    {
        // postoji zapis
        foreach ($this->ListaZapisa as $VrednostCvoraListe)
        {
            $IDPrijema=$VrednostCvoraListe[1];
            
        }
    }  			
    else 
    {
        $IDPrijema='Nema zapisa';
    }
    return   $IDPrijema;
    }




public function DajKolekcijuPrijemaFiltrirano($filterPolje, $filterVrednost, $nacinFiltriranja, $Sortiranje)
//Vraca filtriranu kolekciju svih vrednosti iz entiteta hospitalizacija
{
if ($nacinFiltriranja=="like")
{
$SQL = "select * from `prijem` WHERE $filterPolje like '%".$filterVrednost."%' ORDER BY $Sortiranje";
}
else
{
$SQL = "select * from `prijem` WHERE $filterPolje ='".$filterVrednost."' ORDER BY $Sortiranje";
}
$this->UcitajSvePoUpitu($SQL);
return $this->Kolekcija; // uzima iz baznek klase vrednost atributa
}

}
?>