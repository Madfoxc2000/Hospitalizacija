import { invalid } from "./JsValidacije.js";

const korisnickoime = document.forms['prijavaForm']['korisnickoIme'];
const sifra         = document.forms['prijavaForm']['sifra'];

korisnickoime.oninvalid = invalid;
korisnickoime.oninput   = invalid;
sifra.oninvalid         = invalid;
sifra.oninput           = invalid;

document.getElementById('prijavaForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const statusEl = document.getElementById('KorisnickoMessage');

    fetch('api/auth/login', {
        method: 'POST',
        credentials: 'same-origin',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams(new FormData(this)).toString(),
    })
        .then(r => r.json())
        .then(data => {
            if (data && data.ok && data.redirect) {
                window.location.href = data.redirect;
            } else {
                if (statusEl) statusEl.textContent = 'Погрешно корисничко име или шифра';
            }
        })
        .catch(() => {
            if (statusEl) statusEl.textContent = 'Грешка при пријављивању';
        });
});
