<?php

namespace App;

class News extends BaseModel
{
    function getLocalizedProperty($language_id){
        $this->getLocalizedProperties(class_basename($this), $language_id);
    }
    
    public function save(array $options = [])
    {
        parent::save($options);

       $title = "You have a new post to see in La Sirene";
       $body = $this['text'];
       $images = json_decode($this['images']);
       
       
       if(!is_null($body) && $this['is_published'] > 0){
           if(!empty($body)){
               if(!empty($images)){
                    $imageUrl = env('APP_URL') . '/storage/' . str_replace("\\","/",$images[0]); 
                    $this->sendNotification($title, $body, $imageUrl);
               }else{
                   $this->sendNotification($title, $body, "");
               }
           }
       }
    }

    public function sendNotification($title, $body, $image)
    {          
        $SERVER_API_KEY = env('SERVER_API_KEY');
  
        $data = [
            "to" => "/topics/all",
            "notification" => [
                "title" => $title,
                "body" => $body,
                "image" => $image  
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

}
