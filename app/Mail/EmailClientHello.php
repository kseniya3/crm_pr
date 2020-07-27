<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailClientHello extends Mailable
{
    use Queueable, SerializesModels;

    public $client;
    public $deal;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($client, $deal)
    {
        $this->client = $client;
        $this->deal = $deal;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.emailClientHello',
            ['client' => $this->client],
            ['deal' => $this->deal]
        );
    }


}
