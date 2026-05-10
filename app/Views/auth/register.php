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

.auth-shell {
    min-height: 100vh;
    background:
        radial-gradient(circle at top left, var(--accent-light), transparent 35%),
        var(--bg-page);
}

/* ======= SECTION IMAGE ======= */

.auth-visual {
    position: relative;
    overflow: hidden;
    border-radius: 28px;
    min-height: 720px;

    background:
        linear-gradient(
            rgba(13, 17, 23, 0.70),
            rgba(13, 17, 23, 0.88)
        ),
        url('https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=1200&q=80');

    background-size: cover;
    background-position: center;

    display: flex;
    flex-direction: column;
    justify-content: flex-end;

    padding: 50px;
    color: #fff;

    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
}

.auth-visual-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    background: rgba(255,255,255,0.12);

    backdrop-filter: blur(8px);

    padding: 10px 18px;

    border-radius: 999px;

    font-size: 13px;
    font-weight: 700;

    margin-bottom: 25px;

    width: fit-content;
}

.auth-visual-title {
    font-size: 42px;
    font-weight: 800;
    line-height: 1.2;

    margin-bottom: 18px;
}

.auth-visual-text {
    font-size: 16px;
    line-height: 1.8;

    color: rgba(255,255,255,0.88);

    max-width: 520px;
}

/* ======= FORMULAIRE ======= */

.auth-panel {
    background: var(--bg-panel);

    border: 1px solid var(--border-color);

    border-radius: 24px;

    box-shadow: 0 20px 50px rgba(0,0,0,0.08);

    color: var(--text-main);
}

.auth-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    background: var(--accent-light);
    color: var(--accent);

    padding: 8px 14px;

    border-radius: 999px;

    font-weight: 700;
    font-size: 13px;
}

.auth-title {
    color: var(--text-main);
    font-weight: 800;
}

.auth-subtitle {
    color: var(--text-muted);
}

.form-label,
.form-text,
.text-muted {
    color: var(--text-muted) !important;
}

.input-group {
    border-radius: 14px;
}

.input-group-text {
    background: var(--accent-light);

    color: var(--accent);

    border: 1px solid var(--border-color);
    border-right: none;
}

.form-control {
    background: transparent;

    color: var(--text-main);

    border: 1px solid var(--border-color);
}

.form-control::placeholder {
    color: var(--text-muted);
    opacity: 0.8;
}

.form-control:focus {
    background: transparent;
    color: var(--text-main);

    border-color: var(--accent);

    box-shadow: 0 0 0 0.2rem rgba(45,164,78,0.18);
}

.toggle-password {
    border-color: var(--border-color);
    color: var(--text-muted);
}

.toggle-password:hover {
    background: var(--accent-light);
    color: var(--accent);

    border-color: var(--accent);
}

.btn-auth {
    background: var(--accent);

    color: #fff;

    border: none;

    border-radius: 999px;

    font-weight: 700;

    transition: 0.25s ease;
}

.btn-auth:hover {
    background: var(--accent-hover);

    color: #fff;

    transform: translateY(-1px);
}

.auth-link {
    color: var(--accent);

    font-weight: 700;

    text-decoration: none;
}

.auth-link:hover {
    color: var(--accent-hover);

    text-decoration: underline;
}

.auth-divider {
    margin-top: 25px;
}

.auth-stagger {
    animation: fadeUp 0.6s ease both;
    animation-delay: var(--delay);
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

/* ======= RESPONSIVE ======= */

@media (max-width: 991px) {

    .auth-visual {
        display: none;
    }

    .auth-shell {
        padding-left: 14px;
        padding-right: 14px;
    }

    .auth-panel {
        border-radius: 18px;
    }
}
</style>

<div class="container-fluid auth-shell py-4 py-lg-5">
    <div class="row justify-content-center align-items-center g-4">

        <!-- ===== SECTION IMAGE ===== -->

        <div class="col-lg-6 d-none d-lg-block">
            <div class="auth-visual auth-stagger" style="--delay: 0.1s">

                <div class="auth-visual-badge">
    <i class="bi bi-envelope-check-fill"></i>
    JDevMail API
</div>

<h1 class="auth-visual-title">
    Connecte ton site vitrine à une API Email professionnelle.
</h1>

<p class="auth-visual-text">
    JDevMail permet aux sites vitrines d’envoyer facilement des emails depuis leurs formulaires :
    contact, devis, inscription, notification ou confirmation client.
    Une solution simple, rapide et sécurisée pour intégrer l’envoi d’emails sans complexité serveur.
</p>
<p class="auth-subtitle small mb-4 auth-stagger" style="--delay: 0.4s">
    Rejoins la plateforme et déploie tes solutions d'emailing.
</p>

            </div>
        </div>

        <!-- ===== FORMULAIRE ===== -->

        <div class="col-md-10 col-lg-5">
            <div class="auth-panel p-4 p-lg-5">

                <div class="text-center text-lg-start auth-stagger" style="--delay: 0.2s">
                    <span class="auth-badge mb-3">
                        <i class="bi bi-stars"></i>
                        Accès Développeur
                    </span>
                </div>

                <h3 class="auth-title mb-2 auth-stagger" style="--delay: 0.3s">
                    Créer un compte
                </h3>

                <p class="auth-subtitle small mb-4 auth-stagger" style="--delay: 0.4s">
                    Rejoins la plateforme et déploie tes solutions d'emailing.
                </p>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger border-0 shadow-sm auth-stagger" style="--delay: 0.1s">
                        <i class="bi bi-exclamation-circle-fill me-2"></i>
                        <?php echo e($error); ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?php echo APP_URL; ?>/register" novalidate>

                    <?php echo \App\Core\CSRF::field(); ?>

                    <div class="mb-3 auth-stagger" style="--delay: 0.5s">

                        <label class="form-label small fw-bold">
                            NOM COMPLET
                        </label>

                        <div class="input-group shadow-sm">

                            <span class="input-group-text">
                                <i class="bi bi-person-badge"></i>
                            </span>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="Ex: Jonathan Dzoko"
                                required
                            >
                        </div>
                    </div>

                    <div class="mb-3 auth-stagger" style="--delay: 0.6s">

                        <label class="form-label small fw-bold">
                            ADRESSE EMAIL
                        </label>

                        <div class="input-group shadow-sm">

                            <span class="input-group-text">
                                <i class="bi bi-envelope-at"></i>
                            </span>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="votre@email.com"
                                required
                            >
                        </div>
                    </div>

                    <div class="mb-4 auth-stagger" style="--delay: 0.7s">

                        <label class="form-label small fw-bold">
                            MOT DE PASSE
                        </label>

                        <div class="input-group shadow-sm">

                            <span class="input-group-text">
                                <i class="bi bi-shield-lock"></i>
                            </span>

                            <input
                                id="register-password"
                                type="password"
                                name="password"
                                class="form-control"
                                minlength="8"
                                placeholder="Sécurité maximale"
                                required
                            >

                            <button
                                class="btn btn-outline-secondary toggle-password px-3"
                                type="button"
                                data-target="register-password"
                            >
                                <i class="bi bi-eye"></i>
                            </button>

                        </div>

                        <div class="form-text mt-2 small">
                            <i class="bi bi-info-circle me-1"></i>
                            Minimum 8 caractères.
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="btn btn-auth w-100 py-3 auth-stagger"
                        style="--delay: 0.8s"
                    >
                        <i class="bi bi-rocket-takeoff me-2"></i>
                        Commencer l'aventure
                    </button>

                </form>

                <div class="auth-divider text-center auth-stagger" style="--delay: 0.9s">

                    <span class="small text-muted">
                        Déjà inscrit ?
                    </span>

                    <a
                        class="auth-link ms-1 small"
                        href="<?php echo APP_URL; ?>/login"
                    >
                        Se connecter maintenant
                    </a>

                </div>

            </div>
        </div>

    </div>
</div>

<script>
document.querySelectorAll('.toggle-password').forEach(function(button) {

    button.addEventListener('click', function() {

        const targetId = this.getAttribute('data-target');

        const input = document.getElementById(targetId);

        const icon = this.querySelector('i');

        if (!input || !icon) return;

        if (input.type === 'password') {

            input.type = 'text';

            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');

        } else {

            input.type = 'password';

            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    });
});
</script>