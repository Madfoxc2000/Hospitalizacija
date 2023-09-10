
// Podesavanje tastera koji okidaju akcije na listi  
/* ====================================================== Delete section =====================================*/
// Add event listeners to all form submit buttons
const submitButtons = document.querySelectorAll("[data-submit-form]");
submitButtons.forEach(button => {
  button.addEventListener("click", function(e) {
    e.preventDefault();
    const formId = button.getAttribute("data-submit-form");
    showConfirmationPopup(formId);
  });
});


 // Get references to elements
 function showConfirmationPopup(formId) {
 const popup = document.getElementById("popup");
 const confirmDelete = document.getElementById("confirmDelete");
 const cancelDelete = document.getElementById("cancelDelete");

 popup.style.display = "flex";

 // Hide the popup when the cancel button is clicked
 cancelDelete.addEventListener("click", function() {
   popup.style.display = "none";
 });

 // Handle the form submission when the confirm button is clicked
 confirmDelete.addEventListener("click", function() {// Submit the form
   popup.style.display = "none";
   document.getElementById(formId).submit();   // Submit the specific form
 });

return false;
}

/* ====================================================== Update section =====================================*/
// Add event listeners to all form submit buttons
const updateButtons = document.querySelectorAll("[update]");
updateButtons.forEach(button => {
  button.addEventListener("click", function() {
    const formId = button.getAttribute("update");
    sendUpdateForm(formId);
  });
});


 // Get references to elements
 function sendUpdateForm(formId) {
   document.getElementById(formId).submit(); // Submit the specific form
 }

/* ====================================================== Print section =====================================*/
const printButtons = document.querySelectorAll("[print]");
printButtons.forEach(button => {
  button.addEventListener("click", function() {
    const formId = button.getAttribute("print");
    submitPrintForm(formId);
  });
});


 // Get references to elements
 function submitPrintForm(formId) {
   document.getElementById(formId).submit(); // Submit the specific form
 }
