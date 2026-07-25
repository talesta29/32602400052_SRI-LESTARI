<?= $this->include('layout/header') ?>

<div class="container my-5" style="max-width: 480px;">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h4 class="fw-bold text-center text-brand mb-4"><i class="bi bi-person-plus"></i> Buat Akun</h4>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $e): ?>
                            <li><?= esc($e) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('register') ?>" method="post">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label class="form-label">Daftar sebagai</label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="rolePembeli" value="pembeli"
                                   <?= old('role', 'pembeli') === 'pembeli' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="rolePembeli">
                                <i class="bi bi-bag-heart"></i> Pembeli
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="rolePenjual" value="penjual"
                                   <?= old('role') === 'penjual' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="rolePenjual">
                                <i class="bi bi-shop"></i> Penjual
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="<?= esc(old('nama')) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= esc(old('username')) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= esc(old('email')) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">No. HP (opsional)</label>
                    <input type="text" name="no_hp" class="form-control" value="<?= esc(old('no_hp')) ?>">
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" minlength="6" required>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="konfirmasi_password" class="form-control" minlength="6" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-brand w-100">Daftar</button>
            </form>

            <p class="text-center mt-3 mb-0 small">
                Sudah punya akun? <a href="<?= site_url('login') ?>" class="text-brand fw-semibold">Login di sini</a>
            </p>
        </div>
    </div>
</div>

<?= $this->include('layout/footer') ?>
