@extends ('admin.layout')
@section ('content')
	@if ($action=='update')
		{!! Form::model('Article', [
			'method' => 'PATCH',
			'route' => ['admin.articles.update', $item->id],
			'files' => true
		]) !!}
	@endif

	@if ($action=='store')
		{!! Form::open([
			'route' => 'admin.articles.store',
			'files' => true
		]) !!}
	@endif

		<h1>
			Редактирование статьи
		</h1>

		<input type="file" name="cover">
		<br>
		@if ($item->cover)
			<img src="/uploads/articles/{{ $item->cover }}" style="width: 25%;">
		@endif
		<br>
		<div class="clearfix">
		</div>
		<br>


		<label for="exampleInputEmail1">Заголовок</label>
		<input type="text" value="{{ $item->title }}" name="title" placeholder="Заголовок" class="form-control">


		{!! Form::label('url', 'URL:', ['class' => 'control-label']) !!}
		<input type="text" value="{{ $item->url }}" name="url" placeholder="URL новости" class="form-control">


		{!! Form::label('page_description', 'Описание страницы:', ['class' => 'control-label']) !!}
		<input type="text" id="d" value="{{ $item->page_description }}" name="page_description" placeholder="Описание  страницы" class="form-control">

		{!! Form::label('page_keywords', 'Ключевые слова страницы:', ['class' => 'control-label']) !!}
		<input type="text" value="{{ $item->page_keywords }}" name="page_keywords" placeholder="Ключевые слова страницы" class="form-control">

		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		{!! Form::label('text', 'Текст:', ['class' => 'control-label']) !!}
		{!! Form::textarea('text', $item->text, ['class' => 'form-control']) !!}
		<br>
		
		{!! Form::label('text', 'Видимость', ['class' => 'control-label']) !!}
		<input type="checkbox" name="visible" value="1" @if ($item->visible or is_null($item->visible) ) checked @endif>
		<br>
		<button type="submit" class="btn btn-success">
			Сохранить
		</button>
	{!! Form::close() !!}
@endsection