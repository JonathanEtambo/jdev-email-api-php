<?php
namespace App\Services;

class MailService {
    /**
     * Envoi d'un email HTML via la fonction native mail()
     */
    public function sendHtmlMail($to, $subject, $htmlContent, $textContent = '') {
        $to = trim((string) $to);
        $subject = trim((string) $subject);

        if ($to === '' || $subject === '' || preg_match('/[\r\n]/', $to . $subject)) {
            return [
                'success' => false,
                'error' => 'Invalid email headers.'
            ];
        }

        $fromEmail = MAIL_FROM_EMAIL;
        $fromName = MAIL_FROM_NAME;

        $boundary = md5((string) microtime(true));

        $headers = "From: {$fromName} <{$fromEmail}>\r\n";
        $headers .= "Reply-To: {$fromEmail}\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"{$boundary}\"\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";

        $message = "--{$boundary}\r\n";
        $message .= "Content-Type: text/plain; charset=\"UTF-8\"\r\n";
        $message .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
        $message .= ($textContent !== '' ? $textContent : strip_tags($htmlContent)) . "\r\n\r\n";

        $message .= "--{$boundary}\r\n";
        $message .= "Content-Type: text/html; charset=\"UTF-8\"\r\n";
        $message .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
        $message .= $htmlContent . "\r\n\r\n";
        $message .= "--{$boundary}--";

        try {
            $success = @mail($to, $subject, $message, $headers);
            return [
                'success' => $success,
                'error' => $success ? null : "The local mail server could not send the message."
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
