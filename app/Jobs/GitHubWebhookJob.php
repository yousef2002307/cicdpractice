<?php

namespace App\Jobs;



use Spatie\WebhookClient\Jobs\ProcessWebhookJob;

class GitHubWebhookJob extends ProcessWebhookJob
{

    /**
     * Execute the job.
     */
  public function handle()
{
    $payload = $this->webhookCall->payload;
    
    // GitHub بتبعت نوع الحدث في الـ Header مش في جسم الـ Payload
    $eventType = $this->webhookCall->headers->get('X-GitHub-Event'); 

    switch ($eventType) {
        case 'push':
            // حدث الـ Push:
            // ممكن هنا تعمل: php artisan deploy:run
            $pusher = $payload['pusher']['name'] ?? 'Unknown User';
            $branch = $payload['ref'];
            \Log::info("New code pushed by {$pusher} to {$branch}. Starting deployment...");
            break;
            
        case 'pull_request':
            // حدث الـ Pull Request:
            $action = $payload['action'];
            $prTitle = $payload['pull_request']['title'];
            \Log::info("Pull Request event: {$prTitle} was {$action}.");
            break;
            
        // ... أي Events تانية زي issues أو release
    }
    
    // ملاحظة: الـ Job ده بيشتغل في الـ Queue. لازم تشغل php artisan queue:work
}

}
