<?php

namespace App\Http\Controllers;

use App\Customer;

class CustomerApiController extends Controller
{
    function login($email, $password){
        $customer = Customer::where([
            'email' => $email,
            'password' => $password
        ])->first();

        return $customer ? $customer->toDto() : 'null';
    }


    function change($id, $email, $password, $full_name, $phone){
        $customer = Customer::find($id);
        if(!$customer){
            return 'null';
        }

        if($email != 'null'){
            $customer->email = $email;
        }

        if($password != 'null'){
            $customer->password = $password;
        }

        if($full_name != 'null'){
            $customer->full_name = $full_name;
        }

        if($phone != 'null'){
            $customer->phone = $phone;
        }

        $customer->save();
        return $customer;;
    }


    function signup($full_name, $email, $password, $phone, $gender, $date_of_birth){
        $customer = new Customer();
        $customer->full_name = $full_name;
        $customer->email = $email;
        $customer->password = $password;
        $customer->phone = $phone;
        $customer->gender = (int)$gender;

        $time = strtotime($date_of_birth);

        $newformat = date('Y-m-d',$time);

        $customer->date_of_birth = $newformat;
        $customer->save();
        return $customer;
    }
}
