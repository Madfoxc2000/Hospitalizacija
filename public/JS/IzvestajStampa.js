document.addEventListener("DOMContentLoaded", () => {
    const params = new URLSearchParams(window.location.search);
    const id = params.get("id") || params.get("IdHospitalizacije") || "";
    const brojIstorije = params.get("BrojIstorijeBolesti") || "";

    if (!id) {
        return;
    }

    fetch(`api/hospitalizacija-print?id=${encodeURIComponent(id)}`, {
        credentials: "same-origin"
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Request failed");
            }
            return response.json();
        })
        .then((data) => {
            const setText = (id, value) => {
                const el = document.getElementById(id);
                if (el) {
                    el.textContent = value || "";
                }
            };

            setText("OdeljenjeNaPrijemuIZ", `${data.odeljenjeNaPrijemu || ""} ${data.nazivPrijemnogOsiguranja || ""}`.trim());
            setText("BrojIstorijeBolestiIz", brojIstorije);
            setText("DatumPrijemaIZ", data.datumPrijema);
            setText("ImeIPrezimeIZ", `${data.ime || ""} ${data.prezime || ""}`.trim());
            setText("JMBGIZ", data.jmbg);
            setText("DatumRodjenjaIZ", data.datumRodjenja);
            setText("DrzavljasntvoIZ", data.drzavljanstvo);
            setText("PolIZ", data.pol);
            setText("AdresaIZ", data.adresa);
            setText("OsiguranjeIZ", `${data.osnovOsiguranja || ""} ${data.nazivOsiguranja || ""}`.trim());
            setText("LBOIZ", data.lbo);
            setText("UputnaDijagnozaIZ", data.uputnaDijagnoza);
            setText("PovredaIZ", data.povreda);
            setText("SpoljniUzrokPovredeIZ", data.spoljniUzrokPovrede);
            setText("OsnovniUzrokHospitalizacijeIZ", data.osnovniUzrokHospitalizacije);
            setText("PrateceDijagnozeIZ", data.prateceDijagnoze);
            setText("SifraProcedureIZ", data.sifraProcedurePoNomenklaturi);
            setText("TezinaNaPrijemuIZ", data.tezinaNaPrijemu);
            setText("BrojSatiVentilatornePodrskeIZ", data.brojSatiVentilatornePodrske);
            setText("DatumOtpustaIZ", data.datumOtpusta);
            setText("BrojDanaHospitalizacijeIZ", data.brojDanaHospitalizacije);
            setText("OdeljenjeSaKojegJeOtpustIzvrsenIZ", `${data.odeljenjeSaKojegJeOtpustIzvrsen || ""} ${data.nazivOdeljenjaOtpusta || ""}`.trim());
            setText("VrstaOtpustaIZ", `${data.vrstaOtpusta || ""} ${data.nazivOtpusta || ""}`.trim());
            setText("ObdukovanIZ", data.obdukovan);
            setText("OsnovniUzrokSmrtiIZ", data.osnovniUzrokSmrti);

            window.print();
        })
        .catch((err) => {
            document.querySelector('.izvestaj-container').insertAdjacentHTML(
                'afterbegin',
                `<p style="color:red;font-weight:bold;">Грешка при учитавању: ${err.message}</p>`
            );
        });
});
