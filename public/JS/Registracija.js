import { invalid } from "./JsValidacije.js";

const form    = document.getElementById('registracijaForm');
const statusEl = document.getElementById('RegistracijaMessage');

// Vezivanje poruka validacije za obavezna polja
['ime', 'prezime', 'korisnickoIme', 'sifra', 'potvrdaSifre', 'email', 'telefon', 'kodRegistracije'].forEach(name => {
    const el = form.elements[name];
    if (el) {
        el.oninvalid = invalid;
        el.oninput   = invalid;
    }
});

const errorMessages = {
    missing_fields:  'Сва обавезна поља морају бити попуњена',
    invalid_code:    'Код мора бити тачно 5 цифара и почињати са 1, 2 или 3',
    username_taken:  'Корисничко име је већ заузето',
    register_failed: 'Грешка при регистрацији. Покушајте поново.',
};

form.addEventListener('submit', function (event) {
    event.preventDefault();
    statusEl.textContent = '';

    const sifra        = form.elements['sifra'].value;
    const potvrdaSifre = form.elements['potvrdaSifre'].value;

    if (sifra !== potvrdaSifre) {
        statusEl.textContent = 'Шифре се не подударају';
        return;
    }

    const kod = form.elements['kodRegistracije'].value;
    if (!/^[123]\d{4}$/.test(kod)) {
        statusEl.textContent = errorMessages.invalid_code;
        return;
    }

    const formData = new FormData(form);
    formData.delete('potvrdaSifre'); // not sent to server

    fetch('api/auth/register', {
        method:      'POST',
        credentials: 'same-origin',
        headers:     { 'Content-Type': 'application/x-www-form-urlencoded' },
        body:        new URLSearchParams(formData).toString(),
    })
        .then(r => r.json())
        .then(data => {
            if (data && data.ok && data.redirect) {
                window.location.href = data.redirect;
            } else {
                statusEl.textContent = errorMessages[data && data.error] || errorMessages.register_failed;
            }
        })
        .catch(() => {
            statusEl.textContent = 'Грешка при повезивању са сервером';
        });
});
