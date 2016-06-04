<h4>
	Спасибо за оформление заказа на нашем сайте
</h4>
<h5>
	Ваш заказ:
</h5>

@if ($items)
	<br> {!! $items !!} <br>
@endif

<h4>
	При оформлении заказа вы указали следующие данные:
</h4>
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

@if ($password)
	Чтобы просмотреть статус заказа или совершить оплату, войдите в личный кабинет на сайте, используя Ваш адрес электронной почты.<br>
	Ваш пароль: {{ $password }}
	@else
	Чтобы просмотреть статус заказа или совершить оплату, войдите в личный кабинет на сайте<br>
@endif

<br><br>
Наши менеджера свяжутся с Вами в ближайшее время<br><br>