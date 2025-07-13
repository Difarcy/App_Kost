<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>Pembayaran<?= $this->endSection() ?>
<?= $this->section('content') ?>

<h2 class="main-page-title">Pembayaran</h2>
<div class="main-container">
  <div class="main-card">
    <div class="main-content">
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
          <?php if (!empty($pembayaranList)): ?>
            <?php $no = 1 + (($currentPage - 1) * $perPage); foreach ($pembayaranList as $p): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= esc($p['nama_penghuni']) ?></td>
              <td><?= date('F Y', strtotime($p['bulan'])) ?></td>
              <td>Rp<?= number_format($p['jml_tagihan'],0,',','.') ?></td>
              <td>Rp<?= number_format($p['jml_bayar'],0,',','.') ?></td>
              <td><?= esc(ucfirst($p['status'])) ?></td>
              <td><?= esc($p['tgl_bayar']) ?></td>
              <td>
                <div class="table-actions">
                  <a href="#" class="action-btn action-btn-edit" onclick="editPembayaran(<?= $p['id'] ?>)">Edit</a>
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
    </div>
  </div>
</div>
<?= $this->endSection() ?> 