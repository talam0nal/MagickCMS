@extends ('admin.layout')

@section ('content')
	<h1 data-route="orders">
		Заказы 
	</h1>

	<table class="table">
		<tr>
			<td>
				Имя
			</td>
			<td>
				Адрес доставки
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
					<a href="{{ route('admin.orders.edit', $item->id) }}">
						{{ $item->name }}
					</a>
				</td>
				<td>
					{{ $item->address }}
				</td>
				<td>
					{{ $item->created_at }}
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
