<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\ClaimRemark;
use Mail;
use Carbon\Carbon;
class RemainderMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remainder:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'remainder mails';

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
        

       

        $rem=ClaimRemark::where('remainder','<>','')->get();
        foreach($rem as $r){
               $current_date=Carbon::now()->toDateTimeString();
            // $t=time();
            // $date=date("Y-m-d",$t);
            if($current_date==$r->remainder){
                $user=User::where('id',$r->user_id)->first();
                $email=$user->email;
                Mail::to($email)->send(new \App\Mail\Remainder());
                if (Mail::failures()){

                }else{
                    $remainder=ClaimRemark::where('id',$r->id)->update(['remainder'=>'']);
                }
            }
           
        }
       
    

     
        return "done";
    }
}
