<div class="row justify-content-center align-items-center auth-shell py-4">
  <div class="col-md-8 col-lg-6 fade-in-up">
    <div class="auth-panel p-4 p-lg-5">
      <span class="auth-badge mb-3"><i class="bi bi-stars"></i> Essai gratuit</span>
      <h3 class="auth-title mb-2">Inscription</h3>
      <p class="auth-subtitle small mb-4">Crée ton compte et démarre ton espace d'envoi d'emails.</p>

      <?php if (!empty($error)): ?>
        <div class="alert alert-danger" role="alert"><i class="bi bi-exclamation-triangle me-1"></i><?php echo e($error); ?></div>
      <?php endif; ?>

      <form method="post" action="<?php echo APP_URL; ?>/register" novalidate>
        <?php echo \App\Core\CSRF::field(); ?>

        <div class="mb-3 auth-stagger" style="--delay: .05s">
          <label class="form-label">Nom complet</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
            <input type="text" name="name" class="form-control" placeholder="Jonathan Dzoko" required>
          </div>
        </div>

        <div class="mb-3 auth-stagger" style="--delay: .1s">
          <label class="form-label">Email</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" name="email" class="form-control" placeholder="vous@exemple.com" required>
          </div>
        </div>

        <div class="mb-3 auth-stagger" style="--delay: .15s">
          <label class="form-label">Mot de passe</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-key"></i></span>
            <input id="register-password" type="password" name="password" class="form-control" minlength="8" placeholder="8 caractères minimum" required>
            <button class="btn btn-outline-secondary toggle-password" type="button" data-target="register-password" aria-label="Afficher le mot de passe">
              <i class="bi bi-eye"></i>
            </button>
          </div>
          <div class="form-text"><i class="bi bi-info-circle me-1"></i>Utilise un mot de passe fort avec lettres, chiffres et symbole.</div>
        </div>

        <button class="btn btn-success w-100 py-2 auth-stagger" style="--delay: .2s"><i class="bi bi-person-check me-1"></i>Créer mon compte</button>
      </form>

      <div class="auth-divider small text-center text-muted">
        Tu as déjà un compte ?
        <a class="auth-link ms-1" href="<?php echo APP_URL; ?>/login"><i class="bi bi-box-arrow-in-right me-1"></i>Se connecter</a>
      </div>
    </div>
  </div>
</div>
