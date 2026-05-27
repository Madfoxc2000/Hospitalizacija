function _pripremiTabelu(tbodyId, kolone) {
    const tbody = document.getElementById(tbodyId);
    if (!tbody) return null;

    const rows = Array.from(tbody.querySelectorAll('tr'));
    if (rows.length === 0) return null;

    const thead = `<tr>${kolone.map(k => `<th>${k}</th>`).join('')}</tr>`;

    const tbodyHtml = rows.map(row => {
        const cells = Array.from(row.querySelectorAll('td'));
        const lastCell = cells[cells.length - 1];
        const printCells = (lastCell && lastCell.querySelector('form'))
            ? cells.slice(0, -1)
            : cells;
        return `<tr>${printCells.map(td => `<td>${td.textContent.trim()}</td>`).join('')}</tr>`;
    }).join('');

    return `<table><thead>${thead}</thead><tbody>${tbodyHtml}</tbody></table>`;
}

function _otvoriForzuStampe(sadrzaj) {
    const html = `<!DOCTYPE html>
<html lang="sr-RS">
<head>
<meta charset="UTF-8">
<title>Штампање</title>
<style>
body{font-family:Arial,sans-serif;font-size:12px;margin:20px;color:#000}
h2{font-size:15px;margin:0 0 10px}
h3{font-size:13px;margin:20px 0 6px;color:#333}
table{width:100%;border-collapse:collapse;margin-bottom:16px}
th,td{border:1px solid #555;padding:4px 8px;text-align:left;vertical-align:top}
th{background:#e0e0e0;font-weight:bold}
tr:nth-child(even) td{background:#f5f5f5}
</style>
</head>
<body>${sadrzaj}</body>
</html>`;
    const win = window.open('', '_blank');
    if (!win) { alert('Dozvolite iskačuće prozore za štampanje.'); return; }
    win.document.write(html);
    win.document.close();
    win.print();
    win.addEventListener('afterprint', () => win.close());
}

function stampajListu(tbodyId, naslov, kolone) {
    if (!kolone) {
        kolone = Array.from(document.querySelectorAll('th[id^="th"]'))
            .filter(th => th.textContent.trim() && th.id !== 'thHiden' && th.id !== 'th5')
            .map(th => th.textContent.trim());
    }
    const sekcija = _pripremiTabelu(tbodyId, kolone);
    if (!sekcija) return;
    _otvoriForzuStampe(`<h2>${naslov}</h2>${sekcija}`);
}

function stampajViseTabela(naslov, konfiguracije) {
    let sekcije = `<h2>${naslov}</h2>`;
    konfiguracije.forEach(({ tbodyId, podnaslov, kolone }) => {
        const sekcija = _pripremiTabelu(tbodyId, kolone);
        if (sekcija) sekcije += `<h3>${podnaslov}</h3>${sekcija}`;
    });
    _otvoriForzuStampe(sekcije);
}
