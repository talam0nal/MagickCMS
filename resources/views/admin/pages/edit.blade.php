@extends ('admin.layout')
@section ('content')
	@if ($action=='update')
		{!! Form::model('News', [
			'method' => 'PATCH',
			'route' => ['admin.pages.update', $item->id]
		]) !!}
	@endif

	@if ($action=='store')
		{!! Form::open([
			'route' => 'admin.pages.store'
		]) !!}
	@endif

	<h1>
		Редактирование страницы
	</h1>

	<label for="exampleInputEmail1">Заголовок страницы</label>
	<input type="text" value="{{ $item->title }}" name="title" placeholder="Заголовок страницы" class="form-control">
	{!! Form::label('url', 'URL страницы:', ['class' => 'control-label']) !!}
	<input type="text" value="{{ $item->url }}" name="url" placeholder="URL страницы" class="form-control">

	
	<br>
	{!! Form::label('parent', 'Родительская страница:', ['class' => 'control-label']) !!}
	<select name="parent">
		<option value="0" @if ($item->parent==0) selected @endif>Страница верхнего уровня</option>
		@foreach ($nodes as $node)
			@if ($node->id !== $item->id)
			  <option value="{{ $node->id }}" @if ($node->id === $item->parent) selected @endif>
			  	@if ($node->getLevel()==2 )
			  		--
			  	@endif
			  	@if ($node->getLevel()==3 )
			  		---
			  	@endif
			  	{{ $node->title }}
			  </option>
			@endif
		@endforeach
	</select>
	<br>


	{!! Form::label('page_description', 'Описание страницы:', ['class' => 'control-label']) !!}
	<input type="text" id="d" value="{{ $item->page_description }}" name="page_description" placeholder="Описание  страницы" class="form-control">

	{!! Form::label('page_keywords', 'Ключевые слова страницы:', ['class' => 'control-label']) !!}
	<input type="text" value="{{ $item->page_keywords }}" name="page_keywords" placeholder="Ключевые слова страницы" class="form-control">

	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	{!! Form::label('text', 'Текст страницы:', ['class' => 'control-label']) !!}
	{!! Form::textarea('text', $item->text, ['class' => 'form-control']) !!}
	<br>


	{!! Form::label('visible', 'Отображать на сайте', ['class' => 'control-label']) !!}
	<input type="checkbox" name="visible" value="1" @if ($item->visible or is_null($item->visible) ) checked @endif>
	<br>

	{!! Form::label('top_menu', 'Показывать в верхнем меню', ['class' => 'control-label']) !!}
	<input type="checkbox" name="top_menu" value="1" @if ($item->top_menu or is_null($item->visible) ) checked @endif>
	<br><br><br>

	<button type="submit" class="btn btn-success">
		Сохранить
	</button>
	{!! Form::close() !!}
@endsection