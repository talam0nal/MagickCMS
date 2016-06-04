$(function() {

	$('.modal-message i').click(function() {
		hideModalMessage();
	});

	if (location.hash=='#orderSuccess') {
		showModalMessage('Ваш заказ успешно оформлен. В ближайшее время мы свяжемся с Вами');
	}

	if (location.hash=='#feedbackSuccess') {
		showModalMessage('Ваше сообщение успешно отправлено. В ближайшее время мы свяжемся с Вами');
	}

	if (location.hash=='#profileSuccess') {
		showModalMessage('Ваш профайл успешно изменён');
	}

	if (location.hash=='#fail') {
		showModalMessage('Вы ввели неправильный логин/пароль. Пожалуйста, попробуйте снова');
	}

	if (location.hash=='#dealerSuccess') {
		showModalMessage('Ваша заявка успешно отправлена. Мы свяжемся с вами в ближайшее время. Статус заявки вы можете ослеживать в личном кабинете');
	}


	if (location.hash=='#registerSuccess') {
		showModalMessage('Вы успешно зарегистрированы на сайте. Воспользуйтесь формой авторизации, чтобы войти');
	}


	$('nav.dynamic-rubricator .item[data-level="1"] i').click(function() {

		$(this).parent().nextUntil('.item[data-level="1"]').not('.item[data-level="3"]').slideToggle();

		$(this).toggleClass('fa-minus');

		var visibility = $(this).parent().nextUntil('.item[data-level="1"]').not('.item[data-level="2"]').is(":visible");
		if (visibility) {
			$(this).parent().nextUntil('.item[data-level="1"]').not('.item[data-level="2"]').slideUp();
			$(this).parent().nextUntil('.item[data-level="1"]').add('i').removeClass('fa-minus');
		}
	});

	$('nav.dynamic-rubricator .item[data-level="2"] i').click(function() {

		$(this).toggleClass('fa-minus');
		$(this).parent().nextUntil('.item[data-level="2"]').slideToggle();


	});

	/*
		Добавление товара в корзину
	*/
	$('[data-product][data-action="add-to-cart"]').click(function(event) {
		id = $(this).attr('data-product');
		url = '/cart/add';
		token = $('[data-token]').attr('data-token');
		event.preventDefault();
		console.log('add to cart..');
		$.post(url, { id: id, '_token': token }, function(data) {
			totalGoodsInCart = data.total_count;
			totalCost = data.total_cost;
			$('.cart-link').show();
			$('.cart-link span').first().text(totalGoodsInCart);
			$('.cart-link span').eq(0).text(totalCost);
		});
		$(this).hide();
		$(this).next().show();
	});

	/*
		Удаление товара из корзины
	*/
	$('[data-product][data-action="remove-from-cart"]').click(function(event) {
		id = $(this).attr('data-product');
		url = '/cart/delete';
		token = $('[data-token]').attr('data-token');
		event.preventDefault();
		console.log('remove from..');
		$.post(url, { id: id, '_token': token }, function(data) {
			totalGoodsInCart = data.total_count;
			totalCost = data.total_cost;
			if (totalGoodsInCart==0) {
				$('.cart-link').hide();
			} else {
				$('.cart-link span').first().text(totalGoodsInCart);
				$('.cart-link span').eq(0).text(totalCost);
			}

		});
		$(this).hide();
		$(this).prev().show();
	});

	/*
		Удаление товара из списка на странице корзины
	*/
	$('.remove-from-list').click(function() {
		console.log(1);
		id = $(this).attr('data-product');
		url = '/cart/delete';
		el = $(this);
		$.post(url, { id: id, }, function(data) {
			totalGoodsInCart = data.total_count;
			totalCost = data.total_cost;
			el.parent().parent().remove();
			if (totalGoodsInCart==0) {
				$('.cart-link').hide();
				$('table.cart').after('<h1>В корзине нет товаров</h1><a href="/catalog" class="continue-shopping"><i class="fa fa-reply"></i>  Продолжить покупки</a>');
				$('table.cart, .make-order').remove();
			} else {

				$('.cart-link span').first().text(totalGoodsInCart);
				$('.cart-link span').eq(1).text(data.word);
				$('.cart-link span').eq(2).text(totalCost);
			}
		});

	});

	/*
		Пересчёт товаров на странице корзины при клике на кнопку
		"+" или "-"
	*/
	$('[data-product][data-action="recount"]').click(function() {
		count = $(this).attr('data-count');
		id = $(this).attr('data-product');
		initialCount = $('[data-count-product="'+id+'"]').text();
		if (count=='-1' && initialCount=="1") {
			return false;
		}
		url = '/cart/update';
		$.post(url, { id: id, 'count': count }, function(data) {
			totalGoodsInCart = data.total_count;
			totalCost = data.total_cost;
			if (totalGoodsInCart==0) {
				
			} else {
				$('[data-count-product="'+id+'"]').text(data.item_count);
				$('[data-total-price-product="'+id+'"]').text(data.item_cost);

				$('.cart-link span').first().text(totalGoodsInCart);
				$('.cart-link span').eq(1).text(data.word);
				$('.cart-link span').eq(2).text(totalCost);				
			}

		});
	});

	/*
		MixItUp плагин для категорий на главной
	*/
	first = $('[data-first]').attr('data-first');
	$('.row.products').mixItUp({
		selectors: {
			filter: '.filter button'
		},
		load: {
			filter: '.category-1'
		}
	});

	/*
		Инициализируем 2гис карту, если
		для неё есть контейнер
	*/
	mapContainer = $('#map').length;
	if (mapContainer) initMap();
	
	
	/*
		Вертикальный слайдер для фоток на странице товара
	*/
	var photosSlider = $('.product-photos .items').slick({
	  slidesToShow: 3,
	  arrows: false,
	  adaptiveHeight: true,
	  draggable: true,
	  pauseOnHover: false,
	  autoplay: false,
	  autoplaySpeed: 20003334343,
	  vertical: true,
	  infinite: true,
	  touchThreshold: 10,
		  responsive: [
			{
			  breakpoint: 965,
			  settings: {
				adaptiveHeight: true,
			  }
			},
			{
			  breakpoint: 488,
			  settings: {
				adaptiveHeight: true,
			  }
			}
		  ]
	});

	/*
		Горизонтальный слайдер промо акций
	*/
	var photosSlider = $('section.promotions').slick({
	  slidesToShow: 1,
	  arrows: false,
	  adaptiveHeight: true,
	  draggable: true,
	  pauseOnHover: false,
	  autoplay: true,
	  autoplaySpeed: 8000,
	  infinite: true,
	  touchThreshold: 10,
		  responsive: [
			{
			  breakpoint: 965,
			  settings: {
				adaptiveHeight: true,
			  }
			},
			{
			  breakpoint: 488,
			  settings: {
				adaptiveHeight: true,
			  }
			}
		  ]
	});

	/*
		Горизонтальный слайдер партнёров
	*/
	var photosSlider = $('.clients').slick({
	  slidesToShow: 5,
	  arrows: false,
	  adaptiveHeight: true,
	  draggable: true,
	  pauseOnHover: false,
	  autoplay: true,
	  autoplaySpeed: 4000,
	  infinite: true,
	  touchThreshold: 10,
		  responsive: [
			{
			  breakpoint: 965,
			  settings: {
				adaptiveHeight: true,
			  }
			},
			{
			  breakpoint: 488,
			  settings: {
				adaptiveHeight: true,
			  }
			}
		  ]
	});

	/*
		Управление вертикальным слайдером с фото на странице товара
	*/
	$('.product-photos .fa-chevron-up').click(function(e) {
		e.preventDefault();
		photosSlider.slick('slickNext');
	});

	$('.product-photos .fa-chevron-down').click(function(e) {
		e.preventDefault();
		photosSlider.slick('slickPrev');
	});

	/*
		Дропдаун фильтр в каталоге товаров
	*/
	$('.dropdown-filter .current-value, .dropdown-filter .arrow').click(function() {
		$(this)
			.parent()
			.find('.values')
			.slideToggle()
			.parent()
			.find('.fa')
			.toggleClass('fa-chevron-up fa-chevron-down')
			;
	});

	$('.dropdown-filter .value').click(function() {
		text = $(this).text();
		$(this)
			.parent()
			.parent()
			.find('.current-value')
			.text(text)
			.next()
			.slideToggle()
			.parent()
			.find('.fa')
			.toggleClass('fa-chevron-up fa-chevron-down')
			;
	});
});


/*
	Инициализируем 2Гис карту
*/
function initMap() {
	lon = $('[data-longitude]').data('longitude');
	lat = $('[data-latitude]').data('latitude');
	baloon = $('[data-baloon]').data('baloon');
	var map;
	DG.then(function() {
		map = DG.map('map',
		{
			center: [lat, lon],
			zoom: 17,
			scrollWheelZoom: false,
			touchZoom: false,
		});

		DG.marker([lat, lon]).addTo(map).bindPopup(baloon);
	});		
}

/*
	Показывает модальное окно
*/
function showModalMessage(text) {
	$('.modal-message span').text(text);
	$('#overlay, .modal-message').fadeIn();
}

/*
	Скрывает модальное окно
*/
function hideModalMessage() {
	$('#overlay, .modal-message').fadeOut();
}

$('a.phone').click(function(event) {
	event.preventDefault();
});