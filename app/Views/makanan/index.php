<?= $this->include('layout/header') ?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h3 class="fw-bold mb-0"><i class="bi bi-clipboard-data text-brand"></i> Kelola Data Makanan</h3>
        <a href="<?= site_url('makanan/create') ?>" class="btn btn-brand">
            <i class="bi bi-plus-circle"></i> Tambah Makanan
        </a>
    </div>

    <?php if (session()->getFlashdata('sukses')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= esc(session()->getFlashdata('sukses')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('gagal')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= esc(session()->getFlashdata('gagal')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('makanan') ?>" method="get" class="row g-2 mb-4">
        <div class="col-8 col-md-4">
            <input type="text" name="q" class="form-control" placeholder="Cari nama / kategori..." value="<?= esc($keyword ?? '') ?>">
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i> Cari</button>
        </div>
    </form>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Gambar</th>
                            <th>Nama Makanan</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($makanan)): ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">Belum ada data makanan.</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; ?>
                            <?php foreach ($makanan as $item): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <?php if (!empty($item['gambar'])): ?>
                                            <img src="<?= base_url('uploads/makanan/' . $item['gambar']) ?>" width="55" height="55" style="object-fit:cover;border-radius:8px;">
                                        <?php else: ?>
                                            <span class="text-muted small">Tidak ada</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($item['nama_makanan']) ?></td>
                                    <td><span class="badge badge-brand text-white"><?= esc($item['kategori']) ?></span></td>
                                    <td>Rp <?= number_format((float) $item['harga'], 0, ',', '.') ?></td>
                                    <td><?= (int) $item['stok'] ?></td>
                                    <td>
                                        <span class="badge <?= $item['status'] === 'Tersedia' ? 'bg-success' : 'bg-secondary' ?>">
                                            <?= esc($item['status']) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= site_url('makanan/edit/' . $item['id']) ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="<?= site_url('makanan/delete/' . $item['id']) ?>" class="btn btn-sm btn-outline-danger"
                                           title="Hapus" onclick="return confirm('Yakin ingin menghapus data \'<?= esc($item['nama_makanan'], 'js') ?>\'?');">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
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
