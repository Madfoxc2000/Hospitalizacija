<div class="administrator-table-content">
    <h1>Списак пацијената</h1>
    <div class="table-form-container">

        <div class="filter-form-container pacijent">
            <form class="filter-form-upper" id="filter-form-upper" action="" method="GET">
                <label class="form-label" for="filter">Број историје болести:</label>
                <input type="text" class="form-control form-control-sm" id="filter" name="filter"/>
                <span class="ValidationMessage" id="filterMessage"></span>
                <div class="d-flex gap-2 mt-1">
                    <button type="submit" class="btn btn-sm btn-outline-light" name="filtriraj" value="Филтрирај">Филтрирај</button>
                    <button type="submit" class="btn btn-sm btn-outline-secondary" name="svi" value="СВИ">СВИ</button>
                </div>
            </form>
        </div>

        <div class="table-container-main">
            <div id="pacijenti-korisnik-status">Учитавање...</div>
            <table class="table table-dark table-bordered table-sm w-100">
                <thead>
                    <tr>
                        <th id="th1">Број историје болести</th>
                        <th id="th2">Ime</th>
                        <th id="th3">Презиме</th>
                        <th id="th4">Датум рођења</th>
                    </tr>
                </thead>
            </table>
            <div class="table-responsive table-container">
                <table class="table table-dark table-striped table-hover table-sm w-100">
                    <tbody id="pacijenti-korisnik-body"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
