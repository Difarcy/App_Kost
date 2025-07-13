<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>Tagihan<?= $this->endSection() ?>
<?= $this->section('content') ?>

<h2 class="main-page-title">Tagihan</h2>
<div class="main-container">
  <div class="main-card">
    <div class="main-content">
      <!-- Toolbar: Export, Cetak, Tambah, Pencarian, Filter -->
      <div class="filter-section" style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; margin-bottom: 18px; gap: 12px;">
        <div style="display: flex; gap: 8px; align-items: center;">
          <button type="button" class="btn btn-success" onclick="alert('Export belum diimplementasikan!')">
            <i class="fas fa-file-export"></i> Export
          </button>
          <button type="button" class="btn btn-info" onclick="window.print()">
            <i class="fas fa-print"></i> Cetak
          </button>
          <button type="button" class="btn btn-primary" onclick="alert('Form tambah tagihan belum diimplementasikan!')">
            <i class="fas fa-plus"></i> Tambah Tagihan
          </button>
        </div>
        <form method="get" style="display: flex; gap: 8px; align-items: center;">
          <input type="text" name="search" placeholder="Cari nama penghuni/kamar..." value="<?= esc($_GET['search'] ?? '') ?>" style="padding: 6px 12px; border-radius: 6px; border: 1px solid #ccc; min-width: 180px;">
          <input type="month" name="bulan" value="<?= esc($_GET['bulan'] ?? '') ?>" style="padding: 6px 12px; border-radius: 6px; border: 1px solid #ccc;">
          <button type="submit" class="btn btn-outline-secondary">Reset</button>
        </form>
      </div>
      <!-- Show Entries Dropdown -->
      <div class="show-entries-bar" style="margin-bottom: 12px;">
        <form method="get" style="display: flex; align-items: center; gap: 8px;">
          <label for="entries">Show</label>
          <select id="entries" name="entries" onchange="this.form.submit()">
            <option value="10" <?= (isset($_GET['entries']) && $_GET['entries'] == 10) ? 'selected' : '' ?>>10</option>
            <option value="25" <?= (isset($_GET['entries']) && $_GET['entries'] == 25) ? 'selected' : '' ?>>25</option>
            <option value="50" <?= (isset($_GET['entries']) && $_GET['entries'] == 50) ? 'selected' : '' ?>>50</option>
            <option value="100" <?= (isset($_GET['entries']) && $_GET['entries'] == 100) ? 'selected' : '' ?>>100</option>
          </select>
          <span>entries</span>
          <input type="hidden" name="search" value="<?= esc($_GET['search'] ?? '') ?>">
          <input type="hidden" name="bulan" value="<?= esc($_GET['bulan'] ?? '') ?>">
        </form>
      </div>
      <div class="table-container" id="tableContainer">
        <table class="data-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Bulan</th>
              <th>Nama Penghuni</th>
              <th>Nomor Kamar</th>
              <th>Jumlah Tagihan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $filtered = $tagihan;
          // Filter pencarian
          if (!empty($_GET['search'])) {
            $filtered = array_filter($filtered, function($t) {
              return stripos($t['nama_penghuni'], $_GET['search']) !== false
                || stripos($t['nomor_kamar'], $_GET['search']) !== false;
            });
          }
          // Filter bulan
          if (!empty($_GET['bulan'])) {
            $filtered = array_filter($filtered, function($t) {
              return strpos($t['bulan'], $_GET['bulan']) === 0;
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
            <?php $no = 1 + $start; foreach ($pagedData as $t): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= date('F Y', strtotime($t['bulan'])) ?></td>
              <td><?= esc($t['nama_penghuni']) ?></td>
              <td><?= esc($t['nomor_kamar']) ?></td>
              <td>Rp<?= number_format($t['jml_tagihan'],0,',','.') ?></td>
              <td>
                <div class="table-actions">
                  <a href="#" class="action-btn action-btn-edit" onclick="editTagihan(<?= $t['id'] ?>)">Edit</a>
                  <a href="#" class="action-btn action-btn-delete" onclick="confirmDeleteTagihan(<?= $t['id'] ?>)">Hapus</a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" class="empty-table-message">Tidak ada data tagihan.</td>
            </tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
      <!-- Pagination Bar -->
      <div class="pagination-bar" style="margin-top: 16px; display: flex; justify-content: space-between; align-items: center;">
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
<?= $this->endSection() ?> 