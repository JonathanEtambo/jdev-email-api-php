# JDev Mail API

Plateforme SaaS d'envoi d'emails en PHP natif (MVC), avec gestion des sites, cles API, quotas, abonnements et administration.

**Proprietaire:** Jonathan Dzoko Etambo  
**Version:** 1.0  
**Stack:** PHP 8+, PDO, MySQL, Bootstrap 5, JavaScript

---

## 1. Fonctionnalites

- Authentification utilisateur (inscription, connexion, session)
- Gestion des sites (CRUD)
- Generation de cles API (`site_id`, `public_key`, `secret_key`)
- Endpoint API `POST /api/send-email`
- Quota trial + controle abonnement
- Rate limiting par cle API
- Journalisation des envois (`email_logs`)
- Paiement manuel + validation admin
- Dashboard utilisateur + espace admin

---

## 2. Architecture

Architecture MVC stricte:

- `app/Core` : Router, Controller, Database, Session, CSRF
- `app/Models` : User, Site, Subscription, Payment, EmailLog, Plan
- `app/Controllers` : Auth, Dashboard, Site, Api, Subscription, Admin, Docs
- `app/Views` : pages UI
- `routes/web.php` : routes web
- `routes/api.php` : routes API
- `config/config.php` : configuration application
- `database/schema.sql` : schema SQL complet
- `public/index.php` : front controller

---

## 3. Prerequis

- XAMPP (Apache + PHP 8+ + MySQL)
- PHP CLI disponible (`php -v`)
- MySQL actif
- `mod_rewrite` Apache actif

---

## 4. Installation rapide

### 4.1 Copier le projet

Place le projet dans:

```text
C:\xampp\htdocs\jdevmail
```

### 4.2 Base de donnees

1. Importer `database/schema.sql`.
2. Verifier `config/config.php`:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'jdev_mail_api');
define('DB_USER', 'root');
define('DB_PASS', '');
define('APP_URL', 'http://localhost/jdevmail');
```

### 4.3 Lancer

- Demarrer Apache + MySQL depuis XAMPP
- Ouvrir: `http://localhost/jdevmail`

---

## 5. Configuration email (PHP mail + XAMPP Sendmail)

Le projet envoie via `mail()` (pas de SMTP dans le code).  
Le relais SMTP se fait via XAMPP Sendmail.

### 5.1 `C:\xampp\sendmail\sendmail.ini`

```ini
smtp_server=smtp.gmail.com
smtp_port=587
smtp_ssl=tls
auth_username=VOTRE_EMAIL@gmail.com
auth_password=VOTRE_APP_PASSWORD_GMAIL
force_sender=VOTRE_EMAIL@gmail.com
error_logfile=error.log
debug_logfile=debug.log
hostname=localhost
```

### 5.2 `C:\xampp\php\php.ini`

```ini
SMTP=smtp.gmail.com
smtp_port=587
sendmail_from=VOTRE_EMAIL@gmail.com
sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t -i"
mail.add_x_header=On
mail.log = "C:\xampp\sendmail\php_mail.log"
```

### 5.3 Important Gmail

- Activer la validation en 2 etapes
- Generer un App Password Google (16 caracteres)
- Utiliser cet App Password dans `auth_password`
- Redemarrer Apache apres modifications

---

## 6. Workflow pour recuperer les cles API

1. Creer un compte (`/register`)
2. Se connecter (`/login`)
3. Aller sur `/sites`
4. Creer un site
5. Recuperer:
   - `site_id`
   - `public_key`
   - `secret_key`

Ces 3 valeurs sont obligatoires pour appeler l'API.

---

## 7. Endpoint API

### 7.1 URL

```text
POST http://localhost/jdevmail/api/send-email
```

### 7.2 Headers

```text
Content-Type: application/json
Accept: application/json
```

### 7.3 Payload

```json
{
  "site_id": "site_xxxxx",
  "public_key": "jpk_xxxxx",
  "secret_key": "jsk_xxxxx",
  "to": "client@example.com",
  "subject": "Bienvenue",
  "html_content": "<h1>Hello</h1>",
  "text_content": "Hello (optionnel)"
}
```

### 7.4 Reponse succes (200)

```json
{
  "success": true,
  "message": "Email sent successfully",
  "data": {
    "site_id": "site_xxxxx",
    "status": "sent",
    "remaining_emails": 49,
    "plan_mode": "trial"
  }
}
```

### 7.5 Reponse erreur (exemple 429)

```json
{
  "success": false,
  "error": "Rate limit exceeded",
  "error_code": "rate_limit_exceeded",
  "retry_after_seconds": 42
}
```

### 7.6 Codes HTTP

- `200` Email envoye
- `400` JSON invalide ou champ requis manquant
- `401` Identifiants API invalides
- `403` Compte inactif ou quota trial epuise
- `413` Payload trop volumineux
- `422` Donnees invalides (email/sujet)
- `429` Limite de requetes depassee
- `502` Echec d'envoi cote serveur mail local
- `500` Erreur interne

---

## 8. Exemples API multi-langages

### 8.1 cURL (Linux / macOS)

```bash
curl -X POST "https://jdev.fermekilo6.com/api/send-email" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "site_id":"site_d0436b925c563972",
    "public_key":"jpk_4673613909a30cba350221b1bdb824d2",
    "secret_key":"jsk_76a3208d77f02be21545b783ffdea27649f331a985da320407c8259ff41403f9",
    "to":"jodzoko@gmail.com",
    "subject":"Test API",
    "html_content":"<p>Bonjour depuis cURL</p>"
  }'
```

### 8.2 cURL (Windows PowerShell - recommande)

```powershell
@'
{
  "site_id":"site_xxxxx",
  "public_key":"jpk_xxxxx",
  "secret_key":"jsk_xxxxx",
  "to":"client@example.com",
  "subject":"Test API",
  "html_content":"<p>Bonjour depuis PowerShell</p>"
}
'@ | Set-Content payload.json

curl.exe -X POST "http://localhost/jdevmail/api/send-email" `
  -H "Content-Type: application/json" `
  -H "Accept: application/json" `
  --data-binary "@payload.json"

Remove-Item payload.json
```

### 8.3 PHP (cURL)

```php
<?php
$payload = [
    'site_id' => 'site_xxxxx',
    'public_key' => 'jpk_xxxxx',
    'secret_key' => 'jsk_xxxxx',
    'to' => 'client@example.com',
    'subject' => 'Test API',
    'html_content' => '<p>Bonjour depuis PHP</p>'
];

$ch = curl_init('http://localhost/jdevmail/api/send-email');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Accept: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo $httpCode . PHP_EOL;
echo $response;
```

### 8.4 JavaScript (fetch)

```js
const response = await fetch('http://localhost/jdevmail/api/send-email', {
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
    html_content: '<p>Bonjour depuis JS</p>'
  })
});

const data = await response.json();
console.log(response.status, data);
```

### 8.5 Node.js (Axios)

```js
import axios from 'axios';

const payload = {
  site_id: 'site_xxxxx',
  public_key: 'jpk_xxxxx',
  secret_key: 'jsk_xxxxx',
  to: 'client@example.com',
  subject: 'Test API',
  html_content: '<p>Bonjour depuis Node</p>'
};

const res = await axios.post('http://localhost/jdevmail/api/send-email', payload, {
  headers: { Accept: 'application/json' }
});

console.log(res.status, res.data);
```

### 8.6 Python (requests)

```python
import requests

payload = {
    "site_id": "site_xxxxx",
    "public_key": "jpk_xxxxx",
    "secret_key": "jsk_xxxxx",
    "to": "client@example.com",
    "subject": "Test API",
    "html_content": "<p>Bonjour depuis Python</p>"
}

r = requests.post(
    "http://localhost/jdevmail/api/send-email",
    json=payload,
    headers={"Accept": "application/json"},
    timeout=20,
)

print(r.status_code)
print(r.json())
```

### 8.7 Java (HttpClient)

```java
import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;

String json = """
{
  "site_id":"site_xxxxx",
  "public_key":"jpk_xxxxx",
  "secret_key":"jsk_xxxxx",
  "to":"client@example.com",
  "subject":"Test API",
  "html_content":"<p>Bonjour depuis Java</p>"
}
""";

HttpRequest request = HttpRequest.newBuilder()
    .uri(URI.create("http://localhost/jdevmail/api/send-email"))
    .header("Content-Type", "application/json")
    .header("Accept", "application/json")
    .POST(HttpRequest.BodyPublishers.ofString(json))
    .build();

HttpClient client = HttpClient.newHttpClient();
HttpResponse<String> response = client.send(request, HttpResponse.BodyHandlers.ofString());
System.out.println(response.statusCode());
System.out.println(response.body());
```

### 8.8 C# (.NET)

```csharp
using System.Net.Http.Json;

var http = new HttpClient();

var payload = new {
    site_id = "site_xxxxx",
    public_key = "jpk_xxxxx",
    secret_key = "jsk_xxxxx",
    to = "client@example.com",
    subject = "Test API",
    html_content = "<p>Bonjour depuis C#</p>"
};

var response = await http.PostAsJsonAsync("http://localhost/jdevmail/api/send-email", payload);
var body = await response.Content.ReadAsStringAsync();

Console.WriteLine((int)response.StatusCode);
Console.WriteLine(body);
```

### 8.9 Go

```go
package main

import (
    "bytes"
    "fmt"
    "net/http"
    "time"
)

func main() {
    payload := []byte(`{
      "site_id":"site_xxxxx",
      "public_key":"jpk_xxxxx",
      "secret_key":"jsk_xxxxx",
      "to":"client@example.com",
      "subject":"Test API",
      "html_content":"<p>Bonjour depuis Go</p>"
    }`)

    req, _ := http.NewRequest("POST", "http://localhost/jdevmail/api/send-email", bytes.NewBuffer(payload))
    req.Header.Set("Content-Type", "application/json")
    req.Header.Set("Accept", "application/json")

    client := &http.Client{Timeout: 20 * time.Second}
    resp, err := client.Do(req)
    if err != nil {
        panic(err)
    }
    defer resp.Body.Close()

    fmt.Println(resp.StatusCode)
}
```

### 8.10 Dart (Flutter / Dart)

```dart
import 'dart:convert';
import 'package:http/http.dart' as http;

Future<void> sendEmail() async {
  final uri = Uri.parse('http://localhost/jdevmail/api/send-email');

  final payload = {
    'site_id': 'site_xxxxx',
    'public_key': 'jpk_xxxxx',
    'secret_key': 'jsk_xxxxx',
    'to': 'client@example.com',
    'subject': 'Test API',
    'html_content': '<p>Bonjour depuis Dart</p>',
  };

  final res = await http.post(
    uri,
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
    },
    body: jsonEncode(payload),
  );

  print(res.statusCode);
  print(res.body);
}
```

---

## 9. Depannage

### 9.1 `404 - Page non trouvee` sur `/api/send-email`

- Verifier l'URL exacte
- Verifier `mod_rewrite`
- Verifier que la requete arrive bien sur `public/index.php`

### 9.2 `405 Method Not Allowed`

- Route existante mais methode incorrecte
- Utiliser `POST`

### 9.3 `invalid_json`

- JSON mal echappe (surtout sous PowerShell)
- Utiliser la methode `payload.json`

### 9.4 `invalid_credentials`

- Mauvais `site_id`, `public_key` ou `secret_key`
- Site suspendu/inactif

### 9.5 `mail_delivery_failed`

- Sendmail XAMPP mal configure
- Mauvais App Password Gmail
- Apache non redemarre apres modif `php.ini`

Logs utiles:

- `C:\xampp\sendmail\error.log`
- `C:\xampp\sendmail\debug.log`
- `C:\xampp\sendmail\php_mail.log`

---

## 10. Securite (important)

- Ne jamais exposer `secret_key` dans le frontend public
- Ne jamais commiter des cles reelles dans GitHub
- Regenerer immediatement toute cle exposee
- Mettre `display_errors=0` en production
- Forcer HTTPS en production

---

## 11. Verification rapide

### 11.1 Syntaxe PHP

```bash
php -l app/Controllers/ApiController.php
php -l app/Services/MailService.php
php -l app/Services/RateLimitService.php
```

### 11.2 Test endpoint minimal

```bash
curl -X POST "http://localhost/jdevmail/api/send-email" -H "Content-Type: application/json" -d "{}"
```

Doit retourner une erreur JSON structuree (`validation_error`).

---

## 12. Auteur

**Jonathan Dzoko Etambo**  
Ingenieur Informaticien - Full-Stack Developer
