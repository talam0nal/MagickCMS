@extends ('admin.layout')

@section ('content')
	<h1 data-route="promotions">
		Акции
	</h1>

	<a href="{{ route('admin.promotions.create') }}" class="btn btn-success">
		Добавить акцию
	</a>
	<table class="table">
		<tr>
			<td>
				Название акции
			</td>

			<td>
				Управление
			</td>
		</tr>

		@foreach ($items as $item)
			<tr>
				<td>
					<a href="{{ route('admin.promotions.edit', $item->id) }}">
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
