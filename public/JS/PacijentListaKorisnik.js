document.addEventListener('DOMContentLoaded', () => {
    const tbody = document.getElementById('pacijenti-korisnik-body');
    const statusDiv = document.getElementById('pacijenti-korisnik-status');
    const filterForm = document.getElementById('filter-form-upper');

    function loadPacijenti(filter = '') {
        const url = filter
            ? `api/pacijent-lista?filter=${encodeURIComponent(filter)}`
            : 'api/pacijent-lista';

        fetch(url, { credentials: 'same-origin' })
            .then(r => {
                if (!r.ok) {
                    if (statusDiv) statusDiv.textContent = 'Грешка: HTTP ' + r.status;
                    return Promise.reject(new Error('HTTP ' + r.status));
                }
                return r.json();
            })
            .then(data => {
                if (statusDiv) statusDiv.textContent = '';
                tbody.innerHTML = '';
                if (!data.items || data.items.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="4">НЕМА ПОДАТАКА</td></tr>';
                    return;
                }
                data.items.forEach(p => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td><b>${p.brojIstorijeBolesti}</b></td>
                        <td><b>${p.ime}</b></td>
                        <td><b>${p.prezime}</b></td>
                        <td><b>${p.datumRodjenja}</b></td>
                    `;
                    tbody.appendChild(tr);
                });
            })
            .catch(err => {
                if (statusDiv && !statusDiv.textContent.startsWith('Грешка:'))
                    statusDiv.textContent = 'Грешка при учитавању: ' + err.message;
            });
    }

    loadPacijenti();

    if (filterForm) {
        filterForm.addEventListener('submit', e => {
            e.preventDefault();
            const btn = e.submitter;
            if (btn && btn.name === 'svi') {
                loadPacijenti();
            } else {
                const filter = document.getElementById('filter')?.value ?? '';
                loadPacijenti(filter);
            }
        });
    }
});
