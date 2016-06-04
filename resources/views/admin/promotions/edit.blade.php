@extends ('admin.layout')
@section ('content')
	@if ($action=='update')
		{!! Form::model('Promotion', [
			'method' => 'PATCH',
			'route' => ['admin.promotions.update', $item->id],
			'files' => true
		]) !!}
	@endif

	@if ($action=='store')
		{!! Form::open([
			'route' => 'admin.promotions.store',
			'files' => true
		]) !!}
	@endif

		<h1>
			Редактирование акции
		</h1>

		<input type="file" name="cover">
		<br>
		@if ($item->cover)
			<img src="/uploads/promotions/{{ $item->cover }}" style="width: 25%;">
		@endif
		<br>
		<div class="clearfix">
		</div>
		<br>
		<label for="exampleInputEmail1">Заголовок акции</label>
		<input type="text" value="{{ $item->title }}" name="title" placeholder="Заголовок акции" class="form-control">

		<label for="exampleInputEmail1">Текст кнопки</label>
		<input type="text" value="{{ $item->button_text }}" name="button_text" placeholder="Текст кнопки" class="form-control">

		<label for="exampleInputEmail1">Ссылка</label>
		<input type="text" value="{{ $item->link }}" name="link" placeholder="Ссылка" class="form-control">



		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		{!! Form::label('text', 'Текст:', ['class' => 'control-label']) !!}
		{!! Form::textarea('text', $item->text, ['class' => 'form-control']) !!}
		<br>

		{!! Form::label('text', 'Отображать на сайте', ['class' => 'control-label']) !!}
		<input type="checkbox" name="visible" value="1" @if ($item->visible or is_null($item->visible) ) checked @endif>
		<br>
		<button type="submit" class="btn btn-success">
			Сохранить
		</button>
	{!! Form::close() !!}
@endsection