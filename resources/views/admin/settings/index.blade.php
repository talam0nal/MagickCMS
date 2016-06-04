@extends ('admin.layout')

@section ('content')
	<h1 data-route="settings">
		Настройки сайта
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
					<a href="{{ route('admin.settings.edit', $item->id) }}">
						{{ $item->name }}
					</a>
				</td>
				<td>
					{{ $item->value }}
				</td>
				<td>
					<a href="{{ route('admin.settings.edit', $item->id) }}">
						Редактировать
					</a>
				</td>
			</tr>
		@endforeach
	</table>
@endsection