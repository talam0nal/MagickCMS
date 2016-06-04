@extends ('admin.layout')

@section ('content')
	<h1 data-route="rubrics">
		Рубрики
	</h1>

	<a href="{{ route('admin.rubrics.create') }}" class="btn btn-success">
		Добавить новую рубрику
	</a>
	<table class="table table-hover">
		<tr>
			<td>
				Название рубрики
			</td>
			<td>
				URL рубрики
			</td>
			<td>
				Управление
			</td>
		</tr>

		@foreach ($items as $item)
			<tr @if ($item->getLevel()==1) class="success" @endif>
				<td class=" ">
					<a href="{{ route('admin.rubrics.edit', $item->id) }}" style="padding-left: {{ $item->getLevel()*10 }}px;display:inline-block;">
						{{ $item->title }} @if ($item->getLevel()==3 && $item->goodsInCategory) ({{ $item->goodsInCategory }}) @endif
					</a>
				</td>
				<td>
					{{ $item->url }}
				</td>
				<td>
					<a href="Удалить" data-action="delete" data-id="{{ $item->id }}">
						Удалить
					</a>
				</td>
			</tr>
		@endforeach
	</table>
@endsection
