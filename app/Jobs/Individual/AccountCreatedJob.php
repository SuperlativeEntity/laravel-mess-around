<?php

namespace App\Jobs\Individual;

use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Cartalyst\Sentinel\Users\EloquentUser;
use App\Individual;
use App\Mail\Individual\UserAccountCreatedMail;

class AccountCreatedJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $individual;

    public function __construct(EloquentUser $user,Individual $individual)
    {
        $this->user         = $user;
        $this->individual   = $individual;
    }

    public function handle()
    {
        Mail::to($this->user)->send(new UserAccountCreatedMail($this->individual));
    }
}
