<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ElmStatus;
class ElmSmsStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elm:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get elm status message send or not';

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
        $smscount= ElmStatus::where('id','>=','160')->where('iqama','')->orWhere('iqama',null)->count();
       
        if($smscount>0){
            $sms= ElmStatus::where('id','>=','160')->where('iqama','')->orWhere('iqama',null)->get();
            foreach($sms as $elm){
               
                
                $data=(object) 
                array (
                  'ClientId' => '7026274915',
                  'ClientAuthorization' => 'hMrMOv3e70EUI87/G/kVAo/PtmKljsS3/0mi+gpEoNM=',
                  'BatchNumber' => $elm->batch_no,
                
                );

                $wsdl           = 'https://api.absher.sa/AbsherSmsNotification?wsdl';
                $endpoint       = 'https://api.absher.sa/AbsherSmsNotification';
                $certificate    = './taheiya.pem';
                $password       = 'Abdullah123$';


                    $options = array(
                        'location'      => $endpoint,
                        'keep_alive'    => true,
                        'trace'         => true,
                        'local_cert'    => $certificate,
                        'passphrase'    => $password,
                        'cache_wsdl'    => WSDL_CACHE_NONE,
                        
                    );
                    try{
        
                        $soapClient = new \SoapClient($wsdl, $options);
                        $response1=$soapClient ->GetStatus($data);
                        $batchidentifier=$response1->StatusResult->BatchIdentifier;
                     
                        $data=(object) 
                            array (
                              'ClientId' => '7026274915',
                              'ClientAuthorization' => 'hMrMOv3e70EUI87/G/kVAo/PtmKljsS3/0mi+gpEoNM=',
                              'BatchIdentifier' => $batchidentifier,
                            
                        );



                            //$soapClient = new \SoapClient($wsdl, $options);
                             
                            $response2=$soapClient ->GetDetailedStatus($data);
                            $res=array($response2->StatusDetailResult->Recipients->Recipient->NationalOrIqamaId,
                            $response2->StatusDetailResult->Recipients->Recipient->StatusDescription);
                            // dd($elm->id,$response2->StatusDetailResult->Recipients->Recipient->StatusDescription,$response2->StatusDetailResult->Recipients->Recipient->NationalOrIqamaId);
                              $elm->iqama=$response2->StatusDetailResult->Recipients->Recipient->NationalOrIqamaId;
                              $elm->sms_description=$response2->StatusDetailResult->Recipients->Recipient->StatusDescription;
                              $elm->save();
                            }catch(\Exception $e){
                                 $elm->sms_description='System Error';
                                 $elm->save();
                            }

               
            }
           
        }
        return 0;
    }
}
