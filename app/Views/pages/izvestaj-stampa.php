<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/izvestaj.css">
    <script src="JS/IzvestajStampa.js" defer></script>
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
                <td colspan="6" id="OdeljenjeNaPrijemuIZ" style="width: 85%;"><b></b></td>
              </tr>
            <tr>
            <td style="width: 3%;">3</td>
            <th style="width: 12%;">БРОЈ ИСТОРИЈЕ БОЛЕСТИ</th>
            <td style="width: 30%;" id ="BrojIstorijeBolestiIz"><b></b></td>
            <td style="width: 3%;">4</td>
            <th colspan="2" style="width: 12%;">ДАТУМ ПРИЈЕМА</th>
            <td colspan="2" style="width: 40%;" id="DatumPrijemaIZ"><b></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">5</td>
                <th style="width: 12%;">ИМЕ И ПРЕЗИМЕ ПАЦИЈЕНТА</th>
                <td colspan="6" id="ImeIPrezimeIZ" style="width: 85%;"><b></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">6</td>
                <th style="width: 12%;">ЈМБГ</th>
                <td colspan="3" id="JMBGIZ"><b></b></td>
                <td style="width: 3%;">7</td>
                <th style="width: 12%;">ДАТУМ РОЂЕЊА</th>
                <td id="DatumRodjenjaIZ"><b></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">8</td>
                <th style="width: 12%; height: 2rem;">ДРЖАВЉАНСТВО</th>
                <td colspan="3" id="DrzavljasntvoIZ"><b></b></td>
                <td style="width: 3%;">9</td>
                <th style="width: 12%;">ПОЛ</th>
                <td id="PolIZ"><b></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">10</td>
                <th style="width: 12%;">АДРЕСА И ОПШТИНА ПРЕБИВАЛИШТА</th>
                <td colspan="6" id="AdresaIZ" style="width: 85%;"><b></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">11</td>
                <th style="width: 12%; height: 2rem;">ОСИГУРАЊЕ</th>
                <td style="width: 30%;" id = "OsiguranjeIZ"><b></b></td>
                <td style="width: 3%;">12</td>
                <th colspan="2" style="width: 12%;">ЛБО</th>
                <td colspan="2" style="width: 40%;" id="LBOIZ"><b></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">13</td>
                <th style="width: 12%;">УПУТНА ДИЈАГНОЗА</th>
                <td colspan="6" style="width: 85%;" id="UputnaDijagnozaIZ"><b></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">14</td>
                <th style="width: 12%;">ПОВРЕДА</th>
                <td style="width: 30%;" id="PovredaIZ"></td>
                <td style="width: 3%;">15</td>
                <th colspan="3" style="width: 12%;">СПОЉНИ УЗРОК ПОВРЕДЕ ПО МКБ</th>
                <td colspan="2" style="width: 40%;" id="SpoljniUzrokPovredeIZ"><b></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">16</td>
                <th style="width: 12%;">ОСНОВНИ УЗРОК ХОСПИТАЛИЗАЦИЈЕ</th>
                <td colspan="6" style="width: 85%;" id="OsnovniUzrokHospitalizacijeIZ"><b></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">17</td>
                <th style="width: 12%;">ПРАТЕЋЕ ДИЈАГНОЗЕ</th>
                <td colspan="6" style="width: 85%;" id="PrateceDijagnozeIZ"><b></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">18</td>
                <th style="width: 12%;">ШИФРА ПРОЦЕДУРЕ ПО НОМЕНКЛАТУРИ</th>
                <td colspan="6" style="width: 85%;" id="SifraProcedureIZ"><b></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">19</td>
                <th style="width: 12%; height: 2rem;">ТЕЖИНА НА ПРИЈЕМУ(ЗА НОВОРОЂЕНЧЕ)</th>
                <td colspan="3" id="TezinaNaPrijemuIZ"><b></b></td>
                <td style="width: 3%;">20</td>
                <th style="width: 12%;">БРОЈ САТИ ВЕНТИЛАТОРНЕ ПОДРШКЕ</th>
                <td id="BrojSatiVentilatornePodrskeIZ"><b></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">21</td>
                <th style="width: 12%; height: 2rem;">ДАТУМ ОТПУСТА</th>
                <td colspan="3" id="DatumOtpustaIZ"><b></b></td>
                <td style="width: 3%;">22</td>
                <th style="width: 12%;">БРОЈ ДАНА ХОСПИТАЛИЗАЦИЈЕ</th>
                <td id="BrojDanaHospitalizacijeIZ"><b></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">23</td>
                <th style="width: 12%;">ОДЕЉЕЊЕ СА КОЈЕГ ЈЕ ОТПУСТ ИЗВРШЕН</th>
                <td colspan="6" style="width: 85%;" id="OdeljenjeSaKojegJeOtpustIzvrsenIZ"><b></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">24</td>
                <th style="width: 12%; height: 2rem;">ВРСТА ОТПУСТА</th>
                <td colspan="3" id="VrstaOtpustaIZ"><b></b></td>
                <td style="width: 3%;">25</td>
                <th style="width: 12%;">ОБДУКОВАН</th>
                <td id="ObdukovanIZ"><b></b></td>
            </tr>
            <tr>
                <td style="width: 3%;">26</td>
                <th style="width: 12%;">ОСНОВНИ УЗРОК СМРТИ</th>
                <td colspan="6" style="width: 85%;" id="OsnovniUzrokSmrtiIZ"><b></b></td>
            </tr>
          </table>

          <div class="potpis"><span>ПОТПИС И ФАКСИМИЛ ЛЕКАРА СПЕЦИЈАЛИСТЕ КОЈИ ЈЕ ЗАКЉУЧИО ЕПИЗОДУ БОЛНИЧКОГ ЛЕЧЕЊА</span></div>
    </div>
</body>
</html>
