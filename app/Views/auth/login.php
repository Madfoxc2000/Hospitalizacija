<div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
    <div class="form-container-login">
        <h1 class="mb-4 fs-3">Пријави се</h1>
        <form name="prijavaForm" id="prijavaForm">
            <div class="mb-3">
                <label for="korisnickoIme" class="form-label">Корисник<span aria-label="required">*</span></label>
                <input type="text" class="form-control" name="korisnickoIme" placeholder="Унесите корисничко име" required>
            </div>
            <div class="mb-3">
                <label for="sifra" class="form-label">Шифра<span aria-label="required">*</span></label>
                <input type="password" class="form-control" name="sifra" placeholder="Унесите шифру" required>
            </div>
            <div class="d-flex flex-column align-items-center gap-2 mt-3">
                <span class="ValidationMessage" id="KorisnickoMessage"></span>
                <button type="submit" class="btn btn-primary w-100" name="loginuser" value="Пријави се">Пријави се</button>
                <a href="<?= APP_BASE ?>/registracija"
                   style="font-size:0.85rem; color:rgba(255,255,255,0.6);">
                    Нема налога? Региструј се
                </a>
            </div>
        </form>
    </div>
</div>
