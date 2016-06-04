<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Manager extends BaseModel
{

	protected $fillable = [
		'email',
		'link',
		'name',
	];

	/*
		Выбирает из базы менеджера в очереди
	*/
	public function scopeQueued($query)
	{
		return $query->where('queue', 1);
	}

	/*
		Выбирает менеджера по емаилу
	*/
	public function scopeMail($query, $email)
	{
		return $query->where('email', $email);
	}

	/*
		Находит текущего менеджера в очереди
	*/
	public static function current()
	{
		$manager = Manager::queued()->first();
		if (is_object($manager)) {
			return $manager->id;
		} else {
			$min = Manager::min('id');
			$first = Manager::find($min);
			$first->queue = 1;
			$first->save();
			return $first->id;
		}
		return false;
	}

	/*
		Главный метод, который проверяет наличие
		рекламной ссылки, возвращает емаил текущего 
		менеджера и помечает следующего менеджера
	*/
	
	public static function scratchProcess($link)
	{
		if ($link) {
			$manager = Manager::link($link)->first();
			if (is_object($manager)) {
				return $manager->email;
			} 
		}
		return self::getEmailAndMarkNext();
	}
	

	/*
		Получает емаил текущего менеджера 
		и помечате следующего
	*/
	public static function getEmailAndMarkNext()
	{
		$currentID = Manager::current();
		$current = Manager::find($currentID);
		self::markNext();
		return $current->email;
	}

	/*
		Ищет менеджера по рекламной ссылке
	*/
	public function scopeLink($query, $link)
	{
		return $query->where('link', $link);
	}

	/*
		Помечает следуюещего менеджера
	*/
	public static function markNext()
	{
		$next = Manager::next();
		$nextManager = Manager::find($next);
		$nextManager->queue = 1;
		$nextManager->save();
	}

	/*
		Ищет следующего менеджера
	*/
	public static function next()
	{
		$current = self::current();
		$currentManager = Manager::find($current);
		$currentManager->queue = 0;
		$currentManager->save();
		$next = Manager::where('id', '>', $current)->min('id');
		
		if ($next === NULL) {
			$next = Manager::min('id');
		}
		return $next;
	}

}