<?= $this->include('layout/header') ?>

<div class="container my-5" style="max-width: 560px;">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h4 class="fw-bold text-brand mb-4"><i class="bi bi-person-plus"></i> Tambah User</h4>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $e): ?>
                            <li><?= esc($e) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('user/store') ?>" method="post">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="<?= esc(old('nama')) ?>" required>
                </div>

                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="<?= esc(old('username')) ?>" required>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= esc(old('email')) ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="pembeli" <?= old('role') === 'pembeli' ? 'selected' : '' ?>>Pembeli</option>
                        <option value="penjual" <?= old('role') === 'penjual' ? 'selected' : '' ?>>Penjual</option>
                        <option value="admin" <?= old('role') === 'admin' ? 'selected' : '' ?>>Admin</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" minlength="6" required>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label">No. HP (opsional)</label>
                        <input type="text" name="no_hp" class="form-control" value="<?= esc(old('no_hp')) ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat (opsional)</label>
                    <textarea name="alamat" class="form-control" rows="2"><?= esc(old('alamat')) ?></textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-brand"><i class="bi bi-save"></i> Simpan</button>
                    <a href="<?= site_url('user') ?>" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->include('layout/footer') ?>
