<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? APP_NAME, ENT_QUOTES, 'UTF-8'); ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= APP_URL; ?>/assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top navbar-github">
    <div class="container">
        <a class="navbar-brand fw-semibold" href="<?= APP_URL; ?>">
            <i class="bi bi-envelope-fill me-2" style="color: var(--success);"></i>JDev Mail API
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="bi bi-list fs-2"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2 mt-3 mt-lg-0">
                <li class="nav-item"><a class="nav-link nav-link-gh" href="<?= APP_URL; ?>/pricing">Tarifs</a></li>
                <li class="nav-item"><a class="nav-link nav-link-gh" href="<?= APP_URL; ?>/docs">Documentation</a></li>
                <li class="nav-item"><button class="theme-switch" type="button" data-theme-toggle><i class="bi bi-moon-stars"></i></button></li>
                <li class="nav-item"><a class="btn btn-gh-outline btn-sm w-100" href="<?= APP_URL; ?>/login">Connexion</a></li>
                <li class="nav-item"><a class="btn btn-success btn-sm w-100" href="<?= APP_URL; ?>/register">Essai Gratuit</a></li>
            </ul>
        </div>
    </div>
</nav>
<main><?= $content; ?></main>
<footer class="footer-gh py-4 mt-5">
    <div class="container text-center small text-muted">JDev Mail API © <?= date('Y'); ?> - Développé par <strong><?= htmlspecialchars($founder['name'] ?? 'JONATHAN DZOKO', ENT_QUOTES, 'UTF-8'); ?></strong></div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= APP_URL; ?>/assets/js/main.js"></script>
</body>
</html>
