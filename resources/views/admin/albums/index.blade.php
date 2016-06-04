@extends ('admin.layout')

@section ('content')
	<h1 data-route="albums">
		Альбомы фотогалереи
	</h1>

	<a href="{{ route('admin.albums.create') }}" class="btn btn-success">
		Создать альбом
	</a>
	<table class="table">
		<tr>
			<td>
				Название
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
					<a href="{{ route('admin.albums.edit', $item->id) }}">
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
