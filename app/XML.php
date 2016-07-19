<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Rubric;
use File;

/*
	Класс для работы с XML-файлами
*/
class XML extends BaseModel
{

	/*
		Возвращает массив с рубриками,
		полученных из XML
	*/
	public static function parseRubrics()
	{
		$rubrics = [];
		
		$xml = simplexml_load_file("xml.xml") or die();

		foreach ($xml as $key => $primeGroup) {

			$primeGroupID = (string) $primeGroup['kod'];

			$rubrics[$primeGroupID] = [
				'title'       => (string) $primeGroup['name'],
				'picture'     => (string) $primeGroup['pic1'],
				'article'     => $primeGroupID,
				'description' => (string) $primeGroup['descr'],
				'sort'        => (int) $primeGroup['sort'],
				'pricelist'   => (string) $primeGroup['pname'],
				'visible'     => (string) $primeGroup['disp'],
				'sat1'        => '',
				'sat2'        => '',
				'sat3'        => '',
			];

			foreach ($primeGroup->group as $key2 => $group) {
				$groupID = (string) $group['kod'];
				$rubrics[$primeGroupID]['groups'][$groupID] = [
					'title'   => (string) $group['name'],
					'article' => $groupID,
					'description'   => (string) $group['descr'],
					'sort'          => (int) $group['sort'],
					'pricelist'     => (string) $group['pname'],
					'visible'       => (string) $group['disp'],
					'sat1'          => (string) $group['sat1'],
					'sat2'          => (string) $group['sat2'],
					'sat3'          => (string) $group['sat3']
				];

				foreach ($group->subgroup as $key3 => $subgroup) {
					$rubrics[$primeGroupID]['groups'][$groupID]['subgroups'][] = [
						'title'       => (string) $subgroup['name'],
						'article'     => (string) $subgroup['kod'],
						'picture'     => (string) $subgroup['pic1'],
						'description' => (string) $subgroup['descr'],
						'sort'        => (string) $subgroup['sort'],  
						'pricelist'   => (string) $subgroup['pname'],
						'visible'     => (string) $subgroup['disp'],
						'sat1'        => '',
						'sat2'        => '',
						'sat3'        => '',
					];
				}
			}
		}

		return (array) $rubrics;
	}

	/*
		Обрабатывает массив, полученный из XML
		и сохраняет рубрики в базу
	*/
	public static function fillRubrics()
	{
		/*
			1. Проверяем по артикулу есть ли такая рубрика или нет
			2. Если нет, то сохраняем эту рубрику в базе
			3. Если есть, то апдейтим всё кроме урла, заголовка и сео-параметров
		*/
		$rubrics = self::parseRubrics();

		foreach ($rubrics as $key => $rubric) {

			$insertData = (Object) [
				'title'       => $rubric['title'],
				'article'     => $rubric['article'],
				'parent'      => 0,
				'url'         => Helper::translitAndSanitize($rubric['title']),
				'picture'     => $rubric['picture'],
				'description' => $rubric['description'],
				'sort'        => $rubric['sort'],
				'pricelist'   => $rubric['pricelist'],
				'sat1'        => $rubric['sat1'],
				'sat2'        => $rubric['sat2'],
				'sat3'        => $rubric['sat3']


			];

			if (!Rubric::withArticleExists($rubric['article'])) {
				$newRubricID = self::createRubric($insertData);
			} else {
				$newRubricID = 0;
				$existingID = Rubric::withArticle($rubric['article'])->first();
				$id = $existingID->id;
				self::updateRubric($id, $insertData);
			}
			

			foreach ($rubric['groups'] as $key => $group) {

				$groupData = (Object) [
					'title'       => $group['title'],
					'parent'      => $newRubricID,
					'url'         => Helper::translitAndSanitize($group['title']),
					'article'     => $group['article'],
					'picture'     => '',
					'description' => $group['description'],
					'sort'        => $group['sort'],
					'pricelist'   => $group['pricelist'],
					'sat1'        => $group['sat1'],
					'sat2'        => $group['sat2'],
					'sat3'        => $group['sat3'],
				];

				if (!Rubric::withArticleExists($group['article'])) {
					$newGroupID = self::createRubric($groupData);
				} else {
					$newGroupID = 0;
				}

				if (array_key_exists('subgroups', $group)) {
					foreach ($group['subgroups'] as $key => $subgroup) {
						$subGroupData = (Object) [
							'title'       => $subgroup['title'],
							'parent'      => $newGroupID,
							'url'         => Helper::translitAndSanitize($subgroup['title']),
							'article'     => $subgroup['article'],
							'picture'     => $subgroup['picture'],
							'description' => $subgroup['description'],
							'sort'        => $subgroup['sort'],
							'pricelist'   => $subgroup['pricelist'],
							'sat1'        => '',
							'sat2'        => '',
							'sat3'        => '',
						];

						if (!Rubric::withArticleExists($subgroup['article'])) {
							$newSubgroup = self::createRubric($subGroupData);
						}
					}
				}
			}
		}
	}

	/*
		Сохраняет рубрику в базу
		и возвращает её айдишник
	*/
	private static function createRubric($data)
	{
		$rubric = new Rubric;
		$rubric->title     = $data->title;
		$rubric->parent    = $data->parent;
		$rubric->url       = $data->url;
		$rubric->article   = $data->article;
		$rubric->picture   = $data->picture;
		$rubric->text      = $data->description;
		$rubric->sort      = $data->sort;
		$rubric->pricelist = $data->pricelist;
		$rubric->sat1      = $data->sat1;
		$rubric->sat2      = $data->sat2;
		$rubric->sat3      = $data->sat3;
		$rubric->save();
		return (int) $rubric->id;
	}

	/*
		Обновляет рубрику в базе
	*/
	private static function updateRubric($id, $data)
	{
		$rubric = Rubric::find($id);
		$rubric->picture = $data->picture;
		$rubric->save();
	}

	/*
		Парсит товары из XML
	*/
	public static function parseGoods()
	{
		$goods = [];
		$contents = File::get('xml.xml');
		$simple = $contents;
		$p = xml_parser_create();
		xml_parse_into_struct($p, $simple, $vals, $index);
		xml_parser_free($p);
		$k = 0;
		foreach ($vals as $key => $item) {
			if ($item['tag'] == 'ITEM') {
				$k++;
				$article = (string) $item["attributes"]["SUBGROUP"];
				$rubric  = XML::groupByArticle($article);

				$picture = '';
				$picture2 = '';
				$picture3 = '';

				$related1 = '';
				$related2 = '';
				$related3 = '';

				if (array_key_exists('PIC1', $item["attributes"])) {
					$picture = $item["attributes"]["PIC1"];
				}

				if (array_key_exists('PIC2', $item["attributes"])) {
					$picture2 = $item["attributes"]["PIC2"];
				}

				if (array_key_exists('PIC3', $item["attributes"])) {
					$picture3 = $item["attributes"]["PIC3"];
				}

				if (array_key_exists('SAT1', $item["attributes"])) {
					$related1 = $item["attributes"]["SAT1"];
				}

				if (array_key_exists('SAT2', $item["attributes"])) {
					$related2 = $item["attributes"]["SAT2"];
				}

				if (array_key_exists('SAT3', $item["attributes"])) {
					$related3 = $item["attributes"]["SAT3"];
				}

				$data = [
					'title'       => $item["attributes"]["NAME"],
					'rubric'      => $rubric,
					'text'        => $item["attributes"]["DESCR"],
					'price'       => $item["attributes"]["COST"],
					'whcost'      => $item["attributes"]["WHCOST"],
					'dealer1'     => $item["attributes"]["DEALER1"],
					'dealer2'     => $item["attributes"]["DEALER2"],
					'article'     => (string) $item["attributes"]["KOD"],
					'url'         => Helper::translitAndSanitize($item["attributes"]["NAME"]),
					'picture'     => $picture,
					'picture2'    => $picture2,
					'picture3'    => $picture3,
					'sort'        => (string) $item["attributes"]["SORT"],
					'length'      => (string) $item["attributes"]["V"],
					'width'       => (string) $item["attributes"]["S"],
					'depth'       => (string) $item["attributes"]["G"],
					'weight'      => (string) $item["attributes"]["MASSA"],
					'hotprice'    => (string) $item["attributes"]["HOTPRICE"],
					'hotpic'      => (string) $item["attributes"]["HOTPIC"],
					'hottext'     => (string) $item["attributes"]["HOTTEXT"],
					'remains_msk' => (string) $item["attributes"]["STOCKMSK"],
					'remains_klg' => (string) $item["attributes"]["STOCKKLG"],
					'related1'    => (string) $related1,
					'related2'    => (string) $related2,
					'related3'    => (string) $related3,
					'visible'     => (string) $item["attributes"]["DISP"],
				];


				if ($rubric && !Good::withArticleExists($item["attributes"]["KOD"])) {
					XML::saveGood($data);
				} else {
					self::updateGood($data);
				}

			}
		}
		return (array) $goods;
	} 

	/*
		Сохраняет товар в базу и возращает его айдишник
	*/
	public static function saveGood($data)
	{
		$item = Good::create($data);
		return $item->id;
	}

	/*
		Обновляет товар
	*/
	private static function updateGood($data)
	{
		$itemID = Good::withArticle($data->article)->first();
		if (is_object($itemID)) {
			$item = Good::find($itemID->id);
			$item->price   = $data->price;
			$item->picture = $data->picture;
			$item->text    = $data->text;
			$item->whcost  = $data->whcost;
			$item->dealer1 = $data->dealer1;
			$item->dealer2 = $data->dealer2;
			$item->save();			
		}

	}

	/*
		Возвращет айдишник рубрики по её артикулу
	*/
	public static function groupByArticle($article)
	{
		$rubric = Rubric::withArticle($article)->first();
		if (is_object($rubric)) {
			return $rubric->id;
		} 
		return false;
	}



}