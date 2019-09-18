<?php
/**
 * Created by PhpStorm.
 * User: Md. Jakaria Talukder
 * Date: 15-Oct-18
 * Time: 11:30 AM
 */

namespace App\Channels;


use Illuminate\Notifications\Notification;

class SMS
{
    public function send($notifiable, Notification $notification){
        $message = $notification->toSMS($notifiable);
        $params['type'] = $message['type']?:'text';
        $params['msg'] = $message['msg'];
        $params['api_key'] = 'C20003905d0dae611d2f64.04632743';
        $params['senderid'] = '8801847169884';
        $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance(); //todo try to fix the the number formatting with min digit 10;
        try{
            $n = $phoneUtil->parse($notifiable->phone, "BD")->formatForPigeonSMS();
        }catch (\libphonenumber\NumberParseException $e) {
            logger()->error('Parsing number failed',['error' => true, 'message' => $e->getMessage().'('.$notifiable->phone.')'])  ;
        }
        $params['contacts'] = $n;
        $api_url = 'http://portal.pigeon-sms.pro/smsapi';
        $url = $api_url.'?'.http_build_query($params);
        $data = array(
            'Mobile Number' => $notifiable->phone,
            'Message' => $message,
            'URL' =>$url,
        );
        $client = new \GuzzleHttp\Client(['headers' => ['Accept' => 'application/json']]);
        $error = array(
            '1002' =>'Sender Id/Masking Not Found' ,
            '1003' => 'API Not Found' ,
            '1004' => 'SPAM Detected' ,
            '1005' => 'Internal Error' ,
            '1006' => 'Internal Error' ,
            '1007' => 'Balance Insufficient' ,
            '1008' => 'Message is empty',
            '1009' => 'Message Type Not Set (text/unicode)',
            '1010' => 'Invalid User & Password',
            '1011' => 'Invalid User Id',
        );

        try {
            $response = $client->get($url)->getBody()->getContents();
            $data['response'] = $response;
            logger($data['response']);

            if (array_key_exists($response, $error)){
                $data['error'] = $error[$response];
            }
        } catch (\Exception $e) {
            $data['error'] = $e->getMessage();
        }
        if (isset($data['error'])){
            logger('PigeonSMS', $data);
        }else{
            logger()->error('PigeonSMS', $data);
            return ['error' => false, 'message' => $url] ;
        }
    }
}