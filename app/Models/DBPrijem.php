<?php
class Prijem extends Tabela{
    public function DaLiJePacijentAktivnoPrimljen($BrojIstorijeBolesti): bool {
        $conn = $this->OtvorenaKonekcija->konekcijaDB;
        $db   = $this->OtvorenaKonekcija->KompletanNazivBazePodataka;
        $stmt = mysqli_prepare($conn, "SELECT 1 FROM `{$db}`.`prijem` WHERE BrojIstorijeBolesti = ? AND Arhiviran IS NULL LIMIT 1");
        mysqli_stmt_bind_param($stmt, 's', $BrojIstorijeBolesti);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $postoji = mysqli_stmt_num_rows($stmt) > 0;
        mysqli_stmt_close($stmt);
        return $postoji;
    }

    public function DodajNoviPrijem($idPacijenta,$Odeljenje,$TezinaNaPrijemu,$DatumPrijema,$Povreda,$SpoljniUzrokPovrede,$UputnaDijagnoza,$Pratnja='')
    {
        if (empty($SpoljniUzrokPovrede)){
        $SQL = "INSERT INTO `prijem` (BrojIstorijeBolesti,OdeljenjeNaPrijemu,UputnaDijagnoza,TezinaNaprijemu,DatumPrijema,Povreda,Pratnja) VALUES ('$idPacijenta','$Odeljenje','$UputnaDijagnoza','$TezinaNaPrijemu','$DatumPrijema','$Povreda','$Pratnja')";
        }
    //Unosi vrednosti u entitet prijem
        else{
        $SQL = "INSERT INTO `prijem` (BrojIstorijeBolesti,OdeljenjeNaPrijemu,UputnaDijagnoza,TezinaNaprijemu,DatumPrijema,Povreda,SpoljniUzrokPovrede,Pratnja) VALUES ('$idPacijenta','$Odeljenje','$UputnaDijagnoza','$TezinaNaPrijemu','$DatumPrijema','$Povreda','$SpoljniUzrokPovrede','$Pratnja')";
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
   //Brise vrednost iz entiteta prijem na mestu gde se nalazi zadati ID
        $SQL = "DELETE  FROM `prijem` where ID='$IdZaBrisanje'";
        $greska=$this->IzvrsiAktivanSQLUpit($SQL);
        return $greska;
    }

   
    public function DajDatumPrijema($ID)
    //Vraca filtriranu kolekciju svih vrednosti iz entiteta prijem
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