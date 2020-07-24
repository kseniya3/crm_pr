<?php

namespace App\Jobs;

use App\Mail\Email;
use App\Models\Client;
use App\Models\Deal;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Auth;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpWord\TemplateProcessor;

class ClientDealJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $client;
    public $deal;
    private $emailUser;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($client, $deal, $emailUser)
    {
        $this->client = $client;
        $this->deal = $deal;
        $this->emailUser = $emailUser;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $clientDox = Client::findOrFail($this->client->id);
        $deals = $this->client->deals;
        $templateProcessor = new TemplateProcessor('public\word\user.docx');
        $fileName = $clientDox->second_name;
        $count = $deals->count();

        $replacements_cl = array(
            array('second_name' => $clientDox->second_name, 'first_name' => $clientDox->first_name,
                'middle_name' => $clientDox->middle_name, 'company_name' => $clientDox->company_name,
            ));

        foreach ($deals as $deal)
        {
            $deal_name = $deal->deal_name;
            $open_date = $deal->open_date;
            $close_date = $deal->close_date;
            $status = $deal->status;
            $manager = $deal->user->name;
            $dealARR[] = array('deal_name' => $deal_name, 'open_date' => $open_date,
                'close_date' => $close_date, 'status' => $status, 'manager' => $manager
            );
        }

        $templateProcessor->cloneBlock('block_client', 0, true, false, $replacements_cl);
        $templateProcessor->cloneBlock('block_deal', $count, true, false, $dealARR);

        $templateProcessor->saveAs('public/word/DealFile/'.$fileName.'.docx');

        Mail::to($this->emailUser)->send(new Email($this->client, $this->deal));

        unlink('public/word/DealFile/'.$fileName.'.docx');

        //return response()->download($fileName.'.docx')->deleteFileAfterSend(true);

        //Mail::to($this->client->contacts_email)->send(new Email($this->client, $this->deal));


        //$log = new Logger('LogJob');
        //$log->pushHandler(new StreamHandler('storage/logs/your.log', Logger::WARNING));
        //$log->warning("Создана новая сделка [{$this->clientDeal->id}]" );

    }
}
