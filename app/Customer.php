<?php

namespace App;

use App\Models\Result;
use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
    function toDto(){
        $dto = new Result();
        $dto->id = $this->id;
        $dto->full_name = $this->full_name;
        $dto->email = $this->email;
        $dto->phone = $this->phone;
        $dto->gender = $this->gender;
        $dto->date_of_birth = $this->date_of_birth;
        return $dto;
    } 
}
