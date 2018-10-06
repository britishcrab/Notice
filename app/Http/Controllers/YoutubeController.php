<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;
use Illuminate\Support\Facades\Input;

class YoutubeController extends Controller
{
	public function youtube()
	{
		$videos = ApiService::youtube();
		$keyword = Input::get('keyword');

		return view('google.youtube', compact('videos', 'keyword'));
	}
}
