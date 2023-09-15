import{
    invalid,
    containsOnlyLettersAndNumbers,
    isNumberOfCharacters
  } from "./JsValidacije.js";

  const filter = document.forms["filter-form-upper"]["filter"];

  filter.oninvalid = invalid;
  filter.oninput = invalid;

  document.getElementById("filter-form-upper").addEventListener("submit", function(event) { 
    if (validateForm()==false){
        event.preventDefault();
    }
 });

 function validateForm(){
    if(filter.value==""){
        return true;
        }
        else{
            if(!containsOnlyLettersAndNumbers(filter.value)){
                filterMessage.textContent ="Поље може садржати само слова и бројеве";
                return false;
                }
                else{
                filterMessage.textContent="";
                }
            if(!isNumberOfCharacters(filter.value, 5)){
                    filterMessage.textContent ="Поље мора садржати 5 карактера";
                    return false;
                    }
                    else{
                    filterMessage.textContent="";
                    }
            if(filter.value==""){
                filterMessage.textContent ="Морате попунити поље";
                return false;
                }
                else{
                filterMessage.textContent="";
                }
        }    
 }