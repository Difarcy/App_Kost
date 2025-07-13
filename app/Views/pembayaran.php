<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>Pembayaran<?= $this->endSection() ?>
<?= $this->section('content') ?>

<h2 class="main-page-title">Pembayaran</h2>
<div class="main-container">
  <div class="main-card">
    <div class="main-content">
      <!-- Toolbar: Export, Cetak, Tambah, Pencarian, Filter -->
      <div class="filter-section">
        <div class="toolbar-group">
          <button type="button" class="btn btn-success" onclick="openModal('modalExportPembayaran')">
            <i class="fas fa-file-export"></i> Export
          </button>
          <button type="button" class="btn btn-info" onclick="printPembayaranTable()">
            <i class="fas fa-print"></i> Cetak
          </button>
          <button type="button" class="btn btn-primary" onclick="openModal('modalTambahPembayaran')">
            <i class="fas fa-plus"></i> Tambah Pembayaran
          </button>
        </div>
        <form method="get" class="filter-form" onsubmit="return false;">
          <input type="text" name="search" placeholder="Cari nama penghuni/bulan..." value="<?= esc($_GET['search'] ?? '') ?>" class="input-search" autocomplete="off">
          <select name="status" class="input-select" onchange="this.form.submit()">
            <option value="">Semua Status</option>
            <option value="lunas" <?= (isset($_GET['status']) && $_GET['status'] == 'lunas') ? 'selected' : '' ?>>Lunas</option>
            <option value="cicil" <?= (isset($_GET['status']) && $_GET['status'] == 'cicil') ? 'selected' : '' ?>>Cicil</option>
          </select>
          <button type="button" class="btn btn-outline-secondary" onclick="window.location.href=window.location.pathname">Reset</button>
        </form>
      </div>
      <!-- Show Entries Dropdown -->
      <div class="show-entries-bar">
        <form method="get" class="entries-form">
          <label for="entries">Show</label>
          <select id="entries" name="entries" onchange="this.form.submit()" class="input-select">
            <option value="10" <?= (isset($_GET['entries']) && $_GET['entries'] == 10) ? 'selected' : '' ?>>10</option>
            <option value="25" <?= (isset($_GET['entries']) && $_GET['entries'] == 25) ? 'selected' : '' ?>>25</option>
            <option value="50" <?= (isset($_GET['entries']) && $_GET['entries'] == 50) ? 'selected' : '' ?>>50</option>
            <option value="100" <?= (isset($_GET['entries']) && $_GET['entries'] == 100) ? 'selected' : '' ?>>100</option>
          </select>
          <span>entries</span>
          <input type="hidden" name="search" value="<?= esc($_GET['search'] ?? '') ?>">
          <input type="hidden" name="status" value="<?= esc($_GET['status'] ?? '') ?>">
        </form>
      </div>
      <div class="table-container" id="tableContainer">
        <table class="data-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Penghuni</th>
              <th>Bulan</th>
              <th>Jumlah Tagihan</th>
              <th>Jumlah Bayar</th>
              <th>Status</th>
              <th>Tgl Bayar</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $filtered = $pembayaran;
          // Filter pencarian
          if (!empty($_GET['search'])) {
            $filtered = array_filter($filtered, function($p) {
              return stripos($p['nama_penghuni'], $_GET['search']) !== false
                || stripos($p['bulan'], $_GET['search']) !== false;
            });
          }
          // Filter status
          if (!empty($_GET['status'])) {
            $filtered = array_filter($filtered, function($p) {
              return $p['status'] == $_GET['status'];
            });
          }
          // Pagination logic
          $entries = isset($_GET['entries']) ? (int)$_GET['entries'] : 10;
          $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
          $total = count($filtered);
          $totalPages = max(1, ceil($total / $entries));
          $start = ($page - 1) * $entries;
          $pagedData = array_slice($filtered, $start, $entries);
          ?>
          <?php if (!empty($pagedData)): ?>
            <?php $no = 1 + $start; foreach ($pagedData as $p): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= esc(isset($p['nama_penghuni']) ? $p['nama_penghuni'] : '-') ?></td>
              <td><?= isset($p['bulan']) ? date('F Y', strtotime($p['bulan'])) : '-' ?></td>
              <td><?= isset($p['jml_tagihan']) ? 'Rp'.number_format($p['jml_tagihan'],0,',','.') : '-' ?></td>
              <td>Rp<?= number_format($p['jml_bayar'],0,',','.') ?></td>
              <td><?= esc(ucfirst($p['status'])) ?></td>
              <td><?= esc($p['tgl_bayar']) ?></td>
              <td>
                <div class="table-actions">
                  <a href="#" class="action-btn action-btn-edit" onclick="openModal('modalEditPembayaran')">Edit</a>
                  <a href="#" class="action-btn action-btn-delete" onclick="confirmDeletePembayaran(<?= $p['id'] ?>)">Hapus</a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="8" class="empty-table-message">Tidak ada data pembayaran.</td>
            </tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
      <!-- Pagination Bar -->
      <div class="pagination-bar">
        <div class="pagination-info">
          Menampilkan <?= ($total > 0) ? $start + 1 : 0 ?> sampai <?= min($start + count($pagedData), $total) ?> dari <?= $total ?> data
        </div>
        <div class="pagination-nav">
          <?php
          $queryBase = http_build_query(array_merge($_GET, ['page' => null]));
          $queryBase = preg_replace('/(&|\?)page=[^&]*/', '', $queryBase);
          if ($queryBase && substr($queryBase, -1) !== '&') $queryBase .= '&';
          ?>
          <?php if ($page > 1): ?>
            <a href="?<?= $queryBase ?>page=<?= $page - 1 ?>" class="pagination-link"><i class="fas fa-chevron-left"></i></a>
          <?php else: ?>
            <span class="pagination-link disabled"><i class="fas fa-chevron-left"></i></span>
          <?php endif; ?>
          <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <?php if ($i == $page): ?>
              <span class="pagination-link active"> <?= $i ?> </span>
            <?php else: ?>
              <a href="?<?= $queryBase ?>page=<?= $i ?>" class="pagination-link"> <?= $i ?> </a>
            <?php endif; ?>
          <?php endfor; ?>
          <?php if ($page < $totalPages): ?>
            <a href="?<?= $queryBase ?>page=<?= $page + 1 ?>" class="pagination-link"><i class="fas fa-chevron-right"></i></a>
          <?php else: ?>
            <span class="pagination-link disabled"><i class="fas fa-chevron-right"></i></span>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal Export -->
<div class="modal-overlay" id="modalExportPembayaran" style="display:none;">
  <div class="modal-box">
    <button class="modal-close" onclick="closeModal('modalExportPembayaran')">&times;</button>
    <div class="modal-title">Export Data Pembayaran</div>
    <div>Fitur export akan segera tersedia.</div>
    <div class="modal-footer">
      <button class="btn btn-secondary" onclick="closeModal('modalExportPembayaran')">Tutup</button>
    </div>
  </div>
</div>
<!-- Modal Tambah -->
<div class="modal-overlay" id="modalTambahPembayaran" style="display:none;">
  <div class="modal-box">
    <button class="modal-close" onclick="closeModal('modalTambahPembayaran')">&times;</button>
    <div class="modal-title">Tambah Pembayaran</div>
    <form class="modal-form">
      <input type="text" class="input-search" placeholder="Nama Penghuni" required>
      <input type="month" class="input-date" placeholder="Bulan" required>
      <input type="number" class="input-search" placeholder="Jumlah Tagihan" required>
      <input type="number" class="input-search" placeholder="Jumlah Bayar" required>
      <select class="input-select" required><option value="">Status</option><option value="lunas">Lunas</option><option value="cicil">Cicil</option></select>
      <input type="date" class="input-date" placeholder="Tanggal Bayar" required>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" onclick="closeModal('modalTambahPembayaran')">Batal</button>
      </div>
    </form>
  </div>
</div>
<!-- Modal Edit -->
<div class="modal-overlay" id="modalEditPembayaran" style="display:none;">
  <div class="modal-box">
    <button class="modal-close" onclick="closeModal('modalEditPembayaran')">&times;</button>
    <div class="modal-title">Edit Pembayaran</div>
    <form class="modal-form">
      <input type="text" class="input-search" placeholder="Nama Penghuni" required>
      <input type="month" class="input-date" placeholder="Bulan" required>
      <input type="number" class="input-search" placeholder="Jumlah Tagihan" required>
      <input type="number" class="input-search" placeholder="Jumlah Bayar" required>
      <select class="input-select" required><option value="">Status</option><option value="lunas">Lunas</option><option value="cicil">Cicil</option></select>
      <input type="date" class="input-date" placeholder="Tanggal Bayar" required>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-secondary" onclick="closeModal('modalEditPembayaran')">Batal</button>
      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?> 