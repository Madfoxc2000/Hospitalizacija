<div class="px-3 py-3">

    <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn btn-sm btn-outline-warning btn-stampa-print" onclick="stampajZaposlene()">Штампај</button>
    </div>

    <!-- Nurses table -->
    <div class="mb-5">
        <h2 class="mb-3" style="font-size:1.4rem; letter-spacing:.04em;">
            <span class="material-symbols-outlined align-middle me-1">medical_services</span>
            Медицинске сестре / браћа
        </h2>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle" id="tbl-sestre">
                <thead style="background-color: var(--table-header);">
                    <tr>
                        <th>Презиме</th>
                        <th>Име</th>
                        <th>Специјализација</th>
                        <th>Телефон</th>
                        <th>Е-маил</th>
                        <th>Корисничко име</th>
                    </tr>
                </thead>
                <tbody id="tbody-sestre">
                    <tr><td colspan="6" class="text-center">Учитавање...</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Doctors table -->
    <div>
        <h2 class="mb-3" style="font-size:1.4rem; letter-spacing:.04em;">
            <span class="material-symbols-outlined align-middle me-1">stethoscope</span>
            Лекари
        </h2>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle" id="tbl-lekari">
                <thead style="background-color: var(--table-header);">
                    <tr>
                        <th>Презиме</th>
                        <th>Име</th>
                        <th>Специјализација</th>
                        <th>Телефон</th>
                        <th>Е-маил</th>
                        <th>Корисничко име</th>
                    </tr>
                </thead>
                <tbody id="tbody-lekari">
                    <tr><td colspan="6" class="text-center">Учитавање...</td></tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
