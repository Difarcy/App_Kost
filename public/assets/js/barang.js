// File: data_supplier.js
// Fungsi: File ini digunakan untuk menangani interaksi dan logika pada halaman Data Supplier.
// Biasanya berisi script untuk menambah, mengedit, menghapus, menampilkan detail, dan ekspor data supplier.
// Tambahkan kode JavaScript Anda di bawah ini.

// =============================
// PENCARIAN DINAMIS DATA SUPPLIER
// =============================

function renderSupplierTable(data) {
  const tbody = document.querySelector('#tableContainer tbody');
  if (!tbody) return;
  if (!Array.isArray(data)) {
    tbody.innerHTML = '<tr><td colspan="7" class="empty-table-message">Terjadi kesalahan saat memuat data.</td></tr>';
    return;
  }
  tbody.innerHTML = '';
  if (!data || data.length === 0) {
    tbody.innerHTML = '<tr><td colspan="7" class="empty-table-message">Tidak ada data supplier.</td></tr>';
    return;
  }
  data.forEach((item, idx) => {
    tbody.innerHTML += `
      <tr>
        <td>${idx + 1}</td>
        <td>${item.kode_supplier}</td>
        <td>${item.nama_supplier}</td>
        <td>${item.alamat}</td>
        <td>${item.telepon}</td>
        <td>${item.kota}</td>
        <td>
          <div class="table-actions">
            <a href="#" class="action-btn action-btn-edit" onclick="editSupplier(${item.id})">Edit</a>
            <a href="#" class="action-btn action-btn-delete" onclick="confirmDeleteSupplier(${item.id}, '${item.nama_supplier}')">Hapus</a>
          </div>
        </td>
      </tr>
    `;
  });
}

/**
 * Fungsi export data supplier (Excel, PDF, CSV)
 * Akan redirect ke endpoint export dengan format dan filter aktif
 */
function exportData(format) {
  const search = document.querySelector('input[name="search"]')?.value || '';
  const kota = document.querySelector('select[name="kota"]')?.value || '';
  let url = `data-supplier/export?format=${format}`;
  if (search) url += `&search=${encodeURIComponent(search)}`;
  if (kota) url += `&kota=${encodeURIComponent(kota)}`;
  window.location.href = url;
}

let dataAwalEdit = {};

function editSupplier(id) {
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}data-supplier/get/${id}`)
    .then(res => res.json())
    .then(data => {
      if (data && data.success) {
        dataAwalEdit = data.data;
        document.getElementById('edit_supplier_id').value = data.data.id;
        document.getElementById('edit_kode_supplier').value = data.data.kode_supplier;
        document.getElementById('edit_nama_supplier').value = data.data.nama_supplier;
        document.getElementById('edit_alamat').value = data.data.alamat;
        document.getElementById('edit_telepon').value = data.data.telepon;
        document.getElementById('edit_kota').value = data.data.kota;
        openModal('editSupplier');
      }
    });
}

function fetchAndRender() {
  const searchInput = document.querySelector('input[name="search"]');
  const kotaDropdown = document.querySelector('select[name="kota"]');
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}data-supplier/search?search=${encodeURIComponent(searchInput ? searchInput.value : '')}&kota=${encodeURIComponent(kotaDropdown ? kotaDropdown.value : '')}`)
    .then(res => res.json())
    .then(data => renderSupplierTable(data));
}

function confirmDeleteSupplier(id, nama) {
  if (confirm('Yakin ingin menghapus supplier: ' + nama + '?')) {
    const currentPath = window.location.pathname;
    const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
    fetch(`/${prefix}data-supplier/delete/${id}`, { 
      method: 'POST',
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert('Supplier berhasil dihapus.');
          fetchAndRender();
        } else {
          alert('Maaf, supplier gagal dihapus. Silakan coba lagi.');
        }
      });
  }
}

function openTambahSupplierModal() {
  var form = document.getElementById('formTambahSupplier');
  if (form) form.reset();
  openModal('tambahSupplier');
}

function handleEditSupplierSubmit() {
  var form = document.getElementById('formEditSupplier');
  if (!form) return;
  var id = document.getElementById('edit_supplier_id').value;
  var formData = new FormData();
  if (form['kode_supplier'].value !== dataAwalEdit.kode_supplier) formData.append('kode_supplier', form['kode_supplier'].value);
  if (form['nama_supplier'].value !== dataAwalEdit.nama_supplier) formData.append('nama_supplier', form['nama_supplier'].value);
  if (form['alamat'].value !== dataAwalEdit.alamat) formData.append('alamat', form['alamat'].value);
  if (form['telepon'].value !== dataAwalEdit.telepon) formData.append('telepon', form['telepon'].value);
  if (form['kota'].value !== dataAwalEdit.kota) formData.append('kota', form['kota'].value);
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}data-supplier/update/${id}`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert('Supplier berhasil diperbarui.');
        closeModal('editSupplier');
        fetchAndRender();
      } else {
        alert('Maaf, supplier gagal diperbarui. ' + (data.message || 'Silakan coba lagi.'));
      }
    });
}

function handleAddSupplierSubmit() {
  var form = document.getElementById('formTambahSupplier');
  if (!form) return;
  var formData = new FormData(form);
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}data-supplier/store`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert('Supplier berhasil ditambahkan.');
        closeModal('tambahSupplier');
        fetchAndRender();
      } else {
        alert('Maaf, supplier gagal ditambahkan. ' + (data.message || 'Silakan coba lagi.'));
      }
    });
}

// =============================
// PENCARIAN & FILTER DINAMIS BARANG (AJAX)
// =============================

function renderBarangTable(data) {
  const tbody = document.querySelector('#tableContainer tbody');
  if (!tbody) return;
  tbody.innerHTML = '';
  if (!data || data.length === 0) {
    tbody.innerHTML = '<tr><td colspan="4" class="empty-table-message">Tidak ada data barang.</td></tr>';
    return;
  }
  data.forEach((b, idx) => {
    tbody.innerHTML += `
      <tr>
        <td>${idx + 1}</td>
        <td>${b.nama}</td>
        <td>Rp${parseInt(b.harga).toLocaleString('id-ID')}</td>
        <td>
          <div class="table-actions">
            <a href="#" class="action-btn action-btn-edit" onclick="editBarang(${b.id})">Edit</a>
            <a href="#" class="action-btn action-btn-delete" onclick="confirmDeleteBarang(${b.id}, '${b.nama}')">Hapus</a>
          </div>
        </td>
      </tr>
    `;
  });
}

function fetchAndRenderBarang() {
  const searchInput = document.querySelector('input[name="search"]');
  const hargaDropdown = document.querySelector('select[name="harga"]');
  let url = `/admin/barang/search?search=${encodeURIComponent(searchInput ? searchInput.value : '')}&harga=${encodeURIComponent(hargaDropdown ? hargaDropdown.value : '')}`;
  fetch(url)
    .then(res => res.json())
    .then(data => renderBarangTable(data));
}

// Print only table and title (hide 'Aksi' column)
window.printBarangTable = function() {
  const style = document.createElement('style');
  style.id = 'print-style-barang';
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
    const printStyle = document.getElementById('print-style-barang');
    if (printStyle) printStyle.remove();
  }, 1000);
};

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
  const kotaDropdown = document.querySelector('select[name="kota"]');
  const hargaDropdown = document.querySelector('select[name="harga"]');
  
  // Hanya gunakan AJAX untuk search dan filter
  if (searchInput) searchInput.addEventListener('input', fetchAndRender);
  if (kotaDropdown) kotaDropdown.addEventListener('change', fetchAndRender);
  if (hargaDropdown) hargaDropdown.addEventListener('change', fetchAndRenderBarang);
  
  // Entries dropdown akan ditangani oleh main.js dengan form submission normal
});
