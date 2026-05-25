<h1>Списак активних пацијената</h1>
<div class="table-form-container">

    <div class="filter-form-container pacijent">
        <form class="filter-form-upper" id="filter-form-upper" action="" method="GET">
            <label for="filter">Број историје болести:</label>
            <input type="text" id="filter" name="filter"/>
            <button type="submit" name="filtriraj" value="Филтрирај">Филтрирај</button>
            <span class="ValidationMessage" id="filterMessage"></span>
            <button type="submit" name="svi" value="СВИ">СВИ</button>
        </form>
    </div>

    <div class="table-container-main">
        <div id="primljeni-status">Учитавање...</div>
        <table class="table-spisak-hospitalizacija-korisnik" align="center" cellspacing="0" cellpadding="0" bgcolor="">
            <thead>
                <tr>
                    <th id="th1"><b><font face="Trebuchet MS">Број историје болести</font><br/></th>
                    <th id="th2"><b><font face="Trebuchet MS">Одељење на пријему</font><br/></th>
                    <th id="th3"><b><font face="Trebuchet MS">Упутна дијагноза</font><br/></th>
                    <th id="th4"><b><font face="Trebuchet MS">Датум пријема</font><br/></th>
                    <th id="thHiden"><b><font></font><br/></th>
                </tr>
            </thead>
        </table>
        <div class="table-container">
            <table class="table-spisak-hospitalizacija-korisnik" align="center" cellspacing="0" cellpadding="0" bgcolor="">
                <tbody id="primljeni-body"></tbody>
            </table>
        </div>
    </div>
</div>
