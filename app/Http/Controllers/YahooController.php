<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Weidner\Goutte\GoutteFacade as Goutte;
use App\Services\Yahoo;

class YahooController extends Controller
{
	protected $yahoo;

	function __construct()
	{
		$this->yahoo = new Yahoo;
	}

	public function getYahooTv()
	{
		$programs = $this->yahoo->findYahooTv();

		return view('yahootv',  compact('programs'));
	}

	public function postYahooTv(Request $request)
	{
		$keyword = $request->keyword;
		$programs = $this->yahoo->findYahooTv($keyword);

		return view('yahootv',  compact('programs', 'keyword'));
	}
    //
}
