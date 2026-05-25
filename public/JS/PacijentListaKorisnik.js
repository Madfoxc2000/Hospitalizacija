document.addEventListener('DOMContentLoaded', () => {
    const tbody = document.getElementById('pacijenti-korisnik-body');
    const statusDiv = document.getElementById('pacijenti-korisnik-status');
    const filterForm = document.getElementById('filter-form-upper');

    function loadPacijenti(filter = '') {
        const url = filter
            ? `api/pacijent-lista?filter=${encodeURIComponent(filter)}`
            : 'api/pacijent-lista';

        fetch(url)
            .then(r => r.json())
            .then(data => {
                if (statusDiv) statusDiv.textContent = '';
                tbody.innerHTML = '';
                if (!data.pacijenti || data.pacijenti.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="4">НЕМА ПОДАТАКА</td></tr>';
                    return;
                }
                data.pacijenti.forEach(p => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td id="th1"><b><font>${p.BrojIstorijeBolesti}</font></b></td>
                        <td id="th2"><b><font>${p.Ime}</font></b></td>
                        <td id="th3"><b><font>${p.Prezime}</font></b></td>
                        <td id="th4"><b><font>${p.DatumRodjenja}</font></b></td>
                    `;
                    tbody.appendChild(tr);
                });
            })
            .catch(() => {
                if (statusDiv) statusDiv.textContent = 'Грешка при учитавању.';
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
