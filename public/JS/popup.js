
// Podesavanje tastera koji okidaju akcije na listi
/* ====================================================== Brisanje sekcija =====================================*/
// Delegated handler to support dynamically rendered rows
document.addEventListener("click", function (e) {
  const deleteButton = e.target.closest("[data-submit-form]");
  if (deleteButton) {
    e.preventDefault();
    const formId = deleteButton.getAttribute("data-submit-form");
    showConfirmationPopup(formId);
    return;
  }

  const updateButton = e.target.closest("[update]");
  if (updateButton) {
    const formId = updateButton.getAttribute("update");
    sendUpdateForm(formId);
    return;
  }

  const printButton = e.target.closest("[print]");
  if (printButton) {
    const formId = printButton.getAttribute("print");
    submitPrintForm(formId);
  }
});


function showConfirmationPopup(formId) {
  const popup = document.getElementById("popup");
  const confirmDelete = document.getElementById("confirmDelete");
  const cancelDelete = document.getElementById("cancelDelete");

  const bsModal = new bootstrap.Modal(popup);
  bsModal.show();

  cancelDelete.addEventListener("click", function () {
    bsModal.hide();
  }, { once: true });

  confirmDelete.addEventListener("click", function () {
    bsModal.hide();
    sendDeleteForm(formId);
  }, { once: true });

  return false;
}

function sendDeleteForm(formId) {
  const form = document.getElementById(formId);
  if (!form) {
    return;
  }

  const formData = new FormData(form);
  const action = form.getAttribute("action") || "api/hospitalizacija-obrisi";

  fetch(action, {
    method: "POST",
    credentials: "same-origin",
    body: formData
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Request failed");
      }
      return response.json();
    })
    .then((data) => {
      if (data && data.ok) {
        const row = form.closest("tr");
        if (row) {
          row.remove();
        }
      } else {
        throw new Error("Delete failed");
      }
    })
    .catch(() => {
      alert("Greska pri brisanju");
    });
}

document.addEventListener("submit", function (e) {
  const form = e.target;
  if (form && form.classList.contains("deleteForm")) {
    e.preventDefault();
    showConfirmationPopup(form.id);
  }
});

/* ====================================================== Azuriranje sekcija =====================================*/
// Handled by delegated click listener above.


function sendUpdateForm(formId) {
  document.getElementById(formId).submit();
}

/* ====================================================== Stampanje sekcija =====================================*/
// Handled by delegated click listener above.


function submitPrintForm(formId) {
  document.getElementById(formId).submit();
}
