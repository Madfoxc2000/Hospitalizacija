<h1 class="form-header-hospitalizacija">Измена отпуста</h1>

<div id="hospitalizacija-edit-status">Учитавање...</div>

<form name="hospitalizacijaForm" id="hospitalizacijaForm" data-ajax="true">

<div class="form-container-hospitalizacija">

<input type="hidden" name="IdHospitalizacije" value="<?= htmlspecialchars($id ?? '') ?>">
<input type="hidden" name="IDPrijema" value="">

<div class="input-container">
    <label for="OsnovniUzrokHospitalizacije">Основни узрок хоспитализација:<span aria-label="required">*</span></label>
    <select name="OsnovniUzrokHospitalizacije"></select>
    <span class="ValidationMessage" id="OsnovniUzrokHospitalizacijeMessage"></span>
</div>

<div class="input-container">
    <label for="PrateceDijagnoze">Пратеће дијагнозе:</label>
    <input type="text" name="PrateceDijagnoze" value="">
    <span class="ValidationMessage" id="PrateceDijagnozeMessage"></span>
</div>

<div class="input-container">
    <label for="BrojSatiVentilatornePodrske">Број сати вентилаторне подршке:<span aria-label="required">*</span></label>
    <input type="text" name="BrojSatiVentilatornePodrske" value="">
</div>

<div class="input-container">
    <label for="DatumOtpusta">Датум отпуста:<span aria-label="required">*</span></label>
    <input type="date" name="DatumOtpusta" required value="">
    <span class="ValidationMessage" id="DatumOtpustaMessage"></span>
</div>

<div class="input-container">
    <label for="OdeljenjeSaKojegJeOtpustIzvrsen">Одељење са којег је отпуст извршен:<span aria-label="required">*</span></label>
    <select name="OdeljenjeSaKojegJeOtpustIzvrsen"></select>
    <span class="ValidationMessage" id="OdeljenjeSaKojegJeOtpustIzvrsenMessage"></span>
</div>

<div class="input-container">
    <label for="VrstaOtpusta">Врсте отпуста:<span aria-label="required">*</span></label>
    <select name="VrstaOtpusta" id="VrstaOtpusta"></select>
    <span class="ValidationMessage" id="VrstaOtpustaMessage"></span>
</div>

<div class="input-container">
    <fieldset>
        <legend>Обдукован:</legend>
        <div><input type="radio" id="Obdukovan" name="Obdukovan" value="Да"><label>Да</label></div>
        <div><input type="radio" id="NeObdukovan" name="Obdukovan" value="Не" checked><label>Не</label></div>
    </fieldset>
</div>

<div class="input-container">
    <label for="OsnovniUzrokSmrti">Основни узрок смрти:</label>
    <select name="OsnovniUzrokSmrti" id="OsnovniUzrokSmrti" disabled></select>
    <span class="ValidationMessage" id="OsnovniUzrokSmrtiMessage"></span>
</div>

<div id="save-btn">
    <button type="submit" class="signup-btn" name="btnSnimiVozilo" value="Измени">Измени</button>
</div>

</div>
</form>
