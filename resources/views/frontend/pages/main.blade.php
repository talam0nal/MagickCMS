@extends ('frontend.layout')
@section ('content')
	<main class="container">
		
		<div class="row promotions-and-rubricator">
			<div class="col-md-4">
				@include ('frontend.catalog.rubricator')
			</div>
			<div class="col-md-8">
				<section class="promotions">
					@foreach ($promotions as $item)
						<div class="item">
							<div class="col-md-4">
								<img src="/uploads/promotions/{{ $item->cover }}" alt="{{ $item->title }}">
							</div>
							<div class="col-md-8">
								<h4>
									{{ $item->title }}
								</h4>
								<div class="text">
									{!! $item->text !!}
								</div>
								<a href="{{ $item->link }}" class="more">
									{{ $item->button_text }}
									<i class="fa fa-angle-double-right">
									</i>
								</a>
							</div>
						</div>
					@endforeach
				</section>
			</div>
		</div>
		

		<div class="col-md-9">
			<h2>
				Наша продукция
			</h2>
			<div class="subtitle">
				У нас вы можете купить металлическую мебель с возможностью доставки его до своего адреса
			</div>

			<nav class="filter">
				<button data-filter=".category-1" class="filter">
					Популярные товары
				</button>
				<button data-filter=".category-2" class="filter">
					Товары со скидкой
				</button>
				<button data-filter=".category-3" class="filter">
					Новые товары
				</button>
			</nav>

			<div class="row products" data-first="category-1">
				@foreach ($popularGoods as $item)
					<div class="col-md-4 col-sm-6 mix category-1">
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

				@foreach ($promotionsGoods as $item)
					<div class="col-md-4 col-sm-6 mix category-2">
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

				@foreach ($freshGoods as $item)
					<div class="col-md-4 col-sm-6 mix category-3">
						<a href="#" style="background-image: url('{{ $item->picture }}')" class="item">
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

		<aside class="col-md-3">
			<div class="news-list">
				<a href="{{ route('news.index') }}" class="heading">
					Новости
				</a>

				@foreach ($news as $item)
					<a href="{{ $item->url }}" class="item">
						<h4>
							{{ $item->title }}
						</h4>

						<div class="date">
							{{ $item->date }}
						</div>

						<div class="description">
							{!! $item->description !!}
						</div>
					</a>
				@endforeach
			</div>
		</aside>
	</main>


	<div class="container">
		<section class="about col-md-8 col-sm-12">
			<h2>
				О компании
			</h2>
			<article>
				{!!  $page->text !!}
			</article>
		</section>
	</div>

	<div class="container">
		<section class="about col-md-12 col-sm-12">
			<h2>
				Наши клиенты
			</h2>
			
			<div class="clients">
				@foreach ($partners as $item)
					<div class="partner">
						<img src="/uploads/partners/{{ $item->cover }}">
					</div>
				@endforeach
			</div>

		</section>
	</div>

	<div class="container">
		<section class="map col-md-12 col-sm-12">
			<h2>
				Карта проезда
			</h2>

			<div id="map" data-baloon="Веллмет. Интернет-магазин металлической мебели" data-latitude="{{ $contacts->latitude }}" data-longitude="{{ $contacts->longitude }}">
			</div>
		</section>
	</div>
@endsection