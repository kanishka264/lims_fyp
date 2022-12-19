<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMS extends Model
{
    use HasFactory;

    public function send($mobile, $msg)
    {
        $url = 'https://app.notify.lk/api/v1/send';
        $data = array('user_id' => '24107', 'api_key' => 'tHhrBUtxi9FKKoc9Rovd','message'=>$msg,'to'=>'94'.$mobile,'sender_id'=>'NotifyDEMO');
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
            )
        );

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $response = json_decode($result);
        return $response->status;

    }
}
