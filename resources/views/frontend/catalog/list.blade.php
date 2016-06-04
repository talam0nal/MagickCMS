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
	</div>

	<main class="container">
		<div class="col-md-8">
			<h1>
				{{ $page->title }}
			</h1>
			<div class="subtitle">
				{!! $page->text !!}
			</div>

			<div class="row products" style="margin-top: 30px;">
				@foreach ($products as $item)
					<div class="col-md-4 col-sm-6">
						<a href="{{ $item->url }}" style="background-image: url('{{ $item->picture }}')" class="item">
							<h3>
								{{ $item->title }}
							</h3>
			
							<div class="price">
								{{ $item->price }}
							</div>
				
							<div class="description">
								{!! $item->description !!}
							</div>
							<div class="col-xs-12">
								<button data-basket="{{ $item->in_basket }}" data-product="{{ $item->id}}" data-action="add-to-cart">
									В корзину
								</button>

								<button data-basket="{{ $item->in_basket }}" data-product="{{ $item->id}}" data-action="remove-from-cart">
									Убрать из корзины
								</button>
							</div>
							<img src="https://dummyimage.com/262x262/e2e2e2/000000" alt="title">
						</a>
					</div>
				@endforeach
			</div>

		</div>

		
		@if (isset($rubrics))
			<aside class="col-md-4">
				@include ('frontend.catalog.rubricator')
			</aside>
		@endif
		



	</main>
@endsection