<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $limit = 20;

    function responseUtf8($data){
        return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
    }

    function translate($data, $language_id){
        foreach($data as $i ){
            $i->getLocalizedProperty($language_id);
        }    
    }

    function toDto($all){
        $data = [];
        foreach($all as $i){
            array_push($data, $i->toDto());
        }
        return $data;
    }
}
