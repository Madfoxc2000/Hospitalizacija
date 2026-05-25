import {
    invalid,
    containsOnlyLettersAndNumbers,
} from "./JsValidacije.js";

const vrstaOtpustaEl      = document.getElementById('VrstaOtpusta');
const osnovniUzrokSmrtiEl = document.getElementById('OsnovniUzrokSmrti');
const obdukovanEl         = document.getElementById('Obdukovan');
const neObdukovanEl       = document.getElementById('NeObdukovan');

function setDeathFieldsEnabled(enabled) {
    osnovniUzrokSmrtiEl.disabled = !enabled;
    obdukovanEl.disabled         = !enabled;
    neObdukovanEl.disabled       = !enabled;
}

vrstaOtpustaEl.addEventListener('change', function () {
    setDeathFieldsEnabled(this.value == 6);
});

// ── Populate dropdowns on load ──────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    fetch('api/hospitalizacija-form-data', { credentials: 'same-origin' })
        .then(r => { if (!r.ok) throw new Error('fetch failed'); return r.json(); })
        .then(data => {
            const uzrokSel  = document.querySelector("select[name='OsnovniUzrokHospitalizacije']");
            const smrtiSel  = document.getElementById('OsnovniUzrokSmrti');
            const odeljSel  = document.querySelector("select[name='OdeljenjeSaKojegJeOtpustIzvrsen']");
            const otpustSel = document.getElementById('VrstaOtpusta');

            (data.mkb || []).forEach(item => {
                const text = item.sifra ? `${item.sifra} ${item.naziv || ''}`.trim() : item.naziv || '';
                if (uzrokSel) uzrokSel.appendChild(new Option(text, item.sifra));
                if (smrtiSel) smrtiSel.appendChild(new Option(text, item.sifra));
            });

            (data.odeljenja || []).forEach(item => {
                const text = item.oznaka ? `${item.oznaka} ${item.naziv || ''}`.trim() : item.naziv || '';
                if (odeljSel) odeljSel.appendChild(new Option(text, item.oznaka));
            });

            (data.otpusti || []).forEach(item => {
                const text = item.sifra ? `${item.sifra} ${item.naziv || ''}`.trim() : item.naziv || '';
                if (otpustSel) otpustSel.appendChild(new Option(text, item.sifra));
            });
        })
        .catch(() => {
            const statusEl = document.getElementById('hospitalizacija-edit-status');
            if (statusEl) statusEl.textContent = 'Грешка при учитавању података форме';
        });
});

// ── Validation ──────────────────────────────────────────────────────────────
const PrateceDijagnoze = document.forms['hospitalizacijaForm']['PrateceDijagnoze'];
const DatumOtpusta     = document.forms['hospitalizacijaForm']['DatumOtpusta'];

PrateceDijagnoze.oninvalid = invalid;
PrateceDijagnoze.oninput   = invalid;
DatumOtpusta.oninvalid     = invalid;
DatumOtpusta.oninput       = invalid;

const OsnovniUzrokHospitalizacijeMessage = document.getElementById('OsnovniUzrokHospitalizacijeMessage');
const PrateceDijagnozeMessage            = document.getElementById('PrateceDijagnozeMessage');
const DatumOtpustaMessage                = document.getElementById('DatumOtpustaMessage');
const OdeljenjeSaKojegJeOtpustIzvrsenMsg = document.getElementById('OdeljenjeSaKojegJeOtpustIzvrsenMessage');
const VrstaOtpustaMessage                = document.getElementById('VrstaOtpustaMessage');

function validateForm() {
    const form = document.forms['hospitalizacijaForm'];

    if (form['OsnovniUzrokHospitalizacije'].value === '') {
        OsnovniUzrokHospitalizacijeMessage.textContent = 'Морате одабрати основни узрок хоспитализације';
        return false;
    }
    OsnovniUzrokHospitalizacijeMessage.textContent = '';

    if (!containsOnlyLettersAndNumbers(form['PrateceDijagnoze'].value)) {
        PrateceDijagnozeMessage.textContent = 'Поље може садржати само слова и бројеве';
        return false;
    }
    PrateceDijagnozeMessage.textContent = '';

    if (form['OdeljenjeSaKojegJeOtpustIzvrsen'].value === '') {
        OdeljenjeSaKojegJeOtpustIzvrsenMsg.textContent = 'Морате одабрати одељење';
        return false;
    }
    OdeljenjeSaKojegJeOtpustIzvrsenMsg.textContent = '';

    if (form['VrstaOtpusta'].value === '') {
        VrstaOtpustaMessage.textContent = 'Морате одабрати врсту отпуста';
        return false;
    }
    VrstaOtpustaMessage.textContent = '';

    return true;
}

// ── Submit via fetch() ───────────────────────────────────────────────────────
document.getElementById('hospitalizacijaForm').addEventListener('submit', function (event) {
    event.preventDefault();

    if (!validateForm()) return;

    const statusEl = document.getElementById('hospitalizacija-edit-status');
    if (statusEl) statusEl.textContent = 'Чување...';

    const formData = new FormData(this);
    if (osnovniUzrokSmrtiEl && osnovniUzrokSmrtiEl.disabled) {
        formData.set('OsnovniUzrokSmrti', osnovniUzrokSmrtiEl.value || '');
    }

    const isEdit   = /hospitalizacija-izmeni/.test(window.location.pathname);
    const endpoint = isEdit ? 'api/hospitalizacija-izmeni' : 'api/hospitalizacija-unos';
    const method   = isEdit ? 'PUT' : 'POST';

    fetch(endpoint, {
        method,
        credentials: 'same-origin',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams(formData).toString(),
    })
        .then(r => r.text().then(text => {
            let data;
            try { data = JSON.parse(text); } catch (e) {
                if (statusEl) statusEl.textContent = 'Одговор сервера: ' + text.substring(0, 400);
                throw new Error('invalid_json');
            }
            return { ok: r.ok, data };
        }))
        .then(({ ok, data }) => {
            if (ok && data && data.ok) {
                window.location.href = 'hospitalizacija-lista-filter';
            } else {
                if (statusEl) statusEl.textContent = (data && data.error) || 'Грешка при чувању';
            }
        })
        .catch(e => {
            if (e.message !== 'invalid_json' && statusEl) statusEl.textContent = 'Грешка при чувању';
        });
});
