@extends ('admin.layout')

@section ('content')
	<h1 data-route="news">
		Фото
	</h1>
	<form action="/admin/photos/{{ $object_type }}/{{ $object_id }}" enctype="multipart/form-data" method="post">
		<input type="file" name="files[]" multiple accept="image/*">
		<br><br>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<button type="submit" class="btn btn-success">
			Загрузить фото
		</button>
	</form>

	<style>
		.item {
			position: relative;

		}
		.item i {
			position: absolute;
			right: 30px;
			top: 10px;
			font-size: 40px;
			cursor: pointer;
		}
		.item i:hover {
			color: red;
		}
	</style>


	<div class="row">
		@foreach ($items as $item)
			<div class="col-md-3 item photo">
				<i data-id="{{ $item->id }}" class="fa fa-times" title="Удалить">
				</i>
				<img src="/uploads/photos/{{ $item->image}}">
			</div>
		@endforeach
	</div>
@endsection
