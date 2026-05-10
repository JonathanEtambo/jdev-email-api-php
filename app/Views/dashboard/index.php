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
    --table-head-bg: #f8fafc;
}

[data-theme="dark"] {
    --bg-page: #0d1117;
    --bg-panel: #161b22;
    --text-main: #e6edf3;
    --text-muted: #8b949e;
    --border-color: #30363d;
    --table-head-bg: #1f242c;
}

.dashboard-page {
    background:
        radial-gradient(circle at top left, var(--accent-light), transparent 35%),
        var(--bg-page);
    min-height: 100vh;
    padding: 70px 0;
    color: var(--text-main);
}

.dashboard-hero,
.dashboard-card,
.dashboard-table-card {
    background: var(--bg-panel);
    border: 1px solid var(--border-color);
    color: var(--text-main);
    box-shadow: 0 15px 35px rgba(0,0,0,0.05);
}

.dashboard-hero {
    border-radius: 28px;
    padding: 36px;
    margin-bottom: 28px;
}

.dashboard-badge {
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

.dashboard-title {
    color: var(--text-main);
    font-weight: 900;
    letter-spacing: -0.04em;
}

.dashboard-subtitle {
    color: var(--text-muted);
}

.btn-dashboard {
    background: var(--accent);
    color: #fff !important;
    border: none;
    border-radius: 999px;
    font-weight: 800;
    padding: 12px 18px;
}

.btn-dashboard:hover {
    background: var(--accent-hover);
}

.dashboard-card {
    border-radius: 24px;
    padding: 26px;
    height: 100%;
    transition: 0.25s ease;
}

.dashboard-card:hover {
    transform: translateY(-4px);
    border-color: var(--accent);
}

.dashboard-icon {
    width: 52px;
    height: 52px;
    border-radius: 16px;
    background: var(--accent-light);
    color: var(--accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.stat-label {
    color: var(--text-muted);
    font-size: 13px;
    font-weight: 700;
}

.stat-value {
    color: var(--text-main);
    font-weight: 900;
}

.text-muted-custom {
    color: var(--text-muted) !important;
}

.subscription-card {
    border-left: 5px solid var(--accent);
}

.status-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border-radius: 999px;
    padding: 7px 12px;
    font-size: 12px;
    font-weight: 800;
}

.status-success {
    background: var(--accent-light);
    color: var(--accent);
}

.status-danger {
    background: rgba(220, 53, 69, 0.12);
    color: #dc3545;
}

.status-warning {
    background: rgba(255, 193, 7, 0.14);
    color: #b58100;
}

.dashboard-table-card {
    border-radius: 24px;
    overflow: hidden;
}

.dashboard-table-header {
    padding: 24px;
    border-bottom: 1px solid var(--border-color);
}

.dashboard-table thead th {
    background: var(--table-head-bg);
    color: var(--text-muted);
    text-transform: uppercase;
    font-size: 11px;
    letter-spacing: 0.06em;
    border-color: var(--border-color);
    padding: 16px;
}

.dashboard-table tbody td {
    color: var(--text-main);
    border-color: var(--border-color);
    padding: 16px;
}

.form-select-dashboard {
    background-color: var(--table-head-bg) !important;
    border: 1px solid var(--border-color) !important;
    color: var(--text-main) !important;
    border-radius: 12px;
}

.btn-filter {
    background: var(--accent);
    color: #fff;
    border-radius: 12px;
    border: none;
}

.table-footer {
    background: var(--table-head-bg);
    border-top: 1px solid var(--border-color);
}

.link-dashboard {
    color: var(--accent);
    font-weight: 800;
    text-decoration: none;
}

.link-dashboard:hover {
    color: var(--accent-hover);
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
    .dashboard-hero {
        padding: 28px;
    }

    .dashboard-title {
        font-size: 30px;
    }

    .btn-dashboard {
        width: 100%;
        justify-content: center;
    }
}
</style>

<section class="dashboard-page">
    <div class="container-xl">

        <div class="dashboard-hero">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <span class="dashboard-badge mb-3">
                        <i class="bi bi-speedometer2"></i>
                        JDevMail Dashboard
                    </span>

                    <h2 class="dashboard-title mb-2">
                        Tableau de bord
                    </h2>

                    <p class="dashboard-subtitle mb-0">
                        Aperçu de vos sites vitrines, de vos envois API et de votre quota disponible.
                    </p>
                </div>

                <a href="<?php echo APP_URL; ?>/sites/create" class="btn btn-dashboard d-flex align-items-center gap-2">
                    <i class="bi bi-plus-circle"></i>
                    Nouveau site
                </a>
            </div>
        </div>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success border-0 shadow-sm mb-4">
                <i class="bi bi-check-circle-fill me-2"></i>
                <?php echo e($success); ?>
            </div>
        <?php endif; ?>

        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="dashboard-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="dashboard-icon">
                            <i class="bi bi-envelope-paper"></i>
                        </div>

                        <div>
                            <span class="stat-label d-block">
                                Emails envoyés
                            </span>

                            <h3 class="stat-value mb-0">
                                <?php echo number_format($emails_sent); ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="dashboard-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="dashboard-icon">
                            <i class="bi bi-globe2"></i>
                        </div>

                        <div>
                            <span class="stat-label d-block">
                                Sites actifs
                            </span>

                            <h3 class="stat-value mb-0">
                                <?php echo (int) $sites_count; ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="dashboard-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="dashboard-icon">
                            <i class="bi bi-pie-chart"></i>
                        </div>

                        <div>
                            <span class="stat-label d-block">
                                Quota disponible
                            </span>

                            <h3 class="mb-0 fw-bold" style="color: var(--accent);">
                                <?php echo is_numeric($quota_remaining) ? number_format($quota_remaining) : e($quota_remaining); ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">

                <div class="dashboard-card subscription-card mb-4">
                    <h6 class="fw-bold mb-3">
                        Abonnement actuel
                    </h6>

                    <?php if ($subscription): ?>
                        <div class="mb-3">
                            <span class="status-pill status-success">
                                <i class="bi bi-check-circle-fill"></i>
                                <?php echo e($subscription['plan_name']); ?>
                            </span>
                        </div>

                        <p class="text-muted-custom small mb-0">
                            Expire le
                            <span class="fw-bold" style="color: var(--text-main);">
                                <?php echo e($subscription['end_date']); ?>
                            </span>
                        </p>
                    <?php else: ?>
                        <div class="status-pill status-warning mb-3">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            Version d’essai active
                        </div>

                        <a href="<?php echo APP_URL; ?>/pricing" class="btn btn-dashboard w-100">
                            Débloquer le mode Pro
                        </a>
                    <?php endif; ?>
                </div>

                
            </div>

            <div class="col-lg-8">
                <div class="dashboard-table-card">

                    <div class="dashboard-table-header d-flex flex-wrap align-items-center gap-3">
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-1">
                                Dernières transmissions
                            </h6>

                            <p class="small text-muted-custom mb-0">
                                Historique récent des emails envoyés depuis vos sites vitrines.
                            </p>
                        </div>

                        <form method="get" class="d-flex gap-2">
                            <select name="status" class="form-select form-select-sm form-select-dashboard">
                                <option value="">Tous les statuts</option>
                                <option value="sent">Envoyé</option>
                                <option value="failed">Échec</option>
                            </select>

                            <button class="btn btn-filter btn-sm px-3">
                                <i class="bi bi-filter"></i>
                            </button>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table dashboard-table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Date</th>
                                    <th>Site</th>
                                    <th>Destinataire</th>
                                    <th class="text-end pe-4">Statut</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if (!empty($recent_logs)): ?>
                                    <?php foreach ($recent_logs as $log): ?>
                                        <tr>
                                            <td class="ps-4">
                                                <div class="small fw-bold">
                                                    <?php echo date('d M Y', strtotime($log['sent_at'])); ?>
                                                </div>

                                                <div class="text-muted-custom" style="font-size: 12px;">
                                                    <?php echo date('H:i', strtotime($log['sent_at'])); ?>
                                                </div>
                                            </td>

                                            <td>
                                                <span class="fw-bold">
                                                    <?php echo e($log['site_name']); ?>
                                                </span>
                                            </td>

                                            <td class="text-muted-custom small">
                                                <?php echo e($log['recipient']); ?>
                                            </td>

                                            <td class="text-end pe-4">
                                                <?php if ($log['status'] === 'sent'): ?>
                                                    <span class="status-pill status-success">
                                                        <i class="bi bi-check-circle-fill"></i>
                                                        Envoyé
                                                    </span>
                                                <?php else: ?>
                                                    <span class="status-pill status-danger">
                                                        <i class="bi bi-x-circle-fill"></i>
                                                        Échec
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4">
                                            <div class="empty-state">
                                                <i class="bi bi-inbox d-block mb-3"></i>
                                                Aucun email transmis pour le moment.
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-footer p-3 text-center">
                        <a href="<?php echo APP_URL; ?>/logs" class="link-dashboard">
                            Voir l’historique complet
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>