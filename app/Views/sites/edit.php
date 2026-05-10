<section class="py-4">
  <h3 class="section-title mb-3">Modifier un site</h3>
  <?php if (!empty($error)): ?><div class="alert alert-danger"><?php echo e($error); ?></div><?php endif; ?>
  <form method="post" action="<?php echo APP_URL; ?>/sites/update/<?php echo (int) $site['id']; ?>" class="panel p-4 mb-3">
    <?php echo \App\Core\CSRF::field(); ?>
    <div class="mb-3"><label class="form-label">Nom du site</label><input type="text" name="name" class="form-control" value="<?php echo e($site['name']); ?>" required></div>
    <div class="mb-3"><label class="form-label">Domaine</label><input type="text" name="domain" class="form-control" value="<?php echo e($site['domain']); ?>" required></div>
    <div class="mb-3"><label class="form-label">Rate limit / minute</label><input type="number" name="rate_limit_per_minute" class="form-control" value="<?php echo (int) $site['rate_limit_per_minute']; ?>" min="10" max="1000"></div>
    <div class="form-check mb-2"><input class="form-check-input" type="checkbox" name="is_active" <?php echo $site['is_active'] ? 'checked' : ''; ?>><label class="form-check-label">Site actif</label></div>
    <div class="form-check mb-3"><input class="form-check-input" type="checkbox" name="regenerate_keys" id="regenerate_keys"><label class="form-check-label" for="regenerate_keys">Régénérer les clés API</label></div>
    <button class="btn btn-success">Mettre à jour</button>
  </form>
  <form method="post" action="<?php echo APP_URL; ?>/sites/delete/<?php echo (int) $site['id']; ?>" onsubmit="return confirm('Supprimer ce site ?');">
    <?php echo \App\Core\CSRF::field(); ?>
    <button class="btn btn-outline-danger">Supprimer le site</button>
  </form>
</section>
