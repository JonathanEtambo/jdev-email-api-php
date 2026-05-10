<section class="py-4">
  <h3 class="section-title mb-3">Abonnements</h3>
  <?php if (!empty($success)): ?><div class="alert alert-success"><?php echo e($success); ?></div><?php endif; ?>
  <?php if (!empty($error)): ?><div class="alert alert-danger"><?php echo e($error); ?></div><?php endif; ?>

  <div class="row g-3 mb-4">
    <?php foreach($plans as $plan): ?>
      <div class="col-md-4">
        <div class="panel h-100 p-3 feature-card">
          <h5><?php echo e($plan['name']); ?></h5>
          <p class="text-muted small"><?php echo e($plan['description']); ?></p>
          <h4 class="text-success"><?php echo number_format((float)$plan['price'], 2); ?> USD</h4>
          <?php if ((float)$plan['price'] > 0): ?>
            <a class="btn btn-success btn-sm" href="<?php echo APP_URL; ?>/subscriptions/checkout/<?php echo (int)$plan['id']; ?>">Paiement manuel</a>
          <?php else: ?>
            <span class="badge bg-secondary">Plan gratuit</span>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="panel p-3">
    <h5>Historique paiements</h5>
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead><tr><th>Date</th><th>Plan</th><th>Montant</th><th>Statut</th><th>Réf</th></tr></thead>
        <tbody><?php foreach($payments as $p): ?><tr><td><?php echo e($p['created_at']); ?></td><td><?php echo e($p['plan_name'] ?? '-'); ?></td><td><?php echo e($p['amount']); ?> USD</td><td><?php echo e($p['status']); ?></td><td><?php echo e($p['transaction_id']); ?></td></tr><?php endforeach; ?></tbody>
      </table>
    </div>
  </div>
</section>
