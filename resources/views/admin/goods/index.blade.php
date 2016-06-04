@extends ('admin.layout')

@section ('content')
	<h1 data-route="goods">
		Товары ({{ $count }})
	</h1>

	<a href="{{ route('admin.goods.create') }}" class="btn btn-success">
		Добавить новый товар
	</a>
	<table class="table table-hover">
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
					<a href="{{ route('admin.goods.edit', $item->id) }}">
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