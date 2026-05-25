document.addEventListener("DOMContentLoaded", () => {
    const statusEl = document.getElementById("hospitalizacije-korisnik-status");
    const bodyEl = document.getElementById("hospitalizacije-korisnik-body");
    const filterInput = document.getElementById("filter");
    const filterPrint = document.getElementById("filter-print");
    const formUpper = document.getElementById("filter-form-upper");

    if (!statusEl || !bodyEl) {
        return;
    }

    const params = new URLSearchParams(window.location.search);
    const filterValue = params.get("filter") || "";

    if (filterInput) {
        filterInput.value = filterValue;
    }
    if (filterPrint) {
        filterPrint.value = filterValue;
    }

    if (formUpper) {
        formUpper.addEventListener("submit", () => {
            const val = filterInput ? filterInput.value : "";
            if (filterPrint) {
                filterPrint.value = val;
            }
        });
    }

    const apiUrl = filterValue
        ? `api/hospitalizacije-korisnik?filter=${encodeURIComponent(filterValue)}`
        : "api/hospitalizacije-korisnik";

    fetch(apiUrl, { credentials: "same-origin" })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Request failed");
            }
            return response.json();
        })
        .then((data) => {
            const items = Array.isArray(data.items) ? data.items : [];
            if (items.length === 0) {
                statusEl.textContent = "Nema podataka";
                return;
            }

            statusEl.textContent = "";
            items.forEach((item) => {
                const row = document.createElement("tr");

                const tdBroj = document.createElement("td");
                tdBroj.id = "th1";
                tdBroj.innerHTML = `<b><font>${item.brojIstorijeBolesti || ""}</font><br/>`;

                const tdUzrok = document.createElement("td");
                tdUzrok.id = "th2";
                tdUzrok.innerHTML = `<b><font>${item.osnovniUzrokHospitalizacije || ""}</font><br/>`;

                const tdPrijem = document.createElement("td");
                tdPrijem.id = "th3";
                tdPrijem.innerHTML = `<b><font>${item.datumPrijema || ""}</font><br/>`;

                const tdOtpust = document.createElement("td");
                tdOtpust.id = "th4";
                tdOtpust.innerHTML = `<b><font>${item.datumOtpusta || ""}</font><br/>`;

                row.appendChild(tdBroj);
                row.appendChild(tdUzrok);
                row.appendChild(tdPrijem);
                row.appendChild(tdOtpust);

                bodyEl.appendChild(row);
            });
        })
        .catch(() => {
            statusEl.textContent = "Greska pri ucitavanju";
        });
});
