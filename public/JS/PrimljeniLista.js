document.addEventListener('DOMContentLoaded', () => {
    const uloga    = document.body.dataset.uloga || '';
    const jeSestra = uloga === 'Медицинска сестра';

    const statusEl = document.getElementById('primljeni-status');
    const bodyEl   = document.getElementById('primljeni-body');
    const filterInput = document.getElementById('filter');

    if (!bodyEl) return;

    if (jeSestra) {
        const thHiden = document.getElementById('thHiden');
        if (thHiden) thHiden.style.display = 'none';
    }

    const params      = new URLSearchParams(window.location.search);
    const filterValue = params.get('filter') || '';
    if (filterInput) filterInput.value = filterValue;

    const apiUrl = filterValue
        ? `api/prijem-lista?filter=${encodeURIComponent(filterValue)}`
        : 'api/prijem-lista';

    fetch(apiUrl, { credentials: 'same-origin' })
        .then(r => { if (!r.ok) throw new Error('Request failed'); return r.json(); })
        .then(data => {
            const items = Array.isArray(data.items) ? data.items : [];
            if (items.length === 0) {
                if (statusEl) statusEl.textContent = 'Нема података';
                return;
            }
            if (statusEl) statusEl.textContent = '';

            items.forEach(item => {
                const id        = item.id || '';
                const idTretman = id + 'tretman';
                const idOtpust  = id;

                const row = document.createElement('tr');

                const tdBroj = document.createElement('td');
                tdBroj.id = 'th1';
                tdBroj.innerHTML = `<b><font>${item.brojIstorijeBolesti || ''}</font>`;

                const tdOdel = document.createElement('td');
                tdOdel.id = 'th2';
                tdOdel.innerHTML = `<b><font>${item.odeljenjeNaPrijemu || ''}</font>`;

                const tdDij = document.createElement('td');
                tdDij.id = 'th3';
                tdDij.innerHTML = `<b><font>${item.uputnaDijagnoza || ''}</font>`;

                const tdDatum = document.createElement('td');
                tdDatum.id = 'th4';
                tdDatum.innerHTML = `<b><font>${item.datumPrijema || ''}</font>`;

                row.appendChild(tdBroj);
                row.appendChild(tdOdel);
                row.appendChild(tdDij);
                row.appendChild(tdDatum);

                if (!jeSestra) {
                    const tdAkcije = document.createElement('td');
                    tdAkcije.id = 'th5';

                    const tretmanForm = document.createElement('form');
                    tretmanForm.action = 'medicinski-tretmani-unos';
                    tretmanForm.id     = idTretman;
                    tretmanForm.method = 'GET';
                    const tretmanHidden = document.createElement('input');
                    tretmanHidden.type  = 'hidden';
                    tretmanHidden.name  = 'IdPrijema';
                    tretmanHidden.value = id;
                    const tretmanIcon = document.createElement('span');
                    tretmanIcon.className = 'material-symbols-outlined';
                    tretmanIcon.setAttribute('tretman', idTretman);
                    tretmanIcon.textContent = 'prescriptions';
                    tretmanForm.appendChild(tretmanHidden);
                    tretmanForm.appendChild(tretmanIcon);

                    const otpustForm = document.createElement('form');
                    otpustForm.action = 'hospitalizacija-unos';
                    otpustForm.id     = idOtpust;
                    otpustForm.method = 'GET';
                    const otpustHidden = document.createElement('input');
                    otpustHidden.type  = 'hidden';
                    otpustHidden.name  = 'IdPrijema';
                    otpustHidden.value = id;
                    const otpustIcon = document.createElement('span');
                    otpustIcon.className = 'material-symbols-outlined';
                    otpustIcon.setAttribute('otpust', idOtpust);
                    otpustIcon.textContent = 'tab_move';
                    otpustForm.appendChild(otpustHidden);
                    otpustForm.appendChild(otpustIcon);

                    tdAkcije.appendChild(tretmanForm);
                    tdAkcije.appendChild(otpustForm);
                    row.appendChild(tdAkcije);
                }

                bodyEl.appendChild(row);
            });

            // Vezivanje klikova na ikonice sa slanjem formi
            if (!jeSestra) {
                document.querySelectorAll('[otpust]').forEach(icon => {
                    icon.addEventListener('click', () => {
                        document.getElementById(icon.getAttribute('otpust'))?.submit();
                    });
                });
                document.querySelectorAll('[tretman]').forEach(icon => {
                    icon.addEventListener('click', () => {
                        document.getElementById(icon.getAttribute('tretman'))?.submit();
                    });
                });
            }
        })
        .catch(() => {
            if (statusEl) statusEl.textContent = 'Грешка при учитавању';
        });
});
