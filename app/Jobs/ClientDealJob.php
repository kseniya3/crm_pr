<?php

namespace App\Jobs;

use App\Mail\Email;
use App\Models\Deal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Illuminate\Support\Facades\Mail;

class ClientDealJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $client;
    public $deal;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($client, $deal)
    {
        $this->client = $client;
        $this->deal = $deal;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->client->contacts_email)->send(new Email($this->client, $this->deal));
        //$log = new Logger('LogJob');
        //$log->pushHandler(new StreamHandler('storage/logs/your.log', Logger::WARNING));
        //$log->warning("Создана новая сделка [{$this->clientDeal->id}]" );

    }
}
