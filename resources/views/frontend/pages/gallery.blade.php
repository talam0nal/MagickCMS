@extends ('frontend.layout')
@section ('content')
	<div class="breadcrumbs">
		<nav class="container">
			<div class="col-xs-12">
				<a href="/">
					Главная 
				</a>
				<a href="#">
					{{ $page->title }}
				</a>
			</div>
		</nav>
	</div>

	<main class="container">
		<article class="col-xs-12 col-sm-12 col-md-8">
			<h1>
				{{ $page->title }}
			</h1>
			<div class="description">
				{!! $page->text !!}
			</div>

			@foreach ($items as $item)
				<div class="col-md-3">
					<a href="/gallery/{{ $item->url }}">
						<img src="/uploads/albums/{{ $item->cover }}" alt="{{ $item->title }}">
						{{ $item->title }}
					</a>
				</div>
			@endforeach
		</article>
	</main>
@endsection
