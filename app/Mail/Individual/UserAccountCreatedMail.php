<?php

namespace App\Mail\Individual;

use App\Individual;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserAccountCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $individual;

    public function __construct(Individual $individual)
    {
        $this->individual = $individual;
    }

    public function build()
    {
        return $this->from(config('system.admin_username'))->view('emails.individual.user_account_created')->with(['individual'=>$this->individual]);
    }
}
