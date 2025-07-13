<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>Kamar<?= $this->endSection() ?>
<?= $this->section('content') ?>

<h2 class="main-page-title">Kamar</h2>
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
          <button type="button" class="btn btn-primary" onclick="alert('Form tambah kamar belum diimplementasikan!')">
            <i class="fas fa-plus"></i> Tambah Kamar
          </button>
        </div>
        <form method="get" style="display: flex; gap: 8px; align-items: center;">
          <input type="text" name="search" placeholder="Cari nomor kamar..." value="<?= esc($_GET['search'] ?? '') ?>" style="padding: 6px 12px; border-radius: 6px; border: 1px solid #ccc; min-width: 180px;">
          <select name="harga" style="padding: 6px 12px; border-radius: 6px; border: 1px solid #ccc;">
            <option value="">Semua Harga</option>
            <option value="<1000000" <?= (isset($_GET['harga']) && $_GET['harga'] == '<1000000') ? 'selected' : '' ?>>Di bawah 1 juta</option>
            <option value=">=1000000" <?= (isset($_GET['harga']) && $_GET['harga'] == '>=1000000') ? 'selected' : '' ?>>1 juta ke atas</option>
          </select>
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
          <input type="hidden" name="harga" value="<?= esc($_GET['harga'] ?? '') ?>">
        </form>
      </div>
      <div class="table-container" id="tableContainer">
        <table class="data-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Nomor Kamar</th>
              <th>Harga</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $filtered = $kamar;
          // Filter pencarian
          if (!empty($_GET['search'])) {
            $filtered = array_filter($filtered, function($k) {
              return stripos($k['nomor'], $_GET['search']) !== false;
            });
          }
          // Filter harga
          if (!empty($_GET['harga'])) {
            if ($_GET['harga'] == '<1000000') {
              $filtered = array_filter($filtered, function($k) { return $k['harga'] < 1000000; });
            } elseif ($_GET['harga'] == '>=1000000') {
              $filtered = array_filter($filtered, function($k) { return $k['harga'] >= 1000000; });
            }
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
            <?php $no = 1 + $start; foreach ($pagedData as $k): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= esc($k['nomor']) ?></td>
              <td>Rp<?= number_format($k['harga'],0,',','.') ?></td>
              <td>
                <div class="table-actions">
                  <a href="#" class="action-btn action-btn-edit" onclick="editKamar(<?= $k['id'] ?>)">Edit</a>
                  <a href="#" class="action-btn action-btn-delete" onclick="confirmDeleteKamar(<?= $k['id'] ?>, '<?= esc($k['nomor']) ?>')">Hapus</a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" class="empty-table-message">Tidak ada data kamar.</td>
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