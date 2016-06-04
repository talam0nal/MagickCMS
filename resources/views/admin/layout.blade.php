<html>
	<head>	
		<title>Панель управления</title>
	   <link rel="shortcut icon" href="/img/fav.png" type="image/x-icon">
		
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="/css/vendor/pikaday.css">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<link rel="stylesheet/less" type="text/css" href="/css/admin.less" />
		<script src="/js/vendor/less.min.js"></script>
	</head>


<body>


	<div class="col-md-2 menu">
		<a href="/">
			<i class="fa fa-eye"></i> Вернуться на сайт
		</a>
		<br>
		
		<a href="{{ route('admin.news.index') }}">
			<i class="fa fa-newspaper-o"></i> Новости
		</a>
		<br>

		<a href="{{ route('admin.articles.index') }}">
			<i class="fa fa-book"></i> Статьи
		</a>
		<br>

		<a href="{{ route('admin.albums.index') }}">
			<i class="fa fa-picture-o"></i> Фотогалерея
		</a>
		<br>

		<a href="{{ route('admin.pages.index') }}">
			<i class="fa fa-file-o"></i> Страницы
		</a>
		<br>

		<a href="{{ route('admin.rubrics.index') }}">
			<i class="fa fa-th-list"></i> Рубрики товаров 
		</a>
		<br>
 
		<a href="{{ route('admin.goods.index') }}">
			<i class="fa fa-tags"></i> Товары
		</a>
		<br>

		<a href="{{ route('admin.orders.index') }}">
			<i class="fa fa-shopping-cart"></i> Заказы
		</a>
		<br>

		<a href="{{ route('admin.managers.index') }}">
			<i class="fa fa-users"></i> Менеджеры
		</a>
		<br>

		<a href="{{ route('admin.promotions.index') }}">
			<i class="fa fa-flag"></i> Акции
		</a>
		<br>

		<a href="{{ route('admin.partners.index') }}">
			<i class="fa fa-star"></i> Клиенты
		</a>
		<br>

		<a href="{{ route('admin.customers.index') }}">
			<i class="fa fa-users"></i>
			Покупатели
		</a>
		<br>

		<a href="{{ route('admin.contacts.index') }}">
			<i class="fa fa-map-marker"></i> Контакты
		</a>
		<br>

		<a href="/admin/xml">
			<i class="fa fa-file-code-o"></i> Импорт XML
		</a>
		<br>

		<a href="{{ route('admin.logs.index') }}">
			<i class="fa fa-calendar"></i> Просмотр журнала
		</a>
		<br>

		<a href="{{ route('images.unavailable') }}">
			<i class="fa fa-times"></i> Товары без картинок
		</a>
		<br>

		<a href="{{ route('goods.empty') }}">
			<i class="fa fa-times"></i> Товары без описаний
		</a>
		<br>

		<a href="/admin/rubrics/empty/images">
			<i class="fa fa-times"></i> Рубрики без картинок
		</a>
		<br>		

		<a href="{{ route('rubrics.empty') }}">
			<i class="fa fa-times"></i> Рубрики без описаний
		</a>
		<br>

		<a href="{{ route('admin.settings.index') }}">
			<i class="fa fa-cog"></i> Настройки
		</a>
		<br>

		<a href="{{ route('admin.php') }}">
			<i class="fa fa-info-circle"></i> Версия PHP
		</a>
		<br>

		<a href="{{ route('admin.clean.cache') }}">
			<i class="fa fa-magic"></i> Очистить кеш
		</a>
		<br>

		<a href="/admin/logout">
			<i class="fa fa-sign-out"></i> Выйти
		</a>
		<br>

	</div>
	<div class="col-md-9">
		@yield ('content')
	</div>

	<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
	<script src="/js/vendor/moment.js"></script>
	<script src="/js/vendor/pikaday.js"></script>
	<script src="/js/vendor/pikaday.jquery.js"></script>
	<script src="/js/vendor/ckeditor/ckeditor.js"></script>
	<script>
		$(function() {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$('[data-action="delete"]').click(function(event) {
				event.preventDefault();
				id = $(this).data('id');
				route = $('[data-route]').attr('data-route');
				var row = $(this).parent().parent();
					
				var request = $.ajax(
				{
					method: "POST",
					 type: 'post',
					_method: 'delete',
					data: {_method: 'delete'},
					url: "/admin/"+route+"/"+id,
				});

				request.done(function() {
					row.remove();
				});

				request.error(function() {
					alert('Во время запроса произошла ошибка');
				});
			});

			var picker = new Pikaday({
				field: document.getElementById('datepicker'),
				format: 'D MMM YYYY',
				onSelect: function() {
					console.log(this.getMoment().format('Do MMMM YYYY'));
				}
			});

			l = $('#text').length;
			if (l) {
				CKEDITOR.replace('text');
			}
			

			$('.item.photo i').click(function() {
				id = $(this).attr('data-id');
				var row = $(this).parent();
				var request = $.ajax(
				{
					method: "POST",
					 type: 'post',
					_method: 'delete',
					data: {_method: 'delete'},
					url: "/admin/photos/"+id,
				});

				request.done(function() {
					row.remove();
				});				
			});

		});
	</script>
</body>