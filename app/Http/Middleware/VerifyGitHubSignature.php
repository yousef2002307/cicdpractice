<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\WebhookClient\Exceptions\InvalidConfig;
use Spatie\WebhookClient\WebhookConfigRepository;

class VerifyGitHubSignature
{
    public function handle(Request $request, Closure $next, string $configName = 'default')
    {
        $configRepository = app(WebhookConfigRepository::class);

        $config = $configRepository->getConfig($configName);

        if (is_null($config)) {
            throw InvalidConfig::couldNotFindConfig($configName);
        }

        $validator = $config->signatureValidator;

        if (! $validator->isValid($request, $config)) {
            return response()->json(['message' => 'Invalid signature.'], 400);
        }

        return $next($request);

    }
}
