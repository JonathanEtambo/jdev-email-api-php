<section class="hero-section py-5 bg-gradient-light border-bottom position-relative overflow-hidden">
    <!-- Background decoration -->
    <div class="position-absolute top-0 end-0 w-50 h-100 opacity-10">
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path fill="#2da44e" d="M69.5,-58.8C86.7,-40.2,94.2,-14.7,89.6,8.9C85,32.5,68.2,54.2,46.8,67.9C25.4,81.6,-0.7,87.3,-25.1,80.1C-49.5,72.9,-72.2,52.9,-81.5,28.8C-90.8,4.7,-86.7,-23.5,-72.6,-46.6C-58.5,-69.7,-34.4,-87.6,-7.9,-84.2C18.7,-80.8,52.3,-77.4,69.5,-58.8Z" transform="translate(100 100)"/>
        </svg>
    </div>
    
    <div class="container py-5 position-relative">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 fade-in-up">
                <div class="badge bg-success bg-opacity-10 text-success mb-4 px-3 py-2 rounded-pill">
                    <i class="bi bi-rocket-takeoff"></i> API Puissante & Simple
                </div>
                <h1 class="display-4 fw-bold text-dark mb-4 lh-1">
                    L'API d'Email Simple pour vos 
                    <span class="text-gradient">Projets PHP</span>
                </h1>
                <p class="lead text-secondary mb-4 fs-5">
                    Intégrez l'envoi d'emails sur tous vos sites en quelques secondes. 
                    Une seule API, une gestion centralisée, une performance native.
                </p>
                
                <!-- Stats -->
                <div class="d-flex gap-4 mb-4">
                    <div>
                        <span class="h3 fw-bold text-success">99.9%</span>
                        <span class="text-secondary d-block">Disponibilité</span>
                    </div>
                    <div>
                        <span class="h3 fw-bold text-success">< 1s</span>
                        <span class="text-secondary d-block">Temps réponse</span>
                    </div>
                    <div>
                        <span class="h3 fw-bold text-success">10M+</span>
                        <span class="text-secondary d-block">Emails envoyés</span>
                    </div>
                </div>
                
                <div class="d-flex flex-wrap gap-3">
                    <a href="/register" class="btn btn-success btn-lg px-5 shadow-sm hover-lift">
                        <i class="bi bi-arrow-right-circle me-2"></i>Démarrer maintenant
                    </a>
                    <a href="/docs" class="btn btn-outline-dark btn-lg px-5 hover-lift">
                        <i class="bi bi-book me-2"></i>Voir la documentation
                    </a>
                </div>
                
                <!-- Trust badge -->
                <div class="mt-4 pt-2">
                    <span class="small text-secondary">
                        <i class="bi bi-shield-check text-success"></i> Aucune carte bancaire requise
                    </span>
                </div>
            </div>
            
            <div class="col-lg-6 d-none d-lg-block fade-in-right">
                <div class="card shadow-xl border-0 bg-gradient-dark text-white p-4 code-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex gap-2">
                                <div class="rounded-circle" style="width: 12px; height: 12px; background: #ff5f56;"></div>
                                <div class="rounded-circle" style="width: 12px; height: 12px; background: #ffbd2e;"></div>
                                <div class="rounded-circle" style="width: 12px; height: 12px; background: #27c93f;"></div>
                            </div>
                            <span class="text-white-50 small">api.jdevmail.com</span>
                        </div>
                        <pre class="mb-0"><code class="language-json"><span class="text-info">POST</span> <span class="text-warning">/api/v1/send-email</span>
{
  <span class="text-success">"site_id"</span>: <span class="text-light">"site_8b3f9e2a..."</span>,
  <span class="text-success">"to"</span>: <span class="text-light">"client@example.com"</span>,
  <span class="text-success">"subject"</span>: <span class="text-light">"Bienvenue sur notre plateforme !"</span>,
  <span class="text-success">"template_id"</span>: <span class="text-light">"welcome_email"</span>,
  <span class="text-success">"variables"</span>: {
    <span class="text-info">"name"</span>: <span class="text-light">"Utilisateur"</span>
  }
}</code></pre>
                        
                        <!-- Response preview -->
                        <div class="mt-3 pt-2 border-top border-secondary">
                            <div class="small text-success">
                                <i class="bi bi-check-circle-fill"></i> Response: { "status": "queued", "message_id": "msg_123456" }
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tech stack badges -->
                <div class="d-flex gap-2 justify-content-center mt-4">
                    <span class="badge bg-dark text-white px-3 py-2"><i class="bi bi-filetype-php"></i> PHP 8+</span>
                    <span class="badge bg-dark text-white px-3 py-2"><i class="bi bi-code-slash"></i> RESTful</span>
                    <span class="badge bg-dark text-white px-3 py-2"><i class="bi bi-shield-lock"></i> TLS 1.3</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-white border-bottom">
    <div class="container py-4">
        <div class="row g-4">
            <div class="col-md-4 fade-in-up" style="animation-delay: 0.1s">
                <div class="feature-card text-center p-4 rounded-4 border bg-white h-100">
                    <div class="feature-icon mx-auto mb-3 bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="bi bi-lightning-charge-fill text-success fs-2"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Ultra Rapide</h5>
                    <p class="text-secondary small">Temps d'envoi optimisé avec file d'attente asynchrone et delivery en < 50ms</p>
                </div>
            </div>
            
            <div class="col-md-4 fade-in-up" style="animation-delay: 0.2s">
                <div class="feature-card text-center p-4 rounded-4 border bg-white h-100">
                    <div class="feature-icon mx-auto mb-3 bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="bi bi-graph-up fs-2 text-success"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Analytics Détaillées</h5>
                    <p class="text-secondary small">Taux d'ouverture, clics, bounces et engagement en temps réel</p>
                </div>
            </div>
            
            <div class="col-md-4 fade-in-up" style="animation-delay: 0.3s">
                <div class="feature-card text-center p-4 rounded-4 border bg-white h-100">
                    <div class="feature-icon mx-auto mb-3 bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="bi bi-shield-check fs-2 text-success"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Sécurité Maximale</h5>
                    <p class="text-secondary small">Chiffrement TLS, authentification API, logs détaillés et conformité RGPD</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Founder Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center text-center mb-5 fade-in-up">
            <div class="col-lg-8">
                <div class="badge bg-dark text-white mb-3 px-3 py-1">À propos</div>
                <h2 class="fw-bold display-6">Le Fondateur</h2>
                <p class="lead text-secondary">Un expert passionné qui a créé une solution email performante pour les développeurs PHP</p>
                <hr class="mx-auto border-success border-3 opacity-100" style="width: 60px;">
            </div>
        </div>
        
        <div class="row align-items-center g-5">
            <div class="col-md-4 text-center fade-in-left">
                <div class="position-relative d-inline-block">
                    <div class="avatar-circle shadow-lg mx-auto mb-3" style="width: 180px; height: 180px; background: linear-gradient(135deg, #2da44e 0%, #1a6e3a 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-person-fill text-white" style="font-size: 5rem;"></i>
                    </div>
                    <div class="position-absolute bottom-0 end-0 bg-success rounded-circle p-2 border border-white">
                        <i class="bi bi-check-lg text-white small"></i>
                    </div>
                </div>
                
                <!-- Social links -->
                <div class="d-flex gap-2 justify-content-center mt-3">
                    <a href="#" class="btn btn-outline-dark btn-sm rounded-circle"><i class="bi bi-github"></i></a>
                    <a href="#" class="btn btn-outline-dark btn-sm rounded-circle"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="btn btn-outline-dark btn-sm rounded-circle"><i class="bi bi-twitter-x"></i></a>
                </div>
            </div>
            
            <div class="col-md-8 fade-in-right">
                <h4 class="fw-bold mb-1 display-6"><?php echo htmlspecialchars($founder['name'] ?? 'Jonathan Dzoko', ENT_QUOTES, 'UTF-8'); ?></h4>
                <p class="text-success fw-semibold mb-3 fs-5">
                    <i class="bi bi-star-fill me-1"></i> 
                    <?php echo htmlspecialchars($founder['role'] ?? 'Architecte Full-Stack & Entrepreneur', ENT_QUOTES, 'UTF-8'); ?>
                </p>
                <p class="text-muted lead">
                    <?php echo htmlspecialchars($founder['bio'] ?? 'Avec plus de 10 ans d\'expérience dans le développement web et l\'infrastructure cloud, Jonathan a créé JDev Mail API pour résoudre les problématiques d\'envoi d\'emails rencontrées dans ses propres projets. Sa vision : une API simple, fiable et scalable pour tous les développeurs PHP.', ENT_QUOTES, 'UTF-8'); ?>
                </p>
                
                <div class="d-flex flex-wrap gap-2 mt-4">
                    <span class="badge bg-light text-dark border px-3 py-2">
                        <i class="bi bi-check-circle-fill text-success me-1"></i> Full-Stack
                    </span>
                    <span class="badge bg-light text-dark border px-3 py-2">
                        <i class="bi bi-shield-check text-success me-1"></i> Cybersecurity
                    </span>
                    <span class="badge bg-light text-dark border px-3 py-2">
                        <i class="bi bi-wifi text-success me-1"></i> Networks
                    </span>
                    <span class="badge bg-light text-dark border px-3 py-2">
                        <i class="bi bi-cpu text-success me-1"></i> IoT
                    </span>
                    <span class="badge bg-light text-dark border px-3 py-2">
                        <i class="bi bi-cloud text-success me-1"></i> Cloud
                    </span>
                </div>
                
                <!-- Quote -->
                <div class="mt-4 p-3 bg-white rounded-3 border">
                    <i class="bi bi-quote text-success fs-4 me-2"></i>
                    <span class="text-secondary fst-italic">"Rendre l'envoi d'emails aussi simple que possible pour les développeurs PHP"</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- API Features Demo Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center text-center mb-5 fade-in-up">
            <div class="col-lg-8">
                <h2 class="fw-bold display-6">Pourquoi choisir notre API ?</h2>
                <p class="text-secondary lead">Tout ce dont vous avez besoin pour une communication email fiable</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 fade-in-up" style="animation-delay: 0.1s">
                <div class="d-flex gap-3 p-3 rounded-3 border bg-light">
                    <div class="flex-shrink-0">
                        <div class="bg-success bg-opacity-10 rounded p-2">
                            <i class="bi bi-code-square text-success fs-3"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Intégration Simple</h6>
                        <p class="text-secondary small mb-0">Une ligne de code pour envoyer votre premier email. SDK PHP disponible.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 fade-in-up" style="animation-delay: 0.2s">
                <div class="d-flex gap-3 p-3 rounded-3 border bg-light">
                    <div class="flex-shrink-0">
                        <div class="bg-success bg-opacity-10 rounded p-2">
                            <i class="bi bi-speedometer2 text-success fs-3"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Haute Performance</h6>
                        <p class="text-secondary small mb-0">Infrastructure scalable capable de gérer des milliers d'emails par seconde.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 fade-in-up" style="animation-delay: 0.3s">
                <div class="d-flex gap-3 p-3 rounded-3 border bg-light">
                    <div class="flex-shrink-0">
                        <div class="bg-success bg-opacity-10 rounded p-2">
                            <i class="bi bi-graph-up text-success fs-3"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Suivi en Temps Réel</h6>
                        <p class="text-secondary small mb-0">Dashboard analytics avec métriques détaillées de vos campagnes.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 fade-in-up" style="animation-delay: 0.4s">
                <div class="d-flex gap-3 p-3 rounded-3 border bg-light">
                    <div class="flex-shrink-0">
                        <div class="bg-success bg-opacity-10 rounded p-2">
                            <i class="bi bi-headset text-success fs-3"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Support 24/7</h6>
                        <p class="text-secondary small mb-0">Une équipe dédiée pour vous assister à chaque étape de votre projet.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- CTA Banner -->
        <div class="mt-5 p-5 bg-gradient-primary rounded-4 text-center text-white fade-in-up" style="background: linear-gradient(135deg, #1a1e2b 0%, #2d3748 100%);">
            <h3 class="fw-bold mb-3">Prêt à simplifier vos envois d'emails ?</h3>
            <p class="mb-4 opacity-75">Commencez gratuitement dès aujourd'hui et envoyez 1000 emails par mois</p>
            <a href="/register" class="btn btn-success btn-lg px-5 shadow-sm">
                <i class="bi bi-rocket-takeoff me-2"></i>Démarrer maintenant
            </a>
            <p class="small mt-3 opacity-50 mb-0">Aucune carte bancaire requise - Essai gratuit 30 jours</p>
        </div>
    </div>
</section>