<?php

namespace App\Helpers\Classes;

use App\Models\Setting;
use Exception;
use Illuminate\Support\Collection;



class Settings{
    private Collection $settings;

    public function __construct(){
        // init $settings
        $this->settings = Setting::all();
    }

    public static function query(){
        return new self();
    }

    public function get(){
        return $this->settings;
    }

    public function set($name, $value){
        $isUpdated = Setting::where('name',$name)
            ->update([
                'value'=>$value
        ]);

        if($isUpdated){
            // get latest settings from database after update
            $this->settings = Setting::all();

            return true;
        }

        throw new \Exception('Errors during set value in settings table');
    }

    public function getLanguage(){
        try{
            $languages = $this->settings->firstWhere('name','languages')['value'];
            /* iterate over all languages and get active true
                'value'=>[
                    [
                        'language'=>'English',
                        'code'=>'en',
                        'direction'=>'ltr',
                        'is_active'=>false
                    ],
                    [
                        'language'=>'Arabic',
                        'code'=>'ar',
                        'direction'=>'rtl',
                        'is_active'=>true
                    ],
                    [
                        'language'=>'Urdu',
                        'code'=>'ur',
                        'direction'=>'rtl',
                        'is_active'=>false
                    ]
                ]
            */
            foreach ($languages as $language){
                if($language['is_active']){
                    return $language;
                }
            };
        }
        catch(Exception $e){
            /*
            return default language on exception
            because getLanuge() method is used in AppServiceProvider boot method
            which cause to stop whole application
            */
            return [
                'language'=>'English',
                'code'=>'en',
                'direction'=>'ltr',
                'is_active'=>false
            ];
        }

    }

    public function setLanguage($languageCode='en'){
        $languages = $this->settings->firstWhere('name','languages')['value'];
         /* value json field in database
            'value'=>[
                [
                    'language'=>'English',
                    'code'=>'en',
                    'direction'=>'ltr',
                    'is_active'=>false
                ],
                [
                    'language'=>'Arabic',
                    'code'=>'ar',
                    'direction'=>'rtl',
                    'is_active'=>true
                ],
                [
                    'language'=>'Urdu',
                    'code'=>'ur',
                    'direction'=>'rtl',
                    'is_active'=>false
                ]
            ]
        */
        // set all languages to (false boolean) first
        foreach ($languages as $key => $language){

            if($language['code'] == $languageCode){
                $language['is_active'] = true;
            }
            else{
                $language['is_active'] = false;
            }

            $languages[$key] = $language;
        };

        $isUpdated = Setting::where('name','languages')
            ->update([
                'value'=>$languages
            ]);

        if($isUpdated){
            // get latest settings from database after update
            $this->settings = Setting::all();

            // set config locale value
            config()->set('app.locale', $languageCode);

            return true;
        }

        throw new \Exception('Errors during set languages value in settings table');

    }
}
