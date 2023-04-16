<?php

namespace App\Services;

use App\Repositories\SettingRepository;
use Auth;

class SettingService
{
    protected $SettingRepository;
    public function __construct(SettingRepository $SettingRep)
    {
        $this->SettingRepository = $SettingRep;
    }

    public function getSettingData($colum , $lang=null){
        $data = $this->SettingRepository->getSettingData($colum , $lang);
        return $data;
    }
}
