@extends ('admin.layout')
@section ('content')
	@if ($action=='update')
		{!! Form::model('Rubric', [
			'method' => 'PATCH',
			'route' => ['admin.rubrics.update', $item->id]
		]) !!}
	@endif

	@if ($action=='store')
		{!! Form::open([
			'route' => 'admin.rubrics.store'
		]) !!}
	@endif

	<h1>
		Редактирование рубрики
	</h1>

	@if (count($errors) > 0)
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
	<label for="exampleInputEmail1">Название рубрики</label>
	<input type="text" value="{{ $item->title }}" name="title" placeholder="Название рубрики" class="form-control">
	<br>
	{!! Form::label('parent', 'Родительский раздел:', ['class' => 'control-label']) !!}
	<select name="parent">
		<option value="0" @if ($item->parent==0) selected @endif>Поместить в корень каталога</option>
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
	<br><br>
	<b>Используемое изображение:</b> {{ $item->picture }} @if (!$item->picture)  изображение отсутствует @endif<br>
	<br><br>

	{!! Form::label('url', 'URL рубрики:', ['class' => 'control-label']) !!}
	<input type="text" value="{{ $item->url }}" name="url" placeholder="URL рубрики" class="form-control">

	{!! Form::label('page_description', 'Описание рубрики:', ['class' => 'control-label']) !!}
	<input type="text" id="d" value="{{ $item->page_description }}" name="page_description" placeholder="Описание  рубрики" class="form-control">

	{!! Form::label('page_keywords', 'Ключевые слова рубрики:', ['class' => 'control-label']) !!}
	<input type="text" value="{{ $item->page_keywords }}" name="page_keywords" placeholder="Ключевые слова рубрики" class="form-control">

	{!! Form::label('description', 'Краткое описание рубрики:', ['class' => 'control-label']) !!}
	<textarea style="height: 150px;" type="text" name="description" placeholder="Краткое описание рубрики" class="form-control">{{ $item->description }}</textarea>

	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	{!! Form::label('text', 'Текст рубрики:', ['class' => 'control-label']) !!}
	{!! Form::textarea('text', $item->text, ['class' => 'form-control']) !!}
	<br>

		<br>
		{!! Form::label('text', 'Отображать на главной', ['class' => 'control-label']) !!}
		<input type="checkbox" name="in_index" value="1" @if ($item->in_index or is_null($item->in_index) ) checked @endif>
		<br><br>



	<button type="submit" class="btn btn-success">
		Сохранить
	</button>
	{!! Form::close() !!}
@endsection