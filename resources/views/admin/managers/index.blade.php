@extends ('admin.layout')

@section ('content')
	<h1 data-route="managers">
		Менеджеры
	</h1>

	<a href="{{ route('admin.managers.create') }}" class="btn btn-success">
		Добавить менеджера
	</a>
	<table class="table">
		<tr>
			<td>
				Имя менеджера
			</td>
			<td>
				Email
			</td>
			<td>
				Ссылка
			</td>
			<td>
				Управление
			</td>
		</tr>

		@foreach ($items as $item)
			<tr>
				<td>
					<a href="{{ route('admin.managers.edit', $item->id) }}">
						{{ $item->name }}
					</a>
				</td>
				<td>
					{{ $item->email }}
				</td>
				<td>
					{{ $item->link }}
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
