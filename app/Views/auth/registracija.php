<div class="d-flex justify-content-center align-items-center py-4">
    <div class="form-container-login" style="min-width:340px; max-width:480px; width:100%;">
        <h1 class="mb-4 fs-3">Региструј се</h1>
        <form name="registracijaForm" id="registracijaForm" novalidate>

            <div class="row g-3 mb-3">
                <div class="col-6">
                    <label for="ime" class="form-label">Име<span aria-label="required">*</span></label>
                    <input type="text" class="form-control" name="ime" id="ime"
                           placeholder="Унесите име" required>
                </div>
                <div class="col-6">
                    <label for="prezime" class="form-label">Презиме<span aria-label="required">*</span></label>
                    <input type="text" class="form-control" name="prezime" id="prezime"
                           placeholder="Унесите презиме" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="korisnickoIme" class="form-label">Корисничко име<span aria-label="required">*</span></label>
                <input type="text" class="form-control" name="korisnickoIme" id="korisnickoIme"
                       placeholder="Унесите корисничко име" required autocomplete="username">
            </div>

            <div class="row g-3 mb-3">
                <div class="col-6">
                    <label for="sifra" class="form-label">Шифра<span aria-label="required">*</span></label>
                    <input type="password" class="form-control" name="sifra" id="sifra"
                           placeholder="Унесите шифру" required autocomplete="new-password">
                </div>
                <div class="col-6">
                    <label for="potvrdaSifre" class="form-label">Потврда шифре<span aria-label="required">*</span></label>
                    <input type="password" class="form-control" name="potvrdaSifre" id="potvrdaSifre"
                           placeholder="Поновите шифру" required autocomplete="new-password">
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Е-маил<span aria-label="required">*</span></label>
                <input type="email" class="form-control" name="email" id="email"
                       placeholder="Унесите е-маил" required autocomplete="email">
            </div>

            <div class="mb-3">
                <label for="telefon" class="form-label">Телефон<span aria-label="required">*</span></label>
                <input type="text" class="form-control" name="telefon" id="telefon"
                       placeholder="+381..." required>
            </div>

            <div class="mb-3">
                <label for="specijalizacija" class="form-label">Специјализација</label>
                <input type="text" class="form-control" name="specijalizacija" id="specijalizacija"
                       placeholder="Шифра специјализације (необавезно)" maxlength="10">
            </div>

            <div class="mb-3">
                <label for="kodRegistracije" class="form-label">
                    Код регистрације<span aria-label="required">*</span>
                </label>
                <input type="text" class="form-control" name="kodRegistracije" id="kodRegistracije"
                       placeholder="5-цифрени код" pattern="[123][0-9]{4}"
                       minlength="5" maxlength="5" required autocomplete="off">
              
            </div>

            <div class="d-flex flex-column align-items-center gap-2 mt-3">
                <span class="ValidationMessage" id="RegistracijaMessage"></span>
                <button type="submit" class="btn btn-primary w-100">Региструј се</button>
                <a href="<?= APP_BASE ?>/prijava" class="text-center"
                   style="font-size:0.85rem; color:rgba(255,255,255,0.6);">
                    Већ имаш налог? Пријави се
                </a>
            </div>

        </form>
    </div>
</div>
