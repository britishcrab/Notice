<?php

namespace App\Services;

use Weidner\Goutte\GoutteFacade as Goutte;
use Illuminate\Support\Facades\Input;
use GuzzleHttp\Client;
use App\Http\Controllers\YoutubeController as Youtube;

class ApiService
{
    public static function getContent($media)
    {
        switch ($media) {
            case 'youtube': return self::youtube();
        }
    }

	private static function youtube()
	{
		$client = new \Google_Client;
		$client->setApplicationName("Notice");
		$client->setDeveloperKey(config('const.GOOGLE_API_KEY'));
		
		$youtube = new \Google_Service_YouTube($client);

		$params = self::getParams();

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

	private static function getParams($content_type='video', $limit=50)
	{
	    $input = Input::all();
	    $params = [
	        'type' => $content_type,
            'maxResults' => $limit,
        ];
	    if(isset($input['channelId'])){array_push($params, ['channelId' => $input['channelId']]);}
        if(isset($input['pageToken'])){array_push($params, ['pageToken' => $input['pageToken']]);}
        if(isset($input['keyword'])){array_push($params, ['q' => $input['keyword']]);}

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
		$pagi_settiing = json_decode(file_get_contents(__DIR__.'/youtube_pagination.json'));

		if(empty($p)){
			return;
		}
		return $pagi_settiing->$p;
	}
}
