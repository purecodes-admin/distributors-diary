<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $invoice;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->invoice = $email;
    }
    
   
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd(storage_path());
        // dd($this->invoice->pdf);
        $this->invoice->load('distributor');
        return $this->view('users.testmail')->attach(storage_path() .'/app/public/'. $this->invoice->pdf);
       
    }
}
