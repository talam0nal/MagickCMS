<h4>
	Новый заказ на сайте
</h4>
<h5>
	Пользователь указал следующие данные:
</h5>

@if ($data['name'])
	Название организации/контактное лицо: {{ $data['name'] }} <br>
@endif

@if ($data['email'])
	Электронная почта: {{ $data['email'] }} <br>
@endif

@if ($data['phone'])
	Телефон: {{ $data['phone'] }} <br>
@endif

@if ($data['address'])
	Адрес доставки: {{ $data['address'] }} <br>
@endif

@if ($data['comments'])
	Комментарий к заказу: {{ $data['comments'] }} <br>
@endif

@if ($items)
	Список товаров:<br> {!! $items !!} <br>
@endif

