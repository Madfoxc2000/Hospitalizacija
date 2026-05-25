document.addEventListener("DOMContentLoaded", () => {
    const statusEl = document.getElementById("hospitalizacija-edit-status");
    const form = document.getElementById("hospitalizacijaForm");

    if (!form) {
        return;
    }

    const idInput = form.querySelector("input[name='IdHospitalizacije']");
    if (!idInput || !idInput.value) {
        if (statusEl) {
            statusEl.textContent = "Nedostaje ID";
        }
        return;
    }

    fetch(`api/hospitalizacija-izmeni?id=${encodeURIComponent(idInput.value)}`, {
        credentials: "same-origin"
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Request failed");
            }
            return response.json();
        })
        .then((data) => {
            const hospitalizacija = data.hospitalizacija || {};

            const idPrijemaInput = form.querySelector("input[name='IDPrijema']");
            if (idPrijemaInput) {
                idPrijemaInput.value = hospitalizacija.idPrijema || "";
            }

            const pratece = form.querySelector("input[name='PrateceDijagnoze']");
            if (pratece) {
                pratece.value = hospitalizacija.prateceDijagnoze || "";
            }

            const brojSati = form.querySelector("input[name='BrojSatiVentilatornePodrske']");
            if (brojSati) {
                brojSati.value = hospitalizacija.brojSatiVentilatornePodrske || "";
            }

            const datumOtpusta = form.querySelector("input[name='DatumOtpusta']");
            if (datumOtpusta) {
                datumOtpusta.value = hospitalizacija.datumOtpusta || "";
            }

            const uzrokSelect = form.querySelector("select[name='OsnovniUzrokHospitalizacije']");
            const smrtiSelect = form.querySelector("select[name='OsnovniUzrokSmrti']");
            const mkb = Array.isArray(data.mkb) ? data.mkb : [];

            if (uzrokSelect) {
                uzrokSelect.innerHTML = "";
                mkb.forEach((item) => {
                    const option = document.createElement("option");
                    option.value = item.sifra || "";
                    option.textContent = item.sifra || "";
                    uzrokSelect.appendChild(option);
                });
                uzrokSelect.value = hospitalizacija.osnovniUzrokHospitalizacije || "";
            }

            if (smrtiSelect) {
                smrtiSelect.innerHTML = "";
                mkb.forEach((item) => {
                    const option = document.createElement("option");
                    option.value = item.sifra || "";
                    option.textContent = item.sifra || "";
                    smrtiSelect.appendChild(option);
                });
                smrtiSelect.value = hospitalizacija.osnovniUzrokSmrti || "";
            }

            const odeljenjeSelect = form.querySelector("select[name='OdeljenjeSaKojegJeOtpustIzvrsen']");
            const odeljenja = Array.isArray(data.odeljenja) ? data.odeljenja : [];
            if (odeljenjeSelect) {
                odeljenjeSelect.innerHTML = "";
                odeljenja.forEach((item) => {
                    const option = document.createElement("option");
                    option.value = item.oznaka || "";
                    option.textContent = item.oznaka ? `${item.oznaka} ${item.naziv || ""}`.trim() : item.naziv || "";
                    odeljenjeSelect.appendChild(option);
                });
                odeljenjeSelect.value = hospitalizacija.odeljenjeSaKojegJeOtpustIzvrsen || "";
            }

            const otpustSelect = form.querySelector("select[name='VrstaOtpusta']");
            const otpusti = Array.isArray(data.otpusti) ? data.otpusti : [];
            if (otpustSelect) {
                otpustSelect.innerHTML = "";
                otpusti.forEach((item) => {
                    const option = document.createElement("option");
                    option.value = item.sifra || "";
                    option.textContent = item.sifra ? `${item.sifra} ${item.naziv || ""}`.trim() : item.naziv || "";
                    otpustSelect.appendChild(option);
                });
                otpustSelect.value = hospitalizacija.vrstaOtpusta || "";
                otpustSelect.dispatchEvent(new Event("change"));
            }

            const obdukovanDa = document.getElementById("Obdukovan");
            const obdukovanNe = document.getElementById("NeObdukovan");
            if (hospitalizacija.obdukovan === "Да") {
                if (obdukovanDa) {
                    obdukovanDa.checked = true;
                }
            } else if (hospitalizacija.obdukovan === "Не") {
                if (obdukovanNe) {
                    obdukovanNe.checked = true;
                }
            }

            if (statusEl) {
                statusEl.textContent = "";
            }
        })
        .catch(() => {
            if (statusEl) {
                statusEl.textContent = "Greska pri ucitavanju";
            }
        });
});
