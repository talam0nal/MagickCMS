@extends ('admin.layout')

@section ('content')
	<h1 data-route="contacts">
		Контакты
	</h1>

	<table class="table">
		<tr>
			<td>
				Параметр
			</td>
			<td>
				Значение
			</td>
			<td>
				Управление
			</td>
		</tr>

		@foreach ($items as $item)
			<tr>
				<td>
					<a href="{{ route('admin.contacts.edit', $item->id) }}">
						{{ $item->name }}
					</a>
				</td>
				<td>
					{{ $item->value }}
				</td>
				<td>
					<a href="{{ route('admin.contacts.edit', $item->id) }}">
						Редактировать
					</a>
				</td>
			</tr>
		@endforeach
	</table>
@endsection