
// Podesavanje tastera koji okidaju akcije na listi  
/* ====================================================== Brisanje sekcija =====================================*/
// Dodaje event listener svim tasterima za zeljeni element
const submitButtons = document.querySelectorAll("[data-submit-form]");
submitButtons.forEach(button => {
  button.addEventListener("click", function(e) {
    e.preventDefault();
    const formId = button.getAttribute("data-submit-form");
    showConfirmationPopup(formId);
  });
});


 // Preuzima refernce elemenata
 function showConfirmationPopup(formId) {
 const popup = document.getElementById("popup");
 const confirmDelete = document.getElementById("confirmDelete");
 const cancelDelete = document.getElementById("cancelDelete");

 popup.style.display = "flex";

 // Sakriva popup prozor ukoliko je dugme "cancel" pritisnuto
 cancelDelete.addEventListener("click", function() {
   popup.style.display = "none";
 });

 // Salje formu ukoliko je dugme "confirm" pritisnuto
 confirmDelete.addEventListener("click", function() {
   popup.style.display = "none";
   document.getElementById(formId).submit();   // Prosledjuje specificnu formu
 });

return false;
}

/* ====================================================== Azuriranje sekcija =====================================*/
// Dodaje event listener svim tasterima za zeljeni element
const updateButtons = document.querySelectorAll("[update]");
updateButtons.forEach(button => {
  button.addEventListener("click", function() {
    const formId = button.getAttribute("update");
    sendUpdateForm(formId);
  });
});


// Preuzima refernce elemenata
 function sendUpdateForm(formId) {
   document.getElementById(formId).submit(); // Prosledjuje specificnu formu
 }

/* ====================================================== Stampanje sekcija =====================================*/
// Dodaje event listener svim tasterima za zeljeni element
const printButtons = document.querySelectorAll("[print]");
printButtons.forEach(button => {
  button.addEventListener("click", function() {
    const formId = button.getAttribute("print");
    submitPrintForm(formId);
  });
});


// Preuzima refernce elemenata
 function submitPrintForm(formId) {
   document.getElementById(formId).submit(); // Prosledjuje specificnu formu
 }
