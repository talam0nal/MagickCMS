@extends ('frontend.layout')
@section ('content')
	<main class="container news">
		<section class="col-md-8 col-sm-12">
			<h1>
				{{ $page->title }}
			</h1>
			<div class="subtitle">
				Оставайтесь в курсе новостей нашей компании
			</div>

			<div class="clearfix" style="height: 50px;">
			</div>

			@foreach ($news as $item)
				<a class="item" href="{{ $item->url }}">
					<div class="date">
						{{ $item->day }}<br>{{ $item->month }}
					</div>
					@if ($item->cover)
						<img src="/uploads/news/{{ $item->cover }}" alt="{{ $item->title }}">
					@endif
					<h3>
						{{ $item->title }}
					</h3>
					<div class="description">
						{{ $item->description }}		
					</div>
				</a>
				<div class="clearfix">
				</div>
			@endforeach

			@include('pagination.default', ['paginator' => $news])

		</section>
	</main>
@endsection
