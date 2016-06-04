@extends ('admin.layout')
@section ('content')
	<h1>
		Редактирование клиента
	</h1>
	@if ($action=='update')
		{!! Form::model('News', [
			'method' => 'PATCH',
			'route' => ['admin.customers.update', $item->id],
			'files' => true
		]) !!}
	@endif

	@if ($action=='store')
		{!! Form::open([
			'route' => 'admin.customers.store',
			'files' => true
		]) !!}
	@endif


		<label for="exampleInputEmail1">Имя</label>
		<input type="text" value="{{ $item->name }}" name="name" placeholder="Имя" class="form-control">

		<label for="exampleInputEmail1">E-mail</label>
		<input type="text" value="{{ $item->email }}" name="email" placeholder="Email" class="form-control">

		<label for="exampleInputEmail1">Телефон</label>
		<input type="text" value="{{ $item->phone }}" name="phone" placeholder="Телефон" class="form-control">

		<label for="exampleInputEmail1">Адрес</label>
		<input type="text" value="{{ $item->address }}" name="address" placeholder="Адрес" class="form-control">

		<label for="exampleInputEmail1">Компания</label>
		<input type="text" value="{{ $item->company }}" name="company" placeholder="Компания" class="form-control">

		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<br>
		{!! Form::label('status', 'Статус покупателя:', ['class' => 'control-label']) !!}
		<select name="type">
			<option value="1" @if ($item->type == 1) selected @endif >
				Обычный покупатель
			</option>
			<option value="2" @if ($item->type == 2) selected @endif >
				Дилер 1
			</option>

			<option value="3" @if ($item->type == 3) selected @endif >
				Дилер 2
			</option>

		</select>
		<br>

		<br>

		@if ($item->dealerClaim)
			Данный пользователь подавал заявку на дилерство
		@endif
		<br><br>


		<div class="clearfix">
		</div>

		@if (count($item->orders) )
			<h2>
				Заказы, совершённые клиентом:
			</h2>
			<table class="table">
				<tr>
					<td style="width: 180px;">
						Дата
					</td>

					<td>
						Имя
					</td>

					<td>
						Адрес
					</td>

					<td style="width: 160px;">
						Телефон
					</td>

					<td>
						Товары
					</td>

				</tr>

				@foreach ($item->orders as $order)
					<tr>
						<td>
							<a href="/admin/orders/{{ $order->id }}/edit" target="_blank" title="Просмотр заказа">
								{{ $order->created_at }}
							</a>
						</td>

						<td>
							{{ $order->name }}
						</td>

						<td>
							{{ $order->address }}
						</td>

						<td>
							{{ $order->phone }}
						</td>

						<td>
							{!! $order->items !!}
						</td>

					</tr>
				@endforeach
			</table>
		@endif
		<button type="submit" class="btn btn-success">
			Сохранить
		</button>
	{!! Form::close() !!}
@endsection