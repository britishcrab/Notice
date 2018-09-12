<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Weidner\Goutte\GoutteFacade as Goutte;
use App\Events\ProductArrivalEvent;
use App\Services\AddressService;

class NoticeController extends Controller
{
	protected $address_service;

	function __construct()
	{
		$this->address_service = new AddressService;
	}
	/**
	 * lineの通知を外に出すテスト
	 **/
	public function test()
	{
		$address = new \App\Services\AddressService;
		$address = $address->findLine('yuya');

		/**
		 * omsに商品が入荷したら通知を送る
		 **/
//		$crawler = Goutte::request('GET', 'https://www.o-ms.hk/show.php/itemid/IA463/');
		$crawler = Goutte::request('GET', 'https://www.o-ms.hk/show.php/itemid/T035/');
		$is_arrival = $crawler->filter('div.cart_box');
		$url = $crawler->getUri();
		if ($is_arrival->count() == 0){
			echo "not exist!";
		}else{
            event(new ProductArrivalEvent($url));
			echo "exist!";
		}
	}

	public function getHome()
	{
		return view('main');
	}
    public function Line()
    {
		$url = 'https://notify-api.line.me/api/notify';
		/**
		 * 送信先のline選択
		 **/
		/* $token = $this->address_service->findLine('yuya'); */
		$token = $this->address_service->findLine('sayaka');

		$message = 'celexolが入荷しました';
		$data = array('message' => $message);
		$data = http_build_query($data);

		$header = array(
				'Content-Type: application/x-www-form-urlencoded',
				'Authorization: Bearer ' . $token,
				'Content-Length: ' .strlen($data),
		);

		$ch = curl_init($url);

		$options = array(
			CURLOPT_RETURNTRANSFER  => true,
			CURLOPT_POST            => true,
			CURLOPT_HTTPHEADER      => $header,
			CURLOPT_POSTFIELDS      => $data,
		);

		curl_setopt_array($ch, $options);

		$response =  curl_exec($ch);

		curl_close($ch);
    }
    //
}
