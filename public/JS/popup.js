
// ── Modal za odbijeni pristup ─────────────────────────────────────────────────
(function () {
    const html = `
<div class="modal fade" id="authErrorModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-danger text-white border-0">
        <h5 class="modal-title" id="authErrorTitle">Greška</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="authErrorBody"></div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
      </div>
    </div>
  </div>
</div>`;
    document.addEventListener('DOMContentLoaded', () => {
        document.body.insertAdjacentHTML('beforeend', html);
    });
})();

function showAuthErrorModal(title, message) {
    const el = document.getElementById('authErrorModal');
    if (!el) return;
    document.getElementById('authErrorTitle').textContent = title;
    document.getElementById('authErrorBody').textContent = message;
    new bootstrap.Modal(el).show();
}

// Globalni presretač fetch poziva — hvata 401 (istekla sesija) i 403 (zabranjen pristup)
const _originalFetch = window.fetch;
window.fetch = function (...args) {
    return _originalFetch.apply(this, args).then(function (response) {
        if (response.status === 403) {
            showAuthErrorModal('Pristup odbijen', 'Nemate dozvolu za ovu akciju.');
            return Promise.reject(new Error('forbidden'));
        }
        if (response.status === 401) {
            showAuthErrorModal('Sesija istekla', 'Vaša sesija je istekla. Osvežite stranicu i prijavite se ponovo.');
            return Promise.reject(new Error('unauthorized'));
        }
        return response;
    });
};

// Podesavanje tastera koji okidaju akcije na listi
/* ====================================================== Brisanje sekcija =====================================*/
// Delegirani hendler za dinamički renderovane redove
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
// Obrađuje se delegiranim klik slušačem iznad.


function sendUpdateForm(formId) {
  document.getElementById(formId).submit();
}

/* ====================================================== Stampanje sekcija =====================================*/
// Obrađuje se delegiranim klik slušačem iznad.


function submitPrintForm(formId) {
  document.getElementById(formId).submit();
}
