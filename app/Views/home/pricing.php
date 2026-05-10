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

.pricing-page {
    background:
        radial-gradient(circle at top left, var(--accent-light), transparent 35%),
        var(--bg-page);
    min-height: 100vh;
    padding: 70px 0;
}

.pricing-hero {
    background: var(--bg-panel);
    border: 1px solid var(--border-color);
    border-radius: 28px;
    padding: 40px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.06);
    margin-bottom: 32px;
}

.pricing-badge {
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

.pricing-title {
    color: var(--text-main);
    font-weight: 800;
    letter-spacing: -0.04em;
}

.pricing-subtitle {
    color: var(--text-muted);
    max-width: 760px;
    line-height: 1.7;
}

.plan-card {
    background: var(--bg-panel);
    border: 1px solid var(--border-color);
    border-radius: 24px;
    padding: 28px;
    height: 100%;
    color: var(--text-main);
    box-shadow: 0 15px 35px rgba(0,0,0,0.05);
    transition: 0.25s ease;
}

.plan-card:hover {
    transform: translateY(-4px);
    border-color: var(--accent);
}

.plan-icon {
    width: 50px;
    height: 50px;
    border-radius: 16px;
    background: var(--accent-light);
    color: var(--accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    margin-bottom: 18px;
}

.plan-name {
    color: var(--text-main);
    font-weight: 800;
}

.plan-description {
    color: var(--text-muted);
    min-height: 48px;
}

.plan-price {
    color: var(--accent);
    font-size: 34px;
    font-weight: 800;
    margin: 20px 0;
}

.plan-price small {
    font-size: 14px;
    color: var(--text-muted);
    font-weight: 600;
}

.btn-pricing {
    background: var(--accent);
    color: #fff !important;
    border: none;
    border-radius: 999px;
    font-weight: 700;
    padding: 11px 18px;
}

.btn-pricing:hover {
    background: var(--accent-hover);
}

.pricing-note {
    background: var(--accent-light);
    color: var(--text-muted);
    border-radius: 20px;
    padding: 18px 22px;
    margin-top: 28px;
}

.pricing-note strong {
    color: var(--accent);
}

@media (max-width: 768px) {
    .pricing-hero {
        padding: 28px;
    }

    .pricing-title {
        font-size: 30px;
    }
}
</style>

<section class="pricing-page">
    <div class="container">

        <div class="pricing-hero">
            <span class="pricing-badge mb-3">
                <i class="bi bi-tags-fill"></i>
                Tarifs JDevMail
            </span>

            <h1 class="pricing-title display-6 mb-3">
                Plans adaptés à la croissance de vos sites vitrines
            </h1>

            <p class="pricing-subtitle mb-0">
                Choisissez un plan JDevMail pour activer l’envoi d’emails via API :
                formulaires de contact, demandes de devis, confirmations client et notifications.
                L’activation se fait par validation manuelle administrateur.
            </p>
        </div>

        <div class="row g-4">
            <?php foreach ($plans as $plan): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="plan-card">

                        <div class="plan-icon">
                            <?php if ((float)$plan['price'] <= 0): ?>
                                <i class="bi bi-gift-fill"></i>
                            <?php else: ?>
                                <i class="bi bi-rocket-takeoff-fill"></i>
                            <?php endif; ?>
                        </div>

                        <h5 class="plan-name mb-2">
                            <?php echo e($plan['name']); ?>
                        </h5>

                        <p class="plan-description small mb-3">
                            <?php echo e($plan['description']); ?>
                        </p>

                        <div class="plan-price">
                            <?php echo number_format((float)$plan['price'], 2); ?> USD
                            <small>/ plan</small>
                        </div>

                        <a href="<?php echo APP_URL; ?>/register" class="btn btn-pricing w-100">
                            <i class="bi bi-arrow-right-circle me-2"></i>
                            Commencer
                        </a>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="pricing-note">
            <strong><i class="bi bi-info-circle me-1"></i> Note :</strong>
            après inscription, votre accès API peut être activé selon le plan choisi et la validation administrative.
        </div>

    </div>
</section>