(function($) {
	"use strict"

	// Mobile Nav toggle
	$('.menu-toggle > a').on('click', function (e) {
		e.preventDefault();
		$('#responsive-nav').toggleClass('active');
	})

	// Fix cart dropdown from closing
	$('.cart-dropdown').on('click', function (e) {
		e.stopPropagation();
	});

	/////////////////////////////////////////

	// Products Slick
	$('.products-slick').each(function() {
		var $this = $(this),
				$nav = $this.attr('data-nav');

		$this.slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: true,
			infinite: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
			responsive: [{
	        breakpoint: 991,
	        settings: {
	          slidesToShow: 2,
	          slidesToScroll: 1,
	        }
	      },
	      {
	        breakpoint: 480,
	        settings: {
	          slidesToShow: 1,
	          slidesToScroll: 1,
	        }
	      },
	    ]
		});
	});

    // Catalog Ajax
/*    $('#catalog-submit-button').on('click', function (e) {
        $.ajax({
            url: "/json-catalog/",
            method: 'POST',
            data: {
                category:5
            },
        }).done(function(json) {
            alert(json);
        });
    });*/
	// Products Widget Slick
	$('.products-widget-slick').each(function() {
		var $this = $(this),
				$nav = $this.attr('data-nav');

		$this.slick({
			infinite: true,
			autoplay: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
		});
	});

	/////////////////////////////////////////

	// Product Main img Slick
	// $('#product-main-img').slick({
  //   infinite: true,
  //   speed: 300,
  //   dots: false,
  //   arrows: true,
  //   fade: true,
  //   asNavFor: '#product-imgs',
  // });

	// Product imgs Slick
  $('#product-imgs').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    centerMode: true,
    focusOnSelect: true,
		centerPadding: 0,
		vertical: true,
    asNavFor: '#product-main-img',
		responsive: [{
        breakpoint: 991,
        settings: {
					vertical: false,
					arrows: false,
					dots: true,
        }
      },
    ]
  });

	// Product img zoom
	var zoomMainProduct = document.getElementById('product-main-img');
	if (zoomMainProduct) {
		$('#product-main-img .product-preview').zoom();
	}

	/////////////////////////////////////////

	// Input number
	$('.input-number').each(function() {
		var $this = $(this),
		$input = $this.find('input[type="number"]'),
		up = $this.find('.qty-up'),
		down = $this.find('.qty-down');

		down.on('click', function () {
			var value = parseInt($input.val()) - 1;
			value = value < 1 ? 1 : value;
			$input.val(value);
			$input.change();
			updatePriceSlider($this , value)
		})

		up.on('click', function () {
			var value = parseInt($input.val()) + 1;
			$input.val(value);
			$input.change();
			updatePriceSlider($this , value)
		})
	});

	// var priceInputMax = document.getElementById('price-max'),
	// 		priceInputMin = document.getElementById('price-min');
    //
	// priceInputMax.addEventListener('change', function(){
	// 	updatePriceSlider($(this).parent() , this.value)
	// });
    //
	// priceInputMin.addEventListener('change', function(){
	// 	updatePriceSlider($(this).parent() , this.value)
	// });

	function updatePriceSlider(elem , value) {
		if ( elem.hasClass('price-min') ) {
			console.log('min')
			priceSlider.noUiSlider.set([value, null]);
		} else if ( elem.hasClass('price-max')) {
			console.log('max')
			priceSlider.noUiSlider.set([null, value]);
		}
	}

	// Price Slider
	var priceSlider = document.getElementById('price-slider');
	if (priceSlider) {
		noUiSlider.create(priceSlider, {
			start: [1, 999],
			connect: true,
			step: 1,
			range: {
				'min': 1,
				'max': 999
			}
		});

		priceSlider.noUiSlider.on('update', function( values, handle ) {
			var value = values[handle];
			handle ? priceInputMax.value = value : priceInputMin.value = value
		});
	}

    // main page slick slider
    $('.category-slider').slick({
        dots: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 5000,
    });






})(jQuery);
$('input[name=rating]').click(function (event) {
    $('input[name=score]').val(event.target.value);
});


$('.add-to-cart-btn').click(function (event){
    event.preventDefault();
    $.ajax({
        url: $(this).attr('data-href'),
        method:'post',
        dataType: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            $.ajax({
                url: '/basket/ajax/count/',
                method:'post',
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#basket-count').html(response.count);
                }
            });

            new Toast({
                title: data.name,
                text: 'Добавлен в корзину',
                theme: 'success',
                autohide: true,
                interval: 10000
            });
            event.target.innerText = 'Добавить еще';
        }
    });
    return false;
});


function getUrlParams(url = location.search){
    var regex = /[?&]([^=#]+)=([^&#]*)/g, params = {}, match;
    while(match = regex.exec(url)) {
        params[match[1]] = match[2];
    }
    return params;
}
params = getUrlParams();
sort = params['sort'];
order = params['order'];
$('#catalog-sort-select option[value='+sort+']').prop('selected', true);
$('#catalog-order-select option[value='+order+']').prop('selected', true);
$('#catalog-filter-clean').click(function (event){
    $('#catalog-sort-select option[value=0]').prop('selected', true);
    $('#catalog-order-select option[value=0]').prop('selected', true);
    window.location.href=window.location.href.split('?')[0]
});

$('#delivery').change(function (event) {
    changedValue = event.target.value;
    if (changedValue === 'pickup') {
        $('#deliveryPointSelect').removeClass('display-none');
        $('#adressInput').addClass('display-none');
    } else if (changedValue === 'delivery') {
        $('#adressInput').removeClass('display-none');
        $('#deliveryPointSelect').addClass('display-none');
    }
});

$('input[type=radio][name=delivery]').change(function(event) {
    changedValue = event.target.value;
    if (changedValue === 'pickup') {
        $('#deliveryPointSelect').removeClass('display-none');
        $('#adressInput').addClass('display-none');

        $('select[name=delivery_point_id]').attr('required', true);
        $('input[name=adress]').removeAttr('required');
    }
    else if (changedValue === 'delivery') {
        $('#deliveryPointSelect').addClass('display-none');
        $('#adressInput').removeClass('display-none');

        $('input[name=adress]').attr('required', true);
        $('select[name=delivery_point_id]').removeAttr('required');
    }
});
