	<head>
		<meta charset="utf-8">
		<title>{{ $page->title }}</title>
		<meta name="description" content="{{ $page->page_description }}">
		<meta name="keywords" content="{{ $page->page_keywords }}">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link rel="stylesheet/less" type="text/css" href="/css/global.less" />
		<script src="/js/vendor/less.min.js"></script>
	</head>

	<h1>
		{{ $page->title }}
	</h1>
	<div id="map" data-baloon="Веллмет. Интернет-магазин металлической мебели" data-latitude="{{ $contacts->latitude }}" data-longitude="{{ $contacts->longitude }}" style="height: 600px">
	</div>

	<div class="col-sm-12 col-md-6 contacts-info">
		<h4>
			Контактная информация
		</h4>
		<div class="phone">
			тел.: {{ $contacts->phone }}
		</div>
		<div class="address">
			{{ $contacts->address }}
		</div>
	</div>


<script src="http://maps.api.2gis.ru/2.0/loader.js?pkg=full"></script>
<script src="/js/vendor/jquery-2.1.4.js"></script>
<script src="/js/vendor/slick.min.js"></script>
<script src="/js/vendor/jquery.mixitup.js"></script>
<script src="/js/global.js"></script>
