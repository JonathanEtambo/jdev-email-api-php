<style>
:root {
    --accent: #2da44e;
    --accent-hover: #1a6e3a;
    --accent-light: rgba(45,164,78,.12);

    --bg-page: #f6f8fa;
    --bg-panel: #ffffff;
    --bg-soft: #f8fafc;

    --text-main: #1a1e2b;
    --text-muted: #64748b;

    --border-color: #d0d7de;
    --table-head-bg: #f8fafc;
    --table-row-hover: rgba(45,164,78,.05);

    --danger: #dc3545;
    --warning: #f59e0b;
    --code-bg: #f1f5f9;
    --code-text: #334155;
}

[data-theme="dark"] {
    --bg-page: #0d1117;
    --bg-panel: #161b22;
    --bg-soft: #1f242c;

    --text-main: #e6edf3;
    --text-muted: #8b949e;

    --border-color: #30363d;
    --table-head-bg: #1f242c;
    --table-row-hover: rgba(45,164,78,.08);

    --danger: #ff6b6b;
    --warning: #fbbf24;
    --code-bg: #0d1117;
    --code-text: #e6edf3;
}

.admin-page {
    min-height: 100vh;
    padding: 70px 0 120px;
    background:
        radial-gradient(circle at top left, var(--accent-light), transparent 35%),
        var(--bg-page);
    color: var(--text-main);
}

.admin-hero,
.admin-panel {
    background: var(--bg-panel);
    border: 1px solid var(--border-color);
    color: var(--text-main);
    box-shadow: 0 15px 35px rgba(0,0,0,.05);
}

[data-theme="dark"] .admin-hero,
[data-theme="dark"] .admin-panel {
    box-shadow: 0 15px 35px rgba(0,0,0,.35);
}

.admin-hero {
    border-radius: 28px;
    padding: 38px;
    margin-bottom: 28px;
}

.admin-badge {
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

.admin-title {
    color: var(--text-main);
    font-weight: 900;
    letter-spacing: -.04em;
}

.admin-subtitle {
    color: var(--text-muted);
    max-width: 780px;
    line-height: 1.7;
}

.admin-panel {
    border-radius: 24px;
    overflow: hidden;
    margin-bottom: 24px;
}

.admin-panel-header {
    padding: 24px;
    border-bottom: 1px solid var(--border-color);
    background: var(--bg-panel);
}

.admin-panel-title {
    font-weight: 900;
    color: var(--text-main);
    margin-bottom: 4px;
}

.admin-panel-subtitle {
    color: var(--text-muted);
    font-size: 13px;
    margin-bottom: 0;
}

/* TABLE */
.admin-table {
    margin-bottom: 0;
    color: var(--text-main);
    --bs-table-bg: var(--bg-panel);
    --bs-table-color: var(--text-main);
    --bs-table-border-color: var(--border-color);
    --bs-table-hover-bg: var(--table-row-hover);
    --bs-table-hover-color: var(--text-main);
}

.admin-table thead th {
    background: var(--table-head-bg) !important;
    color: var(--text-muted) !important;
    border-color: var(--border-color) !important;
    text-transform: uppercase;
    font-size: 11px;
    letter-spacing: .06em;
    padding: 16px;
}

.admin-table tbody td {
    background: var(--bg-panel) !important;
    color: var(--text-main) !important;
    border-color: var(--border-color) !important;
    padding: 16px;
    vertical-align: middle;
}

.admin-table tbody tr:hover td {
    background: var(--table-row-hover) !important;
}

.admin-muted {
    color: var(--text-muted) !important;
}

.admin-table code {
    background: var(--code-bg);
    color: var(--code-text);
    padding: 5px 9px;
    border-radius: 999px;
    font-weight: 700;
}

/* BADGES */
.status-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border-radius: 999px;
    padding: 7px 12px;
    font-size: 12px;
    font-weight: 800;
    white-space: nowrap;
}

.status-success {
    background: var(--accent-light);
    color: var(--accent);
}

.status-danger {
    background: rgba(220,53,69,.12);
    color: var(--danger);
}

.status-warning {
    background: rgba(245,158,11,.14);
    color: var(--warning);
}

.role-pill {
    background: var(--bg-soft);
    color: var(--text-main);
    border: 1px solid var(--border-color);
}

/* BUTTONS */
.btn-admin-success,
.btn-admin-danger,
.btn-admin-warning {
    border-radius: 999px;
    font-weight: 800;
    padding: 8px 14px;
    transition: .25s ease;
}

.btn-admin-success {
    background: var(--accent);
    color: #fff !important;
    border: 1px solid var(--accent);
}

.btn-admin-success:hover {
    background: var(--accent-hover);
    border-color: var(--accent-hover);
}

.btn-admin-danger {
    background: transparent;
    color: var(--danger) !important;
    border: 1px solid rgba(220,53,69,.35);
}

.btn-admin-danger:hover {
    background: var(--danger);
    color: #fff !important;
}

.btn-admin-warning {
    background: transparent;
    color: var(--warning) !important;
    border: 1px solid rgba(245,158,11,.35);
}

.btn-admin-warning:hover {
    background: var(--warning);
    color: #111827 !important;
}

/* ALERTS */
.alert-success {
    background: var(--accent-light) !important;
    color: var(--accent) !important;
}

.alert-danger {
    background: rgba(220,53,69,.12) !important;
    color: var(--danger) !important;
}

/* EMPTY */
.empty-state {
    text-align: center;
    color: var(--text-muted);
    padding: 38px 18px;
}

.empty-state i {
    color: var(--accent);
    font-size: 38px;
}

@media (max-width: 768px) {
    .admin-page {
        padding: 50px 0 90px;
    }

    .admin-hero {
        padding: 28px;
    }

    .admin-title {
        font-size: 30px;
    }
}
</style>

<section class="admin-page">
    <div class="container-xl">

        <div class="admin-hero">
            <span class="admin-badge mb-3">
                <i class="bi bi-shield-lock-fill"></i>
                JDevMail Admin
            </span>

            <h2 class="admin-title mb-3">
                Administration
            </h2>

            <p class="admin-subtitle mb-0">
                Gérez les paiements en attente, les sites connectés à l’API JDevMail
                et les utilisateurs inscrits sur la plateforme.
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

        <div class="admin-panel">
            <div class="admin-panel-header">
                <h5 class="admin-panel-title">Paiements en attente</h5>
                <p class="admin-panel-subtitle">Validez ou rejetez les paiements soumis par les utilisateurs.</p>
            </div>

            <div class="table-responsive">
                <table class="table admin-table align-middle">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Plan</th>
                            <th>Montant</th>
                            <th>Réf</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($pendingPayments)): ?>
                            <?php foreach ($pendingPayments as $payment): ?>
                                <tr>
                                    <td><span class="fw-bold"><?php echo e($payment['user_email']); ?></span></td>
                                    <td><?php echo e($payment['plan_name'] ?? '-'); ?></td>
                                    <td><span class="status-pill status-success"><?php echo e($payment['amount']); ?> USD</span></td>
                                    <td><code><?php echo e($payment['transaction_id']); ?></code></td>
                                    <td>
                                        <div class="d-flex justify-content-end gap-2 flex-wrap">
                                            <form method="post" action="<?php echo APP_URL; ?>/admin/payments/approve/<?php echo (int) $payment['id']; ?>">
                                                <?php echo \App\Core\CSRF::field(); ?>
                                                <button class="btn btn-admin-success btn-sm">
                                                    <i class="bi bi-check-circle me-1"></i> Valider
                                                </button>
                                            </form>

                                            <form method="post" action="<?php echo APP_URL; ?>/admin/payments/reject/<?php echo (int) $payment['id']; ?>">
                                                <?php echo \App\Core\CSRF::field(); ?>
                                                <button class="btn btn-admin-danger btn-sm">
                                                    <i class="bi bi-x-circle me-1"></i> Rejeter
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="bi bi-receipt d-block mb-3"></i>
                                        Aucun paiement en attente.
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="admin-panel">
            <div class="admin-panel-header">
                <h5 class="admin-panel-title">Gestion des sites</h5>
                <p class="admin-panel-subtitle">Activez ou suspendez les sites utilisant l’API JDevMail.</p>
            </div>

            <div class="table-responsive">
                <table class="table admin-table align-middle">
                    <thead>
                        <tr>
                            <th>Site</th>
                            <th>Propriétaire</th>
                            <th>Statut</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($sites)): ?>
                            <?php foreach ($sites as $site): ?>
                                <tr>
                                    <td><span class="fw-bold"><?php echo e($site['name']); ?></span></td>
                                    <td class="admin-muted"><?php echo e($site['user_email']); ?></td>
                                    <td>
                                        <?php if ($site['is_active']): ?>
                                            <span class="status-pill status-success">
                                                <i class="bi bi-check-circle-fill"></i> Actif
                                            </span>
                                        <?php else: ?>
                                            <span class="status-pill status-danger">
                                                <i class="bi bi-pause-circle-fill"></i> Suspendu
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end">
                                            <?php if ($site['is_active']): ?>
                                                <form method="post" action="<?php echo APP_URL; ?>/admin/sites/suspend/<?php echo (int) $site['id']; ?>">
                                                    <?php echo \App\Core\CSRF::field(); ?>
                                                    <button class="btn btn-admin-warning btn-sm">
                                                        <i class="bi bi-pause-circle me-1"></i> Suspendre
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                <form method="post" action="<?php echo APP_URL; ?>/admin/sites/activate/<?php echo (int) $site['id']; ?>">
                                                    <?php echo \App\Core\CSRF::field(); ?>
                                                    <button class="btn btn-admin-success btn-sm">
                                                        <i class="bi bi-play-circle me-1"></i> Réactiver
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="bi bi-globe2 d-block mb-3"></i>
                                        Aucun site enregistré.
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="admin-panel">
            <div class="admin-panel-header">
                <h5 class="admin-panel-title">Utilisateurs</h5>
                <p class="admin-panel-subtitle">Liste des comptes inscrits sur la plateforme JDevMail.</p>
            </div>

            <div class="table-responsive">
                <table class="table admin-table align-middle">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $u): ?>
                                <tr>
                                    <td><span class="fw-bold"><?php echo e($u['name']); ?></span></td>
                                    <td class="admin-muted"><?php echo e($u['email']); ?></td>
                                    <td><span class="status-pill role-pill"><?php echo e($u['role']); ?></span></td>
                                    <td>
                                        <?php if (($u['status'] ?? '') === 'active'): ?>
                                            <span class="status-pill status-success">
                                                <i class="bi bi-check-circle-fill"></i> Actif
                                            </span>
                                        <?php else: ?>
                                            <span class="status-pill status-danger">
                                                <i class="bi bi-x-circle-fill"></i>
                                                <?php echo e($u['status']); ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="bi bi-people d-block mb-3"></i>
                                        Aucun utilisateur enregistré.
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