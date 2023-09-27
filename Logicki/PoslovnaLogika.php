<?php
Class PoslovnaLogika {
//Implementira funkciju za proveru da li je pacijent maloletan

    
public function DaLiJeMaloletan($datumRodjenja)
{
//Uzima danasnji datum i datum prosledjen parametrom funkcije, formatira ih, a zatim poredi razliku izmedju godina
//Nakon toga preuzima parametar u kome se nalazi broj godina i poredi ga sa prethodno dobijenom vrednoscu
$today = new DateTime();
$Datum = DateTime::createFromFormat("Y-m-d", $datumRodjenja);
$razlika = $today->diff($Datum);
$godine = $razlika->y;
$xml=simplexml_load_file(dirname(__DIR__)."/klase/ParametarGodina.xml") or die("Ne moze da se ucita XML fajl");
$parametarGodine = $xml->godina;
if($godine>$parametarGodine){
     return "Не";
    }
else{
    return "Да";
    }
}

//Racuna razliku dana izmedju dana na prijemu i broja dana kada je hospitalizacija unesena
public function DajBrojDana($Date1, $Date2)
{
       $date_format = 'Y-m-d';
    // Create DateTime objects for the input dates
    $Datum = DateTime::createFromFormat($date_format, $Date1);
    $Datum1 = DateTime::createFromFormat($date_format, $Date2);

    // Calculate the difference between the two dates
    $razlika = $Datum->diff($Datum1);

    // Calculate the total number of days
    $Dani = $razlika->y * 365 + $razlika->m * 30 + $razlika->d;

    return $Dani;
}
}
?>