<?= $this->include('layout/header') ?>

<section class="hero py-5 mb-5">
    <div class="container text-center py-4">
        <h1 class="fw-bold mb-3">Lapar? Pesan Makanan Favoritmu Sekarang!</h1>
        <p class="lead mb-4">Mie Ayam, Bakso, Soto, Sate, dan menu lezat lainnya siap diantar hangat ke meja Anda.</p>

        <form action="<?= site_url('/') ?>" method="get" class="row justify-content-center g-2">
            <div class="col-8 col-md-5">
                <input type="text" name="q" class="form-control form-control-lg" placeholder="Cari menu, misal: Bakso"
                       value="<?= esc($keyword ?? '') ?>">
            </div>
            <div class="col-auto">
                <button class="btn btn-light btn-lg text-brand fw-semibold" type="submit">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>
        </form>
    </div>
</section>

<div class="container mb-5">

    <?php if (session()->getFlashdata('sukses')): ?>
        <div class="alert alert-success"><?= esc(session()->getFlashdata('sukses')) ?></div>
    <?php endif; ?>

    <!-- Filter kategori -->
    <div class="mb-4 d-flex flex-wrap gap-2">
        <a href="<?= site_url('/') ?>"
           class="btn btn-sm <?= empty($kategoriAktif) ? 'btn-brand' : 'btn-outline-secondary' ?>">Semua</a>
        <?php foreach ($kategori as $k): ?>
            <a href="<?= site_url('/') ?>?kategori=<?= urlencode($k['kategori']) ?>"
               class="btn btn-sm <?= ($kategoriAktif === $k['kategori']) ? 'btn-brand' : 'btn-outline-secondary' ?>">
                <?= esc($k['kategori']) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <?php if (empty($makanan)): ?>
        <div class="text-center py-5">
            <i class="bi bi-emoji-frown display-4 text-muted"></i>
            <p class="mt-3 text-muted">Belum ada menu makanan yang tersedia saat ini.</p>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($makanan as $item): ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card card-menu h-100">
                        <?php if (!empty($item['gambar'])): ?>
                            <img src="<?= base_url('uploads/makanan/' . $item['gambar']) ?>" alt="<?= esc($item['nama_makanan']) ?>">
                        <?php else: ?>
                            <div class="no-image"><i class="bi bi-image"></i></div>
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <span class="badge badge-brand text-white mb-2 align-self-start"><?= esc($item['kategori']) ?></span>
                            <h6 class="card-title fw-semibold mb-1"><?= esc($item['nama_makanan']) ?></h6>
                            <p class="text-muted small mb-2 flex-grow-1">
                                <?= esc(mb_strimwidth($item['deskripsi'] ?? '-', 0, 70, '...')) ?>
                            </p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <strong class="text-brand">Rp <?= number_format((float) $item['harga'], 0, ',', '.') ?></strong>
                                <span class="badge <?= $item['status'] === 'Tersedia' ? 'bg-success' : 'bg-secondary' ?>">
                                    <?= esc($item['status']) ?>
                                </span>
                            </div>

                            <?php if (session()->get('role') === 'pembeli' && $item['status'] === 'Tersedia'): ?>
                                <button type="button" class="btn btn-sm btn-brand w-100" data-bs-toggle="modal" data-bs-target="#modalPesan<?= $item['id'] ?>">
                                    <i class="bi bi-cart-plus"></i> Pesan
                                </button>

                                <div class="modal fade" id="modalPesan<?= $item['id'] ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <form action="<?= site_url('pesan/' . $item['id']) ?>" method="post" class="modal-content">
                                            <?= csrf_field() ?>
                                            <div class="modal-header">
                                                <h6 class="modal-title">Pesan <?= esc($item['nama_makanan']) ?></h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Jumlah</label>
                                                    <input type="number" name="jumlah" class="form-control" value="1" min="1" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Catatan (opsional)</label>
                                                    <textarea name="catatan" class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-brand w-100">Buat Pesanan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php elseif (!session()->get('logged_in') && $item['status'] === 'Tersedia'): ?>
                                <a href="<?= site_url('login') ?>" class="btn btn-sm btn-outline-secondary w-100">
                                    <i class="bi bi-box-arrow-in-right"></i> Login untuk Memesan
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?= $this->include('layout/footer') ?>
