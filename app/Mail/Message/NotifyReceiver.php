<?php

namespace App\Mail\Message;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Client;
use App\Models\Conversation;

class NotifyReceiver extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $recepient;
    public $conversation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( Client $sender, Client $recepient, Conversation $conversation )
    {
        $this->sender = $sender;
        $this->recepient = $recepient;
        $this->conversation = $conversation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.messages.new_message');
    }
}
