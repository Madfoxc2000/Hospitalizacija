import {
    invalid,
} from "./JsValidacije.js";

const povredjen   = document.getElementById('Povredjen');
const nePovredjen = document.getElementById('NePovredjen');
const povreda     = document.getElementById('UzrokPovrede');

povredjen.addEventListener('click',   () => { povreda.disabled = false; });
nePovredjen.addEventListener('click', () => { povreda.disabled = true;  });

// ── Populate dropdowns on load ──────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    fetch('api/prijem-form-data', { credentials: 'same-origin' })
        .then(r => { if (!r.ok) throw new Error('fetch failed'); return r.json(); })
        .then(data => {
            const odeljSel   = document.querySelector("select[name='OdeljenjeNaPrijemu']");
            const mkbSel     = document.querySelector("select[name='UputnaDijagnoza']");
            const spoljniSel = document.getElementById('UzrokPovrede');

            (data.odeljenja || []).forEach(item => {
                const text = item.oznaka ? `${item.oznaka} ${item.naziv || ''}`.trim() : item.naziv || '';
                if (odeljSel) odeljSel.appendChild(new Option(text, item.oznaka));
            });

            (data.mkb || []).forEach(item => {
                const text = item.sifra ? `${item.sifra} ${item.naziv || ''}`.trim() : item.naziv || '';
                if (mkbSel) mkbSel.appendChild(new Option(text, item.sifra));
            });

            (data.spoljniUzroci || []).forEach(item => {
                const text = item.sifra ? `${item.sifra} ${item.naziv || ''}`.trim() : item.naziv || '';
                if (spoljniSel) spoljniSel.appendChild(new Option(text, item.sifra));
            });
        })
        .catch(() => {
            const statusEl = document.getElementById('prijem-status');
            if (statusEl) statusEl.textContent = 'Грешка при учитавању података форме';
        });
});

// ── Validation ──────────────────────────────────────────────────────────────
const DatumPrijema      = document.forms['prijemForm']['DatumPrijema'];
const TezinaNaPrijemu   = document.forms['prijemForm']['TezinaNaPrijemu'];

DatumPrijema.oninvalid    = invalid;
DatumPrijema.oninput      = invalid;
TezinaNaPrijemu.oninvalid = invalid;
TezinaNaPrijemu.oninput   = invalid;

const OdeljenjeNaPrijemuMessage    = document.getElementById('OdeljenjeNaPrijemuMessage');
const UputnaDijagnozaMessage       = document.getElementById('UputnaDijagnozaMessage');

function validateForm() {
    const form = document.forms['prijemForm'];

    if (form['OdeljenjeNaPrijemu'].value === '') {
        OdeljenjeNaPrijemuMessage.textContent = 'Морате одабрати одељење на пријему';
        return false;
    }
    OdeljenjeNaPrijemuMessage.textContent = '';

    if (form['UputnaDijagnoza'].value === '') {
        UputnaDijagnozaMessage.textContent = 'Морате одабрати упутну дијагнозу';
        return false;
    }
    UputnaDijagnozaMessage.textContent = '';

    return true;
}

// ── Submit via fetch() ───────────────────────────────────────────────────────
document.getElementById('prijemForm').addEventListener('submit', function (event) {
    event.preventDefault();

    if (!validateForm()) return;

    const statusEl = document.getElementById('prijem-status');
    if (statusEl) statusEl.textContent = 'Чување...';

    fetch('api/prijem-unos', {
        method: 'POST',
        credentials: 'same-origin',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams(new FormData(this)).toString(),
    })
        .then(r => { if (!r.ok) throw new Error('Request failed'); return r.json(); })
        .then(data => {
            if (data && data.ok) {
                window.location.href = 'primljeni-pacijenti';
            } else {
                if (statusEl) statusEl.textContent = data.error || 'Грешка при чувању';
            }
        })
        .catch(() => {
            if (statusEl) statusEl.textContent = 'Грешка при чувању';
        });
});
