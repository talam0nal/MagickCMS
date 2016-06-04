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
				{!! $page->page_description !!}
			</div>

            <div style="height: 20px;">
            </div>

            <form method="POST" method="POST" action="/dealer">
                {!! csrf_field() !!}

                <input type="hidden" name="id" value="{{ $id }}">
                <div class="input">
                    <input required type="text" id="email" name="email" value="{{ $email }}" style="padding-left: 170px;">
                    <label for="email" class="placeholder" style="width: 150px;">
                        <i class="fa fa-envelope">
                        </i>
                        E-mail
                    </label>
                </div>

                <div class="input">
                    <input required type="text" id="name" name="name" value="{{ $name }}" style="padding-left: 170px;">
                    <label for="name" class="placeholder" style="width: 150px;">
                        <i class="fa fa-user">
                        </i>
                        Имя
                    </label>
                </div>

                <div class="input">
                    <input required type="text" id="company" name="company" value="{{ $company }}" style="padding-left: 170px;">
                    <label for="company" class="placeholder" style="width: 150px;">
                        <i class="fa fa-user">
                        </i>
                        Компания
                    </label>
                </div>

                <div class="input">
                    <input type="text" id="phone" name="phone" value="{{ $phone }}" style="padding-left: 170px;">
                    <label for="phone" class="placeholder" style="width: 150px;">
                        <i class="fa fa-phone">
                        </i>
                        Телефон
                    </label>
                </div>

                <div class="input">
                    <input type="text" id="address" name="address" value="{{ $address }}" style="padding-left: 170px;">
                    <label for="address" class="placeholder" style="width: 150px;">
                        <i class="fa fa-truck">
                        </i>
                        Адрес
                    </label>
                </div>

                <button class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
                    <i class="fa fa-sign-in">
                    </i>
                    Отправить заявку
                </button>
            </form>
            <div class="clearfix">
            </div>
            {!! $page->text !!}

		</article>
	</section>
@endsection
