<?php

namespace App;

use App\Models\CustomerTypeDto;

class CustomerType extends BaseModel
{
    function getLocalizedProperty($language_id){
        $this->getLocalizedProperties(class_basename($this), $language_id);
    }


    function services(){
        return $this->hasMany(Service::class)
        ;
    }

    function toDto(){
        $dto = new CustomerTypeDto();
        $dto->id = $this->id;
        $dto->name = $this->name;
        $dto->image = $this->image;
        return $dto;
    }
}
