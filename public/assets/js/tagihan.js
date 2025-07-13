// File: data_customer.js
// Fungsi: File ini digunakan untuk menangani interaksi dan logika pada halaman Data Customer.
// Biasanya berisi script untuk menambah, mengedit, menghapus, menampilkan detail, dan ekspor data customer.
// Tambahkan kode JavaScript Anda di bawah ini.

// =============================
// PENCARIAN DINAMIS DATA CUSTOMER
// =============================

function renderCustomerTable(data) {
  const tbody = document.querySelector('#tableContainer tbody');
  if (!tbody) return;
  tbody.innerHTML = '';
  if (!data || data.length === 0) {
    tbody.innerHTML = '<tr><td colspan="7" class="empty-table-message">Tidak ada data customer.</td></tr>';
    return;
  }
  data.forEach((item, idx) => {
    tbody.innerHTML += `
      <tr>
        <td>${idx + 1}</td>
        <td>${item.kode_customer}</td>
        <td>${item.nama_customer}</td>
        <td>${item.alamat}</td>
        <td>${item.telepon}</td>
        <td>${item.kota}</td>
        <td>
          <div class="table-actions">
            <a href="#" class="action-btn action-btn-edit" onclick="editCustomer(${item.id})">Edit</a>
            <a href="#" class="action-btn action-btn-delete" onclick="confirmDeleteCustomer(${item.id}, '${item.nama_customer}')">Hapus</a>
          </div>
        </td>
      </tr>
    `;
  });
}

function fetchAndRender() {
  const searchInput = document.querySelector('input[name="search"]');
  const kotaDropdown = document.querySelector('select[name="kota"]');
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}data-customer/search?search=${encodeURIComponent(searchInput ? searchInput.value : '')}&kota=${encodeURIComponent(kotaDropdown ? kotaDropdown.value : '')}`)
    .then(res => res.json())
    .then(data => renderCustomerTable(data));
}

document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.querySelector('input[name="search"]');
  const kotaDropdown = document.querySelector('select[name="kota"]');
  
  // Hanya gunakan AJAX untuk search dan filter
  if (searchInput) searchInput.addEventListener('input', fetchAndRender);
  if (kotaDropdown) kotaDropdown.addEventListener('change', fetchAndRender);
  
  // Entries dropdown akan ditangani oleh main.js dengan form submission normal
});

/**
 * Fungsi export data customer (Excel, PDF, CSV)
 * Akan redirect ke endpoint export dengan format dan filter aktif
 */
function exportCustomer(format) {
  const search = document.querySelector('input[name="search"]')?.value || '';
  const kota = document.querySelector('select[name="kota"]')?.value || '';
  let url = `/data-customer/export?format=${format}`;
  if (search) url += `&search=${encodeURIComponent(search)}`;
  if (kota) url += `&kota=${encodeURIComponent(kota)}`;
  window.location.href = url;
}

let dataAwalEdit = {};

function editCustomer(id) {
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}data-customer/get/${id}`)
    .then(res => res.json())
    .then(data => {
      if (data && data.success) {
        dataAwalEdit = data.data;
        document.getElementById('edit_customer_id').value = data.data.id;
        document.getElementById('edit_kode_customer').value = data.data.kode_customer;
        document.getElementById('edit_nama_customer').value = data.data.nama_customer;
        document.getElementById('edit_alamat').value = data.data.alamat;
        document.getElementById('edit_telepon').value = data.data.telepon;
        document.getElementById('edit_kota').value = data.data.kota;
        openModal('editCustomer');
      }
    });
}

function confirmDeleteCustomer(id, nama) {
  if (confirm('Yakin ingin menghapus customer: ' + nama + '?')) {
    const currentPath = window.location.pathname;
    const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
    fetch(`/${prefix}data-customer/delete/${id}`, { 
      method: 'POST',
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert('Customer berhasil dihapus.');
          fetchAndRender();
        } else {
          alert('Maaf, customer gagal dihapus. Silakan coba lagi.');
        }
      });
  }
}

function openTambahCustomerModal() {
  var form = document.getElementById('formTambahCustomer');
  if (form) form.reset();
  openModal('tambahCustomer');
}

function handleEditCustomerSubmit() {
  var form = document.getElementById('formEditCustomer');
  if (!form) return;
  var id = document.getElementById('edit_customer_id').value;
  var formData = new FormData();
  if (form['kode_customer'].value !== dataAwalEdit.kode_customer) formData.append('kode_customer', form['kode_customer'].value);
  if (form['nama_customer'].value !== dataAwalEdit.nama_customer) formData.append('nama_customer', form['nama_customer'].value);
  if (form['alamat'].value !== dataAwalEdit.alamat) formData.append('alamat', form['alamat'].value);
  if (form['telepon'].value !== dataAwalEdit.telepon) formData.append('telepon', form['telepon'].value);
  if (form['kota'].value !== dataAwalEdit.kota) formData.append('kota', form['kota'].value);
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}data-customer/update/${id}`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert('Customer berhasil diperbarui.');
        closeModal('editCustomer');
        fetchAndRender();
      } else {
        alert('Maaf, customer gagal diperbarui. ' + (data.message || 'Silakan coba lagi.'));
      }
    });
}

function handleAddCustomerSubmit() {
  var form = document.getElementById('formTambahCustomer');
  if (!form) return;
  var formData = new FormData(form);
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}data-customer/store`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert('Customer berhasil ditambahkan.');
        closeModal('tambahCustomer');
        fetchAndRender();
      } else {
        alert('Maaf, customer gagal ditambahkan. ' + (data.message || 'Silakan coba lagi.'));
      }
    });
}

// =============================
// PENCARIAN & FILTER DINAMIS TAGIHAN (AJAX)
// =============================

function renderTagihanTable(data) {
  const tbody = document.querySelector('#tableContainer tbody');
  if (!tbody) return;
  tbody.innerHTML = '';
  if (!data || data.length === 0) {
    tbody.innerHTML = '<tr><td colspan="6" class="empty-table-message">Tidak ada data tagihan.</td></tr>';
    return;
  }
  data.forEach((t, idx) => {
    tbody.innerHTML += `
      <tr>
        <td>${idx + 1}</td>
        <td>${t.bulan}</td>
        <td>${t.nama_penghuni}</td>
        <td>${t.nomor_kamar}</td>
        <td>Rp${parseInt(t.jml_tagihan).toLocaleString('id-ID')}</td>
        <td>
          <div class="table-actions">
            <a href="#" class="action-btn action-btn-edit" onclick="editTagihan(${t.id})">Edit</a>
            <a href="#" class="action-btn action-btn-delete" onclick="confirmDeleteTagihan(${t.id})">Hapus</a>
          </div>
        </td>
      </tr>
    `;
  });
}

function fetchAndRenderTagihan() {
  const searchInput = document.querySelector('input[name="search"]');
  const bulanInput = document.querySelector('input[name="bulan"]');
  let url = `/admin/tagihan/search?search=${encodeURIComponent(searchInput ? searchInput.value : '')}&bulan=${encodeURIComponent(bulanInput ? bulanInput.value : '')}`;
  fetch(url)
    .then(res => res.json())
    .then(data => renderTagihanTable(data));
}

document.addEventListener('DOMContentLoaded', function() {
  // Tombol Reset
  const resetBtn = document.querySelector('.btn-outline-secondary');
  if (resetBtn) {
    resetBtn.addEventListener('click', function() {
      window.location.href = window.location.pathname;
    });
  }
  // Tombol Print
  const printBtn = document.querySelector('.btn-info');
  if (printBtn) {
    printBtn.addEventListener('click', function() {
      window.print();
    });
  }
  // Tombol Export
  const exportBtn = document.querySelector('.btn-success');
  if (exportBtn) {
    exportBtn.addEventListener('click', function() {
      // Hapus semua alert yang tidak diperlukan
    });
  }
  // Tombol Tambah
  const tambahBtn = document.querySelector('.btn-primary');
  if (tambahBtn) {
    tambahBtn.addEventListener('click', function() {
      // Hapus semua alert yang tidak diperlukan
    });
  }
  const searchInput = document.querySelector('input[name="search"]');
  const bulanInput = document.querySelector('input[name="bulan"]');
  if (searchInput) searchInput.addEventListener('input', fetchAndRenderTagihan);
  if (bulanInput) bulanInput.addEventListener('change', fetchAndRenderTagihan);
});

// Print only table and title (hide 'Aksi' column)
window.printTagihanTable = function() {
  const style = document.createElement('style');
  style.id = 'print-style-tagihan';
  style.innerHTML = `
    @media print {
      body * { visibility: hidden !important; }
      .main-page-title, .table-container, .main-page-title *,.table-container * { visibility: visible !important; }
      .main-page-title { display: block !important; margin-bottom: 16px !important; }
      .table-container { position: absolute !important; left: 0; top: 40px; width: 100vw !important; margin: 0 !important; padding: 0 !important; box-shadow: none !important; border: none !important; }
      .data-table { width: 100% !important; border-collapse: collapse !important; }
      .data-table th, .data-table td { border: 1px solid #000 !important; padding: 8px !important; text-align: left !important; }
      .data-table th { background-color: #f0f0f0 !important; font-weight: bold !important; }
      .data-table th:last-child, .data-table td:last-child { display: none !important; }
    }
  `;
  document.head.appendChild(style);
  window.print();
  setTimeout(function() {
    const printStyle = document.getElementById('print-style-tagihan');
    if (printStyle) printStyle.remove();
  }, 1000);
};

window.editTagihan = function(id) {
  // TODO: fetch data tagihan by id dan isi form modalEditTagihan
  openModal('modalEditTagihan');
};
