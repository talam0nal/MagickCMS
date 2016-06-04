@extends ('frontend.layout')
@section ('content')
	<div class="breadcrumbs">
		<nav class="container">
			<div class="col-xs-12">
				<a href="/">
					Главная 
				</a>
				<a href="{{ route('news.index') }}">
					Новости 
				</a>
				<a href="#">
					{{ $page->title }}
				</a>
			</div>
		</nav>
	</div>

	<main class="container">
		<article class="col-xs-12 col-sm-12 col-md-8 new-item">
			<div class="date">
				{{ $page->day }}<br>{{ $page->month }}
			</div>

			@if ($page->cover)
				<img src="/uploads/news/{{ $page->cover }}" alt="{{ $page->title }}">
			@endif

			<div class="clearfix">
			</div>

			<h1>
				{{ $page->title }}
			</h1>

			<div class="clearfix">
			</div>
			
			<div class="description">
				{!! $page->text !!}
			</div>

		</article>
	</main>
@endsection
