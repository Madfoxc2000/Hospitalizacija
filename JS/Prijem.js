import{
   invalid,
   containsOnlyLettersAndNumbers,
   containsOnlyLetters,
   containsOnlyNumbers,
   isLetterUppercase,
   isNumberOfCharacters,
   isPhoneNumberOk,

 } from "./JsValidacije.js";

 const povredjen = document.getElementById('Povredjen');
const nePovredjen = document.getElementById('NePovredjen');
const povreda = document.getElementById('UzrokPovrede');

// Vrsi logiku forme, gde su uslovno omoguceni neki od elemenata 
function changeUzrokPovredeState (bool) {
povreda.disabled = bool;
}

povredjen.addEventListener('click', function () {changeUzrokPovredeState(false)});
nePovredjen.addEventListener('click',function() {changeUzrokPovredeState(true)});

document.getElementById("prijemForm").addEventListener("submit", function(event) { 
    if (validateForm()==false){
        event.preventDefault();
    }
 });


// const SpoljniUzrokPovrede = document.forms["hospitalizacijaForm"]["SpoljniUzrokPovrede"];
const OdeljenjeNaPrijemu = document.forms["prijemForm"]["OdeljenjeNaprijemu"];
const DatumPrijema = document.forms["prijemForm"]["DatumPrijema"];
const UputnaDijagnoza = document.forms["prijemForm"]["UputnaDijagnoza"];
const TezinaNaPrijemu = document.forms["prijemForm"]["TezinaNaPrijemu"];

DatumPrijema.oninvalid = invalid;
DatumPrijema.oninput = invalid;

TezinaNaPrijemu.oninvalid = invalid;
TezinaNaPrijemu.oninput = invalid;

const OdeljenjeNaPrijemuMessage = document.getElementById('OdeljenjeNaPrijemuMessage');
const UputnaDijagnozaMessage = document.getElementById('UputnaDijagnozaMessage');
const SpoljniUzrokPovredeMessage = document.getElementById('SpoljniUzrokPovredeMessage');
const TezinaNaPrijemuMessage = document.getElementById('TezinaNaPrijemuMessage');

function validateForm(){
    if(OdeljenjeNaPrijemu.value==""){
    OdeljenjeNaPrijemuMessage.textContent = "Морате одабрати одељење на пријему";
    return false;
   }
   else{
    OdeljenjeNaPrijemuMessage.textContent ="";
   }
   if(UputnaDijagnoza.value==""){
    UputnaDijagnozaMessage.textContent ="Морате одабрати упутну дијагнозу";
    return false;
   }
   else{
    UputnaDijagnozaMessage.textContent = "";
   }
   
}