<div class="form-container-tretman">
    <h1 class="form-header-hospitalizacija">Унос Активности</h1>
    <form name="aktivnostForm" id="aktivnostForm">
        <input type="hidden" name="IdPrijema" value="<?php echo htmlspecialchars($IdPrijema ?? ''); ?>">

        <div class="mb-3">
            <label class="form-label" for="TipAktivnosti">Тип Активности<span aria-label="required">*</span></label>
            <select class="form-select" name="TipAktivnosti" id="TipAktivnosti">
                <option value="">изаберите</option>
            </select>
            <span class="ValidationMessage" id="TipAktivnostiMessage"></span>
        </div>

        <div class="mb-3">
            <label class="form-label" for="DatumIzvrsenja">Датум извршења<span aria-label="required">*</span></label>
            <input type="date" class="form-control" name="DatumIzvrsenja" required>
            <span class="ValidationMessage" id="DatumIzvrsenjaMessage"></span>
        </div>

        <div class="mb-3">
            <label class="form-label" for="Opis">Опис<span aria-label="required">*</span></label>
            <textarea class="form-control" name="Opis" rows="4"></textarea>
            <span class="ValidationMessage" id="OpisMessage"></span>
        </div>

        <div id="tretman-status"></div>

        <div class="d-flex justify-content-center mt-3">
            <button type="submit" id="Enter" class="btn btn-primary px-5" name="btnSnimiVozilo" value="Сними">Сними</button>
        </div>
    </form>
</div>
