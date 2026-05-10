<style>
    :root {
        --dx-primary: #5B6C3D;
        --dx-secondary: #99C68E;
        --dx-dark: #355749;
        --dx-light: #f4f7f2;
    }

    .dx-page {
        color: var(--dx-dark);
    }

    .dx-contact-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: var(--dx-primary);
        color: #fff;
        flex-shrink: 0;
    }

    .dx-card {
        border-radius: 1.2rem;
        border: 1px solid var(--border-color);
    }

    .dx-btn {
        background: var(--dx-primary);
        border-color: var(--dx-primary);
        color: #fff;
    }

    .dx-btn:hover,
    .dx-btn:focus {
        background: var(--dx-dark);
        border-color: var(--dx-dark);
        color: #fff;
    }

    .dx-map {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
        border-radius: 1rem;
    }

    .dx-map iframe {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }

    .dx-status {
        display: none;
    }

    .dx-loading {
        opacity: .7;
        pointer-events: none;
    }
</style>

<section class="py-5 dx-page">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold mb-3">Contactez-<span style="color:var(--dx-primary)">nous</span></h1>
                <p class="lead text-secondary mb-4">Pret a transformer votre vision en realite ? Notre equipe vous accompagne.</p>

                <div class="d-flex align-items-start gap-3 mb-3">
                    <div class="dx-contact-icon"><i class="bi bi-envelope"></i></div>
                    <div>
                        <h6 class="mb-0 fw-bold">Email</h6>
                        <p class="mb-0 text-secondary">dxcode243@gmail.com</p>
                    </div>
                </div>
                <div class="d-flex align-items-start gap-3">
                    <div class="dx-contact-icon"><i class="bi bi-geo-alt"></i></div>
                    <div>
                        <h6 class="mb-0 fw-bold">Adresse</h6>
                        <p class="mb-0 text-secondary">ISTA KINSHASA, Barumbu, RDC</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="https://via.placeholder.com/400x350/5B6C3D/ffffff?text=DX-CODE" alt="DX-CODE" class="img-fluid rounded-4 shadow" style="max-height:350px;object-fit:cover;">
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-soft">
    <div class="container">
        <div class="card dx-card shadow-sm border-0">
            <div class="card-body p-4 p-md-5">
                <h3 class="fw-bold mb-4 text-center">Envoyez un message</h3>

                <div id="dxStatus" class="alert dx-status" role="alert"></div>

                <form id="dxContactForm" novalidate>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Prenom & Nom *</label>
                            <input type="text" id="dxName" class="form-control form-control-lg" placeholder="Ex: Jonathan Doe" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email *</label>
                            <input type="email" id="dxEmail" class="form-control form-control-lg" placeholder="votre@email.com" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Service souhaite</label>
                            <select id="dxService" class="form-select form-select-lg">
                                <option value="Developpement Web">Developpement Web</option>
                                <option value="Developpement Mobile">Developpement Mobile</option>
                                <option value="IoT & Systemes embarques">IoT & Systemes embarques</option>
                                <option value="Cybersecurite">Cybersecurite</option>
                                <option value="Consulting & Accompagnement">Consulting & Accompagnement</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Message *</label>
                            <textarea id="dxMessage" class="form-control" rows="5" placeholder="Decrivez votre projet..." required></textarea>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" id="dxSubmit" class="btn dx-btn btn-lg px-5 py-3">
                                <i class="bi bi-send me-2"></i>Envoyer le message
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Notre Localisation</h2>
        <div class="dx-map shadow">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3978.508!2d15.31!3d-4.32!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zSVNUQSBfIEJBUlVNQlU!5e0!3m2!1sfr!2scd!4v123456789" allowfullscreen loading="lazy"></iframe>
        </div>
        <p class="mt-3 text-secondary small">Situe au sein de l'Institut Superieur des Techniques Appliquees (ISTA KINSHASA).</p>
    </div>
</section>

<script>
(() => {
    const form = document.getElementById('dxContactForm');
    const statusBox = document.getElementById('dxStatus');
    const submitBtn = document.getElementById('dxSubmit');

    const endpoint = '<?php echo APP_URL; ?>/api/contact-dxcode';

    const showStatus = (type, message) => {
        statusBox.className = `alert alert-${type} dx-status`;
        statusBox.textContent = message;
        statusBox.style.display = 'block';
    };

    const isValidEmail = (email) => /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(email);

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const user_name = document.getElementById('dxName').value.trim();
        const user_email = document.getElementById('dxEmail').value.trim();
        const service = document.getElementById('dxService').value.trim();
        const message = document.getElementById('dxMessage').value.trim();

        if (!user_name || !user_email || !message) {
            showStatus('danger', 'Veuillez remplir tous les champs obligatoires.');
            return;
        }

        if (user_name.length < 2) {
            showStatus('danger', 'Nom trop court (minimum 2 caracteres).');
            return;
        }

        if (!isValidEmail(user_email)) {
            showStatus('danger', 'Veuillez entrer une adresse email valide.');
            return;
        }

        if (message.length < 10) {
            showStatus('danger', 'Message trop court (minimum 10 caracteres).');
            return;
        }

        const payload = { user_name, user_email, service, message };

        submitBtn.disabled = true;
        submitBtn.classList.add('dx-loading');
        const initialHtml = submitBtn.innerHTML;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Envoi en cours...';

        try {
            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            const data = await response.json();

            if (response.ok && data.success) {
                showStatus('success', data.message || 'Message envoye avec succes.');
                form.reset();
            } else {
                showStatus('danger', data.message || data.error || 'Echec de l\'envoi.');
            }
        } catch (error) {
            showStatus('danger', 'Impossible de joindre le serveur. Verifiez la connexion.');
        } finally {
            submitBtn.disabled = false;
            submitBtn.classList.remove('dx-loading');
            submitBtn.innerHTML = initialHtml;
        }
    });
})();
</script>
