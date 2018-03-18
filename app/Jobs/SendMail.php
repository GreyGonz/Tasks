<?php

namespace App\Jobs;

use App\Mail\DefaultMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $emailto, $subject, $message;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($emailto, $subject, $message)
    {
      $this->emailto = $emailto;
      $this->subject = $subject;
      $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      Mail::to($this->emailto)->send(new DefaultMail($this->subject, $this->message));
    }
}
