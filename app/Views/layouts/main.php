<?php
use App\Core\Session;

$isLoggedIn = !empty(Session::get('user_id'));
$userRole   = Session::get('user_role') ?? null;
$userName   = Session::get('user_name') ?? 'Utilisateur';

$currentUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

function active_link(string $path, string $currentUri): string {
    return str_contains($currentUri, $path) ? 'active' : '';
}
?>
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

    <style>
        :root {
            --accent: #2da44e;
            --accent-hover: #1a6e3a;
            --accent-light: rgba(45, 164, 78, 0.12);
            --bg-body: #f6f8fa;
            --bg-panel: #ffffff;
            --text-main: #1a1e2b;
            --text-muted: #64748b;
            --border-color: #d0d7de;
        }

        [data-theme="dark"] {
            --bg-body: #0d1117;
            --bg-panel: #161b22;
            --text-main: #e6edf3;
            --text-muted: #8b949e;
            --border-color: #30363d;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
        }

        .jdev-navbar {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border-color);
            padding: .85rem 0;
        }

        [data-theme="dark"] .jdev-navbar {
            background: rgba(22,27,34,0.9);
        }

        .jdev-brand {
            font-weight: 800;
            font-size: 1.35rem;
            color: var(--text-main);
            text-decoration: none;
        }

        .jdev-brand span {
            color: var(--accent);
        }

        .jdev-brand-icon {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: var(--accent-light);
            color: var(--accent);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
        }

        .jdev-nav-link {
            color: var(--text-muted) !important;
            font-weight: 600;
            font-size: .92rem;
            padding: .55rem .85rem !important;
            border-radius: 10px;
        }

        .jdev-nav-link:hover,
        .jdev-nav-link.active {
            color: var(--accent) !important;
            background: var(--accent-light);
        }

        .btn-jdev {
            background: var(--accent);
            color: #fff !important;
            border-radius: 999px;
            font-weight: 700;
            border: none;
            padding: .55rem 1rem;
        }

        .btn-jdev:hover {
            background: var(--accent-hover);
        }

        .btn-jdev-outline {
            border: 1px solid var(--border-color);
            color: var(--text-main) !important;
            background: var(--bg-panel);
            border-radius: 999px;
            font-weight: 700;
            padding: .55rem 1rem;
        }

        .btn-jdev-outline:hover {
            border-color: var(--accent);
            color: var(--accent) !important;
            background: var(--accent-light);
        }

        .theme-switch {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            background: var(--bg-panel);
            color: var(--text-muted);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .theme-switch:hover {
            color: var(--accent);
            border-color: var(--accent);
        }

        .user-pill {
            background: var(--accent-light);
            color: var(--accent);
            border-radius: 999px;
            padding: .45rem .8rem;
            font-weight: 700;
            font-size: .85rem;
        }

        main {
            min-height: calc(100vh - 150px);
        }

        .footer-jdev {
            border-top: 1px solid var(--border-color);
            background: var(--bg-panel);
        }

        @media (max-width: 991px) {
            .jdev-actions {
                padding-top: 1rem;
                align-items: stretch !important;
            }

            .jdev-actions .btn,
            .jdev-actions .theme-switch {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg sticky-top jdev-navbar">
    <div class="container">

        <a class="jdev-brand d-flex align-items-center" href="<?= APP_URL; ?>">
            <span class="jdev-brand-icon">
                <i class="bi bi-envelope-paper-heart-fill"></i>
            </span>
            JDev<span>Mail</span>
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="bi bi-list fs-1"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <?php if ($isLoggedIn): ?>

                <ul class="navbar-nav mx-auto gap-lg-1">
                    <li class="nav-item">
                        <a class="nav-link jdev-nav-link <?= active_link('/dashboard', $currentUri); ?>" href="<?= APP_URL; ?>/dashboard">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link jdev-nav-link <?= active_link('/sites', $currentUri); ?>" href="<?= APP_URL; ?>/sites">
                            <i class="bi bi-globe2 me-1"></i> Mes sites
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link jdev-nav-link <?= active_link('/docs', $currentUri); ?>" href="<?= APP_URL; ?>/docs">
                            <i class="bi bi-code-square me-1"></i> Docs API
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link jdev-nav-link <?= active_link('/pricing', $currentUri); ?>" href="<?= APP_URL; ?>/pricing">
                            <i class="bi bi-credit-card me-1"></i> Abonnement
                        </a>
                    </li>

                    <?php if ($userRole === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link jdev-nav-link <?= active_link('/admin', $currentUri); ?>" href="<?= APP_URL; ?>/admin">
                                <i class="bi bi-shield-lock me-1"></i> Admin
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>

                <div class="d-flex align-items-center gap-2 jdev-actions">
                    <button class="theme-switch" type="button" data-theme-toggle>
                        <i class="bi bi-moon-stars"></i>
                    </button>

                    <span class="user-pill d-none d-lg-inline-flex">
                        <i class="bi bi-person-circle me-1"></i>
                        <?= htmlspecialchars($userName, ENT_QUOTES, 'UTF-8'); ?>
                    </span>

                    <a class="btn btn-jdev-outline btn-sm" href="<?= APP_URL; ?>/logout">
                        <i class="bi bi-box-arrow-right me-1"></i> Déconnexion
                    </a>
                </div>

            <?php else: ?>

                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <li class="nav-item">
                        <a class="nav-link jdev-nav-link <?= active_link('/', $currentUri); ?>" href="<?= APP_URL; ?>">
                            Accueil
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link jdev-nav-link <?= active_link('/pricing', $currentUri); ?>" href="<?= APP_URL; ?>/pricing">
                            Tarifs
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link jdev-nav-link <?= active_link('/docs', $currentUri); ?>" href="<?= APP_URL; ?>/docs">
                            Documentation
                        </a>
                    </li>

                    <li class="nav-item">
                        <button class="theme-switch" type="button" data-theme-toggle>
                            <i class="bi bi-moon-stars"></i>
                        </button>
                    </li>

                    <li class="nav-item">
                        <a class="btn btn-jdev-outline btn-sm" href="<?= APP_URL; ?>/login">
                            Connexion
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="btn btn-jdev btn-sm" href="<?= APP_URL; ?>/register">
                            Démarrer gratuitement
                        </a>
                    </li>
                </ul>

            <?php endif; ?>

        </div>
    </div>
</nav>

<main>
    <?= $content; ?>
</main>

<footer class="footer-jdev py-4 mt-5">
    <div class="container text-center small text-muted">
        JDevMail © <?= date('Y'); ?> —
        Développé par
        <strong><?= htmlspecialchars($founder['name'] ?? 'JONATHAN DZOKO', ENT_QUOTES, 'UTF-8'); ?></strong>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= APP_URL; ?>/assets/js/main.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const html = document.documentElement;
    const themeToggle = document.querySelector('[data-theme-toggle]');

    const savedTheme = localStorage.getItem('theme') || 'light';
    html.setAttribute('data-theme', savedTheme);
    updateThemeIcon(savedTheme);

    if (themeToggle) {
        themeToggle.addEventListener('click', function () {
            const currentTheme = html.getAttribute('data-theme') || 'light';
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';

            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon(newTheme);
        });
    }

    function updateThemeIcon(theme) {
        const icon = document.querySelector('[data-theme-toggle] i');
        if (!icon) return;

        icon.classList.toggle('bi-sun', theme === 'dark');
        icon.classList.toggle('bi-moon-stars', theme !== 'dark');
    }
});
</script>

</body>
</html>