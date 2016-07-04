@extends ('frontend.layout')
@section ('content')
	<div class="breadcrumbs">
		<nav class="container">
			<div class="col-xs-12">
				<a href="/">
					Главная
				</a>
				<a href="{{ route('catalog.index', false) }}">
					Каталог 
				</a>
				@foreach ($breadcrumbs as $item)
					<a href="{{ $item->url }}">
						{{ $item->text }}
					</a>
				@endforeach
			</div>
		</nav>


		<script>
			console.log('index.blade.php');
		</script>
	</div>

	<main class="container">
		<div class="col-md-8">
			<h1>
				{{ $page->title }}
			</h1>
			<div class="subtitle" style="margin-bottom:30px;">
				{!! $page->text !!}
			</div>



			@foreach ($currentRubrics as $item)
				<h2>
					{{ $item->title }}
				</h2>
				

				<div class="row products">
					@foreach ($item->goods as $good)
						<div class="col-md-4 col-sm-6">
							<a href="{{ $good->url }}" style="background-image: url('{{ $good->picture }}')" class="item">
								<h3>
									{{ $good->title }}
								</h3>

								<div class="price">
									{{ $good->price }}
								</div>

								<div class="description">
									{!! $good->description !!}
								</div>
								<div class="col-xs-12">
									<button data-basket="{{ $item->in_basket }}" data-product="{{ $item->id}}" data-action="add-to-cart">
										В корзину
									</button>

									<button data-basket="{{ $item->in_basket }}" data-product="{{ $item->id}}" data-action="remove-from-cart">
										Убрать из корзины
									</button>
								</div>
								<img src="https://dummyimage.com/262x262/e2e2e2/000000" alt="title">
							</a>
						</div>
					@endforeach
				</div>

			@endforeach

		</div>

		<aside class="col-md-4">
			@include ('frontend.catalog.rubricator')
		</aside>
	</main>
@endsection