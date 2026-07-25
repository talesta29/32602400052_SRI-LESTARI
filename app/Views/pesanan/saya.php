<?= $this->include('layout/header') ?>

<div class="container my-5">
    <h3 class="fw-bold mb-4"><i class="bi bi-receipt text-brand"></i> Pesanan Saya</h3>

    <?php if (session()->getFlashdata('sukses')): ?>
        <div class="alert alert-success"><?= esc(session()->getFlashdata('sukses')) ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('gagal')): ?>
        <div class="alert alert-danger"><?= esc(session()->getFlashdata('gagal')) ?></div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Makanan</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Catatan</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($pesanan)): ?>
                            <tr><td colspan="7" class="text-center text-muted py-4">Anda belum pernah memesan.</td></tr>
                        <?php else: ?>
                            <?php $no = 1; ?>
                            <?php foreach ($pesanan as $p): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($p['nama_makanan'] ?? '-') ?></td>
                                    <td><?= (int) $p['jumlah'] ?></td>
                                    <td>Rp <?= number_format((float) $p['total_harga'], 0, ',', '.') ?></td>
                                    <td><?= esc($p['catatan'] ?? '-') ?></td>
                                    <td>
                                        <?php
                                            $warna = [
                                                'Menunggu'   => 'bg-warning text-dark',
                                                'Diproses'   => 'bg-info text-dark',
                                                'Selesai'    => 'bg-success',
                                                'Dibatalkan' => 'bg-danger',
                                            ][$p['status']] ?? 'bg-secondary';
                                        ?>
                                        <span class="badge <?= $warna ?>"><?= esc($p['status']) ?></span>
                                    </td>
                                    <td><?= esc($p['created_at']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layout/footer') ?>
