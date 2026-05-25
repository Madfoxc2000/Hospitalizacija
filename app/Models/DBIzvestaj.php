<?php
class Izvestaj extends Tabela{
public $IDHospitalizacije;


public function __construct($NovaOtvorenaKonekcija, $NoviNazivTabele){
	// podrazumevamo da je otvorena konekcija, a zatvara se spolja
		$this->OtvorenaKonekcija = $NovaOtvorenaKonekcija;
		$this->NazivBazePodataka = $NovaOtvorenaKonekcija->KompletanNazivBazePodataka;
		$this->NazivTabele = $NoviNazivTabele;
		$this->TipMYSQL = $NovaOtvorenaKonekcija->VerzijaMYSQLNaredbi;
	}

public function DajIzvestaj() {
	$rezultatPar1 = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "SET @HospitalizacijaIDP='$this->IDHospitalizacije'");
    $Kolekcija = mysqli_query($this->OtvorenaKonekcija->konekcijaDB, "CALL `Izvestaj`(@HospitalizacijaIDP);");
	return $Kolekcija;
}
}
?>