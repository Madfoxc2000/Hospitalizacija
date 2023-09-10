<?php 
class Validacije{
// Omogućava funkcije za osnovne validacije podataka
// public function DaLiJeVeliko($string,$NazivPolja)
// {
//     $firstCharacter = mb_substr($string, 0, 1, 'UTF-8');
//     $uppercaseVersion = mb_strtoupper($firstCharacter, 'UTF-8');

//     if ($firstCharacter === $uppercaseVersion) {    
    
//     }
//     else {
//         return ' Почетно слово '.$NazivPolja. ' мора бити велико ';
//     }    
// }
// public function DaLiIma13brojeva($JMBG)
// {
//     $length = strlen($JMBG);
//     if($length==13){

//     }
//     else{
//         return ' ЈМБГ мора имати 13 бројева ';
//     }
// }
// public function DaLiIma7karaktera($OsnoviUzrokHospitalizacije)
// {
//     $length = strlen($OsnoviUzrokHospitalizacije);
//     if($length==7){

//     }
//     else{
//         return ' Основни узрок хоспитализације мора имати 7 карактера ';
//     }
// }
// public function DaLiSuOdgovarajućiTipoviPodataka($OsnovniUzrokHospitalizacije, $NazivPolja)
// {
//         $pattern = '/^[A-Za-z0-9\s]+$/';
//         if (preg_match($pattern, $OsnovniUzrokHospitalizacije) === 1) {
  
//         } else {
//             return 'Поље'.$NazivPolja.'мора да садржи само слова, бројеве и размак';
//         }
// }
// public function DaLiSuSamoBrojevi($JMBG,$NazivPolja)
// {
//     $all_digits = true;
//     for ($i = 0; $i < strlen($JMBG); $i++) {
//         if (!ctype_digit($JMBG[$i])) {
//             $all_digits = false;
//             break;
//         }
//     }
//     if ($all_digits) {
    
//     } else {
//         return ' Поље '.$NazivPolja.' мора садржати само бројеве';
//     }
// }

public function DaLiJePacijentPrimljen($BrojeviBolesti,$NoviBrojBolesti){
    if (stripos($BrojeviBolesti, $NoviBrojBolesti) !== false) {
        return ' Није могуће обрисати податке о пацијенту за који се чувају подаци о хоспитализацији ';
    } 
    else {
      
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
// LBO ima 11 cifara
?>