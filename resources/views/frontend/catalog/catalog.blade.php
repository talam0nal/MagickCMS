@extends ('frontend.layout')
@section ('content')
	<div class="breadcrumbs">
		<nav class="container">
			<div class="col-xs-12">
				<a href="/">
					Главная
				</a>
				<a href="{{ route('catalog.index', false) }}">
					Каталог 
				</a>
				@foreach ($breadcrumbs as $item)
					<a href="{{ $item->url }}">
						{{ $item->text }}
					</a>
				@endforeach
			</div>
		</nav>


		<script>
			console.log('index.blade.php');
		</script>
	</div>

	<main class="container">
		<div class="col-md-8">
			<h1>
				{{ $page->title }}
			</h1>
			<div class="subtitle" style="margin-bottom:30px;">
				{!! $page->text !!}
			</div>

			<div class="row products">
				@foreach ($currentRubrics as $item)
					<div class="col-md-4 col-sm-6">
						<a href="{{ $item->url }}" style="background-image: url('{{ $item->picture }}')" class="item">
							<h3>
								{{ $item->title }}
							</h3>



							<div class="description">
								{!! $item->description !!}
							</div>
							<div class="col-xs-12">

							</div>
							<img src="https://dummyimage.com/262x262/e2e2e2/000000" alt="title">
						</a>
					</div>
				@endforeach
			</div>

		</div>

		<aside class="col-md-4">
			@include ('frontend.catalog.rubricator')
		</aside>
	</main>
@endsection