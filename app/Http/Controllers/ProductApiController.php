<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    function get($service_id, $ln, $page){
        $offset = ($page - 1) * $this->limit;

        $all = Product::where([
            'is_published' => 1,
            'service_id' => $service_id])
        ->offset($offset)->limit($this->limit)
        ->orderby('display_order')->get();

        $this->translate($all, $ln);
        $dtos = $this->toDto($all);

        foreach($all as $key => $i){
            $details = $i->productDetails()->where(['is_published' => 1])
            ->orderby('display_order')->get();
                   
            $this->translate($details, $ln);
            $dtos[$key]->product_details = $this->toDto($details);
        }
        
        $result = new Result();
        $result->products = $dtos;
        return $this->responseUtf8($result);
    }
}
