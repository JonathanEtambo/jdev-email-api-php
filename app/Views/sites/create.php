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
.site-form-card {
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

.site-form-card {
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

.rate-card {
    background: var(--accent-light);

    border-radius: 18px;

    padding: 18px;

    margin-top: 10px;
}

.rate-card small {
    color: var(--text-muted);
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

.form-tip {
    color: var(--text-muted);

    font-size: 13px;
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
    .site-form-card {
        padding: 26px;
    }

    .site-title {
        font-size: 30px;
    }

    .btn-site {
        width: 100%;
    }
}
</style>

<section class="site-page">

    <div class="container">

        <!-- HERO -->

        <div class="site-hero fade-up">

            <span class="site-badge mb-3">
                <i class="bi bi-globe2"></i>
                JDevMail Sites
            </span>

            <h2 class="site-title mb-3">
                Ajouter un nouveau site
            </h2>

            <p class="site-subtitle mb-0">
                Connectez un site vitrine à JDevMail afin d’envoyer des emails
                via API : formulaires de contact, demandes de devis,
                confirmations client et notifications transactionnelles.
            </p>

        </div>

        <!-- FORM -->

        <div class="site-form-card fade-up">

            <form method="post" action="<?php echo APP_URL; ?>/sites/store">

                <?php echo \App\Core\CSRF::field(); ?>

                <!-- NOM -->

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
                            placeholder="Ex: Mon Site Vitrine"
                            required
                        >

                    </div>

                    <div class="form-tip mt-2">
                        Nom interne utilisé dans votre dashboard JDevMail.
                    </div>

                </div>

                <!-- DOMAINE -->

                <div class="mb-4">

                    <label class="form-label">
                        Domaine du site
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-link-45deg"></i>
                        </span>

                        <input
                            type="text"
                            name="domain"
                            class="form-control"
                            placeholder="monsite.com"
                            required
                        >

                    </div>

                    <div class="form-tip mt-2">
                        Entrez uniquement le domaine sans https://
                    </div>

                </div>

                <!-- RATE LIMIT -->

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
                            value="60"
                            min="10"
                            max="1000"
                        >

                    </div>

                    <div class="rate-card mt-3">

                        <div class="d-flex align-items-start gap-3">

                            <div>
                                <i class="bi bi-info-circle-fill fs-4"
                                   style="color: var(--accent);"></i>
                            </div>

                            <div>

                                <strong class="d-block mb-1">
                                    Limitation des requêtes API
                                </strong>

                                <small>
                                    Définissez le nombre maximum d’emails pouvant être envoyés
                                    par minute depuis ce site afin d’éviter les abus API.
                                </small>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- BUTTON -->

                <div class="d-flex justify-content-end">

                    <button class="btn btn-site">

                        <i class="bi bi-plus-circle me-2"></i>
                        Créer le site

                    </button>

                </div>

            </form>

        </div>

    </div>

</section>