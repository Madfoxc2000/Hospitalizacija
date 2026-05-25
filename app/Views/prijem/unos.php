<h1 class="form-header-hospitalizacija">Пријем пацијента</h1>

<form name="prijemForm" id="prijemForm">
<input type="hidden" name="idPacijenta" value="<?php echo htmlspecialchars($idPacijenta ?? ''); ?>">

<div class="form-container-hospitalizacija">
<div class="row g-3 justify-content-center px-2 py-3">

<div class="col-12 col-sm-6 col-md-4">
    <label class="form-label" for="OdeljenjeNaPrijemu">Одељење на пријему<span aria-label="required">*</span></label>
    <select class="form-select" name="OdeljenjeNaPrijemu">
        <option value="">изаберите</option>
    </select>
    <span class="ValidationMessage" id="OdeljenjeNaPrijemuMessage"></span>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <label class="form-label" for="UputnaDijagnoza">Упутна дијагноза<span aria-label="required">*</span></label>
    <select class="form-select" name="UputnaDijagnoza">
        <option value="">изаберите</option>
    </select>
    <span class="ValidationMessage" id="UputnaDijagnozaMessage"></span>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <label class="form-label" for="TezinaNaPrijemu">Тежина на пријему</label>
    <input type="number" class="form-control" name="TezinaNaPrijemu" placeholder="1000">
    <span class="ValidationMessage" id="TezinaNaPrijemuMessage"></span>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <label class="form-label" for="DatumPrijema">Датум пријема<span aria-label="required">*</span></label>
    <input type="date" class="form-control" name="DatumPrijema" required>
    <span class="ValidationMessage" id="DatumPrijemaMessage"></span>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <fieldset class="border rounded p-2">
        <legend class="float-none w-auto px-1 fs-6">Повреда:</legend>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="Povredjen" name="Povreda" value="Да">
            <label class="form-check-label" for="Povredjen">Да</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="NePovredjen" name="Povreda" value="Не" checked>
            <label class="form-check-label" for="NePovredjen">Не</label>
        </div>
    </fieldset>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <label class="form-label" for="SpoljniUzrokPovrede">Спољни узрок повреде</label>
    <select class="form-select" name="SpoljniUzrokPovrede" id="UzrokPovrede" disabled>
        <option value="">изаберите</option>
    </select>
    <span class="ValidationMessage" id="SpoljniUzrokPovredeMessage"></span>
</div>

<div class="col-12" id="prijem-status"></div>

<div class="col-12 d-flex justify-content-center pb-3">
    <button type="submit" id="Enter" class="btn btn-primary px-5" name="btnSnimiVozilo" value="Сними">Сними</button>
</div>

</div>
</div>
</form>
