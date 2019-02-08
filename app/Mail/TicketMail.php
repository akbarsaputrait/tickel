<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $from, $content, $status, $to, $link;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($from, $to, $status, $content, $link)
    {
        $this->from = $from;
        $this->content = $content;
        $this->status = $status;
        $this->to = $to;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.ticket');
    }
}
