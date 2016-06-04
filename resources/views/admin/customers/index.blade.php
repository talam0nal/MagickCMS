@extends ('admin.layout')

@section ('content')
	<h1 data-route="customers">
		Покупатели
	</h1>

	<table class="table">
		<tr>
			<td>
				Имя/Организация
			</td>
			<td>
				Email
			</td>
			<td>
				Телефон
			</td>
			<td>
				Адрес
			</td>
			<td>
				Управление
			</td>

		</tr>

		@foreach ($items as $item)
			<tr>
				<td>
					<a href="{{ route('admin.customers.edit', $item->id) }}">
						{{ $item->name }}
					</a>
				</td>
				<td>
					{{ $item->email }}
				</td>
				<td>
					{{ $item->phone }}
				</td>
				<td>
					{{ $item->address }}
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
