<?php

namespace App\Services;

use Weidner\Goutte\GoutteFacade as Goutte;

class Yahoo
{
	public function findYahooTv($keyword = '大食い')
	{
		$keyword = $keyword;
		$crawler = Goutte::request('GET', 'https://tv.yahoo.co.jp/search/?q='.$keyword);
		$is_arrival = $crawler->filter('div.cart_box');
		$programs = $crawler->filter('div.mb15 ul.programlist li')->each(function($element){
			$tr['day'] =  $element->filter('div.leftarea')->text()."\n";
			$tr['title'] =  $element->filter('p.yjLS')->text()."\n";
			$tr['href'] =  $element->filter('p.yjLS a')->attr('href')."\n";
			$tr['content'] =  $element->filter('p.yjMS.pb5p')->eq(1)->text()."\n";
			return $tr;
		});

		return $programs;
	}
    //
}
