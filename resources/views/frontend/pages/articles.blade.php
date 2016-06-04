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
				<div class="row" style="margin-bottom: 30px;">
					<div class="col-md-4">
						<img src="/uploads/articles/{{ $item->cover }}">
					</div>

					<div class="col-md-8">
						<a href="/articles/{{ $item->url }}">	
							{{ $item->title }}
						</a>
					</div>
				</div>
			@endforeach
		</article>
	</main>
@endsection
