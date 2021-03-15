<?php

namespace App\Console\Commands;
use PDF;
use App\Models\User;
use App\Models\Billing;
use App\Models\Invoice;
use App\Mail\InvoiceMail;
use Illuminate\Mail\Mailable;
use Illuminate\Console\Command;
use App\Console\Commands\SendEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendemail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is use to send email to users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $date=date('y-m-d');
        $date1=date('Y-m-d H:i:s');


        // $billings = Billing::all();
        
        // get all distributors from users table
        $distributors = User::where('set_as', 0)->get();

        
        // loop through distributors
        foreach($distributors as $distributor)
        {
            // generate invoice pdf and save it somewhere in /storage

            $filename = '/invoices/' . time() . '-invoice-' . $distributor->id . '.pdf';
            
            PDF::loadView('users.bill-invoice',['data' => $distributor])->save(storage_path() . $filename);

            // storage/invoices/12232343233-invoice-123.pdf


            $invoice= new Invoice;
            $invoice->distributor_id=$distributor->id;
            $invoice->amount= $distributor->payment;
            $invoice->month= $date;
            $invoice->due_date=$date1;
            $invoice->has_paid=$date;
            $invoice->has_send=1;
            $invoice->pdf = $filename;

            $invoice->save();

            Mail::to($distributor->email)->send(new InvoiceMail($invoice));
            // return"Email Send Successfully!";
            // save data in invoices table along with pdf link

            // dispatch email to distributor along with invoice in attachment

        }   
    }


}