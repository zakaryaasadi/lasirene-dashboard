<?php

namespace App;

use App\Models\ProductDto;

class Product extends BaseModel
{
    function getLocalizedProperty($language_id){
        $this->getLocalizedProperties(class_basename($this), $language_id);
    }


    function productDetails(){
        return $this->hasMany(ProductDetail::class);
    }
    
    function toDto(){
        $dto = new ProductDto();
        $dto->id = $this->id;
        $dto->name = $this->name;
        $dto->description = $this->description;
        $dto->from_time = $this->from_time;
        $dto->to_time = $this->to_time;
        $dto->from_price = $this->from_price;
        $dto->to_price = $this->to_price;
        $dto->rating = $this->rating;
        $dto->image = $this->image;
        $dto->offer = $this->offer;

        return $dto;
    }
}
