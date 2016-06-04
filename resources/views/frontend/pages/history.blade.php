@extends ('frontend.layout')
@section ('content')
	<div class="breadcrumbs">
		<nav class="container">
			<div class="col-xs-12">
				<a href="/profile">
					Личный кабинет  
				</a>
				<a href="#">
					{{ $page->title }}
				</a>
			</div>
		</nav>
	</div>

	<section class="container contacts">
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h1>
				{{ $page->title }}
			</h1>
			<div class="description">
				{!! $page->text !!}
			</div>

            <div style="height: 20px;">
            </div>
        @if (count($history) )
            <table class="table" style="color: #000">
                <tr>

                    <td>
                        <b>Номер заказа</b>
                    </td>

                    <td style="width: 180px;">
                        <b>Дата покупки</b>
                    </td>

                    <td>
                        <b>Адрес доставки</b>
                    </td>

                    <td style="width: 200px;">
                        <b>Список товаров</b>
                    </td>

                    <td>
                        <b>Статус заказа</b>
                    </td>

                    <td>
                        <b>Статус оплаты</b>
                    </td>

                </tr>

                @foreach ($history as $order)
                    <tr>

                        <td>
                            {{ $order->id }}
                        </td>

                        <td>
                            {{ $order->created_at }}
                        </td>

                        <td>
                            {{ $order->address }}
                        </td>

                        <td>
                            {!! $order->items !!}
                        </td>

                        <td>
                            <i class="fa {{ $order->icon }}"></i>
                            <b>{{ $order->statusText }}</b>
                        </td>

                        <td>
                            @if ($order->payment)
                            <div style="color: green;">
                                <b><i class="fa fa-check"></i> Оплачен</b>
                            </div>
                            @else
                                <div style="color: orange;">
                                    <a href="/payment" style="color: orange;">
                                        <i class="fa fa-credit-card"></i>
                                        Оплатить
                                    </a>
                                </div>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </table>
            @else
                <h2>
                    Ваша история покупок пуста
                </h2>
        @endif

                    
		</article>
	</section>
@endsection
