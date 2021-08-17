<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class BaseModel extends Model
{
    function getLocalizedProperties($entity_name, $language_id){
        // like name, description ....
        $allProperties = LocalizedProperty::Where([
            "language_id" => $language_id,
            "entity_id" => $this->id,
            "local_key_group" => $entity_name,
            ])->get();

        foreach($allProperties as $props){
            $exists = $this->isExistProperty($props->local_key);
            if($exists){
                $this[$props->local_key] = $props->local_value;
            }
        }
    }


    function isExistProperty($name){   
        $properties = get_object_vars($this);
        foreach($properties["attributes"] as $key => $value){
            if($key == $name){
                return true;
            }
        }
        return false;
    }
}
