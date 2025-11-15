<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $subjectLine;
    public string $body;
    public bool $isHtml;

    /**
     * Create a new message instance.
     */
    public function __construct(string $subjectLine, string $body, bool $isHtml = false)
    {
        $this->subjectLine = $subjectLine;
        $this->body = $body;
        $this->isHtml = $isHtml;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        // Set subject here for broad compatibility across Laravel versions
        $this->subject($this->subjectLine);

        return $this->view('emails.email-template')
            ->with([
                'body' => $this->body,
                'isHtml' => $this->isHtml,
            ]);
    }

    /**
     * Static helper method to send an email with full control over settings.
     * Returns array with status, to, subject, etc.
     */
    public static function l_mail(
        $to,
        $subject,
        $body,
        $isHtml = false,
        $cc = [],
        $bcc = [],
        $from = null,
        $fromName = null,
        $replyTo = null,
        $mailer = null,
        $attachments = [] // Accept array of paths or associative arrays
    )
    {
        try {
            // Basic email validation
            if (! $to || ! filter_var($to, FILTER_VALIDATE_EMAIL)) {
                return [
                    'status' => 'error',
                    'message' => "Invalid 'to' email address: {$to}",
                ];
            }

            // Prepare mailable
            $mailable = (new LMail($subject, $body, $isHtml));
            if ($from && filter_var($from, FILTER_VALIDATE_EMAIL)) {
                $mailable->from($from, $fromName ?: config('app.name'));
            }
            if ($replyTo && filter_var($replyTo, FILTER_VALIDATE_EMAIL)) {
                $mailable->replyTo($replyTo);
            }

            // Build the Mailer pipeline
            $mailerBuilder = $mailer ? \Illuminate\Support\Facades\Mail::mailer($mailer) : \Illuminate\Support\Facades\Mail::mailer(config('mail.default'));
            $mail = $mailerBuilder->to($to);
            if (!empty($cc)) {
                $validCc = array_values(array_filter($cc, fn($e) => filter_var($e, FILTER_VALIDATE_EMAIL)));
                if ($validCc) { $mail->cc($validCc); }
            }
            if (!empty($bcc)) {
                $validBcc = array_values(array_filter($bcc, fn($e) => filter_var($e, FILTER_VALIDATE_EMAIL)));
                if ($validBcc) { $mail->bcc($validBcc); }
            }

            // Attach files if provided
            $attachedFiles = [];
            foreach ($attachments as $attachment) {
                // Allow string path or array with path,name,mime
                if (is_string($attachment)) {
                    $path = $attachment;
                    if (is_file($path)) {
                        $mail->attach($path);
                        $attachedFiles[] = basename($path);
                    }
                    continue;
                }
                if (is_array($attachment)) {
                    $path = $attachment['path'] ?? null;
                    if ($path && is_file($path)) {
                        $options = [];
                        if (!empty($attachment['name'])) {
                            $options['as'] = $attachment['name'];
                        }
                        if (!empty($attachment['mime'])) {
                            $options['mime'] = $attachment['mime'];
                        }
                        $mail->attach($path, $options);
                        $attachedFiles[] = $options['as'] ?? basename($path);
                    }
                }
            }

            $mail->send($mailable);

            return [
                'status' => 'sent',
                'to' => $to,
                'subject' => $subject,
                'mailer' => $mailer ?: config('mail.default'),
                'from' => $from ?: config('mail.from.address'),
                'cc' => $cc,
                'bcc' => $bcc,
                'html' => $isHtml,
                'attachments' => $attachedFiles,
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Failed to send test email',
                'error' => $e->getMessage(),
            ];
        }
    }
}
