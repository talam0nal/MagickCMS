@extends ('admin.layout')

@section ('content')
	<h1 data-route="pages">
		Версия PHP: {{ phpversion() }}
	</h1>


@endsection
