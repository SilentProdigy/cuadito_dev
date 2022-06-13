<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($template, $data = [])
    {
        $this->data = $data;
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from = isset($this->data['form']) ? $this->data['form'] : getenv('MAIL_FROM_ADDRESS');
        return $this->subject($this->data['subject'])
            ->from($from)
            ->markdown($this->template, $this->data);
    }
}
