@extends ('admin.layout')

@section ('content')
	<h1 data-route="settings">
		Просмотр журнала событий
	</h1>

	<table class="table">
		<tr>
			<td>
				Дата
			</td>
			<td>
				Тип
			</td>
			<td>
				Данные
			</td>
		</tr>

		@foreach ($items as $item)
			<tr>
				<td>
					{{ $item->created_at }}
				</td>
				<td>
					{{ $item->type }}
				</td>
				<td>
					
					{{ $item->data }}
					
				</td>
			</tr>
		@endforeach
	</table>
@endsection