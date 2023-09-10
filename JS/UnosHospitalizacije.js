import{
   invalid,
   containsOnlyLettersAndNumbers,
   containsOnlyLetters,
   containsOnlyNumbers,
   isLetterUppercase,
   isNumberOfCharacters,
   isPhoneNumberOk,

 } from "./JsValidacije.js";

// Vrsi logiku forme, gde su uslovno omoguceni neki od elemenata 

const vrstaOtpusta = document.getElementById('VrstaOtpusta');
const osnovniUzrokSmrti = document.getElementById('OsnovniUzrokSmrti');
const obdukovan = document.getElementById('Obdukovan'); 
const neObdukovan = document.getElementById('NeObdukovan'); 

function changeElementsAboutDeathStates (string){
 if (string == 6){
    osnovniUzrokSmrti.disabled = false;
    obdukovan.disabled=false;
    neObdukovan.disabled=false;
 }
 else{
    osnovniUzrokSmrti.disabled = true;
    obdukovan.disabled = true;
    neObdukovan.disabled = true;
 }
}

vrstaOtpusta.addEventListener('change', function(){changeElementsAboutDeathStates(vrstaOtpusta.value)});


// Pozivanje validacije
document.getElementById("hospitalizacijaForm").addEventListener("submit", function(event) { 
   if (validateForm()==false){
       event.preventDefault();
   }
});



// Validacija unosa forme
const OsnovniUzrokHospitalizacije = document.forms["hospitalizacijaForm"]["OsnovniUzrokHospitalizacije"];
const PrateceDijagnoze = document.forms["hospitalizacijaForm"]["PrateceDijagnoze"];
const BrojSatiVentilatornePodrske = document.forms["hospitalizacijaForm"]["BrojSatiVentilatornePodrske"];
const DatumOtpusta = document.forms["hospitalizacijaForm"]["DatumOtpusta"];
const BrojDanaHospitalizacije = document.forms["hospitalizacijaForm"]["BrojDanaHospitalizacije"];
const OdeljenjeSaKojegJeOtpustIzvrsen = document.forms["hospitalizacijaForm"]["OdeljenjeSaKojegJeOtpustIzvrsen"];
const VrstaOtpusta = document.forms["hospitalizacijaForm"]["VrstaOtpusta"];
const OsnovniUzrokSmrti = document.forms["hospitalizacijaForm"]["OsnovniUzrokSmrti"];



PrateceDijagnoze.oninvalid = invalid;
PrateceDijagnoze.oninput = invalid;
BrojSatiVentilatornePodrske.oninvalid = invalid;
BrojSatiVentilatornePodrske.oninput = invalid;
DatumOtpusta.oninvalid = invalid;
DatumOtpusta.oninput = invalid;


// Spremanje promenjljivih za prikaz poruka o validaciji

const OsnovniUzrokHospitalizacijeMessage = document.getElementById('OsnovniUzrokHospitalizacijeMessage');
const PrateceDijagnozeMessage = document.getElementById('PrateceDijagnozeMessage');
const BrojSatiVentilatornePodrskeMessage = document.getElementById('BrojSatiVentilatornePodrskeMessage');
const DatumOtpustaMessage = document.getElementById('DatumOtpustaMessage');
const OdeljenjeSaKojegJeOtpustIzvrsenMessage = document.getElementById('OdeljenjeSaKojegJeOtpustIzvrsenMessage');
const VrstaOtpustaMessage = document.getElementById('VrstaOtpustaMessage');
const OsnovniUzrokSmrtiMessage = document.getElementById('OsnovniUzrokSmrtiMessage');

// Validacija vrednosti podataka
function validateForm(){
  if(OsnovniUzrokHospitalizacije.value==""){
   OsnovniUzrokHospitalizacijeMessage.textContent="Морате одабрати основни узрок хоспитализације";
   return false;
  }
  else{
   OsnovniUzrokHospitalizacijeMessage.textContent ="";
  }
  if(!containsOnlyLettersAndNumbers(PrateceDijagnoze.value)){
   PrateceDijagnozeMessage.textContent ="Поље може садржати само слова и бројеве";
   return false;
   }
   else{
   PrateceDijagnozeMessage.textContent="";
   }
   if(OdeljenjeSaKojegJeOtpustIzvrsen.value==""){
      OdeljenjeSaKojegJeOtpustIzvrsenMessage.textContent="Морате одабрати одељење";
      return false;
      }
   else{
      OdeljenjeSaKojegJeOtpustIzvrsenMessage.textContent ="";
   }
   if(VrstaOtpusta.value==""){
      VrstaOtpustaMessage.textContent="Морате одабрати врсту отпуста";
      return false;
   }
   else{
      VrstaOtpustaMessage.textContent ="";
   }
}
