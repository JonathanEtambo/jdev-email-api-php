<section class="py-4">
  <h3 class="section-title mb-3">Paiement manuel</h3>
  <div class="panel p-3 mb-3">
    <p class="mb-1"><strong>Plan:</strong> <?php echo e($plan['name']); ?></p>
    <p class="mb-0"><strong>Prix:</strong> <?php echo number_format((float)$plan['price'], 2); ?> USD</p>
  </div>
  <form method="post" action="<?php echo APP_URL; ?>/subscriptions/store-payment" class="panel p-4">
    <?php echo \App\Core\CSRF::field(); ?>
    <input type="hidden" name="plan_id" value="<?php echo (int)$plan['id']; ?>">
    <div class="mb-3"><label class="form-label">Méthode de paiement</label><select class="form-select" name="payment_method"><option value="mobile_money">Mobile Money</option><option value="bank_transfer">Virement bancaire</option><option value="cash">Cash</option></select></div>
    <div class="mb-3"><label class="form-label">Référence / preuve</label><input type="text" class="form-control" name="reference" required></div>
    <button class="btn btn-success">Soumettre le paiement</button>
  </form>
</section>
