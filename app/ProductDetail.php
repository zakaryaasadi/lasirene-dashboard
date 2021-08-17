<?php

namespace App;

use App\Models\ProductDetailDto;

class ProductDetail extends BaseModel
{
    function getLocalizedProperty($language_id){
        $this->getLocalizedProperties(class_basename($this), $language_id);
    }

    function toDto(){
        $dto = new ProductDetailDto();
        $dto->id = $this->id;
        $dto->name = $this->name;
        $dto->from_time = $this->from_time;
        $dto->to_time = $this->to_time;
        $dto->from_price = $this->from_price;
        $dto->to_price = $this->to_price;

        return $dto;
    }
}
