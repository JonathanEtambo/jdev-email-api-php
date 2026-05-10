<style>
:root{
    --accent:#2da44e;
    --accent-hover:#1a6e3a;
    --accent-light:rgba(45,164,78,.12);
    --bg-page:#f6f8fa;
    --bg-panel:#ffffff;
    --text-main:#1a1e2b;
    --text-muted:#64748b;
    --border-color:#d0d7de;
    --code-bg:#0d1117;
    --code-panel:#161b22;
}

[data-theme="dark"]{
    --bg-page:#0d1117;
    --bg-panel:#161b22;
    --text-main:#e6edf3;
    --text-muted:#8b949e;
    --border-color:#30363d;
    --code-bg:#010409;
    --code-panel:#0d1117;
}

.home-page{
    background:
        radial-gradient(circle at top left,var(--accent-light),transparent 35%),
        var(--bg-page);
    color:var(--text-main);
}

.home-hero{
    padding:80px 0;
    border-bottom:1px solid var(--border-color);
}

.home-badge{
    display:inline-flex;
    align-items:center;
    gap:8px;
    background:var(--accent-light);
    color:var(--accent);
    padding:9px 16px;
    border-radius:999px;
    font-size:13px;
    font-weight:800;
}

.home-title{
    color:var(--text-main);
    font-weight:900;
    letter-spacing:-0.05em;
    line-height:1.05;
}

.text-gradient{
    background:linear-gradient(135deg,var(--accent),#5dd87b);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

.home-subtitle{
    color:var(--text-muted);
    line-height:1.8;
}

.stat-value{
    color:var(--accent);
    font-weight:900;
}

.stat-label{
    color:var(--text-muted);
    font-size:14px;
}

.btn-home{
    background:var(--accent);
    border:none;
    color:#fff!important;
    border-radius:999px;
    font-weight:800;
    padding:13px 26px;
}

.btn-home:hover{
    background:var(--accent-hover);
}

.btn-home-outline{
    background:transparent;
    border:1px solid var(--border-color);
    color:var(--text-main)!important;
    border-radius:999px;
    font-weight:800;
    padding:13px 26px;
}

.btn-home-outline:hover{
    border-color:var(--accent);
    color:var(--accent)!important;
    background:var(--accent-light);
}

.code-card{
    background:linear-gradient(135deg,var(--code-bg),var(--code-panel));
    color:#fff;
    border:1px solid rgba(255,255,255,.08);
    border-radius:26px;
    box-shadow:0 25px 60px rgba(0,0,0,.25);
}

.code-card pre{
    margin:0;
    color:#e6edf3;
    font-size:14px;
    line-height:1.8;
}

.tech-badge{
    background:var(--code-bg);
    color:#fff;
    border-radius:999px;
    padding:9px 14px;
    font-weight:700;
    font-size:13px;
}

.section-block{
    padding:70px 0;
    border-bottom:1px solid var(--border-color);
}

.section-white{
    background:var(--bg-page);
}

.feature-card,
.info-card,
.founder-card,
.quote-card{
    background:var(--bg-panel);
    border:1px solid var(--border-color);
    color:var(--text-main);
    border-radius:24px;
    box-shadow:0 15px 35px rgba(0,0,0,.05);
}

.feature-card{
    transition:.25s ease;
}

.feature-card:hover,
.info-card:hover{
    transform:translateY(-4px);
    border-color:var(--accent);
}

.feature-icon,
.info-icon{
    width:60px;
    height:60px;
    border-radius:18px;
    background:var(--accent-light);
    color:var(--accent);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:26px;
}

.section-mini-badge{
    display:inline-flex;
    align-items:center;
    gap:8px;
    background:var(--accent-light);
    color:var(--accent);
    padding:8px 14px;
    border-radius:999px;
    font-weight:800;
    font-size:13px;
}

.section-title{
    color:var(--text-main);
    font-weight:900;
    letter-spacing:-0.04em;
}

.section-text,
.card-text,
.text-muted-custom{
    color:var(--text-muted);
}

.avatar-circle{
    width:180px;
    height:180px;
    background:linear-gradient(135deg,var(--accent),var(--accent-hover));
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    box-shadow:0 20px 45px rgba(45,164,78,.25);
}

.social-btn{
    width:38px;
    height:38px;
    border-radius:50%;
    border:1px solid var(--border-color);
    color:var(--text-main);
    display:inline-flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
}

.social-btn:hover{
    color:var(--accent);
    border-color:var(--accent);
    background:var(--accent-light);
}

.skill-badge{
    display:inline-flex;
    align-items:center;
    gap:6px;
    background:var(--bg-panel);
    border:1px solid var(--border-color);
    color:var(--text-main);
    padding:9px 14px;
    border-radius:999px;
    font-weight:700;
    font-size:13px;
}

.cta-banner{
    background:linear-gradient(135deg,#161b22,#0d1117);
    border-radius:30px;
    color:#fff;
    padding:50px;
    box-shadow:0 25px 60px rgba(0,0,0,.18);
}

.fade-in-up{
    animation:fadeUp .7s ease both;
}

.fade-in-right{
    animation:fadeRight .7s ease both;
}

.fade-in-left{
    animation:fadeLeft .7s ease both;
}

@keyframes fadeUp{
    from{opacity:0;transform:translateY(24px);}
    to{opacity:1;transform:translateY(0);}
}

@keyframes fadeRight{
    from{opacity:0;transform:translateX(30px);}
    to{opacity:1;transform:translateX(0);}
}

@keyframes fadeLeft{
    from{opacity:0;transform:translateX(-30px);}
    to{opacity:1;transform:translateX(0);}
}

@media(max-width:991px){
    .home-hero{
        padding:55px 0;
    }

    .home-title{
        font-size:2.5rem;
    }

    .section-block{
        padding:55px 0;
    }

    .cta-banner{
        padding:32px 22px;
    }
}
</style>

<div class="home-page">

<section class="home-hero position-relative overflow-hidden">
    <div class="container position-relative">
        <div class="row align-items-center g-5">

            <div class="col-lg-6 fade-in-up">

                <div class="home-badge mb-4">
                    <i class="bi bi-envelope-check-fill"></i>
                    API Email simple pour sites vitrines
                </div>

                <h1 class="home-title display-4 mb-4">
                    Connectez vos sites vitrines à
                    <span class="text-gradient">JDevMail API</span>
                </h1>

                <p class="home-subtitle lead mb-4">
                    JDevMail permet à vos sites vitrines d’envoyer facilement des emails :
                    formulaires de contact, demandes de devis, confirmations client et notifications.
                    Une seule API, une gestion centralisée et une intégration rapide.
                </p>

                <div class="d-flex gap-4 mb-4 flex-wrap">
                    <div>
                        <span class="h3 stat-value">Simple</span>
                        <span class="stat-label d-block">Intégration API</span>
                    </div>

                    <div>
                        <span class="h3 stat-value">Sécurisé</span>
                        <span class="stat-label d-block">Clés API</span>
                    </div>

                    <div>
                        <span class="h3 stat-value">Centralisé</span>
                        <span class="stat-label d-block">Dashboard</span>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-3">
                    <a href="<?php echo APP_URL; ?>/register" class="btn btn-home btn-lg">
                        <i class="bi bi-arrow-right-circle me-2"></i>
                        Démarrer maintenant
                    </a>

                    <a href="<?php echo APP_URL; ?>/docs" class="btn btn-home-outline btn-lg">
                        <i class="bi bi-book me-2"></i>
                        Voir la documentation
                    </a>
                </div>

                <div class="mt-4 pt-2">
                    <span class="small text-muted-custom">
                        <i class="bi bi-shield-check text-success"></i>
                        Aucune carte bancaire requise pour commencer.
                    </span>
                </div>

            </div>

            <div class="col-lg-6 d-none d-lg-block fade-in-right">

                <div class="code-card p-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex gap-2">
                            <div class="rounded-circle" style="width:12px;height:12px;background:#ff5f56;"></div>
                            <div class="rounded-circle" style="width:12px;height:12px;background:#ffbd2e;"></div>
                            <div class="rounded-circle" style="width:12px;height:12px;background:#27c93f;"></div>
                        </div>

                        <span class="text-white-50 small">
                            <?php echo parse_url(APP_URL, PHP_URL_HOST); ?>
                        </span>
                    </div>

                    <pre><code><span class="text-info">POST</span> <span class="text-warning">/api/send-email</span>
{
  <span class="text-success">"site_id"</span>: <span class="text-light">"site_xxxxx"</span>,
  <span class="text-success">"public_key"</span>: <span class="text-light">"jpk_xxxxx"</span>,
  <span class="text-success">"secret_key"</span>: <span class="text-light">"jsk_xxxxx"</span>,
  <span class="text-success">"to"</span>: <span class="text-light">"client@example.com"</span>,
  <span class="text-success">"subject"</span>: <span class="text-light">"Demande de contact"</span>,
  <span class="text-success">"html_content"</span>: <span class="text-light">"&lt;p&gt;Bonjour depuis mon site vitrine&lt;/p&gt;"</span>
}</code></pre>

                    <div class="mt-3 pt-3 border-top border-secondary">
                        <div class="small text-success">
                            <i class="bi bi-check-circle-fill"></i>
                            Response: { "success": true, "status": "sent" }
                        </div>
                    </div>

                </div>

                <div class="d-flex gap-2 justify-content-center mt-4 flex-wrap">
                    <span class="tech-badge">
                        <i class="bi bi-filetype-php"></i> PHP
                    </span>

                    <span class="tech-badge">
                        <i class="bi bi-code-slash"></i> REST API
                    </span>

                    <span class="tech-badge">
                        <i class="bi bi-shield-lock"></i> API Keys
                    </span>
                </div>

            </div>

        </div>
    </div>
</section>

<section class="section-block section-white">
    <div class="container">
        <div class="row g-4">

            <div class="col-md-4 fade-in-up">
                <div class="feature-card text-center p-4 h-100">
                    <div class="feature-icon mx-auto mb-3">
                        <i class="bi bi-lightning-charge-fill"></i>
                    </div>

                    <h5 class="fw-bold mb-2">
                        Intégration rapide
                    </h5>

                    <p class="card-text small mb-0">
                        Connectez un formulaire de contact ou de devis à l’API en quelques minutes.
                    </p>
                </div>
            </div>

            <div class="col-md-4 fade-in-up" style="animation-delay:.1s">
                <div class="feature-card text-center p-4 h-100">
                    <div class="feature-icon mx-auto mb-3">
                        <i class="bi bi-globe2"></i>
                    </div>

                    <h5 class="fw-bold mb-2">
                        Multi-sites
                    </h5>

                    <p class="card-text small mb-0">
                        Gérez plusieurs sites vitrines depuis un seul espace JDevMail.
                    </p>
                </div>
            </div>

            <div class="col-md-4 fade-in-up" style="animation-delay:.2s">
                <div class="feature-card text-center p-4 h-100">
                    <div class="feature-icon mx-auto mb-3">
                        <i class="bi bi-shield-check"></i>
                    </div>

                    <h5 class="fw-bold mb-2">
                        Accès sécurisé
                    </h5>

                    <p class="card-text small mb-0">
                        Chaque site utilise ses propres clés API pour sécuriser les envois.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="section-block">
    <div class="container">

        <div class="row justify-content-center text-center mb-5 fade-in-up">
            <div class="col-lg-8">
                <div class="section-mini-badge mb-3">
                    <i class="bi bi-person-badge"></i>
                    À propos
                </div>

                <h2 class="section-title display-6">
                    Le Fondateur
                </h2>

                <p class="section-text lead">
                    Une solution pensée pour simplifier l’envoi d’emails depuis les sites vitrines et projets web.
                </p>

                <hr class="mx-auto border-success border-3 opacity-100" style="width:60px;">
            </div>
        </div>

        <div class="row align-items-center g-5">

            <div class="col-md-4 text-center fade-in-left">
                <div class="position-relative d-inline-block">
                    <div class="avatar-circle mx-auto mb-3">
                        <i class="bi bi-person-fill text-white" style="font-size:5rem;"></i>
                    </div>

                    <div class="position-absolute bottom-0 end-0 bg-success rounded-circle p-2 border border-white">
                        <i class="bi bi-check-lg text-white small"></i>
                    </div>
                </div>

                <div class="d-flex gap-2 justify-content-center mt-3">
                    <a href="#" class="social-btn">
                        <i class="bi bi-github"></i>
                    </a>

                    <a href="#" class="social-btn">
                        <i class="bi bi-linkedin"></i>
                    </a>

                    <a href="#" class="social-btn">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-8 fade-in-right">

                <h4 class="section-title display-6 mb-1">
                    <?php echo htmlspecialchars($founder['name'] ?? 'Jonathan Dzoko', ENT_QUOTES, 'UTF-8'); ?>
                </h4>

                <p class="fw-semibold mb-3 fs-5" style="color:var(--accent);">
                    <i class="bi bi-star-fill me-1"></i>
                    <?php echo htmlspecialchars($founder['role'] ?? 'Développeur Full-Stack & Entrepreneur', ENT_QUOTES, 'UTF-8'); ?>
                </p>

                <p class="section-text lead">
                    <?php echo htmlspecialchars($founder['bio'] ?? 'Jonathan a créé JDevMail pour aider les développeurs et propriétaires de sites vitrines à intégrer facilement l’envoi d’emails sans gérer eux-mêmes toute la complexité SMTP. Sa vision : une API simple, fiable et accessible.', ENT_QUOTES, 'UTF-8'); ?>
                </p>

                <div class="d-flex flex-wrap gap-2 mt-4">
                    <span class="skill-badge">
                        <i class="bi bi-check-circle-fill text-success"></i> Full-Stack
                    </span>

                    <span class="skill-badge">
                        <i class="bi bi-shield-check text-success"></i> Cybersecurity
                    </span>

                    <span class="skill-badge">
                        <i class="bi bi-wifi text-success"></i> Networks
                    </span>

                    <span class="skill-badge">
                        <i class="bi bi-cpu text-success"></i> IoT
                    </span>

                    <span class="skill-badge">
                        <i class="bi bi-cloud text-success"></i> Cloud
                    </span>
                </div>

                <div class="quote-card mt-4 p-4">
                    <i class="bi bi-quote fs-4 me-2" style="color:var(--accent);"></i>
                    <span class="section-text fst-italic">
                        “Rendre l’envoi d’emails simple, fiable et accessible pour les sites vitrines.”
                    </span>
                </div>

            </div>

        </div>

    </div>
</section>

<section class="section-block section-white">
    <div class="container">

        <div class="row justify-content-center text-center mb-5 fade-in-up">
            <div class="col-lg-8">
                <h2 class="section-title display-6">
                    Pourquoi choisir JDevMail ?
                </h2>

                <p class="section-text lead">
                    Tout ce dont vous avez besoin pour connecter vos sites vitrines à une API Email fiable.
                </p>
            </div>
        </div>

        <div class="row g-4">

            <div class="col-md-6 fade-in-up">
                <div class="info-card d-flex gap-3 p-4 h-100">
                    <div class="info-icon flex-shrink-0">
                        <i class="bi bi-code-square"></i>
                    </div>

                    <div>
                        <h6 class="fw-bold mb-1">
                            Intégration simple
                        </h6>

                        <p class="section-text small mb-0">
                            Une requête HTTP suffit pour envoyer votre premier email depuis un site vitrine.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 fade-in-up" style="animation-delay:.1s">
                <div class="info-card d-flex gap-3 p-4 h-100">
                    <div class="info-icon flex-shrink-0">
                        <i class="bi bi-speedometer2"></i>
                    </div>

                    <div>
                        <h6 class="fw-bold mb-1">
                            Gestion centralisée
                        </h6>

                        <p class="section-text small mb-0">
                            Suivez vos sites, vos clés API, vos quotas et vos abonnements depuis un dashboard.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 fade-in-up" style="animation-delay:.2s">
                <div class="info-card d-flex gap-3 p-4 h-100">
                    <div class="info-icon flex-shrink-0">
                        <i class="bi bi-envelope-check"></i>
                    </div>

                    <div>
                        <h6 class="fw-bold mb-1">
                            Envois transactionnels
                        </h6>

                        <p class="section-text small mb-0">
                            Idéal pour les messages de contact, confirmations, devis et notifications client.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 fade-in-up" style="animation-delay:.3s">
                <div class="info-card d-flex gap-3 p-4 h-100">
                    <div class="info-icon flex-shrink-0">
                        <i class="bi bi-headset"></i>
                    </div>

                    <div>
                        <h6 class="fw-bold mb-1">
                            Support développeur
                        </h6>

                        <p class="section-text small mb-0">
                            Une documentation claire pour intégrer rapidement JDevMail dans vos projets.
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <div class="cta-banner text-center mt-5 fade-in-up">
            <h3 class="fw-bold mb-3">
                Prêt à simplifier vos envois d’emails ?
            </h3>

            <p class="mb-4 opacity-75">
                Créez votre compte JDevMail et connectez vos sites vitrines à notre API Email.
            </p>

            <a href="<?php echo APP_URL; ?>/register" class="btn btn-home btn-lg">
                <i class="bi bi-rocket-takeoff me-2"></i>
                Démarrer maintenant
            </a>

            <p class="small mt-3 opacity-50 mb-0">
                Aucune carte bancaire requise pour commencer.
            </p>
        </div>

    </div>
</section>

</div>