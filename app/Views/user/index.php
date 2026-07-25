<?= $this->include('layout/header') ?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h3 class="fw-bold mb-0"><i class="bi bi-people text-brand"></i> Manajemen User</h3>
        <a href="<?= site_url('user/create') ?>" class="btn btn-brand">
            <i class="bi bi-person-plus"></i> Tambah User
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

    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-muted small">Total User</div>
                    <div class="fs-4 fw-bold text-brand"><?= array_sum($ringkasan) ?></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-muted small">Admin</div>
                    <div class="fs-4 fw-bold"><?= $ringkasan['admin'] ?></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-muted small">Penjual</div>
                    <div class="fs-4 fw-bold"><?= $ringkasan['penjual'] ?></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-muted small">Pembeli</div>
                    <div class="fs-4 fw-bold"><?= $ringkasan['pembeli'] ?></div>
                </div>
            </div>
        </div>
    </div>

    <form action="<?= site_url('user') ?>" method="get" class="row g-2 mb-4">
        <div class="col-8 col-md-4">
            <input type="text" name="q" class="form-control" placeholder="Cari nama / username / email..." value="<?= esc($keyword ?? '') ?>">
        </div>
        <div class="col-6 col-md-3">
            <select name="role" class="form-select">
                <option value="">Semua Role</option>
                <option value="admin" <?= $roleAktif === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="penjual" <?= $roleAktif === 'penjual' ? 'selected' : '' ?>>Penjual</option>
                <option value="pembeli" <?= $roleAktif === 'pembeli' ? 'selected' : '' ?>>Pembeli</option>
            </select>
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
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>No. HP</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($users)): ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Belum ada data user.</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; ?>
                            <?php foreach ($users as $item): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <?= esc($item['nama']) ?>
                                        <?php if ((int) $item['id'] === (int) session()->get('user_id')): ?>
                                            <span class="badge bg-info text-dark">Anda</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($item['username']) ?></td>
                                    <td><?= esc($item['email']) ?></td>
                                    <td>
                                        <?php
                                            $warnaRole = [
                                                'admin'   => 'bg-danger',
                                                'penjual' => 'bg-warning text-dark',
                                                'pembeli' => 'bg-success',
                                            ];
                                        ?>
                                        <span class="badge <?= $warnaRole[$item['role']] ?? 'bg-secondary' ?> text-capitalize">
                                            <?= esc($item['role']) ?>
                                        </span>
                                    </td>
                                    <td><?= esc($item['no_hp'] ?? '-') ?></td>
                                    <td class="text-center">
                                        <a href="<?= site_url('user/edit/' . $item['id']) ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <?php if ((int) $item['id'] !== (int) session()->get('user_id')): ?>
                                            <a href="<?= site_url('user/delete/' . $item['id']) ?>" class="btn btn-sm btn-outline-danger"
                                               title="Hapus" onclick="return confirm('Yakin ingin menghapus user \'<?= esc($item['nama'], 'js') ?>\'?');">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        <?php endif; ?>
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
