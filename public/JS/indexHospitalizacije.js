document.addEventListener("DOMContentLoaded", () => {
    const statusEl = document.getElementById("hospitalizacije-status");
    const bodyEl = document.getElementById("hospitalizacije-body");

    if (!statusEl || !bodyEl) {
        return;
    }

    fetch("api/hospitalizacije-index", { credentials: "same-origin" })
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
                tdBroj.textContent = item.brojIstorijeBolesti ?? "";

                const tdUzrok = document.createElement("td");
                tdUzrok.textContent = item.osnovniUzrokHospitalizacije ?? "";

                const tdPrijem = document.createElement("td");
                tdPrijem.textContent = item.datumPrijema ?? "";

                const tdOtpust = document.createElement("td");
                tdOtpust.textContent = item.datumOtpusta ?? "";

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
