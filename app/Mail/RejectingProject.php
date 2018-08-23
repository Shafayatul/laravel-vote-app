<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RejectingProject extends Mailable
{
    use Queueable, SerializesModels;

    public $email_body;
    public $project_name;
    public $user_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_body, $project_name, $user_name)
    {
        $this->email_body = $email_body;
        $this->project_name = $project_name;
        $this->user_name = $user_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.rejecting-project');
    }
}
