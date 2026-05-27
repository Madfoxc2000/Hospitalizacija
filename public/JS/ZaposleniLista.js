function buildRow(fields) {
    return '<tr>' + fields.map(f => `<td>${f ?? ''}</td>`).join('') + '</tr>';
}

function renderError(tbodyId, colspan, msg) {
    document.getElementById(tbodyId).innerHTML =
        `<tr><td colspan="${colspan}" class="text-center text-danger">${msg}</td></tr>`;
}

function fetchStaff(uloga, tbodyId, buildRowFn, colspan) {
    fetch(`api/zaposleni-lista?uloga=${encodeURIComponent(uloga)}`, { credentials: 'same-origin' })
        .then(r => {
            if (!r.ok) throw new Error(r.status);
            return r.json();
        })
        .then(data => {
            const tbody = document.getElementById(tbodyId);
            if (!Array.isArray(data) || data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="${colspan}" class="text-center">Нема уписаних</td></tr>`;
                return;
            }
            tbody.innerHTML = data.map(buildRowFn).join('');
        })
        .catch(() => renderError(tbodyId, colspan, 'Грешка при учитавању'));
}

window.stampajZaposlene = function () {
    const kolone = Array.from(document.querySelectorAll('#tbl-sestre thead th'))
        .map(th => th.textContent.trim());
    stampajViseTabela('Особље болнице', [
        { tbodyId: 'tbody-sestre', podnaslov: 'Медицинске сестре / браћа', kolone },
        { tbodyId: 'tbody-lekari', podnaslov: 'Лекари', kolone },
    ]);
};

fetchStaff(
    'Медицинска сестра',
    'tbody-sestre',
    r => buildRow([r.PREZIME, r.IME, r.SPECIJALIZACIJA, r.Telefon, r.EMAIL, r.KORISNICKOIME]),
    6
);

fetchStaff(
    'Лекар',
    'tbody-lekari',
    r => buildRow([r.PREZIME, r.IME, r.SPECIJALIZACIJA, r.Telefon, r.EMAIL, r.KORISNICKOIME]),
    6
);
