import{
    invalid,
    containsOnlyLettersAndNumbers,
    containsOnlyLetters,
    containsOnlyNumbers,
    isLetterUppercase,
    isNumberOfCharacters,
    isPhoneNumberOk,
 
  } from "./JsValidacije.js";

  // Pozivanje validacije
  document.getElementById("pacijentForm").addEventListener("submit", function(event) { 
    if (validateForm()==false){
        event.preventDefault();
    }
});


// Validacija unosa forme
const BrojIstorijeBolesti = document.forms["pacijentForm"]["BrojIstorijeBolesti"];
const JMBG = document.forms["pacijentForm"]["JMBG"];
const Ime = document.forms["pacijentForm"]["Ime"];
const Prezime = document.forms["pacijentForm"]["Prezime"];
const ImeJednogRoditelja = document.forms["pacijentForm"]["ImeJednogRoditelja"];
const LBO = document.forms["pacijentForm"]["LBO"];
const OsnovOsiguranja = document.forms["pacijentForm"]["LBO"];
const ClanJePorodice = document.forms["pacijentForm"]["ClanJePorodice"];
const Telefon = document.forms["pacijentForm"]["Telefon"];
const DatumRodjenja = document.forms["pacijentForm"]["DatumRodjenja"];
const Adresa = document.forms["pacijentForm"]["Adresa"];
// const Odeljenje = document.forms["pacijentForm"]["Odeljenje"];


BrojIstorijeBolesti.oninvalid = invalid;
BrojIstorijeBolesti.oninput = invalid;
JMBG.oninvalid = invalid;
JMBG.oninput= invalid
Ime.oninvalid = invalid;
Ime.oninput = invalid;
Prezime.oninvalid = invalid;
Prezime.oninput = invalid;
ImeJednogRoditelja.oninvalid = invalid;
ImeJednogRoditelja.oninput = invalid;
LBO.oninvalid = invalid;
LBO.oninput = invalid;
ClanJePorodice.oninvalid = invalid;
ClanJePorodice.oninput = invalid;
Telefon.oninvalid = invalid;
Telefon.oninput = invalid;
DatumRodjenja.oninvalid = invalid;
DatumRodjenja.oninput = invalid;
Adresa.oninvalid = invalid;
Adresa.oninput = invalid;



// Spremanje promenjljivih za prikaz poruka o validaciji
const BrojIstorijeBolestiMessage = document.getElementById('BrojIstorijeBolestiMessage');
const JMBGMessage = document.getElementById("JMBGMessage");
const ImeMessage = document.getElementById("ImeMessage");
const PrezimeMessage = document.getElementById("PrezimeMessage");
const ImeJednogRoditeljaMessage = document.getElementById("ImeJednogRoditeljaMessage");
const LBOMessage = document.getElementById("LBOMessage");
const ClanJePorodiceMessage = document.getElementById("ClanJePorodiceMessage");
const TelefonMessage = document.getElementById("TelefonMessage");
const OsnovOsiguranjaMessage = document.getElementById("OsnovOsiguranjaMessage");
const DatumRodjenjaMessage = document.getElementById("DatumRodjenjaMessage");

// Validacija vrednosti podataka
function validateForm(){
if(!containsOnlyLettersAndNumbers(BrojIstorijeBolesti.value)){
    BrojIstorijeBolestiMessage.textContent = "Број историје болести мора садржати само слова и бројеве";
    return false;
}
else{
    BrojIstorijeBolestiMessage.textContent = "";
}
if(!containsOnlyNumbers(JMBG.value)){
    JMBGMessage.textContent = "ЈМБГ мора садржати само цифре";
    return false;
}
else{
    JMBGMessage.textContent = "";
}
if(!isNumberOfCharacters(JMBG.value, 13)){
    JMBGMessage.textContent = "ЈМБГ мора садржати тачно 13 цифара";
    return false;
}
else{
    JMBGMessage.textContent = "";
}
if(!containsOnlyLetters(Ime.value)){
    ImeMessage.textContent = "Име мора садржати само слова";
    return false;
}
else{
    ImeMessage.textContent = "";
}
if(!isLetterUppercase(Ime.value[0])){
    ImeMessage.textContent = "Име мора почети великим словом";
    return false;
}
else{
    ImeMessage.textContent = "";
}
if(!containsOnlyLetters(Prezime.value)){
    PrezimeMessage.textContent ="Презиме мора садржати само слова";
    return false;
}
else{
    PrezimeMessage.textContent = "";
}
if(!isLetterUppercase(Prezime.value[0])){
    PrezimeMessage.textContent = "Презиме мора почети великим словом";
    return false;
}
else{
    PrezimeMessage.textContent = "";
}
if(!containsOnlyLetters(ImeJednogRoditelja.value)){
    ImeJednogRoditeljaMessage.textContent = "Име мора садржати само слова";
    return false;
}
else{
    ImeJednogRoditeljaMessage.textContent = "";
}
if(!isLetterUppercase(ImeJednogRoditelja.value[0])){
    ImeJednogRoditeljaMessage.textContent = "Име мора почети великим словом";
    return false;
}
else{
    ImeJednogRoditeljaMessage.textContent = "";
}
if(!isNumberOfCharacters(LBO.value, 11)){
    LBOMessage.textContent = "ЛБО мора имати тачно 11 цифара";
    return false;
}
else{
    LBOMessage.textContent = "";
}
if(!containsOnlyLetters(ClanJePorodice.value)){
   ClanJePorodiceMessage.textContent ="Члан породице мора садржати само слова";
    return false;
}
else{
    ClanJePorodiceMessage.textContent = "";
}
if(!isLetterUppercase(ClanJePorodice.value[0])){
    ClanJePorodiceMessage.textContent ="Члан породице мора почети великим словом";
    return false;
}
else{
    ClanJePorodiceMessage.textContent = "";
}
if (!isPhoneNumberOk(Telefon.value)){
    TelefonMessage.textContent ="Број телефона није исправан";
    return false;
}
else{
    TelefonMessage.textContent = "";
}
if(OsnovOsiguranja.value==""){
    OsnovOsiguranjaMessage.textContent="Морате одабрати основни узрок хоспитализације";
    return false;
   }
   else{
    OsnovOsiguranjaMessage.textContent ="";
   }
return true;
}

