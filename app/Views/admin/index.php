<section class="py-4">
  <h3 class="section-title mb-3">Administration</h3>
  <?php if (!empty($success)): ?><div class="alert alert-success"><?php echo e($success); ?></div><?php endif; ?>
  <?php if (!empty($error)): ?><div class="alert alert-danger"><?php echo e($error); ?></div><?php endif; ?>

  <div class="panel p-3 mb-4">
    <h5>Paiements en attente</h5>
    <div class="table-responsive"><table class="table table-sm align-middle"><thead><tr><th>User</th><th>Plan</th><th>Montant</th><th>Réf</th><th>Actions</th></tr></thead><tbody><?php foreach($pendingPayments as $payment): ?><tr><td><?php echo e($payment['user_email']); ?></td><td><?php echo e($payment['plan_name'] ?? '-'); ?></td><td><?php echo e($payment['amount']); ?> USD</td><td><?php echo e($payment['transaction_id']); ?></td><td class="d-flex gap-1"><form method="post" action="<?php echo APP_URL; ?>/admin/payments/approve/<?php echo (int)$payment['id']; ?>"><?php echo \App\Core\CSRF::field(); ?><button class="btn btn-success btn-sm">Valider</button></form><form method="post" action="<?php echo APP_URL; ?>/admin/payments/reject/<?php echo (int)$payment['id']; ?>"><?php echo \App\Core\CSRF::field(); ?><button class="btn btn-outline-danger btn-sm">Rejeter</button></form></td></tr><?php endforeach; ?></tbody></table></div>
  </div>

  <div class="panel p-3 mb-4">
    <h5>Gestion des sites</h5>
    <div class="table-responsive"><table class="table table-sm align-middle"><thead><tr><th>Site</th><th>Propriétaire</th><th>Statut</th><th>Action</th></tr></thead><tbody><?php foreach($sites as $site): ?><tr><td><?php echo e($site['name']); ?></td><td><?php echo e($site['user_email']); ?></td><td><?php echo $site['is_active'] ? 'Actif' : 'Suspendu'; ?></td><td><?php if($site['is_active']): ?><form method="post" action="<?php echo APP_URL; ?>/admin/sites/suspend/<?php echo (int)$site['id']; ?>"><?php echo \App\Core\CSRF::field(); ?><button class="btn btn-outline-warning btn-sm">Suspendre</button></form><?php else: ?><form method="post" action="<?php echo APP_URL; ?>/admin/sites/activate/<?php echo (int)$site['id']; ?>"><?php echo \App\Core\CSRF::field(); ?><button class="btn btn-success btn-sm">Réactiver</button></form><?php endif; ?></td></tr><?php endforeach; ?></tbody></table></div>
  </div>

  <div class="panel p-3">
    <h5>Utilisateurs</h5>
    <div class="table-responsive"><table class="table table-sm align-middle"><thead><tr><th>Nom</th><th>Email</th><th>Role</th><th>Status</th></tr></thead><tbody><?php foreach($users as $u): ?><tr><td><?php echo e($u['name']); ?></td><td><?php echo e($u['email']); ?></td><td><?php echo e($u['role']); ?></td><td><?php echo e($u['status']); ?></td></tr><?php endforeach; ?></tbody></table></div>
  </div>
</section>
