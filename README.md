curl -X POST "http://localhost/jdevmail/api/send-email" \\
  -H "Content-Type: application/json" \\
  -H "Accept: application/json" \\
  -d '{
    "site_id":"site_7a83b5661833ce88",
    "public_key":"jpk_6e1f6075144f84079b773a15604c822e",
    "secret_key":"jsk_3f47fde8a257b7990c6b2238c5e3826ffd862b03ffb7e51eb34b6c4756ce1d0a",
    "to":"jodzoko@gmail.com",
    "subject":"Test API",
    "html_content":"<p>Bonjour depuis cURL</p>"
  }'