<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;

class News extends BaseModel
{
	protected $fillable = [
		'title',
		'text',
		'url',
		'page_description',
		'page_keywords',
		'cover',
		'description'
	];
	public $timestamps = false;
	protected $table = 'news';


	public function cover()
	{
		return $this->morphOne('App\Cover', 'coverable');
	}

	public function scopeVisible($query)
	{
		return $query->where('visible', 1);
	}

	public static function forMain()
	{
		return Cache::rememberForever('news', function () {		
			$news = News::visible()->get();
			foreach ($news as $item) {
				$item->date = date('d.m.Y', $item->date);
				$item->url  = route('news.index').'/'.$item->url;
			}
			return $news;
		});		

	}

}