import{
    invalid,
    containsOnlyLettersAndNumbers,
    isNumberOfCharacters
  } from "./JsValidacije.js";

    const formUpper = document.getElementById("filter-form-upper");
    const filter = document.getElementById("filter");
    const filterMessage = document.getElementById("filterMessage");

    const charLimit = parseInt(filter?.dataset.maxChars ?? '5', 10);

    if (formUpper && filter) {
        filter.oninvalid = invalid;
        filter.oninput = invalid;

        formUpper.addEventListener("submit", function(event) {
            if (validateForm() == false) {
                event.preventDefault();
            }
        });
    }

 function validateForm(){
    if(filter.value==""){
        return true;
        }
        else{
            if(!containsOnlyLettersAndNumbers(filter.value)){
                if (filterMessage) {
                    filterMessage.textContent ="Поље може садржати само слова и бројеве";
                }
                return false;
                }
                else{
                if (filterMessage) {
                    filterMessage.textContent="";
                }
                }
            if(!isNumberOfCharacters(filter.value, charLimit)){
                    if (filterMessage) {
                        filterMessage.textContent =`Поље мора садржати ${charLimit} карактера`;
                    }
                    return false;
                    }
                    else{
                    if (filterMessage) {
                        filterMessage.textContent="";
                    }
                    }
            if(filter.value==""){
                if (filterMessage) {
                    filterMessage.textContent ="Морате попунити поље";
                }
                return false;
                }
                else{
                if (filterMessage) {
                    filterMessage.textContent="";
                }
                }
        }    
 }