@extends ('frontend.layout')
@section ('content')
	<div class="breadcrumbs">
		<nav class="container">
			<div class="col-xs-12">
				<a href="/">
					Главная
				</a>
				<a href="{{ route('catalog.index') }}">
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
			<h1 style="margin-bottom: 50px;">
				Результаты поиска по запросу «{{ $query }}»
			</h1>
			<div class="subtitle">
				{!! $page->text !!}
			</div>

<!--
			<div class="filters">
				<div class="lbl">
					Сортировать по:
				</div>
				<div class="dropdown-filter">
					<div class="arrow">
						<i class="fa fa-chevron-down">
						</i>
					</div>
					<div class="current-value">
						Цене ↓ 
					</div>
					<div class="values">
						<div class="value">
							Цене ↑
						</div>
						<div class="value">
							Названию ↑
						</div>
						<div class="value">
							Названию ↓
						</div>
						<div class="value">
							Дате добавления ↑
						</div>
						<div class="value">
							Дате добавления ↓
						</div>
					</div>
				</div>
			</div>	

			<nav class="filter">
				<button>
					Все 
				</button>
				<button>
					Последние
				</button>
				<button>
					Популярные
				</button>
			</nav>
-->
			<div class="row products" style="margin-top: 30px;">

				@foreach ($foundedRubrics as $item)
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
							<img src="http://dummyimage.com/262x262/e2e2e2/000000" alt="title">
						</a>
					</div>
				@endforeach

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
							<img src="http://dummyimage.com/262x262/e2e2e2/000000" alt="title">
						</a>
					</div>
				@endforeach
			</div>

		</div>

		
		@if (isset($rubrics))
			<aside class="col-md-4">
				<!--
				<nav class="rubricator">
					<div class="rubricator-head">
						Наша продукция
					</div>
					@foreach ($rubrics as $item)
						<a href="{{ $item->url }}" data-level="{{ $item->getLevel() }}">
							{{ $item->title }}
						</a>
					@endforeach
				</nav>
				-->

				<nav class="dynamic-rubricator">
					@foreach ($rubrics as $item)
						<div class="item" data-level="{{ $item->getLevel() }}" >
							<a href="{{ $item->url }}" style="background-image: url('http://dimaxmet.ru/catalog/view/image/icons/verstak.png')">
								{{ $item->title }}
							</a>
							<i class="fa fa-plus">
							</i>
						</div>
					@endforeach
				</nav>

			</aside>
		@endif
		



	</main>
@endsection