<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{

	static $replacements = [
			'"'      => "",
			"\\"     => "",
			"»"      => "",
			"«"      => "",
			"."      => "-",
			","      => "-",
			'&quot;' => "", 
			'/'      => '',
			'+'      => '',
			'—'      => '',
			'–'      => '',
			'&#39'   => '',
			" "      => '-',
			"-"      => "-",
			"!"      => "",
			"?"      => "",
			"("      => "-",
			")"      => "-",
			"№"      => '',
			":"      => '',
			"'"      => '',
			'%'      => '',
			'&'      => '-',
			'amp;'   => '-',
			'_'      => '-',
			'&nbsp;' => '-',
			' '      => '-',
			'&nbsp'  => '-',
			' '      => '-',
	];	

	public static function sanitizeURL($url)
	{
		return strtr($url, self::$replacements);
	}

	public static function russianMonth($date) 
	{
		$timestamp = strtotime($date);
		$month = date('n', $date);
		$russianMonths = [
			'',
			'январь',
			'февраль',
			'март',
			'апрел',
			'май',
			'июнь',
			'июль',
			'август',
			'сентябрь',
			'октябрь',
			'ноябрь',
			'декабрь'
		];
		return $russianMonths[$month];
	}

	public static function translit($string)
	{
  $translitTable = array(
  	
	"Г" => "G",
	"Ё"=>"YO",
	"Є"=>"E",
	"Ю"=>"YI",
	"Я"=>"I",
	"и"=>"i",
	"г"=>"g",
	"ё"=>"yo",
	"є"=>"e",
	"ї"=>"yi",
	"А"=>"A",
	"Б"=>"B",
	"В"=>"V",
	"Г"=>"G",
	"Д"=>"D",
	"Е"=>"E",
	"Ж"=>"ZH",
	"З"=>"Z",
	"И"=>"I",
	"Й"=>"Y",
	"К"=>"K",
	"Л"=>"L",
	"М"=>"M",
	"Н"=>"N",
	"О"=>"O",
	"П"=>"P",
	"Р"=>"R",
	"С"=>"S",
	"Т"=>"T",
	"У"=>"U",
	"Ф"=>"F",
	"Х"=>"H",
	"Ц"=>"TS",
	"Ч"=>"CH",
	"Ш"=>"SH",
	"Щ"=>"SCH",
	"Ъ"=>"",
	"Ы"=>"Y",
	"Ь"=>"",
	"Э"=>"E",
	"Ю"=>"YU",
	"Я"=>"YA",
	"а"=>"a",
	"б"=>"b",
	"в"=>"v",
	"г"=>"g",
	"д"=>"d",
	"е"=>"e",
	"ж"=>"zh",
	"з"=>"z",
	"и"=>"i",
	"й"=>"y",
	"к"=>"k",
	"л"=>"l",
	"м"=>"m",
	"н"=>"n",
	"о"=>"o",
	"п"=>"p",
	"р"=>"r",
	"с"=>"s",
	"т"=>"t",
	"у"=>"u",
	"ф"=>"f",
	"х"=>"h",
	"ц"=>"ts",
	"ч"=>"ch",
	"ш"=>"sh",
	"щ"=>"sch",
	"ъ"=>"", 
	"ы"=>"y",
	"ь"=>"",
	"э"=>"e",
	"ю"=>"yu",
	"я"=>"ya",
	);	

  $text=strtr($string, $translitTable);
        $text = mb_strtolower($text, 'utf-8');
        return $text;			
	}

	public static function translitAndSanitize($string)
	{
		$string = self::sanitizeURL($string);
		$string = self::translit($string);
		return $string ;
	}

	public static function contains($input, $substring)
	{
	    return mb_strpos($input, $substring) !== false;
	}

	public static function secureRoute($route)
	{
		$url = route($route);
		$parsed = parse_url($url);
		array_shift($parsed);
		return $parsed['path'];

	}



}