<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
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
        return $this->view('mails.emailClientDeals',
            ['client' => $this->client],
            ['deal' => $this->deal]
        )->attach("public/word/DealFile/{$this->client->second_name}.docx");
    }


}
