<h1 class="form-header-hospitalizacija">Пријем пацијента</h1>

<form name="prijemForm" id="prijemForm">
<input type="hidden" name="idPacijenta" value="<?php echo htmlspecialchars($idPacijenta ?? ''); ?>">

<div class="form-container-hospitalizacija">

<div class="input-container">
    <label for="OdeljenjeNaPrijemu">Одељење на пријему:<span aria-label="required">*</span></label>
    <select name="OdeljenjeNaPrijemu">
        <option value="">изаберите</option>
    </select>
    <span class="ValidationMessage" id="OdeljenjeNaPrijemuMessage"></span>
</div>

<div class="input-container">
    <label for="UputnaDijagnoza">Упутна дијагноза:<span aria-label="required">*</span></label>
    <select name="UputnaDijagnoza">
        <option value="">изаберите</option>
    </select>
    <span class="ValidationMessage" id="UputnaDijagnozaMessage"></span>
</div>

<div class="input-container">
    <label for="TezinaNaPrijemu">Тежина на пријему:</label>
    <input type="number" name="TezinaNaPrijemu" placeholder="1000">
    <span class="ValidationMessage" id="TezinaNaPrijemuMessage"></span>
</div>

<div class="input-container">
    <label for="DatumPrijema">Датум пријема:<span aria-label="required">*</span></label>
    <input type="date" name="DatumPrijema" required>
    <span class="ValidationMessage" id="DatumPrijemaMessage"></span>
</div>

<div class="input-container-radio">
    <fieldset>
        <legend>Повреда:</legend>
        <div>
            <input type="radio" id="Povredjen" name="Povreda" value="Да">
            <label>Да</label>
        </div>
        <div>
            <input type="radio" id="NePovredjen" name="Povreda" value="Не" checked>
            <label>Не</label>
        </div>
    </fieldset>
</div>

<div class="input-container">
    <label for="SpoljniUzrokPovrede">Спољни узрок повреде:</label>
    <select name="SpoljniUzrokPovrede" id="UzrokPovrede" disabled>
        <option value="">изаберите</option>
    </select>
    <span class="ValidationMessage" id="SpoljniUzrokPovredeMessage"></span>
</div>

<div id="prijem-status"></div>

<div id="save-btn">
    <button type="submit" id="Enter" class="save-btn" name="btnSnimiVozilo" value="Сними">Сними</button>
</div>

</div>
</form>
