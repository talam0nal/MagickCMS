@extends ('frontend.layout')
@section ('content')
	<div class="breadcrumbs">
		<nav class="container">
			<div class="col-xs-12">
				<a href="/">
					Главная 
				</a>
				<a href="/cart">
					Корзина 
				</a>
			</div>
		</nav>
	</div>

	<main class="container">
		<div class="col-xs-12">
			@if (count($items))
				<table class="cart"> 
					<tr>
						<td>
							Наименование продукта
						</td>
						<td>
							Цена
						</td>
						<td>
							Количество
						</td>
						<td>
							Сумма
						</td>
					</tr>

					@foreach ($items as $item)
						<tr>
							<td class="title">
								@if ($item->picture)
									<img src="{{ $item->picture }}" alt="{{ $item->title }}">
								@endif
								<a href="{{ $item->url }}">
									{{ $item->title }}
								</a>
							</td>
							<td class="price">
								{{ $item->price }}. -
							</td>
							<td class="recount">
								<i class="fa fa-minus-square" data-action="recount" data-count="-1" data-product="{{ $item->id }}">
								</i>
								<span data-count-product="{{ $item->id }}">{{ $item->count }}</span>
								<i class="fa fa-plus-square" data-action="recount" data-count="1" data-product="{{ $item->id }}">
								</i>
							</td>
							<td class="price">
								<span data-total-price-product="{{ $item->id }}">{{ $item->price * $item->count }}</span>. -
								<span data-product="{{ $item->id }}" class="remove-from-list">
								<i class="fa fa-times">
								</i>
								</span>
							</td>
						</tr>
					@endforeach
				</table>

				<a href="/order" class="make-order">
					<i class="fa fa-truck">
					</i>
					Оформить заказ
				</a>
			@else
				<h1>
					В корзине нет товаров
				</h1>
			@endif

		</div>
	</main>
@endsection