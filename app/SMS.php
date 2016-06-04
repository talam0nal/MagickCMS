<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class SMS extends BaseModel
{
	
	public static function send($number, $text)
	{
		$ch = curl_init("http://sms.ru/sms/send");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POSTFIELDS, [
			"api_id" => Setting::obtain('smsApiID'),
			"to"     => $number,
			"text"   => $text
		]);
		$body = curl_exec($ch);
		curl_close($ch);
		Log::write('SMS', $body. ' to number '.$number.' with text '.$text);
	}

}