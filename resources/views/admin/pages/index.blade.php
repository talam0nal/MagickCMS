@extends ('admin.layout')

@section ('content')
	<h1 data-route="pages">
		Страницы
	</h1>

	<a href="{{ route('admin.pages.create') }}" class="btn btn-success">
		Добавить новую страницу
	</a>
	<table class="table">
		<tr>
			<td>
				Название страницы
			</td>
			<td>
				URL страницы
			</td>
			<td>
				Управление
			</td>
		</tr>

		@foreach ($items as $item)
			<tr>
				<td>
					<a href="{{ route('admin.pages.edit', $item->id) }}" style="padding-left: {{ $item->getLevel()*10 }}px;display:inline-block;">
						{{ $item->title }}
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
