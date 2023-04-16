<?php

namespace App\Repositories;
use Setting;

class SettingRepository
{
    public function getSettingData($colum , $lang=null){
        if($lang != null){
            $data = Setting::get($colum.'_'.$lang);
        }else{
            $data = Setting::get($colum);
        }
        return $data;
    }
}
