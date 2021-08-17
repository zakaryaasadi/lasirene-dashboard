<?php

namespace App\Http\Controllers;

use App\CustomerType;

class CustomerTypeApiController extends Controller
{
    function get($ln){
        $all = CustomerType::where([
            'is_published' => 1
            ])
        ->orderby('display_order')->get();

        
        $this->translate($all, $ln);
        $dtos = $this->toDto($all);

        foreach($all as $key => $i){
            $services = $i->services()->where(['is_published' => 1])
            ->orderby('display_order')->get();
                   
            $this->translate($services, $ln);
            $dtos[$key]->services = $this->toDto($services);
        }
        
        return $this->responseUtf8($dtos);
    }
}
