<div class="row justify-content-center align-items-center auth-shell py-4">
  <div class="col-md-7 col-lg-5 fade-in-up">
    <div class="auth-panel p-4 p-lg-5">
      <span class="auth-badge mb-3"><i class="bi bi-shield-lock-fill"></i> Espace sécurisé</span>
      <h3 class="auth-title mb-2">Connexion</h3>
      <p class="auth-subtitle small mb-4">Accéde à ton dashboard JDev Mail API.</p>

      <?php if (!empty($error)): ?>
        <div class="alert alert-danger" role="alert"><i class="bi bi-exclamation-triangle me-1"></i><?php echo e($error); ?></div>
      <?php endif; ?>

      <form method="post" action="<?php echo APP_URL; ?>/login" novalidate>
        <?php echo \App\Core\CSRF::field(); ?>

        <div class="mb-3 auth-stagger" style="--delay: .05s">
          <label class="form-label">Email</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" name="email" class="form-control" placeholder="vous@exemple.com" required>
          </div>
        </div>

        <div class="mb-3 auth-stagger" style="--delay: .12s">
          <label class="form-label">Mot de passe</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-key"></i></span>
            <input id="password" type="password" name="password" class="form-control" placeholder="Votre mot de passe" required>
            <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password" aria-label="Afficher le mot de passe">
              <i class="bi bi-eye"></i>
            </button>
          </div>
        </div>

        <button class="btn btn-success w-100 py-2 auth-stagger" style="--delay: .18s"><i class="bi bi-box-arrow-in-right me-1"></i>Se connecter</button>
      </form>

      <div class="auth-divider small text-center text-muted">
        Nouveau sur la plateforme ?
        <a class="auth-link ms-1" href="<?php echo APP_URL; ?>/register"><i class="bi bi-person-plus me-1"></i>Créer un compte</a>
      </div>
    </div>
  </div>
</div>
