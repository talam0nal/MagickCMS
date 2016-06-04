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

            <a href="/history" class="dash-to-history">
                <i class="fa fa-history">
                </i>
                Посмотреть историю покупок
            </a>

            <br>

            @if ($dealerClaim && $type==1)
                <div class="dash-to-history" style="color: orange;">
                    <i class="fa fa-eye">
                    </i>
                    Ваша заявка о дилерстве находится на рассмотрении
                </div>
                @elseif ($type!==1)
                    <div class="dash-to-history" style="color: green;">
                        <i class="fa fa-star">
                        </i>
                        Вы являетесь дилером нашей компании
                    </div>
            @endif

            <div style="height: 20px;">
            </div>

            <form method="POST" action="/profile">
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

                <div class="input">
                    <input type="password" id="password" name="password" style="padding-left: 170px;">
                    <label for="password" class="placeholder" style="width: 150px;">
                        <i class="fa fa-key">
                        </i>
                        Новый пароль
                    </label>
                </div>

                <button class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
                    <i class="fa fa-sign-in">
                    </i>
                    Сохранить
                </button>
            </form>
                    
		</article>
	</section>
@endsection
