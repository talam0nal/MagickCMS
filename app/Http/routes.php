<?php

/*
	Админка
*/
Route::group([
		'prefix'     => 'admin',
		'middleware' => 'web',
		'namespace'  => 'Admin',
	], function ()
{

	Route::get('/login',  [
		'as'   => 'login',
		'uses' => 'UsersController@showLoginForm'
	]);

	Route::post('/login', [
		'as'   => 'loginPost',
		'uses' => 'UsersController@login'
	]);

	Route::get('/logout', [
		'as'   => 'logout',
		'uses' => 'UsersController@logout'
	]);
		
	/*
		Главная страница админки
	*/
	Route::get('/', [
		'as'   => 'admin.dashboard', 
		'uses' => 'DashBoardController@index'
	]);


	Route::get('/php', [
		'as'   => 'admin.php', 
		'uses' => 'DashBoardController@php'
	]);

	Route::get('/clean', [
		'as'   => 'admin.clean.cache', 
		'uses' => 'DashBoardController@cleanCache'
	]);


	/*
		Форма загрузки XML
	*/
	Route::get('/xml', [
		'uses' => 'XMLController@showForm',
	]);

	/*
		Загрузка XML-файла пост запросом
	*/
	Route::post('/xml', [
		'uses' => 'XMLController@upload',
	]);

	/*
		Просмотр битых картинок
	*/
	Route::get('/images/unavailable', [
		'as'   => 'images.unavailable',
		'uses' => 'GoodsController@unavailableImages',
	]);

	Route::get('/goods/empty', [
		'as'   => 'goods.empty',
		'uses' => 'GoodsController@withoutDescription'
	]);

	Route::get('/rubrics/empty', [
		'as'   => 'rubrics.empty',
		'uses' => 'RubricsController@withoutDescription'
	]);

	Route::get('/rubrics/empty/images', [
		'as'   => 'rubrics.images',
		'uses' => 'RubricsController@withoutPicture'
	]);



	/*
		Новости
	*/
	Route::resource('news', 'NewsController');

	/*
		Статьи
	*/
	Route::resource('articles', 'ArticlesController');

	/*
		Акции
	*/
	Route::resource('promotions', 'PromotionsController');

	/*
		Партнёры
	*/
	Route::resource('partners', 'PartnersController');

	/*
		Альбомы фотогалереи
	*/
	Route::resource('albums', 'AlbumsController');

	/*
		Страницы
	*/
	Route::resource('pages', 'PagesController');

	/*
		Фото
	*/
	Route::get('photos/{object_type}/{object_id}', [
		'as'  => 'admin.photos.index',
		'uses' => 'PhotosController@index'
	]);
	
	Route::post('photos/{object_type}/{object_id}', [
		'as'   => 'admin.photos.store',
		'uses' => 'PhotosController@store'
	]);

	Route::delete('photos/{object_id}', [
		'as'   => 'admin.photos.destroy',
		'uses' => 'PhotosController@destroy'
	]);



	/*
		Рубрики
	*/
	Route::resource('rubrics', 'RubricsController');

	/*
		Товары
	*/
	Route::resource('goods', 'GoodsController');

	/*
		Контакты
	*/
	Route::resource('contacts', 'ContactsController');

	/*
		Менеджеры
	*/
	Route::resource('managers', 'ManagersController');

	/*
		Покупатели
	*/
	Route::resource('customers', 'CustomersController');

	/*
		Настройки сайта
	*/
	Route::resource('settings', 'SettingsController');

	/*
		Журнал событий
	*/
	Route::resource('logs', 'LogsController');

	/*
		Заказы
	*/
	Route::resource('orders', 'OrdersController');

});


Route::group([
	'middleware' => 
		['web']
	], function () {

		/*
			Главная страница
		*/		
		Route::get('/', [
			'as'   => 'home', 
			'uses' => 'PagesController@index'
		]);

		/*
			Страница с формой входа
		*/
		Route::get('/login',  [
			'as'   => 'login',
			'uses' => 'CustomerController@showLoginForm'
		]);

		/*
			Вход в личный кабинет
		*/
		Route::post('/login', [
			'as'   => 'loginPost',
			'uses' => 'CustomerController@login'
		]);

		/*
			Выход из личного кабинета
		*/
		Route::get('/logout', [
			'as'   => 'logout',
			'uses' => 'CustomerController@logout'
		]);

		/*
			Страница с формой регистрации
		*/
		Route::get('/register', [
			'as'   => 'register',
			'uses' => 'CustomerController@showRegisterForm'
		]);

		/*
			Регистрация
		*/
		Route::post('/register', [
			'as'   => 'registerPost',
			'uses' => 'CustomerController@register'
		]);

		/*
			Стать дилером
		*/
		Route::get('/dealer', [
			'as'   => 'dealer',
			'uses' => 'CustomerController@dealer'
		]);

		Route::post('/dealer', [
			'as'   => 'dealer.send',
			'uses' => 'CustomerController@dealerRegister'
		]);

		/*
			Галерея
		*/
		Route::get('/gallery', [
			'as'   => 'gallery.index',
			'uses' => 'PagesController@gallery'
		]);

		/*
			Галерея
		*/
		Route::get('/gallery/{url}', [
			'as'   => 'gallery.show',
			'uses' => 'PagesController@galleryShow'
		]);

		/*
			Галерея
		*/
		Route::get('/articles', [
			'as'   => 'articles.index',
			'uses' => 'PagesController@articles'
		]);

		/*
			Галерея
		*/
		Route::get('/articles/{url}', [
			'as'   => 'articles.show',
			'uses' => 'PagesController@articleShow'
		]);

		/*
			Личный кабинет
		*/
		Route::get('/profile', [
			'as'   => 'profile',
			'uses' => 'CustomerController@profile'
		]);

		/*
			Изменение личных данных
		*/
		Route::post('/profile', [
			'as'   => 'profile.update',
			'uses' => 'CustomerController@update'
		]);

		/*
			История покупок
		*/
		Route::get('/history', [
			'as'   => 'profile.history',
			'uses' => 'CustomerController@history'
		]);

		/*
			Поиск по сайту
		*/
		Route::get('/search', [
			'as'   => 'search',
			'uses' => 'PagesController@search',
		]);

		/*
			Сертификаты
		*/
		Route::get('/сертификаты',  [
			'as'   => 'certificates',
			'uses' => 'PagesController@certificates'
		]);

		/*
			Тестовый парсинг XML
		*/
		Route::get('xml', [
			'as' => 'xml',
			'uses' => 'PagesController@parseXML'
		]);

		/*
			Страница контактов
		*/
		Route::get('/contacts', [
			'as'   => 'contacts', 
			'uses' => 'PagesController@contacts'
		]);

		/*
			Печать контактов
		*/
		Route::get('/contacts/print', [
			'as'   => 'contacts.print', 
			'uses' => 'PagesController@printContacts'
		]);

		/*
			Отправка формы обратной связи
		*/
		Route::post('/feedback/send', [
			'uses' => 'PagesController@sendFeedback'
		]);

		/*
			Страница корзины
		*/
		Route::get('/cart', [
			'as'   => 'cart', 
			'uses' => 'CartController@cart'
		]);

		/*
			Страница оформления заказа
		*/
		Route::get('/order', [
			'as'   => 'order', 
			'uses' => 'PagesController@order'
		]);

		/*
			Страница оплаты заказа
		*/
		Route::get('/payment', [
			'as'   => 'payment', 
			'uses' => 'PagesController@payment'
		]);

		/*
			Создание заказа
		*/
		Route::post('/order/create', [
			'uses' => 'PagesController@storeOrder'
		]);

		/*
			Обновить количество товаров в корзине
		*/
		Route::post('/cart/update', [
			'uses' => 'CartController@updateCount'
		]);

		/*
			Новости
		*/
		Route::get('/news', [
			'as'   => 'news.index',
			'uses' => 'NewsController@index'
		]);

		Route::get('/news/{url}', [
			'as'   => 'news.show', 
			'uses' => 'NewsController@show'
		]);

		/*
			Индексная страница каталога
		*/
		Route::get('/catalog', [
			'as'   => 'catalog.index',
			'uses' => 'ProductsController@index'
		]);

		/*
			Рубрика каталога
		*/
		Route::get('/catalog/{url}', [
			'as'   => 'catalog.rubric',
			'uses' => 'ProductsController@category'
		]);

		/*
			Подрубрика каталога со списком товаров
		*/
		Route::get('/catalog/{category}/{sCategory}', [
			'as'   => 'catalog.rubric', 
			'uses' => 'ProductsController@sCategory'
		]);

		/*
			Подрубрика каталога со списком товаров
		*/
		Route::get('/catalog/{category}/{sCategory}/{subcategory}', [
			'as'   => 'catalog.rubric', 
			'uses' => 'ProductsController@subCategory'
		]);

		/*
			Страница товара
		*/
		Route::get('/catalog/{category}/{sCategory}/{subcategory}/{item}', [
			'as'   => 'catalog.item',
			'uses' => 'ProductsController@show'
		])->where('url', '(.*)' );

		/*
			Добавить товар в корзину
		*/
		Route::post('/cart/add', [
			'uses' => 'CartController@addToCart'
		]);

		/*
			Удалить товар из корзины
		*/
		Route::post('/cart/delete', [
			'uses' => 'CartController@deleteFromCart'
		]);

		/*
			Текстовые страницы
		*/	
		Route::get('/{all}', 'PagesController@show')->where('all', '^(?!uploads)[a-zA-z-_\/абвгдеёжзийклмнопрстуфхцчшщъьыэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЬЫЭЮЯ]+');
});



