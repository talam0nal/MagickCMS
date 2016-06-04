<h4>
	Новая заявка на дилерство на сайте велмет
</h4>


<h5>
	Пользователь указал следующие данные:
</h5>


<br><br>

@if ($data['company'])
	Название организации: {{ $data['company'] }}<br>
@endif

@if ($data['address'])
	Адрес организации: {{ $data['address'] }}<br>
@endif

@if ($data['email'])
	E-mail: {{ $data['email'] }}<br>
@endif

@if ($data['phone'])
	Телефон: {{ $data['phone'] }}<br>
@endif
