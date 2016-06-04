@extends ('frontend.layout')
@section ('content')
	<section class="container contacts">
		<h1>
			{{ $page->title }}
		</h1>
		<div class="subtitle">
			Консультирование, ответы на интересующие вопросы
		</div>
		<div id="map" data-baloon="Веллмет. Интернет-магазин металлической мебели" data-latitude="{{ $contacts->latitude }}" data-longitude="{{ $contacts->longitude }}">
		</div>

		<div class="col-sm-12">
			<a href="/contacts/print" target="_blank" class="print-contacts">
				<i class="fa fa-print">
				</i>
				Распечатать контакты
			</a>
		</div>

		<form class="col-sm-12 col-md-6" action="/feedback/send" method="POST">

			<h4>
				Оставить комментарий
			</h4>
			<div class="input">
				<input type="text" id="name" name="name">
				<label for="name" class="placeholder">
					Имя:
				</label>
			</div>
			<div class="input">
				<input type="email" id="email" name="email">
				<label for="email" class="placeholder">
					E-mail:
				</label>
			</div>
			<div class="input">
				<textarea id="text" name="msg"></textarea>
				<label for="text" class="placeholder full">
					Ваше сообщение:
				</label>
			</div>
			<button class="col-xs-12 col-sm-6 col-md-5 col-lg-5" data-success="Ваше соообщение успешно отправлено">
				<i class="fa fa-paper-plane">
				</i>
				Отправить
			</button>
		</form>
		<div class="col-sm-12 col-md-6 contacts-info">
			<h4>
				Контактная информация
			</h4>
			<div class="phone">
				тел.: {{ $contacts->phone }}
			</div>
			<div class="address">
				{{ $contacts->address }}
			</div>
		</div>
	</section>
@endsection