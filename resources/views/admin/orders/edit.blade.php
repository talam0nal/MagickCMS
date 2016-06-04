@extends ('admin.layout')
@section ('content')
	@if ($action=='update')
		{!! Form::model('Order', [
			'method' => 'PATCH',
			'route' => ['admin.orders.update', $item->id],
			'files' => true
		]) !!}
	@endif

	@if ($action=='store')
		{!! Form::open([
			'route' => 'admin.ordres.store',
			'files' => true
		]) !!}
	@endif

		<h1>
			Редактирование заказа
		</h1>

		<label for="exampleInputEmail1">Название организации/контактное лицо</label>
		<input type="text" value="{{ $item->name }}" name="name" placeholder="Название организации/контактное лицо" class="form-control">

		{!! Form::label('address', 'Адрес доставки:', ['class' => 'control-label']) !!}
		<input type="text" value="{{ $item->address }}" name="address" placeholder="Адрес доставки" class="form-control">

		{!! Form::label('phone', 'Номер телефона:', ['class' => 'control-label']) !!}
		<input type="text" id="d" value="{{ $item->phone }}" name="phone" placeholder="Телефон" class="form-control">

		{!! Form::label('email', 'Адрес электронной почты:', ['class' => 'control-label']) !!}
		<input type="text" id="d" value="{{ $item->email }}" name="email" placeholder="Адрес электронной почты" class="form-control">

		{!! Form::label('created_at', 'Дата, время создания заказа:', ['class' => 'control-label']) !!}
		<input disabled type="text" id="d" value="{{ $item->created_at }}" name="page_description" placeholder="Дата, время создания заказа" class="form-control">

		{!! Form::label('manager', 'Менеджер:', ['class' => 'control-label']) !!}
		<input disabled type="text" id="manager" value="{{ $manager->name }}" name="manager" placeholder="Менеджер" class="form-control">

		@if ($item->scratch)
			{!! Form::label('scratch', 'Рекламные параметры заказа:', ['class' => 'control-label']) !!}
			<input disabled type="text" id="scratch" value="{{ $item->scratch }}" name="scratch" placeholder="Рекламные параметры заказа" class="form-control">
		@endif

		<br>
		{!! Form::label('status', 'Статус заказа:', ['class' => 'control-label']) !!}
		<select name="status">
			@foreach ($statuses as $status)
					<option value="{{ $status->id }}" @if ($status->id == $item->status) selected @endif >
						{{ $status->title }}
					</option>
		
			@endforeach
		</select>
		<br>

		<br>
		{!! Form::label('status', 'Статус оплаты:', ['class' => 'control-label']) !!}
		<select name="payment">
			<option value="0" @if ( $item->payment==0) selected @endif >
				Не оплачен
			</option>

			<option value="1" @if ($item->payment==1) selected @endif >
				Оплачен
			</option>

		</select>
		<br>

		{!! Form::label('page_keywords', 'Комментарий к заказу:', ['class' => 'control-label']) !!}
		<input type="text" value="{{ $item->comments }}" name="comments" placeholder="Комментарий к заказу" class="form-control">

		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		{!! Form::label('text', 'Товары:', ['class' => 'control-label']) !!}
		{!! Form::textarea('text', $item->items, ['class' => 'form-control']) !!}
		<br>

		<button type="submit" class="btn btn-success">
			Сохранить
		</button>
	{!! Form::close() !!}
@endsection