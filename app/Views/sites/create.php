<section class="py-4">
  <h3 class="section-title mb-3">Ajouter un site</h3>
  <form method="post" action="<?php echo APP_URL; ?>/sites/store" class="panel p-4">
    <?php echo \App\Core\CSRF::field(); ?>
    <div class="mb-3"><label class="form-label">Nom du site</label><input type="text" name="name" class="form-control" required></div>
    <div class="mb-3"><label class="form-label">Domaine</label><input type="text" name="domain" class="form-control" placeholder="monsite.com" required></div>
    <div class="mb-3"><label class="form-label">Rate limit / minute</label><input type="number" name="rate_limit_per_minute" class="form-control" value="60" min="10" max="1000"></div>
    <button class="btn btn-success">Créer le site</button>
  </form>
</section>
