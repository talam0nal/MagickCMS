@extends ('admin.layout')
@section ('content')
	@if ($action=='update')
		{!! Form::model('Partner', [
			'method' => 'PATCH',
			'route' => ['admin.partners.update', $item->id],
			'files' => true
		]) !!}
	@endif

	@if ($action=='store')
		{!! Form::open([
			'route' => 'admin.partners.store',
			'files' => true
		]) !!}
	@endif

		<h1>
			Редактирование клиента
		</h1>

		<input type="file" name="cover">
		<br>
		@if ($item->cover)
			<img src="/uploads/partners/{{ $item->cover }}" style="width: 25%;">
		@endif
		<br>
		<div class="clearfix">
		</div>
		<br>
		<label for="exampleInputEmail1">Заголовок</label>
		<input type="text" value="{{ $item->title }}" name="title" placeholder="Заголовок" class="form-control">




		<input type="hidden" name="_token" value="{{ csrf_token() }}">



		{!! Form::label('text', 'Отображать на сайте', ['class' => 'control-label']) !!}
		<input type="checkbox" name="visible" value="1" @if ($item->visible or is_null($item->visible) ) checked @endif>
		<br>
		<button type="submit" class="btn btn-success">
			Сохранить
		</button>
	{!! Form::close() !!}
@endsection