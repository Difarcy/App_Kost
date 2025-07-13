// File: modal.js
// Fungsi: File ini digunakan untuk menangani logika dan interaksi modal (popup) di aplikasi.
// Biasanya berisi fungsi untuk membuka, menutup, dan mengatur konten modal.
// Tambahkan kode JavaScript Anda di bawah ini.

// =============================
// FUNGSI GLOBAL UNTUK MODAL (modal.js)
// =============================

/**
 * Membuka modal berdasarkan id
 * @param {string} modalId - ID modal
 */
function openModal(modalId) {
  const modal = document.getElementById('modal' + capitalizeFirst(modalId));
  if (modal) {
    modal.style.display = 'block';
    modal.classList.add('show'); // Tambahkan agar modal tampil
    document.body.classList.add('modal-open');
  }
}

/**
 * Menutup modal berdasarkan id
 * @param {string} modalId - ID modal
 */
function closeModal(modalId) {
  const modal = document.getElementById('modal' + capitalizeFirst(modalId));
  if (modal) {
    modal.style.display = 'none';
    modal.classList.remove('show'); // Tambahkan agar modal sembunyi
    document.body.classList.remove('modal-open');
  }
}

/**
 * Mengisi data ke dalam modal (opsional, tergantung kebutuhan)
 * @param {string} modalId - ID modal
 * @param {object} data - Data yang akan diisi
 */
function setModalData(modalId, data) {
  // Implementasi sesuai kebutuhan
}

/**
 * Mengosongkan data modal (opsional, tergantung kebutuhan)
 * @param {string} modalId - ID modal
 */
function clearModal(modalId) {
  // Implementasi sesuai kebutuhan
}

function capitalizeFirst(str) {
  return str.charAt(0).toUpperCase() + str.slice(1);
}

window.openModal = function(id) {
  const modal = document.getElementById(id);
  if (!modal) return;
  modal.classList.add('modal-open');
  modal.style.display = 'flex';
  setTimeout(() => modal.classList.add('modal-visible'), 10);
  document.body.style.overflow = 'hidden';
};

window.closeModal = function(id) {
  const modal = document.getElementById(id);
  if (!modal) return;
  modal.classList.remove('modal-visible');
  setTimeout(() => {
    modal.classList.remove('modal-open');
    modal.style.display = 'none';
    document.body.style.overflow = '';
  }, 200);
};

// Close modal on overlay click
window.addEventListener('click', function(e) {
  if (e.target.classList.contains('modal-overlay')) {
    closeModal(e.target.id);
  }
});

// Close modal on ESC
window.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    document.querySelectorAll('.modal-overlay.modal-open').forEach(function(modal) {
      closeModal(modal.id);
    });
  }
});