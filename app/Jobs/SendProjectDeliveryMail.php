<?php

namespace App\Jobs;

use App\Mail\DefaultMail;
use App\Mail\ProjectDeliveryMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendProjectDeliveryMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      Mail::to('stur@iesebre.com')->send(new ProjectDeliveryMail('Projecte Tasks Gerard Rey!', 'Projecte llest!'));
    }
}
