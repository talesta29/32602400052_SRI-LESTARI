<?= $this->include('layout/header') ?>

<div class="container my-5" style="max-width: 420px;">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h4 class="fw-bold text-center text-brand mb-4"><i class="bi bi-box-arrow-in-right"></i> Login</h4>

            <?php if (session()->getFlashdata('gagal')): ?>
                <div class="alert alert-danger"><?= esc(session()->getFlashdata('gagal')) ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('sukses')): ?>
                <div class="alert alert-success"><?= esc(session()->getFlashdata('sukses')) ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $e): ?>
                            <li><?= esc($e) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('login') ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label">Username atau Email</label>
                    <input type="text" name="identitas" class="form-control" value="<?= esc(old('identitas')) ?>" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-brand w-100">Login</button>
            </form>

            <p class="text-center mt-3 mb-0 small">
                Belum punya akun? <a href="<?= site_url('register') ?>" class="text-brand fw-semibold">Daftar di sini</a>
            </p>
        </div>
    </div>
</div>

<?= $this->include('layout/footer') ?>
