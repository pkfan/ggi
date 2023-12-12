<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CallStatus;
use Illuminate\Support\Facades\Http;

class CallDuration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'call:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call status and duration';

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
        $callcount= CallStatus::where('status',null)->where('duration',null)->count();
        if($callcount!=0){
            $callstatus= CallStatus::where('status',null)->where('duration',null)->get();
            foreach($callstatus as $call){
                $response = Http::withHeaders([
                    'AppsId' => 'lmfuLlmvVEKcOCMyxF1A',
                    'Content-Type' => 'application/json'
                ])->get('https://voice.unifonic.com/v1/calls/'.$call->callId);
   
                if(isset($response['statusCode'])==False){
                    $call->duration=$response['duration'];
                    $call->statuss=$response['status'];
                    $call->save();
                }
    
            }
          

            
        }
        
    }
}
