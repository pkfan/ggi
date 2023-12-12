<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notify_User_About_Loan_Delay_From_Financial_Company extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($d)
    {
        $this->details=$d;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail From Financial Company (Recovery Process)')->view('mails.notify_user_about_loan_delay_from_financal_company')->from('test.bliynk@gmail.com');
    }
}
