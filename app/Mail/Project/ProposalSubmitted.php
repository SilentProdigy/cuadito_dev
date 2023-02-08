<?php

namespace App\Mail\Project;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProposalSubmitted extends Mailable
{
    use Queueable, SerializesModels;
    public $proposal;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($proposal)
    {
        $this->proposal = $proposal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.projects.proposal_submitted');
    }
}
