<?php
Class PoslovnaLogika extends Tabela{
//Implementira funkciju za proveru da li je pacijent maloletan
    private $bazapodataka;
    private $UspehKonekcijeNaDBMS;
    
public function DaLiJeMaloletan($datumRodjenja)
{
//Uzima danasnji datum i datum prosledjen parametrom funkcije, formatira ih, a zatim poredi razliku izmedju godina
//Nakon toga preuzima parametar u kome se nalazi broj godina i poredi ga sa prethodno dobijenom vrednoscu
$today = date("Y-m-d");
$date_format='Y-m-d';
$Datum = DateTime::createFromFormat($date_format, $datumRodjenja);
$Datum1 = DateTime::createFromFormat($date_format, $today);
$razlika = $Datum->diff($Datum1);
$godine = $razlika->y;
$xml=simplexml_load_file(dirname(__DIR__)."/klase/ParametarGodina.xml") or die("Ne moze da se ucita XML fajl");
$parametarGodine = $xml->godina;

if($godine>$parametarGodine){
     return 0;
                            }
else{
    return 1;
    }
}

}
?>