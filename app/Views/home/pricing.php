<section class="hero-section py-5 border-bottom">
    <div class="container py-4">
        <div class="row align-items-center mb-4">
            <div class="col-lg-8">
                <h1 class="section-title display-6 mb-2">Plans adaptés à votre croissance</h1>
                <p class="text-secondary mb-0">Choisissez un plan et activez-le via validation manuelle admin.</p>
            </div>
        </div>
        <div class="row g-3">
            <?php foreach ($plans as $plan): ?>
                <div class="col-md-4">
                    <div class="panel h-100 p-4 feature-card">
                        <h5 class="mb-2"><?php echo e($plan['name']); ?></h5>
                        <p class="text-muted small mb-3"><?php echo e($plan['description']); ?></p>
                        <h3 class="text-success mb-3"><?php echo number_format((float)$plan['price'], 2); ?> USD</h3>
                        <a href="<?php echo APP_URL; ?>/register" class="btn btn-outline-success btn-sm">Commencer</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
