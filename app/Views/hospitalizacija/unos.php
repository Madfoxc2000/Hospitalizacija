<h1 class="form-header-hospitalizacija">Унос отпуста</h1>

<form name="hospitalizacijaForm" id="hospitalizacijaForm">
<div class="form-container-hospitalizacija">
<div class="row g-3 justify-content-center px-2 py-3">

<input type="hidden" name="IdPrijema" value="<?php echo htmlspecialchars($IDPrijema ?? ''); ?>">

<div class="col-12 col-sm-6 col-md-4">
    <label class="form-label" for="OsnovniUzrokHospitalizacije">Основни узрок хоспитализације<span aria-label="required">*</span></label>
    <select class="form-select" name="OsnovniUzrokHospitalizacije">
        <option value="">изаберите</option>
    </select>
    <span class="ValidationMessage" id="OsnovniUzrokHospitalizacijeMessage"></span>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <label class="form-label" for="PrateceDijagnoze">Пратеће дијагнозе</label>
    <input type="text" class="form-control" name="PrateceDijagnoze" placeholder="LOO L99">
    <span class="ValidationMessage" id="PrateceDijagnozeMessage"></span>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <label class="form-label" for="BrojSatiVentilatornePodrske">Број сати вентилаторне подршке</label>
    <input type="number" class="form-control" name="BrojSatiVentilatornePodrske" placeholder="10">
</div>

<div class="col-12 col-sm-6 col-md-4">
    <label class="form-label" for="DatumOtpusta">Датум отпуста<span aria-label="required">*</span></label>
    <input type="date" class="form-control" name="DatumOtpusta" required>
    <span class="ValidationMessage" id="DatumOtpustaMessage"></span>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <label class="form-label" for="OdeljenjeSaKojegJeOtpustIzvrsen">Одељење са којег је отпуст извршен<span aria-label="required">*</span></label>
    <select class="form-select" name="OdeljenjeSaKojegJeOtpustIzvrsen">
        <option value="">изаберите</option>
    </select>
    <span class="ValidationMessage" id="OdeljenjeSaKojegJeOtpustIzvrsenMessage"></span>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <label class="form-label" for="VrstaOtpusta">Врста отпуста<span aria-label="required">*</span></label>
    <select class="form-select" name="VrstaOtpusta" id="VrstaOtpusta">
        <option value="">изаберите</option>
    </select>
    <span class="ValidationMessage" id="VrstaOtpustaMessage"></span>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <fieldset class="border rounded p-2">
        <legend class="float-none w-auto px-1 fs-6">Обдукован:</legend>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="Obdukovan" name="Obdukovan" value="Да" disabled>
            <label class="form-check-label" for="Obdukovan">Да</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="NeObdukovan" name="Obdukovan" value="Не" disabled checked>
            <label class="form-check-label" for="NeObdukovan">Не</label>
        </div>
    </fieldset>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <label class="form-label" for="OsnovniUzrokSmrti">Основни узрок смрти</label>
    <select class="form-select" name="OsnovniUzrokSmrti" id="OsnovniUzrokSmrti" disabled>
        <option value="">изаберите</option>
    </select>
    <span class="ValidationMessage" id="OsnovniUzrokSmrtiMessage"></span>
</div>

<div class="col-12" id="hospitalizacija-edit-status"></div>

<div class="col-12 d-flex justify-content-center pb-3">
    <button type="submit" id="Enter" class="btn btn-primary px-5" name="btnSnimiVozilo" value="Сними">Сними</button>
</div>

</div>
</div>
</form>
