const otpustButtons = document.querySelectorAll("[otpust]");
otpustButtons.forEach(button => {
  button.addEventListener("click", function() {
    const formId = button.getAttribute("otpust");
    submitOtpustForm(formId);
  });
});


 // Get references to elements
 function submitOtpustForm(formId) {
   document.getElementById(formId).submit(); // Submit the specific form
 }

 const tretmanButtons = document.querySelectorAll("[tretman]");
 tretmanButtons.forEach(button => {
   button.addEventListener("click", function() {
     const formId = button.getAttribute("tretman");
     submitTretmanForm(formId);
   });
 });
 
 
  // Get references to elements
  function submitTretmanForm(formId) {
    document.getElementById(formId).submit(); // Submit the specific form
  }
 