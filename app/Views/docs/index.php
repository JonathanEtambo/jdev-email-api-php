<style>
:root {
    --accent: #2da44e;
    --accent-hover: #1a6e3a;
    --accent-light: rgba(45, 164, 78, 0.12);
    --bg-page: #f6f8fa;
    --bg-panel: #ffffff;
    --text-main: #1a1e2b;
    --text-muted: #64748b;
    --border-color: #d0d7de;
    --code-bg: #0d1117;
    --code-text: #e6edf3;
}

[data-theme="dark"] {
    --bg-page: #0d1117;
    --bg-panel: #161b22;
    --text-main: #e6edf3;
    --text-muted: #8b949e;
    --border-color: #30363d;
    --code-bg: #010409;
    --code-text: #e6edf3;
}

.docs-page {
    background:
        radial-gradient(circle at top left, var(--accent-light), transparent 35%),
        var(--bg-page);

    min-height: 100vh;
    padding: 70px 0;
}

.docs-hero {
    background: var(--bg-panel);
    border: 1px solid var(--border-color);
    border-radius: 28px;
    padding: 40px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.06);
    margin-bottom: 30px;
}

.docs-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    background: var(--accent-light);
    color: var(--accent);

    padding: 8px 14px;

    border-radius: 999px;

    font-weight: 700;
    font-size: 13px;
}

.docs-title {
    color: var(--text-main);
    font-weight: 800;
    letter-spacing: -0.04em;
}

.docs-subtitle {
    color: var(--text-muted);
    max-width: 760px;
    line-height: 1.7;
}

.docs-endpoint {
    background: var(--code-bg);
    color: var(--code-text);

    border-radius: 999px;

    padding: 10px 16px;

    font-size: 13px;
    font-weight: 700;
}

.docs-panel {
    background: var(--bg-panel);
    color: var(--text-main);

    border: 1px solid var(--border-color);

    border-radius: 24px;

    padding: 28px;

    box-shadow: 0 15px 35px rgba(0,0,0,0.05);

    margin-bottom: 24px;
}

.docs-panel h5 {
    color: var(--text-main);
    font-weight: 800;
    margin-bottom: 12px;
}

.docs-panel p,
.docs-panel li,
.docs-panel td {
    color: var(--text-muted);
}

.docs-panel code {
    color: var(--accent);
    font-weight: 700;
}

.docs-code {
    position: relative;

    background: var(--code-bg);
    color: var(--code-text);

    border-radius: 18px;

    overflow-x: auto;

    border: 1px solid rgba(255,255,255,0.08);

    margin-top: 15px;
}

.docs-code pre {
    margin: 0;
    padding: 20px;
}

.docs-code code {
    color: var(--code-text);
    font-weight: 500;
    font-size: 14px;
}

.copy-btn {
    position: absolute;
    top: 14px;
    right: 14px;

    border: none;

    background: rgba(255,255,255,0.08);
    color: #fff;

    width: 42px;
    height: 42px;

    border-radius: 12px;

    display: flex;
    align-items: center;
    justify-content: center;

    transition: 0.25s ease;
}

.copy-btn:hover {
    background: var(--accent);
    transform: scale(1.05);
}

.table {
    color: var(--text-main);
}

.table thead th {
    color: var(--text-main);
    border-color: var(--border-color);
    font-weight: 800;
}

.table tbody td {
    border-color: var(--border-color);
}

.http-code {
    background: var(--accent-light);
    color: var(--accent);

    padding: 5px 10px;

    border-radius: 999px;

    font-weight: 800;
}

.docs-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-top: 24px;
}

.docs-feature {
    background: var(--accent-light);
    border-radius: 18px;
    padding: 18px;
    color: var(--text-main);
}

.docs-feature i {
    color: var(--accent);
    font-size: 22px;
}

.docs-feature strong {
    display: block;
    margin-top: 8px;
    margin-bottom: 4px;
}

.docs-feature span {
    color: var(--text-muted);
    font-size: 14px;
}

@media (max-width: 992px) {

    .docs-grid {
        grid-template-columns: 1fr;
    }

    .docs-hero {
        padding: 28px;
    }

    .docs-title {
        font-size: 30px;
    }
}
</style>

<?php
function codeBlock($code) {
?>
<div class="docs-code">

    <button class="copy-btn" type="button">
        <i class="bi bi-copy"></i>
    </button>

    <pre><code><?= htmlspecialchars($code, ENT_QUOTES, 'UTF-8'); ?></code></pre>

</div>
<?php } ?>

<section class="docs-page">
    <div class="container">

        <div class="docs-hero">

            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">

                <div>

                    <span class="docs-badge mb-3">
                        <i class="bi bi-envelope-check-fill"></i>
                        JDevMail API
                    </span>

                    <h1 class="docs-title mb-3">
                        Documentation API Email
                    </h1>

                    <p class="docs-subtitle mb-0">
                        Intègre facilement l’envoi d’emails dans tes sites vitrines :
                        formulaires de contact, demandes de devis, confirmations client
                        et notifications transactionnelles.
                    </p>

                </div>

                <span class="docs-endpoint">
                    POST /api/send-email
                </span>

            </div>

            <div class="docs-grid">

                <div class="docs-feature">
                    <i class="bi bi-code-slash"></i>
                    <strong>Intégration simple</strong>
                    <span>Une requête JSON suffit pour envoyer un email.</span>
                </div>

                <div class="docs-feature">
                    <i class="bi bi-shield-check"></i>
                    <strong>Sécurisé</strong>
                    <span>Authentification avec public_key et secret_key.</span>
                </div>

                <div class="docs-feature">
                    <i class="bi bi-speedometer2"></i>
                    <strong>Contrôle quota</strong>
                    <span>Gestion des limites et abonnements.</span>
                </div>

            </div>

        </div>

        <div class="docs-panel">

            <h5>URL</h5>

            <?php codeBlock(APP_URL . '/api/send-email'); ?>

            <h5 class="mt-4">Headers</h5>

            <?php codeBlock(
'Content-Type: application/json
Accept: application/json'
            ); ?>

            <h5 class="mt-4">Payload requis</h5>

            <?php codeBlock(
'{
  "site_id": "site_xxxxx",
  "public_key": "jpk_xxxxx",
  "secret_key": "jsk_xxxxx",
  "to": "client@example.com",
  "subject": "Bienvenue",
  "html_content": "<h1>Hello</h1>",
  "text_content": "Hello (optionnel)"
}'
            ); ?>

        </div>

        <div class="docs-panel">

            <h5>Réponse de succès — 200</h5>

            <?php codeBlock(
'{
  "success": true,
  "message": "Email sent successfully",
  "data": {
    "site_id": "site_xxxxx",
    "status": "sent",
    "remaining_emails": 49,
    "plan_mode": "trial"
  }
}'
            ); ?>

            <h5 class="mt-4">Réponse d’erreur — 429</h5>

            <?php codeBlock(
'{
  "success": false,
  "error": "Rate limit exceeded",
  "error_code": "rate_limit_exceeded",
  "retry_after_seconds": 42
}'
            ); ?>

        </div>

        <div class="docs-panel">

            <h5>Exemple cURL</h5>

            <?php codeBlock(
'curl -X POST "' . APP_URL . '/api/send-email" \
-H "Content-Type: application/json" \
-H "Accept: application/json" \
-d \'{
  "site_id":"site_xxxxx",
  "public_key":"jpk_xxxxx",
  "secret_key":"jsk_xxxxx",
  "to":"client@example.com",
  "subject":"Test API",
  "html_content":"<p>Bonjour depuis cURL</p>"
}\''
            ); ?>

            <h5 class="mt-4">Exemple JavaScript — fetch</h5>

            <?php codeBlock(
'const response = await fetch("' . APP_URL . '/api/send-email", {
  method: "POST",
  headers: {
    "Content-Type": "application/json",
    "Accept": "application/json"
  },
  body: JSON.stringify({
    site_id: "site_xxxxx",
    public_key: "jpk_xxxxx",
    secret_key: "jsk_xxxxx",
    to: "client@example.com",
    subject: "Test API",
    html_content: "<p>Bonjour depuis JS</p>"
  })
});

const data = await response.json();'
            ); ?>

            <h5 class="mt-4">Exemple PHP — cURL</h5>

            <?php codeBlock(
'$payload = [
    "site_id" => "site_xxxxx",
    "public_key" => "jpk_xxxxx",
    "secret_key" => "jsk_xxxxx",
    "to" => "client@example.com",
    "subject" => "Test API",
    "html_content" => "<p>Bonjour depuis PHP</p>"
];

$ch = curl_init("' . APP_URL . '/api/send-email");

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Accept: application/json"
]);

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

curl_close($ch);'
            ); ?>

        </div>

        <div class="docs-panel">

            <h5>Bonnes pratiques</h5>

            <ul class="mb-0">
                <li>Ne jamais exposer <code>secret_key</code> dans du JavaScript public.</li>
                <li>Journaliser les réponses API côté serveur.</li>
                <li>Respecter <code>retry_after_seconds</code> en cas de <code>429</code>.</li>
                <li>Limiter la taille du HTML envoyé.</li>
                <li>Utiliser l’API côté serveur pour protéger les clés sensibles.</li>
            </ul>

        </div>

    </div>
</section>

<script>
document.querySelectorAll('.copy-btn').forEach(button => {

    button.addEventListener('click', async function () {

        const codeBlock = this.parentElement.querySelector('code');

        if (!codeBlock) return;

        const text = codeBlock.innerText;

        try {

            await navigator.clipboard.writeText(text);

            this.innerHTML = '<i class="bi bi-check-lg"></i>';

            this.style.background = '#2da44e';

            setTimeout(() => {

                this.innerHTML = '<i class="bi bi-copy"></i>';

                this.style.background = '';

            }, 2000);

        } catch (err) {

            console.error('Erreur copie :', err);

        }
    });

});
</script>