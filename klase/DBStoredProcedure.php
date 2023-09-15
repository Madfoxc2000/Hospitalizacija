<?php
class SPHospitalizacija
//“SPHospitalizacija” služi da obezbedi korisniku sigurniji unos hospitalizacije preko stored procedure,
// takodje čita vrednosti iz pogleda.
{

public $IDPrijema;
public $OsnovniUzrokHospitalizacije;
public $PrateceDijagnoze;
public $SifraProcedurePoNomenklaturi;
public $BrojSatiVentilatornePodrske;
public $DatumOtpusta;
public $BrojDanaHospitalizacije;
public $OdeljenjeSaKojegJeOtpustIzvrsen;
public $VrstaOtpusta;
public $Obdukovan;
public $OsnovniUzrokSmrti;

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
		$rezultatPar11 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET @IDPrijema='$this->IDPrijema'");
		$GreskarezultatPar11 =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar8 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET @OsnovniUzrokHospitalizacije='$this->OsnovniUzrokHospitalizacije'");
		$GreskarezultatPar8 =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
		$rezultatPar9 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET @PrateceDijagnoze='$this->PrateceDijagnoze'");
		$GreskarezultatPar9 =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar10 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET @SifraProcedurePoNomenklaturi='$this->SifraProcedurePoNomenklaturi'");
		$GreskarezultatPar10 =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);
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
		$rezultatCall = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "CALL `DodajHospitalizaciju` (@IDPrijema, @OsnovniUzrokHospitalizacije, @PrateceDijagnoze, @BrojSatiVentilatornePodrske, @DatumOtpusta, @BrojDanaHospitalizacije, @OdeljenjeSaKojegJeOtpustIzvrsen, @VrstaOtpusta, @Obdukovan, @OsnovniUzrokSmrti);");
		$GreskarezultatCall =  mysqli_error($this->OtvorenaKonekcija->konekcijaDB);	

	}
	else // mysql
	{
	
		$rezultatPar10 = mysql_query($this->OtvorenaKonekcija->konekcijaDB, "SET @IDPrijema=".$this->IDPrijema);
		$GreskarezultatPar10 =  mysql_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar8 = mysql_query($this->OtvorenaKonekcija->konekcijaDB, "SET @OsnovniUzrokHospitalizacije=".$this->OsnovniUzrokHospitalizacije);
		$GreskarezultatPar8 =  mysql_error($this->OtvorenaKonekcija->konekcijaDB);
        $rezultatPar9 = mysql_query($this->OtvorenaKonekcija->konekcijaDB, "SET @SifraProcedurePoNomenklaturi=".$this->SifraProcedurePoNomenklaturi);
		$GreskarezultatPar9 =  mysql_error($this->OtvorenaKonekcija->konekcijaDB);
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
	
	$greska=$GreskarezultatPar8.$GreskarezultatPar9.$GreskarezultatPar10.$GreskarezultatPar11.$GreskarezultatPar12.$GreskarezultatPar13.$GreskarezultatPar14.$GreskarezultatPar15.$GreskarezultatPar16.$GreskarezultatPar17.$GreskarezultatCall;
	return $greska;
}
}
?>