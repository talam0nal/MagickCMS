@extends ('admin.layout')

@section ('content')
	<h1 data-route="pages">
		Рубрики без описаний. Найдено {{ $count }}
	</h1>

	<table class="table">
		<tr>
			<td>
				Название
			</td>
			<td>
				URL
			</td>
			<td>
				Артикул
			</td>

		</tr>

		@foreach ($items as $item)
			<tr>
				<td>
					<a href="{{ route('admin.rubrics.edit', $item->id) }}">
						{{ $item->title }}
					</a>
				</td>
				<td>
					<a href="{{ route('admin.rubrics.edit', $item->id) }}" target="_blank">
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
