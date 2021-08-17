<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\News;

class NewsApiController extends Controller
{
    function get($ln, $page){
        $offset = ($page - 1) * $this->limit;

        $all = News::where([
            'is_published' => 1
            ])
        ->orderby('id','desc')
        ->offset($offset)->limit($this->limit)
        ->get();

        foreach($all as $i){
            $i->images = json_decode($i->images);
        }

        $result = new Result();
        $this->translate($all, $ln);

        $result->news = $all;
        return $this->responseUtf8($result);
    }


}
