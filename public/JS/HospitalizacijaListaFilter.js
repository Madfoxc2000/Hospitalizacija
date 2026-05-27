document.addEventListener("DOMContentLoaded", () => {
    const statusEl = document.getElementById("hospitalizacije-filter-status");
    const bodyEl = document.getElementById("hospitalizacije-filter-body");
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
        ? `api/hospitalizacije-filter?filter=${encodeURIComponent(filterValue)}`
        : "api/hospitalizacije-filter";

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
                tdBroj.innerHTML = `<b><font>${item.brojIstorijeBolesti || ""}</font>`;

                const tdUzrok = document.createElement("td");
                tdUzrok.id = "th2";
                tdUzrok.innerHTML = `<b><font>${item.osnovniUzrokHospitalizacije || ""}</font>`;

                const tdPrijem = document.createElement("td");
                tdPrijem.id = "th3";
                tdPrijem.innerHTML = `<b><font>${item.datumPrijema || ""}</font>`;

                const tdOtpust = document.createElement("td");
                tdOtpust.id = "th4";
                tdOtpust.innerHTML = `<b><font>${item.datumOtpusta || ""}</font>`;

                const tdAkcije = document.createElement("td");
                tdAkcije.id = "th5";

                const id = item.id || "";
                const updateId = `${id}update`;
                const printId = `${id}print`;
                const canEdit = window.APP_USER_ROLE !== "Медицинска сестра";

                if (canEdit) {
                    const editForm = document.createElement("form");
                    editForm.action = "hospitalizacija-izmeni";
                    editForm.method = "GET";
                    editForm.id = updateId;

                    const editHidden = document.createElement("input");
                    editHidden.type = "hidden";
                    editHidden.name = "IdHospitalizacije";
                    editHidden.value = id;

                    const editIcon = document.createElement("span");
                    editIcon.className = "material-symbols-outlined";
                    editIcon.setAttribute("update", updateId);
                    editIcon.textContent = "edit_document";

                    editForm.appendChild(editHidden);
                    editForm.appendChild(editIcon);
                    tdAkcije.appendChild(editForm);

                    const deleteForm = document.createElement("form");
                    deleteForm.action = "api/hospitalizacija-obrisi";
                    deleteForm.method = "POST";
                    deleteForm.id = id;
                    deleteForm.className = "deleteForm";
                    deleteForm.onsubmit = () => window.showConfirmationPopup && showConfirmationPopup();

                    const deleteHidden = document.createElement("input");
                    deleteHidden.type = "hidden";
                    deleteHidden.name = "IdHospitalizacije";
                    deleteHidden.value = id;

                    const deleteIcon = document.createElement("span");
                    deleteIcon.className = "material-symbols-outlined delete-button";
                    deleteIcon.setAttribute("data-submit-form", id);
                    deleteIcon.textContent = "delete";

                    deleteForm.appendChild(deleteHidden);
                    deleteForm.appendChild(deleteIcon);
                    tdAkcije.appendChild(deleteForm);
                }

                const printForm = document.createElement("form");
                printForm.action = "izvestaj-stampa";
                printForm.method = "GET";
                printForm.id = printId;

                const printHiddenId = document.createElement("input");
                printHiddenId.type = "hidden";
                printHiddenId.name = "IdHospitalizacije";
                printHiddenId.value = id;

                const printHiddenBroj = document.createElement("input");
                printHiddenBroj.type = "hidden";
                printHiddenBroj.name = "BrojIstorijeBolesti";
                printHiddenBroj.value = item.brojIstorijeBolesti || "";

                const printIcon = document.createElement("span");
                printIcon.className = "material-symbols-outlined";
                printIcon.setAttribute("print", printId);
                printIcon.textContent = "print_connect";

                printForm.appendChild(printHiddenId);
                printForm.appendChild(printHiddenBroj);
                printForm.appendChild(printIcon);

                tdAkcije.appendChild(printForm);

                row.appendChild(tdBroj);
                row.appendChild(tdUzrok);
                row.appendChild(tdPrijem);
                row.appendChild(tdOtpust);
                row.appendChild(tdAkcije);

                bodyEl.appendChild(row);
            });
        })
        .catch(() => {
            statusEl.textContent = "Greska pri ucitavanju";
        });
});
