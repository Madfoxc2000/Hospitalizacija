<div class="popup" id="popup">
  <div class="popup-content">
    <p>Да ли сте сигурни да желите да обришете запис?</p>
    <button id="confirmDelete">Да</button>
    <button id="cancelDelete">Nе</button>
  </div>
</div>
<div class="administrator-table-content">

    <h1>Списак хоспитализација</h1>
    <div class="table-form-container">

    <div class="filter-form-container">

        <form class="filter-form-upper" id="filter-form-upper" action="" method="GET">
            <label for="filter">Основни узрок хоспитализације:</label>
            <input type="text" name="filter" id="filter" />
            <span class="ValidationMessage" id="filterMessage"></span>
            <button type="submit" name="filtriraj" value="Филтрирај">Филтрирај</button>
            <button type="submit" name="svi" value="СВИ">СВИ</button>
        </form>

        <form class="filter-form-lower" action="stampa" method="GET">
            <input type="hidden" name="filter" id="filter-print" value=""/>
            <button type="submit" name="filtriraj" value="Штампај по филтеру">Штампај </button>
        </form>
    </div>

        <div class="table-container-main">
            <div id="hospitalizacije-filter-status">Учитавање...</div>
            <table class="table-spisak-hospitalizacija-korisnik" align="center" cellspacing="0" cellpadding="0" bgcolor="">
                <thead>
                    <tr>
                        <th id="th1"><b><font face="Trebuchet MS">Број историје болести</font><br/></th>
                        <th id="th2"><b><font face="Trebuchet MS">Основни узрок хоспитализације</font><br/></th>
                        <th id="th3"><b><font face="Trebuchet MS">Датум пријема</font><br/></th>
                        <th id="th4"><b><font face="Trebuchet MS">Датум отпуста</font><br/></th>
                        <th id="thHiden"><b><font></font><br/></th>
                    </tr>
                </thead>
            </table>
            <div class="table-container">
                <table class="table-spisak-hospitalizacija-korisnik" align="center" cellspacing="0" cellpadding="0" bgcolor="">
                    <tbody id="hospitalizacije-filter-body"></tbody>
                </table>
            </div>
        </div>
    </div>

</div>
