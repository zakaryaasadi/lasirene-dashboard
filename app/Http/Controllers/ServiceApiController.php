<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Service;
use Illuminate\Http\Request;

class ServiceApiController extends Controller
{

    function ladies($ln, $page){
        return $this->get(2, $ln, $page);
    }


    function gents($ln, $page){
        return $this->get(1, $ln, $page);
    }

    function get($customer_type_id, $ln, $page){
        $offset = ($page - 1) * $this->limit;

        $all = Service::where([
            'is_published' => 1,
            'customer_type_id' => $customer_type_id])
        ->offset($offset)->limit($this->limit)
        ->orderby('display_order')->get();

        $this->translate($all, $ln);
        $dtos = $this->toDto($all);

        $result =new Result();
        $result->services = $dtos;
        return $this->responseUtf8($result);
    }
}
