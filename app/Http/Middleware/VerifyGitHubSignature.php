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

        $validatorClass = $config->signatureValidator;

        if (! class_exists($validatorClass)) {
            // Fallback generic exception if specific static method doesn't exist in older versions
            throw new \Exception("Invalid signature validator class: {$validatorClass}");
        }

        $validator = app($validatorClass);

        if (! $validator->isValid($request, $config)) {
            return response()->json(['message' => 'Invalid signature.'], 400);
        }

        return $next($request);
    }
}
