// File: barang_masuk.js
// Fungsi: File ini digunakan untuk menangani interaksi dan logika pada halaman Barang Masuk.
// Biasanya berisi script untuk menambah, mengedit, menghapus, menampilkan detail, dan ekspor data barang masuk.
// Tambahkan kode JavaScript Anda di bawah ini.

// =============================
// PENCARIAN DINAMIS BARANG MASUK
// =============================

function renderBarangMasukTable(data) {
  const tbody = document.querySelector('#tableContainer tbody');
  if (!tbody) return;
  tbody.innerHTML = '';
  if (!data || data.length === 0) {
    tbody.innerHTML = '<tr><td colspan="9" class="empty-table-message">Tidak ada data barang masuk.</td></tr>';
    return;
  }
  data.forEach((item, idx) => {
    tbody.innerHTML += `
      <tr>
        <td>${idx + 1}</td>
        <td>${item.no_surat_jalan}</td>
        <td>${item.tanggal_terima}</td>
        <td>${item.supplier}</td>
        <td>${item.nama_barang}</td>
        <td>${item.jumlah}</td>
        <td>${item.satuan}</td>
        <td>${item.petugas}</td>
        <td>
          <div class="table-actions">
            <a href="#" class="action-btn action-btn-edit" onclick="editBarangMasuk(${item.id})">Edit</a>
            <a href="#" class="action-btn action-btn-delete" onclick="confirmDeleteBarangMasuk(${item.id}, '${item.nama_barang}')">Hapus</a>
          </div>
        </td>
      </tr>
    `;
  });
}

function fetchAndRender() {
  const searchInput = document.querySelector('input[name="search"]');
  const tanggalAwal = document.querySelector('input[name="tanggal_awal"]');
  const tanggalAkhir = document.querySelector('input[name="tanggal_akhir"]');
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}barang-masuk/search?search=${encodeURIComponent(searchInput ? searchInput.value : '')}&tanggal_awal=${encodeURIComponent(tanggalAwal ? tanggalAwal.value : '')}&tanggal_akhir=${encodeURIComponent(tanggalAkhir ? tanggalAkhir.value : '')}`)
    .then(res => res.json())
    .then(data => renderBarangMasukTable(data));
}

document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.querySelector('input[name="search"]');
  const tanggalAwal = document.querySelector('input[name="tanggal_awal"]');
  const tanggalAkhir = document.querySelector('input[name="tanggal_akhir"]');
  
  // Hanya gunakan AJAX untuk search dan filter
  if (searchInput) searchInput.addEventListener('input', fetchAndRender);
  if (tanggalAwal) tanggalAwal.addEventListener('change', fetchAndRender);
  if (tanggalAkhir) tanggalAkhir.addEventListener('change', fetchAndRender);
  
  // Entries dropdown akan ditangani oleh main.js dengan form submission normal
});

/**
 * Fungsi export data barang masuk (Excel, PDF, CSV)
 * Akan redirect ke endpoint export dengan format dan filter aktif
 */
function exportData(format) {
  const search = document.querySelector('input[name="search"]')?.value || '';
  const tanggalAwal = document.querySelector('input[name="tanggal_awal"]')?.value || '';
  const tanggalAkhir = document.querySelector('input[name="tanggal_akhir"]')?.value || '';
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  let url = `${prefix}barang-masuk/export?format=${format}`;
  if (search) url += `&search=${encodeURIComponent(search)}`;
  if (tanggalAwal) url += `&tanggal_awal=${encodeURIComponent(tanggalAwal)}`;
  if (tanggalAkhir) url += `&tanggal_akhir=${encodeURIComponent(tanggalAkhir)}`;
  window.location.href = url;
}

let dataAwalEdit = {};

function editBarangMasuk(id) {
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}barang-masuk/get/${id}`)
    .then(res => res.json())
    .then(data => {
      if (data && data.success) {
        dataAwalEdit = data.data;
        document.getElementById('edit_id').value = data.data.id;
        document.getElementById('edit_no_surat_jalan').value = data.data.no_surat_jalan;
        document.getElementById('edit_tanggal_terima').value = data.data.tanggal_terima;
        document.getElementById('edit_supplier').value = data.data.supplier;
        document.getElementById('edit_nama_barang').value = data.data.nama_barang;
        document.getElementById('edit_jumlah').value = data.data.jumlah;
        document.getElementById('edit_satuan').value = data.data.satuan;
        document.getElementById('edit_petugas').value = data.data.petugas;
        openModal('editBarangMasuk');
      }
    });
}

function confirmDeleteBarangMasuk(id, nama) {
  if (confirm('Yakin ingin menghapus barang masuk: ' + nama + '?')) {
    const currentPath = window.location.pathname;
    const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
    fetch(`/${prefix}barang-masuk/delete/${id}`, { 
      method: 'POST',
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert('Barang masuk berhasil dihapus.');
          fetchAndRender();
        } else {
          alert('Maaf, barang masuk gagal dihapus. Silakan coba lagi.');
        }
      });
  }
}

function openTambahBarangMasukModal() {
  var form = document.getElementById('formTambahBarangMasuk');
  if (form) form.reset();
  openModal('tambahBarangMasuk');
}

function handleTambahBarangMasukSubmit() {
  var form = document.getElementById('formTambahBarangMasuk');
  if (!form) return;
  var formData = new FormData(form);
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}barang-masuk/store`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert('Barang masuk berhasil ditambahkan.');
        closeModal('tambahBarangMasuk');
        location.reload();
      } else {
        alert('Maaf, barang masuk gagal ditambahkan. Silakan coba lagi.');
      }
    });
}

function handleEditBarangMasukSubmit() {
  var form = document.getElementById('formEditBarangMasuk');
  if (!form) return;
  var id = document.getElementById('edit_id').value;
  var formData = new FormData();
  if (form['no_surat_jalan'].value !== dataAwalEdit.no_surat_jalan) formData.append('no_surat_jalan', form['no_surat_jalan'].value);
  if (form['tanggal_terima'].value !== dataAwalEdit.tanggal_terima) formData.append('tanggal_terima', form['tanggal_terima'].value);
  if (form['supplier'].value !== dataAwalEdit.supplier) formData.append('supplier', form['supplier'].value);
  if (form['nama_barang'].value !== dataAwalEdit.nama_barang) formData.append('nama_barang', form['nama_barang'].value);
  if (form['jumlah'].value !== String(dataAwalEdit.jumlah)) formData.append('jumlah', form['jumlah'].value);
  if (form['satuan'].value !== dataAwalEdit.satuan) formData.append('satuan', form['satuan'].value);
  if (form['petugas'].value !== dataAwalEdit.petugas) formData.append('petugas', form['petugas'].value);
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}barang-masuk/update/${id}`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert('Barang masuk berhasil diperbarui.');
        closeModal('editBarangMasuk');
        location.reload();
      } else {
        alert('Maaf, barang masuk gagal diperbarui. ' + (data.message || 'Silakan coba lagi.'));
      }
    });
}

// =============================
// PENCARIAN & FILTER DINAMIS PENGHUNI (AJAX)
// =============================

function renderPenghuniTable(data) {
  const tbody = document.querySelector('#tableContainer tbody');
  if (!tbody) return;
  tbody.innerHTML = '';
  if (!data || data.length === 0) {
    tbody.innerHTML = '<tr><td colspan="7" class="empty-table-message">Tidak ada data penghuni.</td></tr>';
    return;
  }
  data.forEach((p, idx) => {
    tbody.innerHTML += `
      <tr>
        <td>${idx + 1}</td>
        <td>${p.nama}</td>
        <td>${p.no_ktp}</td>
        <td>${p.no_hp}</td>
        <td>${p.tgl_masuk}</td>
        <td>${p.tgl_keluar || ''}</td>
        <td>
          <div class="table-actions">
            <a href="#" class="action-btn action-btn-edit" onclick="editPenghuni(${p.id})">Edit</a>
            <a href="#" class="action-btn action-btn-delete" onclick="confirmDeletePenghuni(${p.id}, '${p.nama}')">Hapus</a>
          </div>
        </td>
      </tr>
    `;
  });
}

function fetchAndRenderPenghuni() {
  const searchInput = document.querySelector('input[name="search"]');
  const tglMasukInput = document.querySelector('input[name="tgl_masuk"]');
  let url = `/admin/penghuni/search?search=${encodeURIComponent(searchInput ? searchInput.value : '')}&tgl_masuk=${encodeURIComponent(tglMasukInput ? tglMasukInput.value : '')}`;
  fetch(url)
    .then(res => res.json())
    .then(data => renderPenghuniTable(data));
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
  const tglMasukInput = document.querySelector('input[name="tgl_masuk"]');
  if (searchInput) searchInput.addEventListener('input', fetchAndRenderPenghuni);
  if (tglMasukInput) tglMasukInput.addEventListener('change', fetchAndRenderPenghuni);
});

// Print only table and title (hide 'Aksi' column)
window.printPenghuniTable = function() {
  const style = document.createElement('style');
  style.id = 'print-style-penghuni';
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
    const printStyle = document.getElementById('print-style-penghuni');
    if (printStyle) printStyle.remove();
  }, 1000);
};

window.editPenghuni = function(id) {
  // TODO: fetch data penghuni by id dan isi form modalEditPenghuni
  openModal('modalEditPenghuni');
};
