import {
    invalid,
    containsOnlyLettersAndNumbers,
    containsOnlyLetters,
    containsOnlyNumbers,
    isLetterUppercase,
    isNumberOfCharacters,
    isPhoneNumberOk,
} from "./JsValidacije.js";

// ── Populate OsnovOsiguranja on load ────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    fetch('api/pacijent-form-data', { credentials: 'same-origin' })
        .then(r => { if (!r.ok) throw new Error('fetch failed'); return r.json(); })
        .then(data => {
            const sel = document.querySelector("select[name='OsnovOsiguranja']");
            if (!sel) return;
            (data.osnovi || []).forEach(item => {
                const text = item.oznaka ? `${item.oznaka} ${item.naziv || ''}`.trim() : item.naziv || '';
                sel.appendChild(new Option(text, item.oznaka));
            });
        })
        .catch(() => {
            const statusEl = document.getElementById('pacijent-status');
            if (statusEl) statusEl.textContent = 'Грешка при учитавању података форме';
        });
});

// ── Validation refs ──────────────────────────────────────────────────────────
const BrojIstorijeBolesti  = document.forms['pacijentForm']['BrojIstorijeBolesti'];
const JMBG                 = document.forms['pacijentForm']['JMBG'];
const Ime                  = document.forms['pacijentForm']['Ime'];
const Prezime              = document.forms['pacijentForm']['Prezime'];
const ImeJednogRoditelja   = document.forms['pacijentForm']['ImeJednogRoditelja'];
const LBO                  = document.forms['pacijentForm']['LBO'];
const OsnovOsiguranja      = document.forms['pacijentForm']['OsnovOsiguranja'];
const ClanJePorodice       = document.forms['pacijentForm']['ClanJePorodice'];
const Telefon              = document.forms['pacijentForm']['Telefon'];
const DatumRodjenja        = document.forms['pacijentForm']['DatumRodjenja'];
const Adresa               = document.forms['pacijentForm']['Adresa'];
const Drzavljanstvo        = document.forms['pacijentForm']['Drzavljanstvo'];

BrojIstorijeBolesti.oninvalid = invalid;
BrojIstorijeBolesti.oninput   = invalid;
JMBG.oninvalid = invalid; JMBG.oninput = invalid;
Ime.oninvalid  = invalid; Ime.oninput  = invalid;
Prezime.oninvalid = invalid; Prezime.oninput = invalid;
ImeJednogRoditelja.oninvalid = invalid; ImeJednogRoditelja.oninput = invalid;
LBO.oninvalid = invalid; LBO.oninput = invalid;
ClanJePorodice.oninvalid = invalid; ClanJePorodice.oninput = invalid;
Telefon.oninvalid = invalid; Telefon.oninput = invalid;
DatumRodjenja.oninvalid = invalid; DatumRodjenja.oninput = invalid;
Adresa.oninvalid = invalid; Adresa.oninput = invalid;

const BrojIstorijeBolestiMessage = document.getElementById('BrojIstorijeBolestiMessage');
const JMBGMessage                = document.getElementById('JMBGMessage');
const ImeMessage                 = document.getElementById('ImeMessage');
const PrezimeMessage             = document.getElementById('PrezimeMessage');
const ImeJednogRoditeljaMessage  = document.getElementById('ImeJednogRoditeljaMessage');
const LBOMessage                 = document.getElementById('LBOMessage');
const ClanJePorodiceMessage      = document.getElementById('ClanJePorodiceMessage');
const TelefonMessage             = document.getElementById('TelefonMessage');
const OsnovOsiguranjaMessage     = document.getElementById('OsnovOsiguranjaMessage');
const DatumRodjenjaMessage       = document.getElementById('DatumRodjenjaMessage');
const DrzavljanstvoMessage       = document.getElementById('DrzavljanstvoMessage');

function validateForm() {
    if (!containsOnlyLettersAndNumbers(BrojIstorijeBolesti.value)) {
        BrojIstorijeBolestiMessage.textContent = 'Број историје болести мора садржати само слова и бројеве';
        return false;
    }
    BrojIstorijeBolestiMessage.textContent = '';

    if (!containsOnlyNumbers(JMBG.value)) {
        JMBGMessage.textContent = 'ЈМБГ мора садржати само цифре';
        return false;
    }
    if (!isNumberOfCharacters(JMBG.value, 13)) {
        JMBGMessage.textContent = 'ЈМБГ мора садржати тачно 13 цифара';
        return false;
    }
    JMBGMessage.textContent = '';

    if (!containsOnlyLetters(Ime.value)) {
        ImeMessage.textContent = 'Име мора садржати само слова';
        return false;
    }
    if (!isLetterUppercase(Ime.value[0])) {
        ImeMessage.textContent = 'Име мора почети великим словом';
        return false;
    }
    ImeMessage.textContent = '';

    if (!containsOnlyLetters(Prezime.value)) {
        PrezimeMessage.textContent = 'Презиме мора садржати само слова';
        return false;
    }
    if (!isLetterUppercase(Prezime.value[0])) {
        PrezimeMessage.textContent = 'Презиме мора почети великим словом';
        return false;
    }
    PrezimeMessage.textContent = '';

    if (!containsOnlyLetters(ImeJednogRoditelja.value)) {
        ImeJednogRoditeljaMessage.textContent = 'Име мора садржати само слова';
        return false;
    }
    if (!isLetterUppercase(ImeJednogRoditelja.value[0])) {
        ImeJednogRoditeljaMessage.textContent = 'Име мора почети великим словом';
        return false;
    }
    ImeJednogRoditeljaMessage.textContent = '';

    if (!isNumberOfCharacters(LBO.value, 11)) {
        LBOMessage.textContent = 'ЛБО мора имати тачно 11 цифара';
        return false;
    }
    LBOMessage.textContent = '';

    if (!containsOnlyLetters(ClanJePorodice.value)) {
        ClanJePorodiceMessage.textContent = 'Члан породице мора садржати само слова';
        return false;
    }
    if (!isLetterUppercase(ClanJePorodice.value[0])) {
        ClanJePorodiceMessage.textContent = 'Члан породице мора почети великим словом';
        return false;
    }
    ClanJePorodiceMessage.textContent = '';

    if (!isPhoneNumberOk(Telefon.value)) {
        TelefonMessage.textContent = 'Број телефона није исправан';
        return false;
    }
    TelefonMessage.textContent = '';

    if (OsnovOsiguranja.value === '') {
        OsnovOsiguranjaMessage.textContent = 'Морате одабрати основ осигурања';
        return false;
    }
    OsnovOsiguranjaMessage.textContent = '';

    if (Drzavljanstvo.value && !containsOnlyLettersAndNumbers(Drzavljanstvo.value)) {
        DrzavljanstvoMessage.textContent = 'Држављанство мора садржати само слова и бројеве';
        return false;
    }
    if (Drzavljanstvo.value && !isLetterUppercase(Drzavljanstvo.value[0])) {
        DrzavljanstvoMessage.textContent = 'Држављанство мора почети великим словом';
        return false;
    }
    DrzavljanstvoMessage.textContent = '';

    return true;
}

// ── Submit via fetch() ───────────────────────────────────────────────────────
document.getElementById('pacijentForm').addEventListener('submit', function (event) {
    event.preventDefault();

    if (!validateForm()) return;

    const statusEl = document.getElementById('pacijent-status');
    if (statusEl) statusEl.textContent = 'Чување...';

    fetch('api/pacijent-unos', {
        method: 'POST',
        credentials: 'same-origin',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams(new FormData(this)).toString(),
    })
        .then(r => { if (!r.ok) throw new Error('Request failed'); return r.json(); })
        .then(data => {
            if (data && data.ok) {
                window.location.href = 'pacijent-lista';
            } else {
                if (statusEl) statusEl.textContent = data.error || 'Грешка при чувању';
            }
        })
        .catch(() => {
            if (statusEl) statusEl.textContent = 'Грешка при чувању';
        });
});
