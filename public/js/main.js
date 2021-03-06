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


/*    catalogItem = $('.product');
    catalogItem.height(catalogItem.width()*2);

    $(window).resize(function(){
        catalogItem.height(catalogItem.width()*2);
    });*/


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
            getBasketCounUurl = '/basket/ajax/count/';
            console.log(getBasketCounUurl)
            $.ajax({
                url: getBasketCounUurl,
                method:'post',
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if ($('#basket-count').length) {
                        $('#basket-count').html(response.count);
                    } else {
                        container = $('.header-basket').find('a');
                        console.log(container)
                        $('.header-basket').find('a').append($('<div>', {
                            'id': 'basket-count',
                            'text': response.count
                        }));
                    }

                }
            });

            new Toast({
                message: data.name+' ???????????????? ?? ??????????????',
                type: 'success',
                customButtons: [
                    {
                        text: '?????????????? ?? ??????????????',
                        onClick: function() {
                            window.location.href = '/basket/';
                        }
                    },
           /*         {
                        text: '???????????????? ??????????',
                        onClick: function() {
                            window.location.href = '/basket/place/';
                        }
                    },*/
                ]
            });
            event.target.innerText = '???????????????? ??????';
        }
    });
    return false;
});

function deleteOrder(orderId) {
    console.log(window.location.host)
    el = $('.cabinet .orders .item[data-order-id='+orderId+']');

    $.ajax({
        url: 'order/ajax/delete/'+orderId,
        method:'post',
        dataType: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function() {
            el.remove();
            if (!$('.cabinet .orders .item').length) {
                $('.cabinet .orders').append('?????????????? ??????');
            }
        }
    });
}

function getUrlParams(url = location.search){
    var regex = /[?&]([^=#]+)=([^&#]*)/g, params = {}, match;
    while(match = regex.exec(url)) {
        params[match[1]] = match[2];
    }
    return params;
}

function updateUserData(event, form)
{
    event.preventDefault()
    res = $(form).serializeArray()
    data = []
    $.each(res,function(){
        data[this.name] = this.value
    });
    console.log(data)
    $.ajax({
        url: '/user/ajax/update/'+data.user_id,
        method:'post',
        dataType: 'JSON',
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function() {
            new Toast({
                message: '???????????? ?? ???????????????????????? ????????????????',
                type: 'success',
            });
        }
    });

}
params = getUrlParams();
sort = params['sort'];
order = params['order'];
key = params['key'];
$('#catalog-sort-select option[value='+sort+']').prop('selected', true);
$('#catalog-order-select option[value='+order+']').prop('selected', true);
$('input[name=key]').val(key)
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

