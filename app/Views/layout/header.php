<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Warung Nusantara') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand: #d9480f;
            --brand-dark: #a13a0c;
            --cream: #fff8f0;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--cream);
        }
        .navbar-brand {
            font-weight: 700;
            color: var(--brand) !important;
        }
        .btn-brand {
            background-color: var(--brand);
            border-color: var(--brand);
            color: #fff;
        }
        .btn-brand:hover {
            background-color: var(--brand-dark);
            border-color: var(--brand-dark);
            color: #fff;
        }
        .text-brand { color: var(--brand); }
        .badge-brand { background-color: var(--brand); }
        .card-menu img, .card-menu .no-image {
            height: 180px;
            object-fit: cover;
            width: 100%;
        }
        .card-menu .no-image {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffe8d6;
            color: var(--brand);
            font-size: 2.5rem;
        }
        .card-menu {
            border: none;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 14px rgba(0,0,0,0.06);
            transition: transform .15s ease;
        }
        .card-menu:hover { transform: translateY(-4px); }
        .hero {
            background: linear-gradient(135deg, var(--brand), #f08c00);
            color: #fff;
            border-radius: 0 0 24px 24px;
        }
        footer {
            background: #2b2118;
            color: #cbb;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('/') ?>">
            <i class="bi bi-egg-fried"></i> Warung Nusantara
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('/') ?>">Etalase</a>
                </li>

                <?php if (session()->get('logged_in')): ?>
                    <?php $role = session()->get('role'); ?>

                    <?php if (in_array($role, ['admin', 'penjual'], true)): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('makanan') ?>">
                                <i class="bi bi-gear"></i> Kelola Makanan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('pesanan-masuk') ?>">
                                <i class="bi bi-inbox"></i> Pesanan Masuk
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if ($role === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('user') ?>">
                                <i class="bi bi-people"></i> Manajemen User
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if ($role === 'pembeli'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('pesanan-saya') ?>">
                                <i class="bi bi-receipt"></i> Pesanan Saya
                            </a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> <?= esc(session()->get('nama')) ?>
                            <span class="badge badge-brand text-white text-capitalize"><?= esc($role) ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?= site_url('logout') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('login') ?>"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-brand btn-sm ms-lg-2" href="<?= site_url('register') ?>">
                            <i class="bi bi-person-plus"></i> Buat Akun
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
