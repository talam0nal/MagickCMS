@extends ('frontend.layout')
@section ('content')
	<div class="breadcrumbs">
		<nav class="container">
			<div class="col-xs-12">
				<a href="/">
					Главная 
				</a>
				<a href="/gallery">
					Галерея 
				</a>
				<a href="#">
					{{ $page->title }}
				</a>
			</div>
		</nav>
	</div>

	<link rel="stylesheet" type="text/css" href="/css/vendor/lightbox.css">

	<main class="container">
		<article class="col-xs-12 col-sm-12 col-md-8">
			<h1>
				{{ $page->title }}
			</h1>
			<div class="description">
				{!! $page->text !!}
			</div>
			@foreach ($photos as $item)
				<a href="/uploads/photos/{{ $item->image }}" data-lightbox="roadtrip" class="col-md-3">
					<img src="/uploads/photos/{{ $item->image }}">
				</a>
			@endforeach
		</article>
	</main>
@endsection
