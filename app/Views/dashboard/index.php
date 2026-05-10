<style>
    /* Variables de thème dynamiques */
    :root {
        --accent: #2da44e;
        --accent-hover: #1a6e3a;
        /* Couleurs Light */
        --bg-dashboard: #f8fafc;
        --bg-card: #ffffff;
        --text-main: #1a1e2b;
        --text-muted: #64748b;
        --border-color: rgba(0, 0, 0, 0.05);
        --table-head-bg: #f8fafc;
        --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
    }

    [data-theme="dark"] {
        --bg-dashboard: #0d1117;
        --bg-card: #161b22;
        --text-main: #e6edf3;
        --text-muted: #8b949e;
        --border-color: #30363d;
        --table-head-bg: #1f242c;
        --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
    }

    /* Layout & Base */
    .dashboard-container { 
        background-color: var(--bg-dashboard); 
        min-height: 100vh; 
        padding-top: 2rem;
        color: var(--text-main);
        transition: all 0.3s ease;
    }

    .text-main { color: var(--text-main) !important; }
    .text-custom-muted { color: var(--text-muted) !important; }

    /* Cartes Statistiques */
    .stat-card-premium {
        background-color: var(--bg-card);
        border-radius: 16px;
        padding: 1.5rem;
        border: 1px solid var(--border-color);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: var(--shadow);
        height: 100%;
    }

    .stat-card-premium:hover {
        transform: translateY(-5px);
        border-color: var(--accent);
    }

    .icon-box {
        width: 48px;
        height: 48px;
        background: rgba(45, 164, 78, 0.1);
        color: var(--accent);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
    }

    /* Table & Card Table */
    .premium-table-card {
        background-color: var(--bg-card);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow);
        border: 1px solid var(--border-color);
    }

    .premium-table thead th {
        background-color: var(--table-head-bg);
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 0.05em;
        color: var(--text-muted);
        padding: 1rem;
        border-bottom: 1px solid var(--border-color);
    }

    .premium-table td {
        border-bottom: 1px solid var(--border-color);
        color: var(--text-main);
    }

    /* Bouton & Badges */
    .btn-premium {
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-hover) 100%);
        color: white !important;
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 600;
        transition: 0.3s;
    }

    .badge-premium {
        padding: 6px 12px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.75rem;
    }

    /* Form Elements Adaptatifs */
    .form-select-premium {
        background-color: var(--table-head-bg) !important;
        border: 1px solid var(--border-color) !important;
        color: var(--text-main) !important;
        border-radius: 8px;
    }
</style>

<section class="dashboard-container">
    <div class="container-xl">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="h3 fw-bold mb-1 text-main">Tableau de bord</h2>
                <p class="text-custom-muted mb-0">Aperçu en temps réel de votre infrastructure mail.</p>
            </div>
            <a href="<?php echo APP_URL; ?>/sites/create" class="btn btn-premium d-flex align-items-center gap-2">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"></path></svg>
                Nouveau Site
            </a>
        </div>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success border-0 shadow-sm d-flex align-items-center p-3 mb-4 rounded-4" style="background-color: rgba(45, 164, 78, 0.15); color: var(--accent);">
                <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                <span class="fw-semibold"><?php echo e($success); ?></span>
            </div>
        <?php endif; ?>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="stat-card-premium">
                    <div class="d-flex align-items-center">
                        <div class="icon-box">
                            <i class="bi bi-envelope-paper fs-4"></i>
                        </div>
                        <div>
                            <span class="text-custom-muted small d-block fw-medium">Emails envoyés</span>
                            <h3 class="mb-0 fw-bold text-main"><?php echo number_format($emails_sent); ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card-premium">
                    <div class="d-flex align-items-center">
                        <div class="icon-box">
                            <i class="bi bi-globe2 fs-4"></i>
                        </div>
                        <div>
                            <span class="text-custom-muted small d-block fw-medium">Sites actifs</span>
                            <h3 class="mb-0 fw-bold text-main"><?php echo (int) $sites_count; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card-premium">
                    <div class="d-flex align-items-center">
                        <div class="icon-box">
                            <i class="bi bi-pie-chart fs-4"></i>
                        </div>
                        <div>
                            <span class="text-custom-muted small d-block fw-medium">Quota disponible</span>
                            <h3 class="mb-0 fw-bold text-success">
                                <?php echo is_numeric($quota_remaining) ? number_format($quota_remaining) : e($quota_remaining); ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="stat-card-premium mb-4 border-start border-4 border-start-success" style="border-left-color: var(--accent) !important;">
                    <h6 class="fw-bold mb-3 text-main">Abonnement actuel</h6>
                    <?php if ($subscription): ?>
                        <div class="mb-3">
                            <span class="badge-premium bg-success-subtle text-success"><?php echo e($subscription['plan_name']); ?></span>
                        </div>
                        <p class="text-custom-muted small mb-0">Expire le <span class="fw-bold text-main"><?php echo e($subscription['end_date']); ?></span></p>
                    <?php else: ?>
                        <div class="d-flex align-items-center text-warning mb-3">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <span class="small fw-bold">Version d'essai active</span>
                        </div>
                        <a href="/pricing" class="btn btn-sm btn-outline-success w-100 rounded-3 fw-bold">Débloquer le mode Pro</a>
                    <?php endif; ?>
                </div>

                <div class="stat-card-premium">
                    <h6 class="fw-bold mb-4 text-main">Répartition d'usage</h6>
                    <div style="position: relative; height: 200px;">
                        <canvas id="emailsChart" data-sent="<?php echo (int) $emails_sent; ?>" data-remaining="<?php echo is_numeric($quota_remaining) ? (int) $quota_remaining : 0; ?>"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="premium-table-card">
                    <div class="card-header bg-transparent p-4 border-0 d-flex flex-wrap align-items-center gap-3">
                        <h6 class="fw-bold mb-0 flex-grow-1 text-main">Dernières transmissions</h6>
                        <form method="get" class="d-flex gap-2">
                            <select name="status" class="form-select form-select-sm form-select-premium">
                                <option value="">Statut</option>
                                <option value="sent">Envoyé</option>
                                <option value="failed">Échec</option>
                            </select>
                            <button class="btn btn-sm btn-dark px-3 rounded-3 shadow-sm"><i class="bi bi-filter"></i></button>
                        </form>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table premium-table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Date</th>
                                    <th>Site</th>
                                    <th>Destinataire</th>
                                    <th class="text-end pe-4">Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($recent_logs as $log): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="small fw-medium text-main"><?php echo date('d M Y', strtotime($log['sent_at'])); ?></div>
                                        <div class="text-custom-muted" style="font-size: 0.7rem;"><?php echo date('H:i', strtotime($log['sent_at'])); ?></div>
                                    </td>
                                    <td><span class="fw-bold text-main"><?php echo e($log['site_name']); ?></span></td>
                                    <td class="text-custom-muted small"><?php echo e($log['recipient']); ?></td>
                                    <td class="text-end pe-4">
                                        <?php if($log['status']==='sent'): ?>
                                            <span class="badge-premium bg-success-subtle text-success">Envoyé</span>
                                        <?php else: ?>
                                            <span class="badge-premium bg-danger-subtle text-danger">Échec</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="p-3 text-center border-top" style="background-color: var(--table-head-bg);">
                        <a href="/logs" class="text-decoration-none small fw-bold" style="color: var(--accent);">Voir l'historique complet <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>