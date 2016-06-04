@extends ('frontend.layout')
@section ('content')
	<div class="breadcrumbs">
		<nav class="container">
			<div class="col-xs-12">
				<a href="/">
					Главная 
				</a>
				<a href="{{ route('catalog.index') }}">
					Каталог товаров
				</a>
				@foreach ($breadcrumbs as $item)
					<a href="{{ $item->url }}">
						{{ $item->text }}
					</a>
				@endforeach
				<a href="{{ $page->url }}">
					{{ $page->title }}
				</a>
			</div>
		</nav>
	</div>

	<main class="container">
		<article class="col-xs-12">
			<h1>
				{{ $page->title }}
			</h1>
			<div class="subtitle" style="margin-bottom: 40px;">
				{{ $page->description }}
			</div>

			<link rel="stylesheet" type="text/css" href="/css/vendor/lightbox.css">

			<div class="row">
				@if ($page->picture)
					<div class="col-sm-4 product-image">

						<div class="price">
							{{ $page->price }}
						</div>

						<a href="{{ $page->picture }}" data-lightbox="roadtrip">		
							<img src="{{ $page->picture }}" alt="{{ $page->title }}" style="width:100%;">
						</a>

						<div class="row" style="margin-top: 30px;">

							@if ($page->picture2)
								<div class="col-md-6">
									<a href="{{ $page->picture2 }}" data-lightbox="roadtrip">	
										<img src="{{ $page->picture2 }}">
									</a>
								</div>
							@endif

							@if ($page->picture3)
								<div class="col-md-6">
									<a href="{{ $page->picture3 }}" data-lightbox="roadtrip">	
										<img src="{{ $page->picture3 }}">
									</a>
								</div>
							@endif
							
						</div>


					</div>
				@endif

				<div class="@if ($page->picture) col-sm-5 col-sm-offset-1 @else col-sm-12 @endif product-desctiption">
					@if (!$page->picture)
						Цена: {{ $page->price }} руб.
						<div class="clearifx">
						</div>
					@endif
						
					{!! $page->text !!}

					<br><br>

					@if ($page->length)
						<i class="fa fa-arrows-h"></i> Длина: {{ $page->length }} мм<br>
					@endif

					@if ($page->width)
						<i class="fa fa-arrows-h"></i> Ширина: {{ $page->width }} мм<br>
					@endif

					@if ($page->depth)
						<i class="fa fa-cube"></i> Глубина: {{ $page->depth }} мм<br>
					@endif

					@if ($page->weight)
						<i class="fa fa-balance-scale"></i> Масса: {{ $page->weight }} кг<br>
					@endif

					@if ($page->remains_klg)
						{{ $page->remains_klg }}
					@endif

					@if ($page->remains_msk)
						{{ $page->remains_msk }}
					@endif

	



					
					<div class="clearfix">
					</div>
					<button class="add-to-cart inner" data-basket="{{ $page->in_basket }}" data-product="{{ $page->id}}" data-action="add-to-cart">
						<i class="fa fa-cart-arrow-down">
						</i>
						Добавить в корзину
					</button>
					<button class="add-to-cart inner" data-basket="{{ $page->in_basket }}" data-product="{{ $page->id}}" data-action="remove-from-cart">
						<i class="fa fa-times">
						</i>
						Убрать из корзины
					</button>
				</div>
			</div>
		</article>
	</main>

	@if (count($similarProducts))
		<section class="container other-products" style="margin-top: 40px;">
			<div class="col-xs-12">
				<h1>
					Другие товары этой категории
				</h1>
				<div class="subtitle" style="margin-bottom: 40px;">
					Только у нас вы можете заказать новую модель со скидкой
				</div>
				<div class="row products">
					@foreach ($similarProducts as $item)
						<div class="col-md-3 col-sm-6">
							<a href="{{ $item->url }}" style="background-image: url('{{ $item->picture }}')" class="item">
								<h3>
									{{ $item->title }}
								</h3>
								<div class="price">
									{{ $item->price }}
								</div>
								<div class="description">
									{{ $item->description }}
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
		</section>
	@endif


@endsection