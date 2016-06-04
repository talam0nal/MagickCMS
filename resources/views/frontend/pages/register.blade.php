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

	<section class="container contacts">
		<article class="col-xs-7 col-sm-7 col-md-8 col-lg-6">
			<h1>
				{{ $page->title }}
			</h1>
			<div class="description">
				{!! $page->text !!}
			</div>

            <div style="height: 20px;">
            </div>

            <form role="form" method="POST" action="/register">
                {!! csrf_field() !!}

                <div class="input">
                    <input required type="text" id="email" name="email" style="padding-left: 170px;">
                    <label for="email" class="placeholder" style="width: 150px;">
                        <i class="fa fa-envelope">
                        </i>
                        E-mail
                    </label>
                </div>

                <div class="input">
                    <input required type="password" id="password" name="password" style="padding-left: 170px;">
                    <label for="password" class="placeholder" style="width: 150px;">
                        <i class="fa fa-key">
                        </i>
                        Пароль
                    </label>
                </div>

                <button class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <i class="fa fa-user-plus">
                    </i>
                    Зарегистрироваться
                </button>
            </form>
                    
		</article>
	</section>
@endsection
