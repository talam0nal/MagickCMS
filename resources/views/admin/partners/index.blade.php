@extends ('admin.layout')

@section ('content')
	<h1 data-route="partners">
		Партнёры
	</h1>

	<a href="{{ route('admin.partners.create') }}" class="btn btn-success">
		Добавить
	</a>
	<table class="table">
		<tr>
			<td>
				Название
			</td>

			<td>
				Управление
			</td>
		</tr>

		@foreach ($items as $item)
			<tr>
				<td>
					<a href="{{ route('admin.partners.edit', $item->id) }}">
						{{ $item->title }}
					</a>
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
