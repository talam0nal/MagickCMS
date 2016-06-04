@extends ('admin.layout')

@section ('content')
	<h1>
		Импорт данных из XML
	</h1>
	@if ( isset($message))
		<h3 style="color: green;">
			Данные успешно обновлены
		</h3>

		<br>
		<a href="/">
			Вернуться на сайт
		</a>
		<br>
		<br>
		<a href="{{ route('admin.goods.index') }}">
			Перейти к редактированию товаров
		</a>
		<br><br>
		<a href="/admin/xml">
			Загрузить файл заново
		</a>

	@else
		<form action="/admin/xml" method="post" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="file" name="file" accept="text/xml">
			<br>
			<button class="btn btn-success"> 
				<i class="fa fa-upload">
				</i>
				Загрузить
			</button>
		</form>	 
	@endif

@endsection