<?php

namespace App\Services;

use Illuminate\Http\Request;
use Spatie\WebhookClient\Exceptions\InvalidConfig;
use Spatie\WebhookClient\SignatureValidator\SignatureValidator;
use Spatie\WebhookClient\WebhookConfig;

class GitHubSignatureValidator implements SignatureValidator
{
    public function isValid(Request $request, WebhookConfig $config): bool
    {
        $signature = $request->header($config->signatureHeaderName);

        if (! $signature) {
            return false;
        }

        $signingSecret = $config->signingSecret;

        if (empty($signingSecret)) {
            throw InvalidConfig::signingSecretNotSet();
        }

        // GitHub sends signature as 'sha256=...'
        $computedSignature = hash_hmac('sha256', $request->getContent(), $signingSecret);

        $expected = 'sha256='.$computedSignature;

        
        // Debugging logs
        \Log::info('GitHub Webhook Signature Check', [
            'header_name' => $config->signatureHeaderName,
            'received_signature' => $signature,
            'computed_signature' => $expected,
            'match' => hash_equals($expected, $signature),

        ]);

        return hash_equals($expected, $signature);
    }
}
