<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use BlueM\Tree;
use Cache;
use App\Setting;
use Request;

class Rubric extends BaseModel
{
	protected $fillable = [
		'title',
		'text',
		'url',
		'page_description',
		'page_keywords',
		'parent',
		'description'
	];
	
	public $timestamps = false;

	/*
		Получает урл рубрики по её айдишнику
	*/
	public static function getURL($id)
	{
		$url  = Helper::secureRoute('catalog.index').'/';
		$data = Rubric::all()->toArray();
		$tree = new Tree($data);
		$node = $tree->getNodeById($id);
		$ancestors = $node->getAncestorsAndSelf();
		$ancestors = array_reverse($ancestors);
		foreach ($ancestors as $item) {
			if ($item->id !==0) {
				$url .= $item->url.'/';
			}
		}
		return $url;
	}

	/*
		Возвращает айдишник самого себя 
		и айдишники родительских разделов
	*/
	public static function getAncestorsIdsAndSelf($id)
	{
		$ids  = [];
		$data = Rubric::all()->toArray();
		$tree = new Tree($data);
		$node = $tree->getNodeById($id);
		$ancestors = $node->getAncestorsAndSelf();
		$ancestors = array_reverse($ancestors);
		foreach ($ancestors as $item) {
			if ($item->id !==0) {
				$ids[] = $item->id;
			}
			
		}
		return $ids;
	}

	/*
		Возращает навигационную цепочку по айдишнику
		рубрики
	*/
	public static function getNavigationCrumb($id)
	{
		$ancestors = Rubric::getAncestorsIdsAndSelf($id);
		$breadcrums = [];
		foreach ($ancestors as $rubricID) {
			$rubric = Rubric::find($rubricID);
			$breadcrums[] = (Object) [
				'text' => $rubric->title,
				'url'  => Rubric::getURL($rubricID)
			];
		}
		return (Object) $breadcrums;
	}

	/*
		Возращает всю структуру каталога
	*/
	public static function getAllNoded()
	{

		return Cache::rememberForever('rubrics', function () {		
			$data = Rubric::orderBy('sort', 'DESC')->get()->toArray();
			$tree = new Tree($data);
			$items = $tree->getNodes();
			$segments = Request::segments();

			$lastSegment =  Request::segment( count(Request::segments()) );
	
			foreach ($items as $item) {
				$item->selfUrl = $item->url;
				foreach ($segments as $segment) {

					if ($segment == $item->selfUrl) {
						$item->current = true;
					} else {
						$item->current = false;
					}
				}
				
				$item->url = Rubric::getURL($item->id);
				$item->picture = Setting::obtain('imagePath').$item->picture;
				


			}
			return $items;
		});

	}

	/*
		Возвращает корневые узлы каталога
	*/
	public static function getRootIds()
	{

		return Cache::rememberForever('rootIds', function () {		
			$ids = [];
			$data = Rubric::orderBy('sort', 'DESC')->get()->toArray();
			$tree = new Tree($data);
			$rootNodes = $tree->getRootNodes();	

			foreach ($rootNodes as $item) {
				$ids[] = $item->id;
			}
			return $ids;
		});	


	}

	public function scopeWithURL($query, $url)
	{
		return $query->where('url', $url);
	}

	public function scopeWithParent($query, $parent)
	{
		return $query->where('parent', $parent);
	}

	public static function bunch($ids)
	{
		return Cache::rememberForever('bunch'.implode($ids), function () use ($ids) {
			$currentRubrics = Rubric::orderBy('sort', 'DESC')->whereIn('id', $ids)->get();
			foreach ($currentRubrics as $item) {
				$item->url = Helper::secureRoute('catalog.index').'/'.$item->url;
				$item->picture = Setting::obtain('imagePath').$item->picture;
			}
			return $currentRubrics;
		});	
	}

	public function scopeVisible($query)
	{
		return $query->where('visible', 1);
	}

	public function scopeWithArticle($query, $id)
	{
		return $query->where('article', $id);
	}

	public static function firstInList()
	{

		return Cache::rememberForever('firstRubric', function () {		
			return Rubric::displayedOnIndexPage()->root()->min('id');
		});

		
	}

	public function scopeDisplayedOnIndexPage($query)
	{
		return $query->where('in_index', 1);
	}

	public function scopeRoot($query)
	{
		return $query->where('parent', 0);
	}

	public function scopeNotRoot($query)
	{
		return $query->where('parent', '!=', 0);
	}

	public static function withArticleExists($article)
	{
		return self::withArticle($article)->count();
	}

	
}