<h1 class="form-header-hospitalizacija">Унос отпуста</h1>

<form name="hospitalizacijaForm" id="hospitalizacijaForm">

<div class="form-container-hospitalizacija">

<input type="hidden" name="IdPrijema" value="<?php echo htmlspecialchars($IDPrijema ?? ''); ?>">

<div class="input-container">
    <label for="OsnovniUzrokHospitalizacije">Основни узрок хоспитализација:<span aria-label="required">*</span></label>
    <select name="OsnovniUzrokHospitalizacije">
        <option value="">изаберите</option>
    </select>
    <span class="ValidationMessage" id="OsnovniUzrokHospitalizacijeMessage"></span>
</div>

<div class="input-container">
    <label for="PrateceDijagnoze">Пратеће дијагнозе:<span aria-label="required">*</span></label>
    <input type="text" name="PrateceDijagnoze" placeholder="LOO L99">
    <span class="ValidationMessage" id="PrateceDijagnozeMessage"></span>
</div>

<div class="input-container">
    <label for="BrojSatiVentilatornePodrske">Број сати вентилаторне подршке:</label>
    <input type="number" name="BrojSatiVentilatornePodrske" placeholder="10">
</div>

<div class="input-container">
    <label for="DatumOtpusta">Датум отпуста:<span aria-label="required">*</span></label>
    <input type="date" name="DatumOtpusta" required>
    <span class="ValidationMessage" id="DatumOtpustaMessage"></span>
</div>

<div class="input-container">
    <label for="OdeljenjeSaKojegJeOtpustIzvrsen">Одељење са којег је отпуст извршен:<span aria-label="required">*</span></label>
    <select name="OdeljenjeSaKojegJeOtpustIzvrsen">
        <option value="">изаберите</option>
    </select>
    <span class="ValidationMessage" id="OdeljenjeSaKojegJeOtpustIzvrsenMessage"></span>
</div>

<div class="input-container">
    <label for="VrstaOtpusta">Врста отпуста:<span aria-label="required">*</span></label>
    <select name="VrstaOtpusta" id="VrstaOtpusta">
        <option value="">изаберите</option>
    </select>
    <span class="ValidationMessage" id="VrstaOtpustaMessage"></span>
</div>

<div class="input-container-radio">
    <fieldset>
        <legend>Обдукован:</legend>
        <div>
            <input type="radio" id="Obdukovan" name="Obdukovan" value="Да" disabled>
            <label>Да</label>
        </div>
        <div>
            <input type="radio" id="NeObdukovan" name="Obdukovan" value="Не" disabled>
            <label>Не</label>
        </div>
    </fieldset>
</div>

<div class="input-container">
    <label for="OsnovniUzrokSmrti">Основни узрок smrti:</label>
    <select name="OsnovniUzrokSmrti" id="OsnovniUzrokSmrti" disabled>
        <option value="">изаберите</option>
    </select>
    <span class="ValidationMessage" id="OsnovniUzrokSmrtiMessage"></span>
</div>

<div id="hospitalizacija-edit-status"></div>

<div id="save-btn">
    <button type="submit" id="Enter" class="save-btn" name="btnSnimiVozilo" value="Сними">Сними</button>
</div>

</div>
</form>
