<?php

namespace App\Http\Controllers;

use App\Events\ProductArrivalEvent;
use Illuminate\Http\Request;
use Weidner\Goutte\GoutteFacade as Goutte;

class ArrivalNoticeController extends Controller
{
	public function index()
	{
		/**
		 * omsに商品が入荷したら通知を送る
		 **/
		$crawler = Goutte::request('GET', 'https://www.o-ms.hk/show.php/itemid/IA463/');
		// $crawler = Goutte::request('GET', 'https://www.o-ms.hk/show.php/itemid/T035/');
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
		return view('home');
	}
    //
}
