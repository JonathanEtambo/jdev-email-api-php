<section class="py-5 bg-soft border-bottom">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
      <h1 class="section-title mb-0">Documentation API</h1>
      <span class="badge bg-success">POST /api/send-email</span>
    </div>
    <p class="text-secondary mb-4">Endpoint transactionnel pour envoyer des emails HTML via PHP <code>mail()</code>.</p>

    <div class="panel p-4 mb-4">
      <h5>URL</h5>
      <pre><code><?php echo APP_URL; ?>/api/send-email</code></pre>
      <h5 class="mt-3">Headers</h5>
      <pre><code>Content-Type: application/json
Accept: application/json</code></pre>
      <h5 class="mt-3">Payload requis</h5>
      <pre><code>{
  "site_id": "site_xxxxx",
  "public_key": "jpk_xxxxx",
  "secret_key": "jsk_xxxxx",
  "to": "client@example.com",
  "subject": "Bienvenue",
  "html_content": "&lt;h1&gt;Hello&lt;/h1&gt;",
  "text_content": "Hello (optionnel)"
}</code></pre>
    </div>

    <div class="panel p-4 mb-4">
      <h5>Reponse de succes (200)</h5>
      <pre><code>{
  "success": true,
  "message": "Email sent successfully",
  "data": {
    "site_id": "site_xxxxx",
    "status": "sent",
    "remaining_emails": 49,
    "plan_mode": "trial"
  }
}</code></pre>

      <h5 class="mt-3">Reponse d'erreur (exemple 429)</h5>
      <pre><code>{
  "success": false,
  "error": "Rate limit exceeded",
  "error_code": "rate_limit_exceeded",
  "retry_after_seconds": 42
}</code></pre>
    </div>

    <div class="panel p-4 mb-4">
      <h5>Codes HTTP</h5>
      <div class="table-responsive">
        <table class="table align-middle mb-0">
          <thead><tr><th>Code</th><th>Description</th></tr></thead>
          <tbody>
            <tr><td><code>200</code></td><td>Email envoye</td></tr>
            <tr><td><code>400</code></td><td>JSON invalide ou champ requis manquant</td></tr>
            <tr><td><code>401</code></td><td>Identifiants API invalides</td></tr>
            <tr><td><code>403</code></td><td>Compte inactif ou quota trial epuise</td></tr>
            <tr><td><code>413</code></td><td>Payload trop volumineux</td></tr>
            <tr><td><code>422</code></td><td>Email destinataire invalide / sujet invalide</td></tr>
            <tr><td><code>429</code></td><td>Rate limit depasse</td></tr>
            <tr><td><code>502</code></td><td>Echec delivery du serveur mail local</td></tr>
            <tr><td><code>500</code></td><td>Erreur interne</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="panel p-4 mb-4">
      <h5>Exemple cURL</h5>
      <pre><code>curl -X POST "<?php echo APP_URL; ?>/api/send-email" \\
  -H "Content-Type: application/json" \\
  -H "Accept: application/json" \\
  -d '{
    "site_id":"site_xxxxx",
    "public_key":"jpk_xxxxx",
    "secret_key":"jsk_xxxxx",
    "to":"client@example.com",
    "subject":"Test API",
    "html_content":"&lt;p&gt;Bonjour depuis cURL&lt;/p&gt;"
  }'</code></pre>

      <h5 class="mt-4">Exemple PHP (cURL)</h5>
      <pre><code>$payload = [
    'site_id' => 'site_xxxxx',
    'public_key' => 'jpk_xxxxx',
    'secret_key' => 'jsk_xxxxx',
    'to' => 'client@example.com',
    'subject' => 'Test API',
    'html_content' => '&lt;p&gt;Bonjour depuis PHP&lt;/p&gt;'
];

$ch = curl_init('<?php echo APP_URL; ?>/api/send-email');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Accept: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);</code></pre>

      <h5 class="mt-4">Exemple JavaScript (fetch)</h5>
      <pre><code>const response = await fetch('<?php echo APP_URL; ?>/api/send-email', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  },
  body: JSON.stringify({
    site_id: 'site_xxxxx',
    public_key: 'jpk_xxxxx',
    secret_key: 'jsk_xxxxx',
    to: 'client@example.com',
    subject: 'Test API',
    html_content: '&lt;p&gt;Bonjour depuis JS&lt;/p&gt;'
  })
});
const data = await response.json();</code></pre>

      <h5 class="mt-4">Exemple Python (requests)</h5>
      <pre><code>import requests

payload = {
    "site_id": "site_xxxxx",
    "public_key": "jpk_xxxxx",
    "secret_key": "jsk_xxxxx",
    "to": "client@example.com",
    "subject": "Test API",
    "html_content": "&lt;p&gt;Bonjour depuis Python&lt;/p&gt;"
}

r = requests.post(
    "<?php echo APP_URL; ?>/api/send-email",
    json=payload,
    headers={"Accept": "application/json"},
    timeout=20
)
print(r.status_code, r.json())</code></pre>

      <h5 class="mt-4">Exemple Node.js (Axios)</h5>
      <pre><code>import axios from 'axios';

const payload = {
  site_id: 'site_xxxxx',
  public_key: 'jpk_xxxxx',
  secret_key: 'jsk_xxxxx',
  to: 'client@example.com',
  subject: 'Test API',
  html_content: '&lt;p&gt;Bonjour depuis Node&lt;/p&gt;'
};

const { data } = await axios.post('<?php echo APP_URL; ?>/api/send-email', payload, {
  headers: { 'Accept': 'application/json' }
});
console.log(data);</code></pre>

      <h5 class="mt-4">Exemple C# (.NET HttpClient)</h5>
      <pre><code>using System.Net.Http.Json;

var http = new HttpClient();
var payload = new {
    site_id = "site_xxxxx",
    public_key = "jpk_xxxxx",
    secret_key = "jsk_xxxxx",
    to = "client@example.com",
    subject = "Test API",
    html_content = "&lt;p&gt;Bonjour depuis C#&lt;/p&gt;"
};

var response = await http.PostAsJsonAsync("<?php echo APP_URL; ?>/api/send-email", payload);
var body = await response.Content.ReadAsStringAsync();</code></pre>

      <h5 class="mt-4">Exemple Go</h5>
      <pre><code>payload := []byte(`{
  "site_id":"site_xxxxx",
  "public_key":"jpk_xxxxx",
  "secret_key":"jsk_xxxxx",
  "to":"client@example.com",
  "subject":"Test API",
  "html_content":"&lt;p&gt;Bonjour depuis Go&lt;/p&gt;"
}`)

req, _ := http.NewRequest("POST", "<?php echo APP_URL; ?>/api/send-email", bytes.NewBuffer(payload))
req.Header.Set("Content-Type", "application/json")
req.Header.Set("Accept", "application/json")

client := &http.Client{Timeout: 20 * time.Second}
resp, _ := client.Do(req)</code></pre>
    </div>

    <div class="panel p-4">
      <h5>Bonnes pratiques</h5>
      <ul class="mb-0">
        <li>Ne jamais exposer <code>secret_key</code> dans du JavaScript public.</li>
        <li>Toujours journaliser <code>status_code</code> et la reponse de l'API cote client.</li>
        <li>Respecter <code>retry_after_seconds</code> en cas de <code>429</code>.</li>
        <li>Limiter la taille du HTML envoye et valider les adresses email en amont.</li>
      </ul>
    </div>
  </div>
</section>
