<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Article;
use App\Http\Service\EmailService;
use App\Http\Service\UserService;
use App\Mail\Notification;

class SendArticleEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $friend_user;
    protected $user;
    public function __construct($friend_user, $user)
    {
        $this->friend_user = $friend_user;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        foreach ($this->friend_user as $value) {
            Mail::to($value->email)->send(new Notification($this->user));
        }
    }
}
