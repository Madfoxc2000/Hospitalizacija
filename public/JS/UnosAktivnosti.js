import { invalid } from "./JsValidacije.js";

const DatumIzvrsenja = document.forms['aktivnostForm']['DatumIzvrsenja'];
DatumIzvrsenja.oninvalid = invalid;
DatumIzvrsenja.oninput   = invalid;

const TipAktivnostiMessage = document.getElementById('TipAktivnostiMessage');

// ── Populate TipAktivnosti on load ──────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    fetch('api/tretmani-tipovi', { credentials: 'same-origin' })
        .then(r => { if (!r.ok) throw new Error('fetch failed'); return r.json(); })
        .then(data => {
            const sel = document.getElementById('TipAktivnosti');
            if (!sel) return;
            (data.items || []).forEach(item => {
                const text = item.id ? `${item.id} ${item.naziv || ''}`.trim() : item.naziv || '';
                sel.appendChild(new Option(text, item.id));
            });
        })
        .catch(() => {
            const statusEl = document.getElementById('tretman-status');
            if (statusEl) statusEl.textContent = 'Грешка при учитавању података форме';
        });
});

function validateForm() {
    const tipSel = document.getElementById('TipAktivnosti');
    if (!tipSel || tipSel.value === '') {
        TipAktivnostiMessage.textContent = 'Морате одабрати тип активности';
        return false;
    }
    TipAktivnostiMessage.textContent = '';
    return true;
}

// ── Submit via fetch() ───────────────────────────────────────────────────────
document.getElementById('aktivnostForm').addEventListener('submit', function (event) {
    event.preventDefault();

    if (!validateForm()) return;

    const statusEl = document.getElementById('tretman-status');
    if (statusEl) statusEl.textContent = 'Чување...';

    fetch('api/tretmani-unos', {
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
