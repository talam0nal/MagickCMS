<?php

namespace App\Http\Controllers;

use App\Page;
use App\Rubric;
use App\Good;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Cart;
use Request;

class ProductsController extends BaseController
{

	/*
		Индексная страница каталога
	*/
	public function index()
	{
		$rootRubrics = Rubric::getRootIds();

		return view('frontend.catalog.catalog', [
			'page'           => Page::catalog(),
			'rubrics'        => Rubric::getAllNoded(),
			'currentRubrics' => Rubric::bunch($rootRubrics),
			'breadcrumbs'    => [],
		]); 
	}

	/*
		Категория каталога
	*/
	public function category($category)
	{

		$page = Rubric::withURL($category)->firstOrFail();

		$currentRubrics = Rubric::withParent($page->id)->get();
	
		foreach ($currentRubrics as $item) {
			$item->url = Rubric::getURL($item->id);
		}

		#Находим всех детей этой рубрики сортируем их по полю сорт и редиректим на нужный
		$firstChild = Rubric::where('parent', $page->id)->orderBy('sort', 'desc')->take(1)->get();
		foreach ($firstChild as $key => $child) {
			return redirect('/catalog/'.$category.'/'.$child->url);
		}

		$rubrics = Rubric::getAllNoded();
		return view('frontend.catalog.index', [
			'page'           => $page,
			'rubrics'        => $rubrics,
			'currentRubrics' => $currentRubrics,
			'breadcrumbs'    => Rubric::getNavigationCrumb($page->id),
		]);
	}


	/*
		Третий уровень вложенности каталога
	*/
	public function sCategory($category, $sCategory)
	{
		$page = Rubric::withURL($sCategory)->firstOrFail();
		$currentRubrics = Rubric::withParent($page->id)->get();

		foreach ($currentRubrics as $item) {
			$item->url = Rubric::getURL($item->id);
			$item->picture = Setting::obtain('imagePath').$item->picture;
			$item->goods = Good::rubric($item->id)->get();
			foreach ($item->goods as $good) {
				$good->url = Rubric::getURL($good->rubric).$good->url;
				$good->picture = Setting::obtain('imagePath').$good->picture;
			}
		}
			
		$rubrics = Rubric::getAllNoded();


		return view('frontend.catalog.index', [
			'page'           => $page,
			'rubrics'        => $rubrics,
			'currentRubrics' => $currentRubrics,
			'breadcrumbs'    => Rubric::getNavigationCrumb($page->id),
		]);
	}

	/*
		Подкатегория каталога. Со списком продуктов
	*/
	public function subCategory($category, $sCategory, $subcategory)
	{
		$page = Rubric::withURL($subcategory)->firstOrFail();
		$products = Good::rubric($page->id)->orderBy('sort', 'desc')->visible()->get();
		$breadcrumbs = Rubric::getNavigationCrumb($page->id);
		foreach ($products as $item) {
			$item->description = nl2br($item->description);
			$item->url = Rubric::getURL($item->rubric).$item->url;
			$item->picture = Setting::obtain('imagePath').$item->picture;
			$item->in_basket = Cart::inBasket($item->id) ? 1 : 0;
		}
		return view('frontend.catalog.list', [
			'page'           => $page,
			'rubrics'        => Rubric::getAllNoded(),
			'products'       => $products,
			'breadcrumbs'    => $breadcrumbs,
		]);
	}

	/*
		Страница продукта
	*/
	public function show($category, $sCategory, $subcategory, $itemURL)
	{
		$page            = Good::withURL($itemURL)->firstOrFail();
		$page->url       = Rubric::getURL($page->rubric).$page->url;
		$page->picture   = $page->picture!=='' ? Setting::obtain('imagePath').$page->picture : null;
		if (!$page->picture) {
			$rubric = Rubric::find($page->rubric);
			$page->picture = Setting::obtain('imagePath').$rubric->picture;
		}
		$page->in_basket = CartController::inBasket($page->id) ? 1 : 0 ;

			if ($page->picture2!=='') {
				$page->picture2 = Setting::obtain('imagePath').$page->picture2;
			} else {
				$page->picture2 = false;
			}

			if ($page->picture3!=='') {
				$page->picture3 = Setting::obtain('imagePath').$page->picture3;
			} else {
				$page->picture3 = false;
			}

		$breadcrumbs = Rubric::getNavigationCrumb($page->rubric);

		return view('frontend.catalog.item', [
				'page'            => $page,
				'breadcrumbs'     => $breadcrumbs,
				'similarProducts' => $this->getSimilarGoods($page->rubric),
			]);
	}

	private function getSimilarGoods($rubric)
	{
		$similarProducts = Good::rubric($rubric)->visible()->take(4)->get();
		foreach ($similarProducts as $key => $item) {
			$item->url = Rubric::getURL($item->rubric).$item->url;

			if ($item->picture!=='') {
				$item->picture = Setting::obtain('imagePath').$item->picture;
			} else {
				$item->picture = false;
			}



			if (CartController::inBasket($item->id)) {
				$item->in_basket = 1;
			} else {
				$item->in_basket = 0;
			}
		}
		return $similarProducts;
	}

}