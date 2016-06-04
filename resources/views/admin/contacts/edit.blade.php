@extends ('admin.layout')
@section ('content')
	@if ($action=='update')
		{!! Form::model('Contact', [
			'method' => 'PATCH',
			'route' => ['admin.contacts.update', $item->id]
		]) !!}
	@endif

	@if ($action=='store')
		{!! Form::open([
			'route' => 'admin.contacts.store'
		]) !!}
	@endif

	<h1>
		Изменение контактной информации
	</h1>

		<label for="exampleInputEmail1">Значение параметра</label>
		<input type="text" value="{{ $item->value }}" name="value" placeholder="Значение параметра" class="form-control">
		<br>
		<button type="submit" class="btn btn-success">
			Сохранить
		</button>
	{!! Form::close() !!}
@endsection