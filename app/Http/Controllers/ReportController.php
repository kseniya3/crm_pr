<?php

namespace App\Http\Controllers;

use App\Jobs\ClientDealJob;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpWord\TemplateProcessor;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $client = Client::find($id);

        return view('Report.index',
            ['client' => $client]
        );
    }

    public function generator($id)
    {
        $client = Client::findOrFail($id);
        $deals = $client->deals;

        $emailUser = auth()->user()->email;
        //dd($emailUser);

        ClientDealJob::dispatch($client, $deals, $emailUser)->delay(20);

        return redirect('/clients/show')->with(['success' => 'Отчет отправлен на почту']);

//        $client = Client::findOrFail($id);
//        $deals = $client->deals;
//        $templateProcessor = new TemplateProcessor('word/user.docx');
//        $fileName = $client->second_name;
//        $count = $deals->count();
//
//        $replacements_cl = array(
//            array('second_name' => $client->second_name, 'first_name' => $client->first_name,
//                'middle_name' => $client->middle_name, 'company_name' => $client->company_name,
//            ));
//
//        foreach ($deals as $deal)
//        {
//            $deal_name = $deal->deal_name;
//            $open_date = $deal->open_date;
//            $close_date = $deal->close_date;
//            $status = $deal->status;
//            $manager = $deal->user->name;
//            $dealARR[] = array('deal_name' => $deal_name, 'open_date' => $open_date,
//                'close_date' => $close_date, 'status' => $status, 'manager' => $manager
//            );
//        }
//
//        $templateProcessor->cloneBlock('block_client', 0, true, false, $replacements_cl);
//        $templateProcessor->cloneBlock('block_deal', $count, true, false, $dealARR);
//        $templateProcessor->saveAs($fileName.'.docx');

        //return response()->download($fileName.'.docx')->deleteFileAfterSend(true);
    }


}
