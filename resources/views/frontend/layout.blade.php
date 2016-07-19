<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>{{ $page->title }}</title>
		<meta name="description" content="{{ $page->page_description }}">
		<meta name="keywords" content="{{ $page->page_keywords }}">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link rel="stylesheet/less" type="text/css" href="/css/global.less" />
		<script src="/js/vendor/less.min.js"></script>
		<link rel="icon" type="image/png" href="/img/logo.png">

		<link rel="preload" href="/">
		<link rel="dns-prefetch" href="/">
		<link rel="preconnect" href="/">
		<link rel="prefetch" href="/">
		<link rel="prerender" href="/">

	</head>
	<body data-token="{{ csrf_token() }}">
		<div id="overlay">
		</div>

		<div class="modal-message">
			<span>
				Ваш заказ успешно оформлен. Мы свяжемся с Вами в ближайшее время
			</span>
			<i class="fa fa-times">
			</i>
		</div>

		<div class="strip">
		</div>

		<header class="container">
			<nav class="col-lg-9 col-md-8">
				@foreach ($topMenu as $item)
					<a href="/{{ $item->url }}">
						{{ $item->title }}
					</a>
				@endforeach
			</nav>

			<div class="col-lg-3 col-md-4 buttons">
					@if (Auth::guard('customers')->check())
						<a href="/profile">
							<i class="fa fa-user">
							</i>
							{{ Auth::guard('customers')->user()->email }}
						</a>
						<a href="/logout">
							<i class="fa fa-sign-out">
							</i>
							Выйти
						</a>
					@else
						<a href="/login">
							<i class="fa fa-sign-in">
							</i>
							Войти
						</a>
						<a href="/register">
							<i class="fa fa-user-plus">
							</i>
							Зарегистрироваться
						</a>
					@endif
				</a>
			</div>

			<a href="/" class="col-md-8 col-sm-8 col-xs-12 logo">
				<div>
					<img src="/img/logo.png" alt="Логотип Велмет">
				</div>
				<h5>
					Wellmet
					<br>
					<span>
						интернет-магазин металлической мебели
					</span>
				</h5>
			</a>

			<div class="col-md-4 col-sm-4">
				<a href="/cart" class="cart-link" @if (!$cart->count) style="display: none;" @endif>
					<i class="fa fa-shopping-cart">
					</i>
					Оформить заказ на сумму <span>{{ $cart->cost }} {{ $cart->word2 }}</span>
				</a>
			</div>

			<div class="col-sm-6 info">

				<a href="#" class="phone">
					<i class="fa fa-phone">
					</i>
					{{ $contacts->phone }}
				</a>




				<a title="" href="{{ $settings->pricelistsPath }}pr_retail/wm_price.xls" class="download-price" style="margin-right: 10px;">
					<i class="fa fa-file-excel-o">
					</i>
					Весь прайс
				</a>

				@if ($priceFile)
					<a title="" href="{{ $settings->pricelistsPath }}pr_retail/{{ $priceFile }}" class="download-price">
						<i class="fa fa-file-excel-o">
						</i>
						Прайс {{ $priceTitle }}
					</a>
				@endif



			</div>

			<form class="col-sm-6" action="/search">
				<input name="query" type="search" placeholder="Введите товар для поиска" @if ($query) value="{{ $query }}" @endif>
				<button type="submit">
					<i class="fa fa-search">
					</i>
				</button>
			</form>
		</header>

		@yield ('content')

		<div class="footer">
			<footer class="container">
				<div class="col-md-3">

				</div>

				<div class="col-md-3">

				</div>

				<div class="col-md-3">
					<a href="{{ route('contacts') }}" class="heading">
						Контакты
					</a>
					{{ $contacts->address }}
					<br>
					тел. {{ $contacts->phone }}
				</div>

				<div class="col-md-3">
					<a href="{{ $contacts->vk }}">
						<i class="fa fa-vk">
						</i>
					</a>
					<a href="{{ $contacts->facebook }}">
						<i class="fa fa-facebook">
						</i>
					</a>

					@if ($contacts->twitter)
						<a href="{{ $contacts->twitter }}">
							<i class="fa fa-twitter">
							</i>
						</a>
					@endif
				</div>
			</footer>
		</div>



		<script src="https://maps.api.2gis.ru/2.0/loader.js?pkg=full"></script>
		<script src="/js/vendor/jquery-2.1.4.js"></script>
		<script src="/js/vendor/slick.min.js"></script>
		<script src="/js/vendor/jquery.mixitup.js"></script>
		<script src="/js/vendor/lightbox.js"></script>
		<script src="/js/global.js"></script>


		{!! $settings->pozvonim !!}

		{!! $settings->counter !!}

	</body>
</html>