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

.sub-page {
    background:
        radial-gradient(circle at top left, var(--accent-light), transparent 35%),
        var(--bg-page);
    min-height: 100vh;
    padding: 70px 0;
}

.sub-hero,
.sub-panel,
.plan-card {
    background: var(--bg-panel);
    border: 1px solid var(--border-color);
    color: var(--text-main);
    box-shadow: 0 15px 35px rgba(0,0,0,0.05);
}

.sub-hero {
    border-radius: 28px;
    padding: 40px;
    margin-bottom: 28px;
}

.sub-badge {
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

.sub-title {
    color: var(--text-main);
    font-weight: 800;
    letter-spacing: -0.04em;
}

.sub-subtitle {
    color: var(--text-muted);
    max-width: 760px;
    line-height: 1.7;
}

.plan-card {
    border-radius: 24px;
    padding: 28px;
    height: 100%;
    transition: 0.25s ease;
    position: relative;
    overflow: hidden;
}

.plan-card:hover {
    transform: translateY(-4px);
    border-color: var(--accent);
}

.plan-icon {
    width: 48px;
    height: 48px;
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
    font-weight: 800;
    color: var(--text-main);
}

.plan-desc {
    color: var(--text-muted);
    min-height: 48px;
}

.plan-price {
    color: var(--accent);
    font-size: 32px;
    font-weight: 800;
    margin: 18px 0;
}

.plan-price small {
    color: var(--text-muted);
    font-size: 14px;
    font-weight: 600;
}

.btn-sub {
    background: var(--accent);
    color: #fff !important;
    border: none;
    border-radius: 999px;
    font-weight: 700;
    padding: 11px 16px;
}

.btn-sub:hover {
    background: var(--accent-hover);
}

.free-badge {
    display: inline-flex;
    background: var(--accent-light);
    color: var(--accent);
    border-radius: 999px;
    padding: 9px 14px;
    font-weight: 700;
}

.sub-panel {
    border-radius: 24px;
    padding: 28px;
}

.sub-panel h5 {
    color: var(--text-main);
    font-weight: 800;
}

.table {
    color: var(--text-main);
}

.table thead th {
    color: var(--text-main);
    border-color: var(--border-color);
    font-weight: 800;
}

.table tbody td {
    color: var(--text-muted);
    border-color: var(--border-color);
}

.status-pill {
    display: inline-flex;
    border-radius: 999px;
    padding: 6px 10px;
    font-size: 12px;
    font-weight: 800;
    background: var(--accent-light);
    color: var(--accent);
}

.empty-state {
    text-align: center;
    padding: 40px 20px;
    color: var(--text-muted);
}

.empty-state i {
    font-size: 42px;
    color: var(--accent);
}

@media (max-width: 768px) {
    .sub-hero {
        padding: 28px;
    }

    .sub-title {
        font-size: 30px;
    }
}
</style>

<section class="sub-page">
    <div class="container">

        <div class="sub-hero">
            <span class="sub-badge mb-3">
                <i class="bi bi-credit-card-2-front-fill"></i>
                JDevMail Billing
            </span>

            <h1 class="sub-title mb-3">
                Abonnements
            </h1>

            <p class="sub-subtitle mb-0">
                Choisis le plan adapté à tes sites vitrines et active l’envoi d’emails via l’API JDevMail.
                Les abonnements permettent de gérer les quotas, les accès API et l’historique de paiement.
            </p>
        </div>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success border-0 shadow-sm mb-4">
                <i class="bi bi-check-circle-fill me-2"></i>
                <?php echo e($success); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger border-0 shadow-sm mb-4">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <?php echo e($error); ?>
            </div>
        <?php endif; ?>

        <div class="row g-4 mb-4">
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

                        <h5 class="plan-name">
                            <?php echo e($plan['name']); ?>
                        </h5>

                        <p class="plan-desc small">
                            <?php echo e($plan['description']); ?>
                        </p>

                        <div class="plan-price">
                            <?php echo number_format((float)$plan['price'], 2); ?> USD
                            <small>/ plan</small>
                        </div>

                        <?php if ((float)$plan['price'] > 0): ?>
                            <a class="btn btn-sub w-100" href="<?php echo APP_URL; ?>/subscriptions/checkout/<?php echo (int)$plan['id']; ?>">
                                <i class="bi bi-wallet2 me-2"></i>
                                Paiement manuel
                            </a>
                        <?php else: ?>
                            <span class="free-badge">
                                <i class="bi bi-check-circle me-2"></i>
                                Plan gratuit
                            </span>
                        <?php endif; ?>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="sub-panel">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                <div>
                    <h5 class="mb-1">
                        Historique des paiements
                    </h5>
                    <p class="small text-muted mb-0">
                        Consulte les transactions liées à tes abonnements JDevMail.
                    </p>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Plan</th>
                            <th>Montant</th>
                            <th>Statut</th>
                            <th>Réf</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($payments)): ?>
                            <?php foreach ($payments as $p): ?>
                                <tr>
                                    <td><?php echo e($p['created_at']); ?></td>
                                    <td><?php echo e($p['plan_name'] ?? '-'); ?></td>
                                    <td><?php echo e($p['amount']); ?> USD</td>
                                    <td>
                                        <span class="status-pill">
                                            <?php echo e($p['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <code><?php echo e($p['transaction_id']); ?></code>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="bi bi-receipt-cutoff d-block mb-3"></i>
                                        Aucun paiement enregistré pour le moment.
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</section>