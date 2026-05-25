document.addEventListener('DOMContentLoaded', () => {
    const statusEl    = document.getElementById('pacijenti-status');
    const bodyEl      = document.getElementById('pacijenti-body');
    const filterInput = document.getElementById('filter');

    if (!bodyEl) return;

    const params      = new URLSearchParams(window.location.search);
    const filterValue = params.get('filter') || '';
    if (filterInput) filterInput.value = filterValue;

    const apiUrl = filterValue
        ? `api/pacijent-lista?filter=${encodeURIComponent(filterValue)}`
        : 'api/pacijent-lista';

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
                const id        = item.brojIstorijeBolesti || '';
                const idUpdate  = id + 'update';
                const idDelete  = id;
                const idPrijem  = id + 'prijem';

                const row = document.createElement('tr');

                const tdBroj = document.createElement('td');
                tdBroj.id = 'th1';
                tdBroj.innerHTML = `<b><font>${id}</font><br/>`;

                const tdIme = document.createElement('td');
                tdIme.id = 'th2';
                tdIme.innerHTML = `<b><font>${item.ime || ''}</font><br/>`;

                const tdPrezime = document.createElement('td');
                tdPrezime.id = 'th3';
                tdPrezime.innerHTML = `<b><font>${item.prezime || ''}</font><br/>`;

                const tdDatum = document.createElement('td');
                tdDatum.id = 'th4';
                tdDatum.innerHTML = `<b><font>${item.datumRodjenja || ''}</font><br/>`;

                const tdAkcije = document.createElement('td');
                tdAkcije.id = 'th5';

                const editForm = document.createElement('form');
                editForm.action = 'pacijent-izmeni';
                editForm.id     = idUpdate;
                editForm.method = 'GET';
                const editHidden = document.createElement('input');
                editHidden.type  = 'hidden';
                editHidden.name  = 'idPacijenta';
                editHidden.value = id;
                const editIcon = document.createElement('span');
                editIcon.className = 'material-symbols-outlined';
                editIcon.setAttribute('update', idUpdate);
                editIcon.textContent = 'edit_document';
                editForm.appendChild(editHidden);
                editForm.appendChild(editIcon);

                const deleteForm = document.createElement('form');
                deleteForm.action    = 'api/pacijent-obrisi';
                deleteForm.id        = idDelete;
                deleteForm.className = 'deleteForm';
                deleteForm.method    = 'POST';
                const deleteHidden = document.createElement('input');
                deleteHidden.type  = 'hidden';
                deleteHidden.name  = 'idPacijenta';
                deleteHidden.value = id;
                const deleteIcon = document.createElement('span');
                deleteIcon.className = 'material-symbols-outlined delete-button';
                deleteIcon.setAttribute('data-submit-form', idDelete);
                deleteIcon.textContent = 'delete';
                deleteForm.appendChild(deleteHidden);
                deleteForm.appendChild(deleteIcon);

                const prijemForm = document.createElement('form');
                prijemForm.action = 'pacijent-prijem';
                prijemForm.id     = idPrijem;
                prijemForm.method = 'GET';
                const prijemHidden = document.createElement('input');
                prijemHidden.type  = 'hidden';
                prijemHidden.name  = 'idPacijenta';
                prijemHidden.value = id;
                const prijemIcon = document.createElement('span');
                prijemIcon.className = 'material-symbols-outlined';
                prijemIcon.setAttribute('prijem', idPrijem);
                prijemIcon.textContent = 'bedroom_child';
                prijemForm.appendChild(prijemHidden);
                prijemForm.appendChild(prijemIcon);

                tdAkcije.appendChild(editForm);
                tdAkcije.appendChild(deleteForm);
                tdAkcije.appendChild(prijemForm);

                row.appendChild(tdBroj);
                row.appendChild(tdIme);
                row.appendChild(tdPrezime);
                row.appendChild(tdDatum);
                row.appendChild(tdAkcije);
                bodyEl.appendChild(row);
            });

            // Wire icon clicks
            document.querySelectorAll('[update]').forEach(icon => {
                icon.addEventListener('click', () => {
                    document.getElementById(icon.getAttribute('update'))?.submit();
                });
            });
            document.querySelectorAll('[prijem]').forEach(icon => {
                icon.addEventListener('click', () => {
                    document.getElementById(icon.getAttribute('prijem'))?.submit();
                });
            });
            document.querySelectorAll('[data-submit-form]').forEach(icon => {
                icon.addEventListener('click', e => {
                    e.preventDefault();
                    const formId = icon.getAttribute('data-submit-form');
                    window.showConfirmationPopup && showConfirmationPopup(formId);
                });
            });
        })
        .catch(() => {
            if (statusEl) statusEl.textContent = 'Грешка при учитавању';
        });
});

function showConfirmationPopup(formId) {
    const popup         = document.getElementById('popup');
    const confirmDelete = document.getElementById('confirmDelete');
    const cancelDelete  = document.getElementById('cancelDelete');

    popup.style.display = 'flex';

    const onConfirm = () => {
        popup.style.display = 'none';
        document.getElementById(formId)?.submit();
        confirmDelete.removeEventListener('click', onConfirm);
    };
    const onCancel = () => {
        popup.style.display = 'none';
        cancelDelete.removeEventListener('click', onCancel);
    };

    confirmDelete.addEventListener('click', onConfirm);
    cancelDelete.addEventListener('click', onCancel);
}
