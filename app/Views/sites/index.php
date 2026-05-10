<style>
    /* 1. SYSTÈME DE COULEURS ET THÈMES */
    :root {
        --accent: #2da44e;
        --accent-hover: #1a6e3a;
        --accent-light: rgba(45, 164, 78, 0.1);
        --transition-default: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        
        /* Mode Jour (Défaut) */
        --bg-card: #ffffff;
        --bg-dashboard: #f8fafc;
        --text-main: #1a1e2b;
        --text-muted: #64748b;
        --border-color: rgba(0, 0, 0, 0.08);
        --table-header: #f8fafc;
        --modal-bg: #ffffff;
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    [data-theme="dark"] {
        --bg-card: #161b22;
        --bg-dashboard: #0d1117;
        --text-main: #e6edf3;
        --text-muted: #8b949e;
        --border-color: #30363d;
        --table-header: #1f242c;
        --modal-bg: #161b22;
        --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.4);
    }

    /* 2. MISE EN PAGE GÉNÉRALE */
    .sites-section { 
        background-color: var(--bg-dashboard); 
        color: var(--text-main);
        min-height: 100vh;
    }

    /* 3. COMPOSANTS PREMIUM */
    .premium-panel {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        box-shadow: var(--shadow);
        overflow: hidden;
        animation: fadeInUp 0.4s ease-out;
    }

    .premium-table thead th {
        background-color: var(--table-header);
        color: var(--text-muted);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 15px;
        border-bottom: 2px solid var(--border-color);
    }

    .site-row { transition: var(--transition-default); }
    .site-row:hover { background-color: var(--accent-light); }

    .btn-premium {
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-hover) 100%);
        border: none;
        color: white !important;
        padding: 10px 24px;
        border-radius: 12px;
        font-weight: 600;
        transition: var(--transition-default);
    }

    .btn-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(45, 164, 78, 0.3);
    }

    /* 4. SYSTÈME DE COPIE (TEXTES LONGS) */
    .copy-group {
        display: flex;
        align-items: center;
        background: var(--bg-dashboard);
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 4px;
        transition: var(--transition-default);
    }

    .copy-group:focus-within { border-color: var(--accent); }

    .copy-input {
        background: transparent !important;
        border: none !important;
        color: var(--accent) !important;
        font-family: 'Monaco', 'Consolas', monospace;
        font-size: 0.85rem;
        padding: 8px 12px;
        flex-grow: 1;
        outline: none;
        text-overflow: ellipsis;
    }

    .btn-copy-action {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        color: var(--text-muted);
        border-radius: 8px;
        padding: 5px 12px;
        transition: var(--transition-default);
    }

    .btn-copy-action:hover { color: var(--accent); background: var(--table-header); }

    /* 5. MODALS & FORMS */
    .modal-content {
        background-color: var(--modal-bg) !important;
        color: var(--text-main) !important;
        border-radius: 24px;
        border: 1px solid var(--border-color);
    }

    .form-control-premium {
        background-color: var(--bg-dashboard) !important;
        border: 1px solid var(--border-color) !important;
        color: var(--text-main) !important;
        border-radius: 10px;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<section class="sites-section py-4">
    <div class="container-xl">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">Mes Sites</h3>
                <p style="color: var(--text-muted);" class="small mb-0">Gestion des accès API et quotas.</p>
            </div>
            <button class="btn btn-premium d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createSiteModal">
                <i class="bi bi-plus-circle-fill"></i> Nouveau site
            </button>
        </div>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4"><?php echo e($success); ?></div>
        <?php endif; ?>

        <div class="premium-panel">
            <div class="table-responsive">
                <table class="table premium-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Projet</th>
                            <th>Domaine</th>
                            <th>Identifiants</th>
                            <th>Statut</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($sites as $site): ?>
                        <tr class="site-row">
                            <td class="ps-4 fw-bold"><?php echo e($site['name']); ?></td>
                            <td><code style="color: var(--accent);"><?php echo e($site['domain']); ?></code></td>
                            <td>
                                <button class="btn btn-sm rounded-pill px-3" 
                                        style="background: var(--table-header); color: var(--text-main); border: 1px solid var(--border-color);"
                                        onclick="openKeysModal('<?php echo e($site['name']); ?>', '<?php echo e($site['site_id']); ?>', '<?php echo e($site['public_key']); ?>', '<?php echo e($site['secret_key'] ?? '••••••••••••••••'); ?>')">
                                    <i class="bi bi-shield-lock text-success"></i> Voir clés
                                </button>
                            </td>
                            <td>
                                <span class="badge rounded-pill <?php echo $site['is_active'] ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-muted'; ?> p-2 px-3">
                                    <?php echo $site['is_active'] ? 'Actif' : 'Suspendu'; ?>
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <a class="btn btn-sm btn-outline-success" href="<?php echo APP_URL; ?>/sites/edit/<?php echo (int) $site['id']; ?>">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="keysModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="modalSiteName">Identifiants API</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="small fw-bold text-muted mb-1">SITE ID</label>
                    <div class="copy-group">
                        <input type="text" id="displaySiteId" class="copy-input" readonly>
                        <button class="btn-copy-action" onclick="copyAction('displaySiteId', this)"><i class="bi bi-clipboard"></i></button>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="small fw-bold text-muted mb-1">CLÉ PUBLIQUE</label>
                    <div class="copy-group">
                        <input type="text" id="displayPublicKey" class="copy-input" readonly>
                        <button class="btn-copy-action" onclick="copyAction('displayPublicKey', this)"><i class="bi bi-clipboard"></i></button>
                    </div>
                </div>
                <div class="mb-0">
                    <label class="small fw-bold text-muted mb-1">CLÉ SECRÈTE</label>
                    <div class="copy-group">
                        <input type="text" id="displaySecretKey" class="copy-input" readonly>
                        <button class="btn-copy-action" onclick="copyAction('displaySecretKey', this)"><i class="bi bi-clipboard"></i></button>
                    </div>
                    <div class="alert alert-warning py-2 small border-0 mt-3"><i class="bi bi-exclamation-triangle-fill"></i> Ne partagez jamais votre clé secrète.</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createSiteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <form method="post" action="<?php echo APP_URL; ?>/sites/store">
                <?php echo \App\Core\CSRF::field(); ?>
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Nouveau Projet Site</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nom du projet</label>
                        <input type="text" name="name" class="form-control form-control-premium" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Domaine</label>
                        <input type="text" name="domain" class="form-control form-control-premium" placeholder="monsite.com" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold">Rate limit (par minute)</label>
                        <input type="number" name="rate_limit_per_minute" class="form-control form-control-premium" value="60">
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="btn btn-premium w-100">Créer le site</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openKeysModal(name, siteId, pubKey, secKey) {
    document.getElementById('modalSiteName').innerText = name;
    document.getElementById('displaySiteId').value = siteId;
    document.getElementById('displayPublicKey').value = pubKey;
    document.getElementById('displaySecretKey').value = secKey;
    new bootstrap.Modal(document.getElementById('keysModal')).show();
}

function copyAction(id, btn) {
    const input = document.getElementById(id);
    navigator.clipboard.writeText(input.value).then(() => {
        const icon = btn.querySelector('i');
        icon.className = "bi bi-check2 text-success";
        setTimeout(() => { icon.className = "bi bi-clipboard"; }, 2000);
    });
}
</script>