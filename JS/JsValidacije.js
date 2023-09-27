// Prilagodjene poruke obavestenja za ne unesene vrednosti
function separateAndConvertToLower(inputString) {
  const words = inputString.split(/(?=[A-Z])/);
  const convertedWords = words.map(word => word.toLowerCase());
  const result = convertedWords.join(' ');

  return result;
}
// Prikazuje prilagodjene poruke o ne unesenim vrednostima
function invalid() {
this.setCustomValidity("");
if (this.validity.valueMissing) {
      if(this.name=="JMBG" || this.name=="LBO"){
          this.setCustomValidity(`Morate uneti ${this.name} `);
      }
      else{
      let name = separateAndConvertToLower(this.name);
  this.setCustomValidity(`Morate uneti ${name} `);
      }
}
}


// Validacija vrednosti podataka
function containsOnlyLettersAndNumbers(value) {
    let pattern = /^$|[a-zA-Z0-9АБВГДЂЕЖЗИЈКЛЉМНЊОПРСТЋУФХЦЧЏШабвгдђежзијклљмнњопрстћуфхцчџш\s]+$/;
    return pattern.test(value);
  }

  function containsOnlyLetters(value) {
    let pattern = /^[a-zA-ZАБВГДЂЕЖЗИЈКЛЉМНЊОПРСТЋУФХЦЧЏШабвгдђежзијклљмнњопрстћуфхцчџш\s]+$/;
    return pattern.test(value);
  }
  
  function containsOnlyNumbers(value) {
    let pattern =/^[0-9]+$/;
    return pattern.test(value);
  }

  function isLetterUppercase(value) {
    let pattern = /^[A-ZАБВГДЂЕЖЗИЈКЛЉМНЊОПРСТЋУФХЦЧЏШ]+$/;
    return pattern.test(value);
  }

  function isNumberOfCharacters(string, number){
    if(string.length == number){
        return true;
    }
    return false;
  }

  function isPhoneNumberOk(string){
    let firstPart = string.slice(0,4);
    let secondPart = string.slice(3);
    let pattern =/[+381]/;
    if(string.length>12 && string.length<16){
         if (pattern.test(firstPart)){
          return containsOnlyNumbers(secondPart);
         }
         else{
          return false;
         }
    }
    else {
        return false;
    }
    
  }
  export{
    invalid,
    containsOnlyLettersAndNumbers,
    containsOnlyLetters,
    containsOnlyNumbers,
    isLetterUppercase,
    isNumberOfCharacters,
    isPhoneNumberOk,
  }