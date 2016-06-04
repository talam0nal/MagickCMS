@extends ('admin.layout')

@section ('content')
	<h1 data-route="articles">
		Статьи
	</h1>

	<a href="{{ route('admin.articles.create') }}" class="btn btn-success">
		Добавить статью
	</a>
	<table class="table">
		<tr>
			<td>
				Заголовок
			</td>
			<td>
				URL
			</td>

			<td>
				Управление
			</td>
		</tr>

		@foreach ($items as $item)
			<tr>
				<td>
					<a href="{{ route('admin.articles.edit', $item->id) }}">
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
