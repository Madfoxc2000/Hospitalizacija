<div class="form-container-tretman">
<h1 class="form-header-hospitalizacija">Унос Активности</h1>
<form name="aktivnostForm" id="aktivnostForm">
<input type="hidden" name="IdPrijema" value="<?php echo htmlspecialchars($IdPrijema ?? ''); ?>">

<div class="input-container-tipAktivnosti">
    <label for="TipAktivnosti">Тип Активности<span aria-label="required">*</span></label>
    <select name="TipAktivnosti" id="TipAktivnosti">
        <option value="">изаберите</option>
    </select>
    <span class="ValidationMessage" id="TipAktivnostiMessage"></span>
</div>

<div class="input-container">
    <label for="DatumIzvrsenja">Датум извршења:<span aria-label="required">*</span></label>
    <input type="date" name="DatumIzvrsenja" required>
    <span class="ValidationMessage" id="DatumIzvrsenjaMessage"></span>
</div>

<div class="input-container">
    <label for="Opis">Опис<span aria-label="required">*</span></label>
    <textarea name="Opis" cols="30" rows="4"></textarea>
    <span class="ValidationMessage" id="OpisMessage"></span>
</div>

<div id="tretman-status"></div>

<div id="save-btn">
    <button type="submit" id="Enter" class="save-btn" name="btnSnimiVozilo" value="Сними">Сними</button>
</div>

</form>
</div>
