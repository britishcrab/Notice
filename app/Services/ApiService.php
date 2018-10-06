<?php

namespace App\Services;

use Weidner\Goutte\GoutteFacade as Goutte;
use Illuminate\Support\Facades\Input;
use GuzzleHttp\Client;
use App\Http\Controllers\YoutubeController as Youtube;

class ApiService
{
	public static function youtube()
	{
		$client = new \Google_Client;
		$client->setApplicationName("Notice");
		$client->setDeveloperKey(config('const.GOOGLE_API_KEY'));
		
		$youtube = new \Google_Service_YouTube($client);

		$params = self::setParams();

		$videos = [];
		try {
			$searchResponse = $youtube->search->listSearch('snippet', $params);
			array_map(function ($searchResult) use (&$videos) {
				$videos[] = $searchResult;
			},$searchResponse['items']);
		} catch (Google_Service_Exception $e) {
			echo htmlspecialchars($e->getMessage());
			exit;
		} catch (Google_Exception $e) {
			echo htmlspecialchars($e->getMessage());
			exit;
		}

		$videos['p'] = Input::get('p')?:1;

		return $videos;
	}

	public static function setParams()
	{
		if(Input::get('channelId')){
			$params = self::setChannelParams();
		}else{
			$params = self::setKeywordParams();
		}
		return $params;
	}

	public static function setKeywordParams()
	{
		if(Input::get('channelId')){
			$params = self::setChannelParams();
		}else{
			$q = Input::get('keyword'); 
			$pagir = self::page(Input::get('p'));
			$type = 'video';
			$limit = 50;

			$params = [];
			if(Input::get()){
				$params = [
					'q' => $q,
					'pageToken' => $pagir,
					'type' => $type,
					'maxResults' => $limit,
				];
			}
		}
		return $params;
	}

	public static function setChannelParams()
	{
		$channelId = Input::get('channelId'); 
		$pagir = self::page(Input::get('p'));
		$type = 'video';
		$limit = 10;

		$params = [];
		if(Input::get()){
			$params = [
				'channelId' => $q,
				'pageToken' => $pagir,
				'type' => $type,
				'maxResults' => $limit,
			];
		}
		return $params;
	}

	private static function page($p)
	{
		if(empty($p)){
			return;
		}
		$p-1;
		$page = array(
			0 => 'CAUQAA',
			1 => 'CA8QAA',
			2 => 'CBkQAA',
			3 => 'CCMQAA',
			4 => 'CC0QAA',
			5 => 'CDcQAA',
			6 => 'CEEQAA',
			7 => 'CEsQAA',
			8 => 'CFUQAA',
			9 => 'CF8QAA',
			10 => 'CGkQAA',
			11 => 'CHMQAA',
			12 => 'CH0QAA',
			13 => 'CIcBEAA',
			14 => 'CJEBEAA',
			15 => 'CJsBEAA',
			16 => 'CKUBEAA',
			17 => 'CK8BEAA',
			18 => 'CLkBEAA',
			19 => 'CMMBEAA',
			20 => 'CM0BEAA',
			21 => 'CNcBEAA',
			22 => 'COEBEAA',
			23 => 'COsBEAA',
			24 => 'CPUBEAA',
			25 => 'CP8BEAA',
			26 => 'CIkCEAA',
			27 => 'CJMCEAA',
			28 => 'CJ0CEAA',
			29 => 'CKcCEAA',
			30 => 'CLECEAA',
			31 => 'CLsCEAA',
			32 => 'CMUCEAA',
			33 => 'CM8CEAA',
			34 => 'CNkCEAA',
			35 => 'COMCEAA',
			36 => 'CO0CEAA',
			37 => 'CPcCEAA',
			38 => 'CIEDEAA',
			39 => 'CIsDEAA',
			40 => 'CJUDEAA',
			41 => 'CJ8DEAA',
			42 => 'CKkDEAA',
			43 => 'CLMDEAA',
			44 => 'CL0DEAA',
			45 => 'CMcDEAA',
			46 => 'CNEDEAA',
			47 => 'CNsDEAA',
			48 => 'COUDEAA',
			49 => 'CO8DEAA',
			50 => 'CPkDEAA',
			51 => 'CIMEEAA',
			52 => 'CI0EEAA',
			53 => 'CJcEEAA',
			54 => 'CKEEEAA',
			55 => 'CKsEEAA',
			56 => 'CLUEEAA',
			57 => 'CL8EEAA',
			58 => 'CMkEEAA',
			59 => 'CNMEEAA',
			60 => 'CN0EEAA',
			61 => 'COcEEAA',
			62 => 'CPEEEAA',
			63 => 'CPsEEAA',
			64 => 'CIUFEAA',
			65 => 'CI8FEAA',
			66 => 'CJkFEAA',
			67 => 'CKMFEAA',
			68 => 'CK0FEAA',
			69 => 'CLcFEAA',
			70 => 'CMEFEAA',
			71 => 'CMsFEAA',
			72 => 'CNUFEAA',
			73 => 'CN8FEAA',
			74 => 'COkFEAA',
			75 => 'CPMFEAA',
			76 => 'CP0FEAA',
			77 => 'CIcGEAA',
			78 => 'CJEGEAA',
			79 => 'CJsGEAA',
			80 => 'CKUGEAA',
			81 => 'CK8GEAA',
			82 => 'CLkGEAA',
			83 => 'CMMGEAA',
			84 => 'CM0GEAA',
			85 => 'CNcGEAA',
			86 => 'COEGEAA',
			87 => 'COsGEAA',
			88 => 'CPUGEAA',
			89 => 'CP8GEAA',
			90 => 'CIkHEAA',
			91 => 'CJMHEAA',
			92 => 'CJ0HEAA',
			93 => 'CKcHEAA',
			94 => 'CLEHEAA',
			95 => 'CLsHEAA',
			96 => 'CMUHEAA',
			97 => 'CM8HEAA',
			98 => 'CNkHEAA',
		);
		return $page[$p];
	}
}