<?= $this->include('layout/header') ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <h3 class="fw-bold mb-4"><i class="bi bi-pencil-square text-brand"></i> Edit Makanan</h3>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <?php if (!empty($makanan['gambar'])): ?>
                        <img src="<?= base_url('uploads/makanan/' . $makanan['gambar']) ?>" width="120" class="rounded mb-3">
                    <?php endif; ?>

                    <form action="<?= site_url('makanan/update/' . $makanan['id']) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label class="form-label">Nama Makanan</label>
                            <input type="text" name="nama_makanan" class="form-control"
                                   value="<?= old('nama_makanan', $makanan['nama_makanan']) ?>" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kategori</label>
                                <input type="text" name="kategori" class="form-control"
                                       value="<?= old('kategori', $makanan['kategori']) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="Tersedia" <?= $makanan['status'] === 'Tersedia' ? 'selected' : '' ?>>Tersedia</option>
                                    <option value="Habis" <?= $makanan['status'] === 'Habis' ? 'selected' : '' ?>>Habis</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga (Rp)</label>
                                <input type="number" name="harga" class="form-control"
                                       value="<?= old('harga', $makanan['harga']) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Stok</label>
                                <input type="number" name="stok" class="form-control"
                                       value="<?= old('stok', $makanan['stok']) ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3"><?= old('deskripsi', $makanan['deskripsi']) ?></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Ganti Gambar</label>
                            <input type="file" name="gambar" class="form-control" accept="image/*">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-brand"><i class="bi bi-save"></i> Perbarui</button>
                            <a href="<?= site_url('makanan') ?>" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layout/footer') ?>
