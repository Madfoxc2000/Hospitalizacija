<?php
class PoslovnaLogika {

    public function DaLiJeMaloletan($datumRodjenja) {
        $today = new DateTime();
        $Datum = DateTime::createFromFormat("Y-m-d", $datumRodjenja);
        $razlika = $today->diff($Datum);
        $godine = $razlika->y;
        $xml = simplexml_load_file(APP_DIR . '/Models/ParametarGodina.xml')
            or die("Ne moze da se ucita XML fajl");
        $parametarGodine = $xml->godina;
        return ($godine > $parametarGodine) ? "Не" : "Да";
    }

    public function DajBrojDana($Date1, $Date2) {
        $date_format = 'Y-m-d';
        $Datum  = DateTime::createFromFormat($date_format, $Date1);
        $Datum1 = DateTime::createFromFormat($date_format, $Date2);
        $razlika = $Datum->diff($Datum1);
        return $razlika->y * 365 + $razlika->m * 30 + $razlika->d;
    }
}
