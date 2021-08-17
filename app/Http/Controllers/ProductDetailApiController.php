<?php

namespace App\Http\Controllers;

use App\ProductDetail;

class ProductDetailApiController extends Controller
{
    function get($product_id, $ln, $page){
        $offset = ($page - 1) * $this->limit;
        
        $all = ProductDetail::where([
            'is_published' => 1,
            'product_id' => $product_id
            ])
        ->offset($offset)->limit($this->limit)
        ->orderby('display_order')->get();

        $this->translate($all, $ln);
        return $this->responseUtf8($all);
    }
}
