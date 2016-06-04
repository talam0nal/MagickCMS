@extends ('admin.layout')
@section ('content')
		@if ($action=='update')
			{!! Form::model('Good', [
				'method' => 'PATCH',
				'route' => ['admin.goods.update', $item->id]
			]) !!}
		@endif

		@if ($action=='store')
			{!! Form::open([
				'route' => 'admin.goods.store'
			]) !!}
		@endif

		<h1>
			Редактирование товара
		</h1>

		<label for="exampleInputEmail1">Название товара</label>
		<input type="text" value="{{ $item->title }}" name="title" placeholder="Название товара" class="form-control">

		

		<br>
		{!! Form::label('rubric', 'Рубрика:', ['class' => 'control-label']) !!}
		<select name="rubric">
			@foreach ($rubrics as $node)
				@if ($node->id !== $item->id)
					<option value="{{ $node->id }}" @if ($node->id == $item->rubric) selected @endif @if ($node->getLevel()<3 ) disabled @endif>
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

		
		{!! Form::label('url', 'URL:', ['class' => 'control-label']) !!}
		<input type="text" value="{{ $item->url }}" name="url" placeholder="URL" class="form-control">

		{!! Form::label('page_description', 'СЕО-описание страницы:', ['class' => 'control-label']) !!}
		<input type="text" id="d" value="{{ $item->page_description }}" name="page_description" placeholder="СЕО-описание  страницы" class="form-control">

		{!! Form::label('page_keywords', 'Ключевые слова страницы:', ['class' => 'control-label']) !!}
		<input type="text" value="{{ $item->page_keywords }}" name="page_keywords" placeholder="Ключевые слова страницы" class="form-control">

		{!! Form::label('description', 'Краткое описание товара:', ['class' => 'control-label']) !!}
		<textarea style="height: 150px;" type="text" name="description" placeholder="Краткое описание товара" class="form-control">{{ $item->description }}</textarea>

		{!! Form::label('price', 'Цена:', ['class' => 'control-label']) !!}
		<input type="text" value="{{ $item->price }}" name="price" placeholder="Цена" class="form-control">

		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		{!! Form::label('text', 'Описание товара:', ['class' => 'control-label']) !!}
		{!! Form::textarea('text', $item->text, ['class' => 'form-control']) !!}
		<br>
		{!! Form::label('text', 'Видимость товара', ['class' => 'control-label']) !!}
		<input type="checkbox" name="visible" value="1" @if ($item->visible or is_null($item->visible) ) checked @endif>
		<br><br>

		<button type="submit" class="btn btn-success">
			Сохранить
		</button>
	{!! Form::close() !!}


@endsection