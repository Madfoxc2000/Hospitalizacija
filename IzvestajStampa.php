<?php
   session_start();
   // kad idemo preko poziva sa URL promenljivom, onda ovako citamo:
   //$korisnik=$_GET['korisnik'];
   
    // citanje vrednosti iz sesije
   $korisnik=$_SESSION["korisnik"];
   
   // ako nije prijavljen korisnik, vraca ga na pocetnu stranicu
   if (!isset($korisnik))
   {
    header ('Location:index.php');
   }  

	$idHospitalizacije=$_POST['IdHospitalizacije'];
    $BrojIstorijeBolesti=$_POST['BrojIstorijeBolesti'];

    require "klase/BaznaKonekcija.php";
		require "klase/BaznaTabela.php";
		$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
		$KonekcijaObject->connect();
		if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
		{	
			require "klase/DBIzvestaj.php";
			$IzvestajObject = new Izvestaj($KonekcijaObject, 'izvestaj');
            $IzvestajObject->IDHospitalizacije=$idHospitalizacije;
            $KolekcijaZapisa = $IzvestajObject->DajIzvestaj();

				$row=0;  // prvi i jedini red ima taj idvesti 
                $IdPrijema=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 0);
				$OsnovniUzrokHospitalizacije=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 1);
				$PrateceDijagnoze=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 2);
				$BrojSatiVentilatornePodrske=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 3);
				$DatumOtpusta=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 4);
				$BrojDanaHospitalizacije=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 5);
				$OdeljenjeSaKojegJeOtpustIzvrsen=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 6);
                $NazivOdeljenjaOtpusta=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 7);
				$VrstaOtpusta=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 8);
                $NazivOtpusta=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 9);
				$Obdukovan=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 10);
                $OsnovniUzrokSmrti=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 11);
                // $BrojIstorijeBolesti=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 12);
                $JMBG=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 13);
                $DatumRodjenja=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 14);
                $Drzavljanstvo=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 15);
                $Pol=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 16);
                $Adresa=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 17);
                $OsnovOsiguranja=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 18);
                $NazivOsiguranja=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 19);
                $LBO=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 20);
                $OdeljenjeNaPrijemu=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 21);
                $NazivPrijemnogOsiguranja=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 22);
                $Ime=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 23);
                $Prezime=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 24); 
                $UputnaDijagnoza=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 25);
                $TezinaNaPrijemu=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 26);
                $DatumPrijema=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 27);
                $Povreda=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 28);
                $SpoljniUzrokPovrede=$IzvestajObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $row, 29);
                $KonekcijaObject->disconnect(); 

            $KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
		    $KonekcijaObject->connect();
            require "klase/DBAktivnost.php";
            $AktivnostObject = new Aktivnost($KonekcijaObject, 'aktivnost');
            $KolekcijaZapisa1 = $AktivnostObject->DajSveAktivnostiPrijema($IdPrijema);
            $UkupanBrojAktivnosti = $AktivnostObject->DajUkupanBrojSvihAktivnosti($KolekcijaZapisa1);
            $SifraProcedurePoNomenklaturi = "";
            if ($UkupanBrojAktivnosti>0) 
			{       for ($RBZapisa = 0; $RBZapisa < $UkupanBrojAktivnosti; $RBZapisa++) 
                {
                    $SifraProcedurePoNomenklaturi .=  $AktivnostObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisa1, $RBZapisa, 2)."|";
                }
            }             
		} // od if uspeh konekcije

      $KonekcijaObject->disconnect(); 
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/izvestaj.css">
</head>
<body>
    <div class="izvestaj-container">
        <table>
            <caption>ИЗВЕШТАЈ О ХОСПИТАЛИЗАЦИЈИ</caption>
            <tr>
              <td style="width: 3%;">1</td>
              <th style="width: 12%;">НАЗИВ ЗДРАВСТВЕНЕ УСТАНОВЕ</th>
              <td colspan="6" id="NazivZdravstveneUstanoveIZ" style="width: 85%;"><b>Клинички Центар</b></td>
            </tr>
            <tr>
                <td style="width: 3%;">2</td>
                <th style="width: 12%;">ОДЕЉЕЊЕ НА ПРИЈЕМУ</th>
                <td colspan="6" id="OdeljenjeNaPrijemuIZ" style="width: 85%;"><b><?php  echo $OdeljenjeNaPrijemu." ".$NazivPrijemnogOsiguranja; ?></b></td>
              </tr>
            <tr>
            <td style="width: 3%;">3</td>
            <th style="width: 12%;">БРОЈ ИСТОРИЈЕ БОЛЕСТИ</th>
            <td style="width: 30%;" id ="BrojIstorijeBolestiIz"><b><?php echo $BrojIstorijeBolesti; ?></b></td>
            <td style="width: 3%;">4</td>
            <th colspan="2" style="width: 12%;">ДАТУМ ПРИЈЕМА</th>
            <td colspan="2" style="width: 40%;" id="DatumPrijemaIZ"><b><?php echo $DatumPrijema; ?></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">5</td>
                <th style="width: 12%;">ИМЕ И ПРЕЗИМЕ ПАЦИЈЕНТА</th>
                <td colspan="6" id="ImeIPrezimeIZ" style="width: 85%;"><b><?php echo $Ime." ".$Prezime; ?></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">6</td>
                <th style="width: 12%;">ЈМБГ</th>
                <td colspan="3" id="JMBGIZ"><b><?php echo $JMBG; ?></b></td>
                <td style="width: 3%;">7</td>
                <th style="width: 12%;">ДАТУМ РОЂЕЊА</th>
                <td id="DatumRodjenjaIZ"><b><?php echo $DatumRodjenja; ?></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">8</td>
                <th style="width: 12%; height: 2rem;">ДРЖАВЉАНСТВО</th>
                <td colspan="3" id="DrzavljasntvoIZ"><b><?php echo $Drzavljanstvo; ?></b></td>
                <td style="width: 3%;">9</td>
                <th style="width: 12%;">ПОЛ</th>
                <td id="PolIZ"><b><?php echo $Pol; ?></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">10</td>
                <th style="width: 12%;">АДРЕСА И ОПШТИНА ПРЕБИВАЛИШТА</th>
                <td colspan="6" id="AdresaIZ" style="width: 85%;"><b><?php echo $Adresa; ?></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">11</td>
                <th style="width: 12%; height: 2rem;">ОСИГУРАЊЕ</th>
                <td style="width: 30%;" id = "OsiguranjeIZ"><b><?php echo $OsnovOsiguranja." ".$NazivOsiguranja; ?></b></td>
                <td style="width: 3%;">12</td>
                <th colspan="2" style="width: 12%;">ЛБО</th>
                <td colspan="2" style="width: 40%;" id="LBOIZ"><b><?php echo $LBO; ?></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">13</td>
                <th style="width: 12%;">УПУТНА ДИЈАГНОЗА</th>
                <td colspan="6" style="width: 85%;" id="UputnaDijagnozaIZ"><b><?php echo $UputnaDijagnoza; ?></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">14</td>
                <th style="width: 12%;">ПОВРЕДА</th>
                <td style="width: 30%;" id="PovredaIZ"><?php echo $Povreda; ?></td>
                <td style="width: 3%;">15</td>
                <th colspan="3" style="width: 12%;">СПОЉНИ УЗРОК ПОВРЕДЕ ПО МКБ</th>
                <td colspan="2" style="width: 40%;" id="SpoljniUzrokPovredeIZ"><b><?php echo $SpoljniUzrokPovrede; ?></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">16</td>
                <th style="width: 12%;">ОСНОВНИ УЗРОК ХОСПИТАЛИЗАЦИЈЕ</th>
                <td colspan="6" style="width: 85%;" id="OsnovniUzrokHospitalizacijeIZ"><b><?php echo $OsnovniUzrokHospitalizacije; ?></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">17</td>
                <th style="width: 12%;">ПРАТЕЋЕ ДИЈАГНОЗЕ</th>
                <td colspan="6" style="width: 85%;" id="PrateceDijagnozeIZ"><b><?php echo $PrateceDijagnoze; ?></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">18</td>
                <th style="width: 12%;">ШИФРА ПРОЦЕДУРЕ ПО НОМЕНКЛАТУРИ</th>
                <td colspan="6" style="width: 85%;" id="SifraProcedureIZ"><b><?php echo $SifraProcedurePoNomenklaturi; ?></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">19</td>
                <th style="width: 12%; height: 2rem;">ТЕЖИНА НА ПРИЈЕМУ(ЗА НОВОРОЂЕНЧЕ)</th>
                <td colspan="3" id="TezinaNaPrijemuIZ"><b><?php echo $TezinaNaPrijemu; ?></b></td>
                <td style="width: 3%;">20</td>
                <th style="width: 12%;">БРОЈ САТИ ВЕНТИЛАТОРНЕ ПОДРШКЕ</th>
                <td id="BrojSatiVentilatornePodrskeIZ"><b><?php echo $BrojSatiVentilatornePodrske; ?></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">21</td>
                <th style="width: 12%; height: 2rem;">ДАТУМ ОТПУСТА</th>
                <td colspan="3" id="DatumOtpustaIZ"><b><?php echo $DatumOtpusta; ?></b></td>
                <td style="width: 3%;">22</td>
                <th style="width: 12%;">БРОЈ ДАНА ХОСПИТАЛИЗАЦИЈЕ</th>
                <td id="BrojDanaHospitalizacijeIZ"><b><?php echo $BrojDanaHospitalizacije; ?></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">23</td>
                <th style="width: 12%;">ОДЕЉЕЊЕ СА КОЈЕГ ЈЕ ОТПУСТ ИЗВРШЕН</th>
                <td colspan="6" style="width: 85%;" id="OdeljenjeSaKojegJeOtpustIzvrsenIZ"><b><?php echo $OdeljenjeSaKojegJeOtpustIzvrsen." ".$NazivOdeljenjaOtpusta; ?></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">24</td>
                <th style="width: 12%; height: 2rem;">ВРСТА ОТПУСТА</th>
                <td colspan="3" id="VrstaOtpustaIZ"><b><?php echo $VrstaOtpusta." ".$NazivOtpusta; ?></b></td>
                <td style="width: 3%;">25</td>
                <th style="width: 12%;">ОБДУКОВАН</th>
                <td id="ObdukovanIZ"><b><?php echo $Obdukovan; ?></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">26</td>
                <th style="width: 12%;">ОСНОВНИ УЗРОК СМРТИ</th>
                <td colspan="6" style="width: 85%;" id="OsnovniUzrokSmrtiIZ"><b><?php echo $OsnovniUzrokSmrti; ?></b></td>
            </tr>
          </table>
        
          <div class="potpis"><span>ПОТПИС И ФАКСИМИЛ ЛЕКАРА СПЕЦИЈАЛИСТЕ КОЈИ ЈЕ ЗАКЉУЧИО ЕПИЗОДУ БОЛНИЧКОГ ЛЕЧЕЊА</span></div>
    </div>
</body>
</html>
