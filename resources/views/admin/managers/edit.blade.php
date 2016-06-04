@extends ('admin.layout')
@section ('content')
	@if ($action=='update')
		{!! Form::model('News', [
			'method' => 'PATCH',
			'route' => ['admin.managers.update', $item->id],
			'files' => true
		]) !!}
	@endif

	@if ($action=='store')
		{!! Form::open([
			'route' => 'admin.managers.store',
			'files' => true
		]) !!}
	@endif

		<h1>
			Редактирование менеджера
		</h1>

		<label for="exampleInputEmail1">Имя</label>
		<input type="text" value="{{ $item->name }}" name="name" placeholder="Имя" class="form-control">

		<label for="exampleInputEmail1">E-mail</label>
		<input type="text" value="{{ $item->email }}" name="email" placeholder="Email" class="form-control">

		<label for="exampleInputEmail1">Рекламная ссылка</label>
		<input type="text" value="{{ $item->link }}" name="link" placeholder="Рекламная ссылка" class="form-control">

		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		
		<br>


		<button type="submit" class="btn btn-success">
			Сохранить
		</button>
	{!! Form::close() !!}
@endsection