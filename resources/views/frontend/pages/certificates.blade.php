@extends ('frontend.layout')
@section ('content')
	<div class="breadcrumbs">
		<nav class="container">
			<div class="col-xs-12">
				<a href="/">
					Главная 
				</a>
				<a href="#">
					{{ $page->title }}
				</a>
			</div>
		</nav>
	</div>

	
	<link rel="stylesheet" type="text/css" href="/css/vendor/lightbox.css">

	<main class="container">
		<article class="col-xs-12 col-sm-12 col-md-8">
			<h1>
				{{ $page->title }}
			</h1>

			<div class="subtitle">
				Вся наша продукция сертифицирована
			</div>
			<br>
			<br>

			<div class="description certificates">
				<div class="row">
					<div class="col-lg-4 col-sm-6">
						<a href="/uploads/pages/сертификатсоответствия.jpg" data-lightbox="roadtrip">
							<img src="/uploads/pages/сертификатсоответствия.jpg" style="width: 100%;">
						</a>
					</div>

					<div class="col-lg-4 col-sm-6">
						<a href="/uploads/pages/приложени1.jpg" data-lightbox="roadtrip">
							<img src="/uploads/pages/приложени1.jpg" style="width: 100%;">
						</a>
					</div>

					<div class="col-lg-4 col-sm-6">
						<a href="/uploads/pages/приложение2.jpg" data-lightbox="roadtrip">
							<img src="/uploads/pages/приложение2.jpg" style="width: 100%;">
						</a>
					</div>					

					<div class="col-lg-4 col-sm-6">
						<a href="/uploads/pages/приложение3.jpg" data-lightbox="roadtrip">
							<img src="/uploads/pages/приложение3.jpg" style="width: 100%;">
						</a>
					</div>		

					<div class="col-lg-4 col-sm-6">
						<a href="/uploads/pages/приложение4.jpg" data-lightbox="roadtrip">
							<img src="/uploads/pages/приложение4.jpg" style="width: 100%;">
						</a>
					</div>											

				</div>
			</div>
		</article>
	</main>
@endsection
