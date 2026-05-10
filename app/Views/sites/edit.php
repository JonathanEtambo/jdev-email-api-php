<style>
:root {
    --accent: #2da44e;
    --accent-hover: #1a6e3a;
    --accent-light: rgba(45, 164, 78, 0.12);

    --bg-page: #f6f8fa;
    --bg-panel: #ffffff;

    --text-main: #1a1e2b;
    --text-muted: #64748b;

    --border-color: #d0d7de;
    --danger: #dc3545;
    --danger-light: rgba(220, 53, 69, 0.12);
}

[data-theme="dark"] {
    --bg-page: #0d1117;
    --bg-panel: #161b22;

    --text-main: #e6edf3;
    --text-muted: #8b949e;

    --border-color: #30363d;
}

.site-page {
    background:
        radial-gradient(circle at top left, var(--accent-light), transparent 35%),
        var(--bg-page);

    min-height: 100vh;
    padding: 70px 0 110px;
}

.site-hero,
.site-form-card,
.danger-card {
    background: var(--bg-panel);
    border: 1px solid var(--border-color);
    color: var(--text-main);
    box-shadow: 0 15px 35px rgba(0,0,0,0.05);
}

.site-hero {
    border-radius: 28px;
    padding: 38px;
    margin-bottom: 28px;
}

.site-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--accent-light);
    color: var(--accent);
    padding: 8px 14px;
    border-radius: 999px;
    font-weight: 800;
    font-size: 13px;
}

.site-title {
    color: var(--text-main);
    font-weight: 900;
    letter-spacing: -0.04em;
}

.site-subtitle {
    color: var(--text-muted);
    max-width: 760px;
    line-height: 1.7;
}

.site-form-card,
.danger-card {
    border-radius: 28px;
    padding: 36px;
}

.form-label {
    color: var(--text-main);
    font-weight: 700;
    margin-bottom: 10px;
}

.form-control {
    background: transparent !important;
    border: 1px solid var(--border-color);
    color: var(--text-main);
    border-radius: 16px;
    padding: 14px 16px;
    min-height: 54px;
    transition: 0.25s ease;
}

.form-control::placeholder {
    color: var(--text-muted);
}

.form-control:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 0.2rem rgba(45,164,78,0.16);
    color: var(--text-main);
}

.input-group-text {
    background: var(--accent-light);
    border: 1px solid var(--border-color);
    border-right: none;
    color: var(--accent);
    border-radius: 16px 0 0 16px;
    padding: 0 16px;
}

.input-group .form-control {
    border-radius: 0 16px 16px 0;
}

.option-card {
    background: var(--accent-light);
    border: 1px solid rgba(45,164,78,0.18);
    border-radius: 18px;
    padding: 18px;
}

.danger-option-card {
    background: var(--danger-light);
    border: 1px solid rgba(220,53,69,0.18);
    border-radius: 18px;
    padding: 18px;
}

.form-check-input {
    border-color: var(--border-color);
}

.form-check-input:checked {
    background-color: var(--accent);
    border-color: var(--accent);
}

.form-check-label {
    color: var(--text-main);
    font-weight: 700;
}

.form-help {
    color: var(--text-muted);
    font-size: 13px;
    margin-top: 5px;
}

.btn-site {
    background: var(--accent);
    color: #fff !important;
    border: none;
    border-radius: 999px;
    padding: 14px 22px;
    font-weight: 800;
    transition: 0.25s ease;
}

.btn-site:hover {
    background: var(--accent-hover);
    transform: translateY(-1px);
}

.btn-danger-soft {
    background: transparent;
    color: var(--danger) !important;
    border: 1px solid rgba(220,53,69,0.35);
    border-radius: 999px;
    padding: 13px 22px;
    font-weight: 800;
}

.btn-danger-soft:hover {
    background: var(--danger);
    color: #fff !important;
}

.danger-title {
    color: var(--danger);
    font-weight: 900;
}

.danger-text {
    color: var(--text-muted);
}

.fade-up {
    animation: fadeUp .6s ease both;
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(18px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .site-page {
        padding: 50px 0 90px;
    }

    .site-hero,
    .site-form-card,
    .danger-card {
        padding: 26px;
    }

    .site-title {
        font-size: 30px;
    }

    .btn-site,
    .btn-danger-soft {
        width: 100%;
    }
}
</style>

<section class="site-page">
    <div class="container">

        <div class="site-hero fade-up">
            <span class="site-badge mb-3">
                <i class="bi bi-pencil-square"></i>
                JDevMail Sites
            </span>

            <h2 class="site-title mb-3">
                Modifier un site
            </h2>

            <p class="site-subtitle mb-0">
                Mettez à jour les informations de votre site vitrine, ajustez la limite d’envoi
                par minute, activez ou désactivez l’accès API, et régénérez les clés si nécessaire.
            </p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger border-0 shadow-sm mb-4">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <?php echo e($error); ?>
            </div>
        <?php endif; ?>

        <div class="site-form-card fade-up mb-4">
            <form method="post" action="<?php echo APP_URL; ?>/sites/update/<?php echo (int) $site['id']; ?>">

                <?php echo \App\Core\CSRF::field(); ?>

                <div class="mb-4">
                    <label class="form-label">
                        Nom du site
                    </label>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-window"></i>
                        </span>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="<?php echo e($site['name']); ?>"
                            required
                        >
                    </div>

                    <div class="form-help">
                        Nom interne visible dans votre dashboard JDevMail.
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        Domaine
                    </label>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-link-45deg"></i>
                        </span>

                        <input
                            type="text"
                            name="domain"
                            class="form-control"
                            value="<?php echo e($site['domain']); ?>"
                            placeholder="monsite.com"
                            required
                        >
                    </div>

                    <div class="form-help">
                        Entrez uniquement le domaine sans https://
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        Rate limit / minute
                    </label>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-speedometer2"></i>
                        </span>

                        <input
                            type="number"
                            name="rate_limit_per_minute"
                            class="form-control"
                            value="<?php echo (int) $site['rate_limit_per_minute']; ?>"
                            min="10"
                            max="1000"
                        >
                    </div>

                    <div class="form-help">
                        Nombre maximum de requêtes API autorisées par minute pour ce site.
                    </div>
                </div>

                <div class="option-card mb-3">
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="is_active"
                            id="is_active"
                            <?php echo $site['is_active'] ? 'checked' : ''; ?>
                        >

                        <label class="form-check-label" for="is_active">
                            Site actif
                        </label>
                    </div>

                    <div class="form-help">
                        Si cette option est désactivée, ce site ne pourra plus envoyer d’emails via l’API.
                    </div>
                </div>

                <div class="danger-option-card mb-4">
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="regenerate_keys"
                            id="regenerate_keys"
                        >

                        <label class="form-check-label" for="regenerate_keys">
                            Régénérer les clés API
                        </label>
                    </div>

                    <div class="form-help">
                        Attention : les anciennes clés API deviendront invalides après la mise à jour.
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-site">
                        <i class="bi bi-check-circle me-2"></i>
                        Mettre à jour
                    </button>
                </div>

            </form>
        </div>

        <div class="danger-card fade-up">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h5 class="danger-title mb-2">
                        Zone dangereuse
                    </h5>

                    <p class="danger-text mb-0">
                        La suppression du site désactivera définitivement ses accès API et son historique lié.
                    </p>
                </div>

                <form
                    method="post"
                    action="<?php echo APP_URL; ?>/sites/delete/<?php echo (int) $site['id']; ?>"
                    onsubmit="return confirm('Supprimer ce site ?');"
                >
                    <?php echo \App\Core\CSRF::field(); ?>

                    <button class="btn btn-danger-soft">
                        <i class="bi bi-trash3 me-2"></i>
                        Supprimer le site
                    </button>
                </form>
            </div>
        </div>

    </div>
</section>