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
				<a href="/order">
					Оформление заказа 
				</a>
			</div>
		</nav>
	</div>

	<section class="container contacts">
		<h1>
			{{ $page->title }}
		</h1>
		<div class="subtitle">
			Пожалуйста, правильно укажите Ваши данные
		</div>

		<div class="col-sm-12 col-md-8">
			<h4>
				Ваш заказ на сумму {{ $cart->cost }} {{ $cart->word2 }}:
			</h4>
			<table class="short-cart-list">
				<tr>
					<td>
						Наименование
					</td>
					<td>
						Цена
					</td>
					<td>
						Количество
					</td>
					<td>
						Всего
					</td>
				</tr>

				@foreach ($items as $item)
					<tr>
						<td>
							<a href="{{ $item->url }}">
								{{ $item->title }}
							</a>
						</td>
						<td>
							{{ $item->price }}
						</td>
						<td>
							{{ $item->count }}
						</td>
						<td>
							{{ $item->price * $item->count }}
						</td>
					</tr>
				@endforeach

			</table>

			<a href="/cart" class="back-to-cart">
				<i class="fa fa-reply">
				</i>
				Вернуться в корзину, чтобы изменить заказ
			</a>
		</div>

		<form class="col-sm-12 col-md-8" action="/order/create" method="POST">
			<h4>
				Данные для отправки заказа:
			</h4>
			<div class="input">
				@if (Auth::guard('customers')->check())
					<input type="text" id="name" name="name" style="padding-left: 370px;" value="{{ Auth::guard('customers')->user()->name }}" class="disabled">
				@else
					<input type="text" id="name" name="name" style="padding-left: 370px;">
				@endif
				<label for="name" class="placeholder" style="width: 350px;">
					<i class="fa fa-user">
					</i>
					Название организации или контактное лицо:
				</label>
			</div>
			<div class="input">
					@if (Auth::guard('customers')->check())
						<input type="email" readonly id="email" name="email" value="{{ Auth::guard('customers')->user()->email }}" style="padding-left: 370px;" class="disabled">
					@else
						<input type="email" id="email" name="email" style="padding-left: 370px;">
					@endif
				
				<label for="email" class="placeholder" style="width: 350px;">
					<i class="fa fa-envelope">
					</i>
					Адрес электронной почты:
				</label>
			</div>
			<div class="input">
				@if (Auth::guard('customers')->check())
					<input value="{{ Auth::guard('customers')->user()->address }}" type="text" id="address" name="address" style="padding-left: 370px;" class="disabled">
				@else
					<input type="text" id="address" name="address" style="padding-left: 370px;">
				@endif
				<label for="address" class="placeholder" style="width: 350px;">
					<i class="fa fa-truck">
					</i>
					Адрес доставки:
				</label>
			</div>
			<div class="input">
				@if (Auth::guard('customers')->check())
					<input type="text" id="phone" name="phone" value="{{ Auth::guard('customers')->user()->phone }}" style="padding-left: 370px;" class="disabled">
				@else
					<input type="text" id="phone" name="phone" style="padding-left: 370px;">
				@endif
				<label for="phone" class="placeholder" style="width: 350px;">
					<i class="fa fa-phone">
					</i>
					Номер телефона:
				</label>
			</div>
			<div class="input">
				<textarea id="text" name="comments"></textarea>
				<label for="text" class="placeholder full">
					<i class="fa fa-comment">
					</i>
					Комментарий к заказу:
				</label>
			</div>
			<button class="col-xs-12 col-sm-6 col-md-5 col-lg-5" data-success="Ваше соообщение успешно отправлено">
				<i class="fa fa-paper-plane">
				</i>
				Оформить заказ
			</button>
		</form>
	</section>
@endsection