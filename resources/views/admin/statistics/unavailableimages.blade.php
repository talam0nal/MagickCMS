@extends ('admin.layout')

@section ('content')
	<h1 data-route="pages">
		Элементы без изображений. Найдено {{ $count }}
	</h1>

	<table class="table">
		<tr>
			<td>
				Название
			</td>
			<td>
				Раздел каталога
			</td>
			<td>
				Артикул из 1С
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
					<a href="{{ $item->url }}" target="_blank">
						{{ $item->url }}
					</a>
				</td>
				<td>
					{{ $item->article }}
				</td>

			</tr>
		@endforeach
	</table>
@endsection
