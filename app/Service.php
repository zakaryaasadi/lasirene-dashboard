<?php

namespace App;

use App\Models\SerivcesDto;

class Service extends BaseModel
{
    function getLocalizedProperty($language_id){
        $this->getLocalizedProperties(class_basename($this), $language_id);
    }

    function toDto(){
        $dto = new SerivcesDto();
        $dto->id = $this->id;
        $dto->name = $this->name;
        $dto->image = $this->image;
        return $dto;
    }
}
