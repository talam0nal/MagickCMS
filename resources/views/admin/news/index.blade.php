@extends ('admin.layout')

@section ('content')
	<h1 data-route="news">
		Новости
	</h1>

	<a href="{{ route('admin.news.create') }}" class="btn btn-success">
		Добавить новость
	</a>
	<table class="table">
		<tr>
			<td>
				Название новости
			</td>
			<td>
				URL новости
			</td>
			<td>
				Дата
			</td>
			<td>
				Управление
			</td>
		</tr>

		@foreach ($items as $item)
			<tr>
				<td>
					<a href="{{ route('admin.news.edit', $item->id) }}">
						{{ $item->title }}
					</a>
				</td>
				<td>
					{{ $item->url }}
				</td>
				<td>
					{{ $item->date }}
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
