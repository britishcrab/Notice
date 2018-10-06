<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
	public function youtube(Request $request)
	{
		$keyword = $this->getKeyword();
		$pagir = $this->getPagir();
		$videos = ApiService::youtube($keyword, $pagir);

		return view('google.youtube', compact('videos', 'keyword'));
	}
    //
}
