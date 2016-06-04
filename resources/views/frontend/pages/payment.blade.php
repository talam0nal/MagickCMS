@extends ('frontend.layout')
@section ('content')
	<div class="breadcrumbs">
		<nav class="container">
			<div class="col-xs-12">
				<a href="/">
					Главная 
				</a>
				<a href="/payment">
					Оплата заказа
				</a>
			</div>
		</nav>
	</div>

	<section class="container contacts">
		<article class="col-xs-12 col-sm-12 col-md-8">
			<h1>
				{{ $page->title }}
			</h1>
			<div class="description">
				<form action="https://money.yandex.ru/eshop.xml" method="post">
					
					<input type="radio" value="PC" id="pc" name="paymentType">
					<label for="pc">
						Оплата из кошелька в Яндекс.Деньгах
					</label>
					<br>

					<input type="radio" value="AC" id="ac" name="paymentType">
					<label for="ac">
						 Оплата с произвольной банковской карты
					</label>
					<br>

					<input type="radio" value="MC" id="mc" name="paymentType">
					<label for="mc">
						Платеж со счета мобильного телефона 
					</label>
					<br>

					<input type="radio" value="GP" id="gp" name="paymentType">
					<label for="gp">
						Оплата наличными через кассы и терминалы
					</label>
					<br>

					<input type="radio" id="WM" name="paymentType" value="WM">
					<label for="WM">Оплата из кошелька в системе WebMoney</label>
					<br>

					<input type="radio" id="SB" name="paymentType" value="SB">
					<label for="SB">Оплата через Сбербанк</label>
					<br>

					<input type="radio" id="MP" name="paymentType" value="MP">
					<label for="MP">Оплата через мобильный терминал (mPOS)</label>
					<br>

					<input type="radio" id="AB" name="paymentType" value="AB">
					<label for="AB">Оплата через Альфа-Клик</label>
					<br>

					<input type="radio" id="МА" name="paymentType" value="МА">
					<label for="МА">Оплата через MasterPass</label>
					<br>

					<input type="radio" id="PB" name="paymentType" value="PB">
					<label for="PB">Оплата через Промсвязьбанк</label>
					<br>

					<input type="radio" id="QW" name="paymentType" value="QW">
					<label for="QW">Оплата через QIWI Wallet</label>
					<br>

					<input type="radio" id="KV" name="paymentType" value="KV">
					<label for="KV">Оплата через КупиВкредит</label>

					<div class="clearfix">
					</div>
					<br>
					<button class="col-xs-12 col-sm-6 col-md-5 col-lg-5" data-success="Ваше соообщение успешно отправлено">
						<i class="fa fa-paper-plane">
						</i>
						Оплатить
					</button>

				</form>
			</div>
		</article>
	</section>
@endsection
