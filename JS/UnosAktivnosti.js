import{
    invalid,
  } from "./JsValidacije.js";

const DatumIzvrsenja = document.forms["aktivnostForm"]["DatumIzvrsenja"];

DatumIzvrsenja.oninvalid = invalid;
DatumIzvrsenja.oninput = invalid;


const TipAktivnostiMessage = document.getElementById('TipAktivnostiMessage');
const TipAktivnosti = document.getElementById('TipAktivnosti');
document.getElementById("aktivnostForm").addEventListener("submit", function(event) { 
    if (validateForm()==false){
        event.preventDefault();
    }
 });


 function validateForm(){
    if(TipAktivnosti.value==""){
        TipAktivnostiMessage.textContent="Морате одабрати тип активности";
        return false;
       }
       else{
        TipAktivnostiMessage.textContent ="";
       }
 }