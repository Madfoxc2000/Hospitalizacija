document.addEventListener('DOMContentLoaded', () => {
    const statusEl = document.getElementById('pacijent-edit-status');
    const form     = document.getElementById('pacijentForm');

    if (!form) return;

    const idPacijenta = new URLSearchParams(window.location.search).get('idPacijenta') || '';
    if (!idPacijenta) {
        if (statusEl) statusEl.textContent = 'Недостаје ID пацијента';
        return;
    }

    fetch(`api/pacijent-izmeni?id=${encodeURIComponent(idPacijenta)}`, { credentials: 'same-origin' })
        .then(r => { if (!r.ok) throw new Error('Request failed'); return r.json(); })
        .then(data => {
            const p = data.pacijent || {};

            const set = (name, val) => {
                const el = form.querySelector(`[name='${name}']`);
                if (el) el.value = val || '';
            };

            set('BrojIstorijeBolesti', p.brojIstorijeBolesti);
            set('JMBG',               p.jmbg);
            set('Ime',                p.ime);
            set('Prezime',            p.prezime);
            set('ImeJednogRoditelja', p.imeJednogRoditelja);
            set('LBO',                p.lbo);
            set('ClanJePorodice',     p.clanJePorodice);
            set('Telefon',            p.telefon);
            set('DatumRodjenja',      p.datumRodjenja);
            set('Drzavljanstvo',      p.drzavljanstvo);
            set('Adresa',             p.adresa);

            const polVal = p.pol || '';
            form.querySelectorAll("input[name='Pol']").forEach(radio => {
                radio.checked = radio.value === polVal;
            });

            const osigSel = form.querySelector("select[name='OsnovOsiguranja']");
            const osnovi  = Array.isArray(data.osnovi) ? data.osnovi : [];
            if (osigSel) {
                osigSel.innerHTML = '<option value="">изаберите</option>';
                osnovi.forEach(item => {
                    const text = item.oznaka ? `${item.oznaka} ${item.naziv || ''}`.trim() : item.naziv || '';
                    osigSel.appendChild(new Option(text, item.oznaka));
                });
                osigSel.value = p.osnovOsiguranja || '';
            }

            if (statusEl) statusEl.textContent = '';
        })
        .catch(() => {
            if (statusEl) statusEl.textContent = 'Грешка при учитавању';
        });

    // ── Submit via fetch() ────────────────────────────────────────────────
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const st = document.getElementById('pacijent-edit-status');
        if (st) st.textContent = 'Чување...';

        fetch('api/pacijent-izmeni', {
            method: 'PUT',
            credentials: 'same-origin',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams(new FormData(this)).toString(),
        })
            .then(r => { if (!r.ok) throw new Error('Request failed'); return r.json(); })
            .then(data => {
                if (data && data.ok) {
                    window.location.href = 'pacijent-lista';
                } else {
                    if (st) st.textContent = data.error || 'Грешка при чувању';
                }
            })
            .catch(() => {
                if (st) st.textContent = 'Грешка при чувању';
            });
    });
});
