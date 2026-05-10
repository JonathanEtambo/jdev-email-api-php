<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? APP_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --accent: #2da44e;
            --accent-hover: #1a6e3a;
            --nav-bg: #ffffff;
            --text-main: #1a1e2b;
        }

        body {
            background-color: #f8fafc;
            color: var(--text-main);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        /* Navbar Style Premium */
        .navbar-premium {
            background: var(--nav-bg);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 0.75rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        }

        .navbar-brand-premium {
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -0.5px;
            font-size: 1.25rem;
        }

        .navbar-brand-premium span {
            color: var(--accent);
        }

        /* Nav Links */
        .nav-link-premium {
            font-weight: 600;
            font-size: 0.9rem;
            color: #64748b;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .nav-link-premium:hover {
            color: var(--accent);
            background: #f0fdf4;
        }

        .nav-link-premium.active {
            color: var(--accent);
            background: #f0fdf4;
        }

        /* Buttons */
        .btn-admin {
            background: var(--accent);
            color: white !important;
            border: none;
            font-weight: 600;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(45, 164, 78, 0.2);
        }

        .btn-logout {
            border: 1px solid #fee2e2;
            color: #ef4444;
            font-weight: 600;
            border-radius: 8px;
        }

        .btn-logout:hover {
            background: #fef2f2;
            color: #dc2626;
            border-color: #fca5a5;
        }

        /* Theme Toggle */
        .theme-switch {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            transition: all 0.2s;
        }

        .theme-switch:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        /* Styles de base (Light par défaut) */
:root {
    --bg-body: #f8fafc;
    --bg-card: #ffffff;
    --text-main: #1a1e2b;
    --nav-bg: #ffffff;
    --border-color: rgba(0,0,0,0.05);
}

/* Styles pour le mode sombre */
[data-theme="dark"] {
    --bg-body: #0d1117;
    --bg-card: #161b22;
    --text-main: #e6edf3;
    --nav-bg: #161b22;
    --border-color: rgba(255,255,255,0.1);
}

body {
    background-color: var(--bg-body);
    color: var(--text-main);
    transition: background-color 0.3s ease, color 0.3s ease;
}

.stat-card-premium, .premium-table-card, .navbar-premium {
    background-color: var(--bg-card) !important;
    border-color: var(--border-color) !important;
}

.navbar-brand-premium, .nav-link-premium {
    color: var(--text-main) !important;
}
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-premium sticky-top">
    <div class="container-fluid px-lg-5">
        <a class="navbar-brand navbar-brand-premium" href="<?php echo APP_URL; ?>/dashboard">
            JDev<span>Mail</span>
        </a>
        
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav mx-auto gap-1">
                <a href="<?php echo APP_URL; ?>/dashboard" class="nav-link nav-link-premium">Dashboard</a>
                <a href="<?php echo APP_URL; ?>/sites" class="nav-link nav-link-premium">Mes Sites</a>
                <a href="<?php echo APP_URL; ?>/subscriptions" class="nav-link nav-link-premium">Abonnements</a>
            </div>

            <div class="d-flex align-items-center gap-3">
                <button class="theme-switch" type="button" data-theme-toggle title="Changer de thème">
                    <i class="bi bi-moon-stars"></i>
                </button>

                <?php if ((\App\Core\Session::get('user_role') ?? '') === 'admin'): ?>
                    <a href="<?php echo APP_URL; ?>/admin" class="btn btn-sm btn-admin px-3">
                        <i class="bi bi-shield-check me-1"></i> Admin
                    </a>
                <?php endif; ?>

                <a href="<?php echo APP_URL; ?>/logout" class="btn btn-sm btn-logout px-3">
                    <i class="bi bi-box-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</nav>

<main class="container-fluid px-lg-5 py-4">
    <?php echo $content; ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?php echo APP_URL; ?>/assets/js/main.js"></script>
<script src="<?php echo APP_URL; ?>/assets/js/dashboard.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.querySelector('[data-theme-toggle]');
    const htmlElement = document.documentElement;
    
    // 1. Vérifier s'il y a un thème enregistré dans le navigateur
    const savedTheme = localStorage.getItem('theme') || 'light';
    htmlElement.setAttribute('data-theme', savedTheme);
    updateIcon(savedTheme);

    // 2. Écouter le clic sur le bouton
    themeToggle.addEventListener('click', () => {
        const currentTheme = htmlElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        
        // Appliquer le thème
        htmlElement.setAttribute('data-theme', newTheme);
        // Sauvegarder le choix
        localStorage.setItem('theme', newTheme);
        // Mettre à jour l'icône
        updateIcon(newTheme);
    });

    function updateIcon(theme) {
        const icon = themeToggle.querySelector('i');
        if (theme === 'dark') {
            icon.classList.replace('bi-moon-stars', 'bi-sun');
        } else {
            icon.classList.replace('bi-sun', 'bi-moon-stars');
        }
    }
});
</script>

</body>
</html>