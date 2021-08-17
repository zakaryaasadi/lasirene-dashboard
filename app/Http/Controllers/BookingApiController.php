<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Customer;
use App\Product;
use App\Service;
use App\BookingDetail;
use App\Models\Result;
use App\ProductDetail;
use Illuminate\Http\Request;

class BookingApiController extends Controller
{
    function add(Request $request){
        $b = new Booking();
        $b->customer_id = $request->customer_id;
        $b->location = $request->location;
        $b->date = $request->date;
        $b->save();
        
        
        foreach($request->details as $i){
            $d = new BookingDetail();
            $d->booking_id = $b->id;
            $d->service_id = $i["service_id"];
            $d->product_id = $i["product_id"];
            $d->product_detail_id = $i["product_detail_id"];
            $d->save();
        }
        
        
        $customer = Customer::find($b->customer_id);
        
        $this->sendNotification('Booking Now!', 'The client '. $customer["full_name"] .' made a booking in '. $b->location .' on ' . $b->date);
        
       // $this->sendNotification('Booking Now!', 'The client ');
        
        return $this->responseUtf8($request);
    }
    
    
    
    public function sendNotification($title, $body)
    {
          
        $SERVER_API_KEY = 'AAAAERf3MGw:APA91bGghalwAiRM72sJ6ZmrKEFKHCRCBeHD4sciFEdk3cwBsyB5-Ejz-Td0BVkbUZcgzHeaoSXNNFX37S180nDL58ZirElGj11Bh6A9LA8qwAYwXdcbR6Ep7ImxbNZIVVwPszk9sQdV';
  
        $data = [
            "to" => "/topics/booking",
            "notification" => [
                "title" => $title,
                "body" => $body,  
            ]
        ];
        $dataString = json_encode($data);
    
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
               
        $response = curl_exec($ch);
  
    }
    
    
        function get($customer_id, $page){

        $offset = ($page - 1) * $this->limit;

        $all = Booking::Where(["customer_id" => $customer_id])
        ->offset($offset)->limit($this->limit)
        ->orderby('created_at', 'desc')->get();

        foreach($all as $booking){
            $details = BookingDetail::where([
                'booking_id' => $booking->id])->get();
            $results = [];
            foreach($details as $d){
                $i = new Result();
                $i->service_name = Service::find($d->service_id)["name"];
                $i->product_name = Product::find($d->product_id)["name"];

                $product_detail = ProductDetail::find($d->product_detail_id);

                $i->product_detail_name = $product_detail["name"];
                 $i->from_price = $product_detail['from_price'];
                $i->to_price = $product_detail['to_price'];
                $i->offer = Product::find($d->product_id)['offer'];

                array_push($results, $i);
            }
            $booking->details = $results;
        }
                
        $r = new Result();
        $r->bookings = $all;
        
        return $this->responseUtf8($r);
    }


}
