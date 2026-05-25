<h1 class="form-header-pacijent">Измени пацијента</h1>

<div id="pacijent-edit-status">Учитавање...</div>

<form name="pacijentForm" id="pacijentForm">
<div class="form-container-pacijent">
<div class="row g-3 justify-content-center px-2">

<input type="hidden" name="BrojIstorijeBolesti" value="">

<div class="col-12 col-sm-6 col-md-4">
    <label class="form-label" for="JMBG">ЈМБГ<span aria-label="required">*</span></label>
    <input type="number" class="form-control" name="JMBG" placeholder="1234567891234" required>
    <span class="ValidationMessage" id="JMBGMessage"></span>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <label class="form-label" for="Ime">Име<span aria-label="required">*</span></label>
    <input type="text" class="form-control" name="Ime" placeholder="Марко" required>
    <span class="ValidationMessage" id="ImeMessage"></span>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <label class="form-label" for="Prezime">Презиме<span aria-label="required">*</span></label>
    <input type="text" class="form-control" name="Prezime" placeholder="Марковић" required>
    <span class="ValidationMessage" id="PrezimeMessage"></span>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <label class="form-label" for="ImeJednogRoditelja">Ime једног родитеља<span aria-label="required">*</span></label>
    <input type="text" class="form-control" name="ImeJednogRoditelja" placeholder="Славко" required>
    <span class="ValidationMessage" id="ImeJednogRoditeljaMessage"></span>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <label class="form-label" for="LBO">ЛБО<span aria-label="required">*</span></label>
    <input type="number" class="form-control" name="LBO" placeholder="11111111111" required>
    <span class="ValidationMessage" id="LBOMessage"></span>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <label class="form-label" for="OsnovOsiguranja">Основ осигурања<span aria-label="required">*</span></label>
    <select class="form-select" name="OsnovOsiguranja">
        <option value="">изаберите</option>
    </select>
    <span class="ValidationMessage" id="OsnovOsiguranjaMessage"></span>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <label class="form-label" for="ClanJePorodice">Члан је породице<span aria-label="required">*</span></label>
    <input type="text" class="form-control" name="ClanJePorodice" placeholder="Славко" required>
    <span class="ValidationMessage" id="ClanJePorodiceMessage"></span>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <label class="form-label" for="Telefon">Телефон<span aria-label="required">*</span></label>
    <input type="tel" class="form-control" name="Telefon" placeholder="+381" required>
    <span class="ValidationMessage" id="TelefonMessage"></span>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <label class="form-label" for="DatumRodjenja">Датум рођења<span aria-label="required">*</span></label>
    <input type="date" class="form-control" name="DatumRodjenja" required>
    <span class="ValidationMessage" id="DatumRodjenjaMessage"></span>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <label class="form-label" for="Drzavljanstvo">Држављанство</label>
    <input type="text" class="form-control" name="Drzavljanstvo" placeholder="Srpsko">
    <span class="ValidationMessage" id="DrzavljanstvoMessage"></span>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <fieldset class="border rounded p-2">
        <legend class="float-none w-auto px-1 fs-6">Пол:</legend>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="Pol" id="PolMusko" value="Мушко">
            <label class="form-check-label" for="PolMusko">Мушко</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="Pol" id="PolZensko" value="Женско">
            <label class="form-check-label" for="PolZensko">Женско</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="Pol" id="PolDrugo" value="Друго" checked>
            <label class="form-check-label" for="PolDrugo">Друго</label>
        </div>
    </fieldset>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <label class="form-label" for="Adresa">Адреса</label>
    <input type="text" class="form-control" name="Adresa" placeholder="" required>
    <span class="ValidationMessage" id="Adresa"></span>
</div>

<div class="col-12 d-flex justify-content-center pb-3">
    <button type="submit" id="Enter" class="btn btn-primary px-5" name="btnSnimiVozilo" value="Сними">Сними</button>
</div>

</div>
</div>
</form>
