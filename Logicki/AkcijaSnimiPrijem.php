<?php
session_start();  
$idkorisnika=$_SESSION["idkorisnika"];

$idPacijenta=$_POST['idPacijenta']; 
$OdeljenjeNaPrijemu=$_POST['OdeljenjeNaPrijemu']; 
$TezinaNaPrijemu=$_POST['Tezina']; 
$DatumPrijema=$_POST['DatumPrijema']; 
$Povreda=$_POST['Povreda']; 
$SpoljniUzrokPovrede=$_POST['SpoljniUzrokPovrede']; 
$UputnaDijagnoza=$_POST['UputnaDijagnoza']; 
echo $OdeljenjeNaPrijemu;
require dirname(__DIR__)."/klase/BaznaKonekcija.php";
require dirname(__DIR__)."/klase/BaznaTabela.php";
$xml=dirname(__DIR__)."/klase/BaznaParametriKonekcije.xml";
$KonekcijaObject = new Konekcija($xml);
$KonekcijaObject->connect();
if ($KonekcijaObject->konekcijaDB) // uspesno realizovana
{
    require dirname(__DIR__)."/klase/DBPrijem.php";
    $PrijemObject = new Prijem($KonekcijaObject, 'aktivnost');
    $greska=$PrijemObject->DodajNoviPrijem($idPacijenta,$OdeljenjeNaPrijemu,$TezinaNaPrijemu,$DatumPrijema,$Povreda,$SpoljniUzrokPovrede,$UputnaDijagnoza);
}

$KonekcijaObject->disconnect();
	
// prikaz uspeha aktivnosti	

if ($greska) {
echo "Greska $greska";	

 }	
 else
 {

     header ('Location:http://localhost/Hospitalizacija/PrimljeniPacijentiLista.php');	
 }
?>