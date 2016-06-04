<?php

namespace App\Http\Controllers;

use App\Page;
use App\News;
use App\Http\Controllers\Controller;
use App\Helper;

class NewsController extends BaseController
{

	public function index()
	{
		$news = News::visible()->paginate(6);
		$page = Page::where('url', 'news')->firstOrFail();
		foreach ($news as $item) {
			$item->day = date('d', $item->date);
			$item->month = mb_substr(Helper::russianMonth($item->date), 0, 3);
			$item->url = route('news.index').'/'.$item->url;
		}
		return view('frontend.news.index', [
			'news' => $news,
			'page' => $page
		]);
	}

	public function show($url)
	{
		$page = News::where('url', $url)->firstOrFail();
		$page->day = date('d', $page->date);
		$page->month = mb_substr(Helper::russianMonth($page->date), 0, 3);
		return view('frontend.news.show', [
				'page' => $page
			]);
	}
}