<?php
class SPHospitalizacija
//“SPHospitalizacija” služi da obezbedi korisniku sigurniji unos hospitalizacije preko stored procedure,
// takodje čita vrednosti iz pogleda.
{
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

public $OtvorenaKonekcija;
public $NazivBazePodataka;
public $NazivTabele;
public $TipMYSQL;
//
public $Kolekcija;
public $BrojZapisa;
public $PrviRedZapisa;
public $ListaZapisa;  // = array();


public function __construct($NovaOtvorenaKonekcija, $NoviNazivTabele){
	// podrazumevamo da je otvorena konekcija, a zatvara se spolja
		$this->OtvorenaKonekcija = $NovaOtvorenaKonekcija;
		$this->NazivBazePodataka = $NovaOtvorenaKonekcija->KompletanNazivBazePodataka;
		$this->NazivTabele = $NoviNazivTabele;
		$this->TipMYSQL = $NovaOtvorenaKonekcija->VerzijaMYSQLNaredbi;
	}

public function DodajNovuHospitalizaciju()
{

	if ($this->TipMYSQL=="mysqli")
	{
		echo "MYSQLI";
		
		$rezultatPar1 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET @BrojIstorijeBolesti='$this->BrojIstorijeBolesti'");
		$GreskarezultatPar1 =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB); 
		$rezultatPar2 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET @NazivZdravstveneUstanove='$this->NazivZdravstveneUstanove'");
		$GreskarezultatPar2 =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
		$rezultatPar3 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET @OdeljenjeNaPrijemu='$this->OdeljenjeNaPrijemu'");
		$GreskarezultatPar3 =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
		$rezultatPar4 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB,  "SET @DatumPrijema='$this->DatumPrijema'");
		$GreskarezultatPar4 =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
		$rezultatPar5 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET @UputnaDijagnoza='$this->UputnaDijagnoza'");
		$GreskarezultatPar5 =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar6 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET @Povreda='$this->Povreda'");
		$GreskarezultatPar6 =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar7 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET @SpoljniUzrokPovrede='$this->SpoljniUzrokPovrede'");
		$GreskarezultatPar7 =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar8 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET @OsnovniUzrokHospitalizacije='$this->OsnovniUzrokHospitalizacije'");
		$GreskarezultatPar8 =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
		$rezultatPar9 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET @PrateceDijagnoze='$this->PrateceDijagnoze'");
		$GreskarezultatPar9 =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar10 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET @SifraProcedurePoNomenklaturi='$this->SifraProcedurePoNomenklaturi'");
		$GreskarezultatPar10 =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar11 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET @TezinaNaPrijemu='$this->TezinaNaPrijemu'");
		$GreskarezultatPar11 =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar12 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET @BrojSatiVentilatornePodrske='$this->BrojSatiVentilatornePodrske'");
		$GreskarezultatPar12 =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar13 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET @DatumOtpusta='$this->DatumOtpusta'");
		$GreskarezultatPar13 =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar14 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET @BrojDanaHospitalizacije='$this->BrojDanaHospitalizacije'");
		$GreskarezultatPar14 =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar15 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET @OdeljenjeSaKojegJeOtpustIzvrsen='$this->OdeljenjeSaKojegJeOtpustIzvrsen'");
		$GreskarezultatPar15 =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar16 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET @VrstaOtpusta='$this->VrstaOtpusta'");
		$GreskarezultatPar16 =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar17 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET @Obdukovan='$this->Obdukovan'");
		$GreskarezultatPar17 =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar18 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET @OsnovniUzrokSmrti='$this->OsnovniUzrokSmrti'");
		$GreskarezultatPar18 =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
		$rezultatPar18 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET @Maloletan='$this->Maloletan'");
		$GreskarezultatPar18 =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
		$rezultatCall = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "CALL `DodajHospitalizaciju` (@BrojIstorijeBolesti, @NazivZdravstveneUstanove, @OdeljenjeNaPrijemu, @DatumPrijema, @UputnaDijagnoza, @Povreda, @SpoljniUzrokPovrede, @OsnovniUzrokHospitalizacije, @PrateceDijagnoze, @SifraProcedurePoNomenklaturi, @TezinaNaPrijemu, @BrojSatiVentilatornePodrske, @DatumOtpusta, @BrojDanaHospitalizacije, @OdeljenjeSaKojegJeOtpustIzvrsen, @VrstaOtpusta, @Obdukovan, @OsnovniUzrokSmrti,@Maloletan);");
		$GreskarezultatCall =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
		
	}
	else // mysql
	{
	
		$rezultatPar1 = mysql_query($this->OtvorenaKonekcija->konekcijaDB, "SET @BrojIstorijeBolesti=".$this->BrojIstorijeBolesti);
		$GreskarezultatPar1 =  mysql_error($this->OtvorenaKonekcija->konekcijaDB); 
		$rezultatPar2 = mysql_query($this->OtvorenaKonekcija->konekcijaDB, "SET @NazivZdravstveneUstanove=".$this->NazivZdravstveneUstanove);
		$GreskarezultatPar2 =  mysql_error($this->OtvorenaKonekcija->konekcijaDB);
		$rezultatPar3 = mysql_query($this->OtvorenaKonekcija->konekcijaDB, "SET @OdeljenjeNaPrijemu=".$this->OdeljenjeNaPrijemu);
		$GreskarezultatPar3 =  mysql_error($this->OtvorenaKonekcija->konekcijaDB);
		$rezultatPar4 = mysql_query($this->OtvorenaKonekcija->konekcijaDB,  "SET @DatumPrijema=".$this->DatumPrijema);
		$GreskarezultatPar4 =  mysql_error($this->OtvorenaKonekcija->konekcijaDB);
		$rezultatPar5 = mysql_query($this->OtvorenaKonekcija->konekcijaDB, "SET @UputnaDijagnoza=".$this->UputnaDijagnoza);
		$GreskarezultatPar5 =  mysql_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar6 = mysql_query($this->OtvorenaKonekcija->konekcijaDB, "SET @Povreda=".$this->Povreda);
		$GreskarezultatPar6 =  mysql_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar7 = mysql_query($this->OtvorenaKonekcija->konekcijaDB, "SET @SpoljniUzrokPovrede=".$this->SpoljniUzrokPovrede);
		$GreskarezultatPar7 =  mysql_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar8 = mysql_query($this->OtvorenaKonekcija->konekcijaDB, "SET @OsnovniUzrokHospitalizacije=".$this->OsnovniUzrokHospitalizacije);
		$GreskarezultatPar8 =  mysql_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar9 = mysql_query($this->OtvorenaKonekcija->konekcijaDB, "SET @SifraProcedurePoNomenklaturi=".$this->SifraProcedurePoNomenklaturi);
		$GreskarezultatPar9 =  mysql_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar10 = mysql_query($this->OtvorenaKonekcija->konekcijaDB, "SET @TezinaNaPrijemu=".$this->TezinaNaPrijemu);
		$GreskarezultatPar10 =  mysql_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar11 = mysql_query($this->OtvorenaKonekcija->konekcijaDB, "SET @BrojSatiVentilatornePodrske=".$this->BrojSatiVentilatornePodrske);
		$GreskarezultatPar11 =  mysql_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar12 = mysql_query($this->OtvorenaKonekcija->konekcijaDB, "SET @DatumOtpusta=".$this->DatumOtpusta);
		$GreskarezultatPar12 =  mysql_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar13 = mysql_query($this->OtvorenaKonekcija->konekcijaDB, "SET @BrojDanaHospitalizacije=".$this->BrojDanaHospitalizacije);
		$GreskarezultatPar13 =  mysql_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar14 = mysql_query($this->OtvorenaKonekcija->konekcijaDB, "SET @OdeljenjeSaKojegJeOtpustIzvrsen=".$this->OdeljenjeSaKojegJeOtpustIzvrsen);
		$GreskarezultatPar14 =  mysql_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar15 = mysql_query($this->OtvorenaKonekcija->konekcijaDB, "SET @VrstaOtpusta=".$this->VrstaOtpusta);
		$GreskarezultatPar15 =  mysql_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar16 = mysql_query($this->OtvorenaKonekcija->konekcijaDB, "SET @Obdukovan=".$this->Obdukovan);
		$GreskarezultatPar16 =  mysql_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar17 = mysql_query($this->OtvorenaKonekcija->konekcijaDB, "SET @OsnovniUzrokSmrti=".$this->OsnovniUzrokSmrti);
		$GreskarezultatPar17 =  mysql_error($this->OtvorenaKonekcija->konekcijaDB);
		$rezultatCall = mysql_query($this->OtvorenaKonekcija->konekcijaDB, "CALL `DodajHospitalizaciju` (@BrojIstorijeBolesti, @NazivZdravstveneUstanove, @OdeljenjeNaPrijemu, @DatumPrijema, @UputnaDijagnoza, @Povreda, @SpoljniUzrokPovrede, @OsnovniUzrokHospitalizacije, @SifraProcedurePoNomenklaturi, @TezinaNaPrijemu, @BrojSatiVentilatornePodrske, @DatumOtpusta, @BrojDanaHospitalizacije, @OdeljenjeSaKojegJeOtpustIzvrsen, @VrstaOtpusta, @Obdukovan, @OsnovniUzrokSmrti);");
		$GreskarezultatCall =  mysql_error($this->OtvorenaKonekcija->konekcijaDB);
	
	}
	
	$greska=$GreskarezultatPar1.$GreskarezultatPar2.$GreskarezultatPar3.$GreskarezultatPar4.$GreskarezultatPar5.$GreskarezultatPar6.$GreskarezultatPar7.$GreskarezultatPar8.$GreskarezultatPar9.$GreskarezultatPar10.$GreskarezultatPar11.$GreskarezultatPar12.$GreskarezultatPar13.$GreskarezultatPar14.$GreskarezultatPar15.$GreskarezultatPar16.$GreskarezultatPar17.$GreskarezultatCall;
	return $greska;
}
public function UcitajSvePoUpitu($Upit)
{
        $this->Kolekcija = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, $Upit);
        $this->BrojZapisa = mysqli_num_rows($this->Kolekcija); 

}

public function DajKolekcijuSvihHospitalizacijaPacijent($BrojIstorijeBolesti)
{
$SQL ="SELECT * FROM `pacijentpogled` WHERE BrojIstorijebolesti='$BrojIstorijeBolesti'";
$this->UcitajSvePoUpitu($SQL); // puni atribut bazne klase Kolekcija
return $this->Kolekcija; // uzima iz baznek klase vrednost atributa
}

public function DajUkupanBrojSvihHospitalizacija($KolekcijaZapisa)
{
return $this->BrojZapisa;
}

public function PrebaciKolekcijuUListu($Kolekcija) //kolekcija je result
{
    $ListaZapisa = array();
    if ($this->TipMYSQL=="mysqli")
    {
        while($RedZapisa = mysqli_fetch_array($Kolekcija,MYSQLI_NUM)) 
            {
                $this->ListaZapisa[] = $RedZapisa;
            }
    }
    else // mysql
    {
        while($RedZapisa = mysql_fetch_array($Kolekcija,MYSQLI_NUM)) 
            {
                $this->ListaZapisa[] = $RedZapisa;
            }
    }
        
    return $ListaZapisa; 
}


public function DajVrednostPoRednomBrojuZapisaPoRBPolja ($Kolekcija, $RBZapisa, $RBPolja)
{
    if ($this->TipMYSQL=="mysqli")
    {
        $ListaZapisa = array();
        $ListaZapisa= $this->PrebaciKolekcijuUListu($Kolekcija);
        $RedZapisa=$this->ListaZapisa[$RBZapisa];
        $Vrednost=$RedZapisa [$RBPolja];
    }
    else // mysql
    {
        $Vrednost=mysql_result($Kolekcija,$RBZapisa, $RBPolja);   //$NazivPolja);
    }

    return $Vrednost;
}



}
?>