<div class="modal fade" id="popup" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <p>Да ли сте сигурни да желите да обришете запис?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button class="btn btn-danger" id="confirmDelete">Да</button>
                <button class="btn btn-secondary" id="cancelDelete">Не</button>
            </div>
        </div>
    </div>
</div>

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
            <div class="mt-2">
                <button type="button" class="btn btn-sm btn-outline-warning w-100 btn-stampa-print" onclick="stampajListu('pacijenti-body', 'Списак пацијената')">Штампај</button>
            </div>
        </div>

        <div class="table-container-main">
            <div id="pacijenti-status">Учитавање...</div>
            <table class="table table-dark table-bordered table-sm w-100">
                <thead>
                    <tr>
                        <th id="th1">Број историје болести</th>
                        <th id="th2">Име</th>
                        <th id="th3">Презиме</th>
                        <th id="th4">Датум рођења</th>
                        <th id="thHiden"></th>
                    </tr>
                </thead>
            </table>
            <div class="table-responsive table-container">
                <table class="table table-dark table-striped table-hover table-sm w-100">
                    <tbody id="pacijenti-body"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
