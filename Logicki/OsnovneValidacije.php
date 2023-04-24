<?php 
class Validacije{
// Omogućava funkcije za osnovne validacije podataka
public function DaLiJeVeliko($string,$NazivPolja)
{
    if (ctype_upper($string[0])) {    
    
    }
    else {
        return ' Почетно слово '.$NazivPolja. ' мора бити велико ';
    }    
}
public function DaLiIma13brojeva($JMBG)
{
    $length = strlen(bin2hex($JMBG));
    if($length==13){

    }
    else{
        return ' ЈМБГ мора имати 13 бројева ';
    }
}
public function DaLiIma7karaktera($OsnoviUzrokHospitalizacije)
{
    $length = strlen(bin2hex($OsnoviUzrokHospitalizacije));
    if($length==7){

    }
    else{
        return ' Основни узрок хоспитализације мора имати 7 карактера ';
    }
}
public function DaLiSuOdgovarajućiTipoviPodataka($OsnoviUzrokHospitalizacije, $NazivPolja)
{
        if (ctype_alnum(str_replace(' ', '', $OsnoviUzrokHospitalizacije)) && ctype_space($OsnoviUzrokHospitalizacije)) {
         
        } else {
            return 'Поље'.$NazivPolja.'мора да садржи само слова, бројеве и размак';
        }
}
public function DaLiSuSamoBrojevi($JMBG,$NazivPolja)
{
    $all_digits = true;
    for ($i = 0; $i < strlen($JMBG); $i++) {
        if (!ctype_digit($JMBG[$i])) {
            $all_digits = false;
            break;
        }
    }
    if ($all_digits) {
    
    } else {
        return ' Поље '.$NazivPolja.' мора садржати само бројеве';
    }
}

public function DaLiJeJedinstvenBrojBolesti($BrojeviBolesti,$NoviBrojBolesti){
    if (stripos($BrojeviBolesti, $NoviBrojBolesti) !== false) {
        return ' Примарни кључ већ постоји, молимо унесите други ';
    } 
    else {
      
    }
    
    
 }

}

?>