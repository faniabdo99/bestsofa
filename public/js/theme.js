function ShowNoto(className,text){
    //Create The Element
    $('body').append('<div class="noto"></div>');
    $('.noto').html(text).addClass(className).fadeIn('fast').delay(3000).fadeOut('fast');
}
function makeid(length) {
    var result= '';
    var characters= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
       result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
 }
;(function($){
    "use strict"
	var nav_offset_top = $('header').height() + 50;
    /*-------------------------------------------------------------------------------
	  Navbar
	-------------------------------------------------------------------------------*/

	//* Navbar Fixed
    function navbarFixed(){
        if ( $('.header_area').length ){
            $(window).scroll(function() {
                var scroll = $(window).scrollTop();
                if (scroll >= nav_offset_top ) {
                    $(".header_area").addClass("navbar_fixed");
                } else {
                    $(".header_area").removeClass("navbar_fixed");
                }
            });
        };
    };
    navbarFixed();


	/*----------------------------------------------------*/
    /*  Parallax Effect js
    /*----------------------------------------------------*/
	function parallaxEffect() {
    	$('.bg-parallax').parallax();
	}
	parallaxEffect();

	var dropToggle = $('.widgets_inner .list li').has('ul').children('a');
    dropToggle.on('click', function() {
        dropToggle.not(this).closest('li').find('ul').slideUp(200);
        $(this).closest('li').children('ul').slideToggle(200);
        return false;
    });

    function mailChimp(){
        $('#mc_embed_signup').find('form').ajaxChimp();
    }
    mailChimp();

	/*----------------------------------------------------*/
    /*  Simple LightBox js
    /*----------------------------------------------------*/
    $('.imageGallery1 .light').simpleLightbox();

	$('.counter').counterUp({
		delay: 10,
		time: 1000
	});

    function product_slider(){
        if ( $('.feature_p_slider').length ){
            $('.feature_p_slider').owlCarousel({
                loop:true,
                margin: 30,
                items: 4,
                nav: false,
                autoplay: false,
                smartSpeed: 1500,
                dots:true,
//				navContainer: '.testimonials_area',
//                navText: ['<i class="lnr lnr-arrow-up"></i>','<i class="lnr lnr-arrow-down"></i>'],
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                    },
                    360: {
                        items: 2,
                    },
                    576: {
                        items: 3,
                    },
                    768: {
                        items: 4,
                    },
                }
            })
        }
    }
    product_slider();

	/*----------------------------------------------------*/
    /*  Clients Slider
    /*----------------------------------------------------*/
    function clients_slider(){
        if ( $('.clients_slider').length ){
            $('.clients_slider').owlCarousel({
                loop:true,
                margin: 30,
                items: 5,
                nav: false,
                autoplay: false,
                smartSpeed: 1500,
                dots:false,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                    },
                    400: {
                        items: 2,
                    },
                    575: {
                        items: 3,
                    },
                    768: {
                        items: 4,
                    },
                    992: {
                        items: 5,
                    }
                }
            })
        }
    }
    clients_slider();

    /*----------------------------------------------------*/
    /*  Hero Section Slide
    /*----------------------------------------------------*/
    function hero_section_slider(){
        $('.full-width-carousel').owlCarousel({
            loop:true,
            items: 1,
            autoplay: true,
            smartSpeed: 1500,
            stopOnHover: true,
            nav: true,
            navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
        });
    }
    hero_section_slider();
	/*----------------------------------------------------*/
    /*  Jquery Ui slider js
    /*----------------------------------------------------*/
	$( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 500,
      values: [ 10, 500 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 )+
      "   $" + $( "#slider-range" ).slider( "values", 1 ) );


	/*----------------------------------------------------*/
    /*  Google map js
    /*----------------------------------------------------*/

    if ( $('#mapBox').length ){
        var $lat = $('#mapBox').data('lat');
        var $lon = $('#mapBox').data('lon');
        var $zoom = $('#mapBox').data('zoom');
        var $marker = $('#mapBox').data('marker');
        var $info = $('#mapBox').data('info');
        var $markerLat = $('#mapBox').data('mlat');
        var $markerLon = $('#mapBox').data('mlon');
        var map = new GMaps({
        el: '#mapBox',
        lat: $lat,
        lng: $lon,
        scrollwheel: false,
        scaleControl: true,
        streetViewControl: false,
        panControl: true,
        disableDoubleClickZoom: true,
        mapTypeControl: false,
        zoom: $zoom,
            styles: [
                {
                    "featureType": "water",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#dcdfe6"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "stylers": [
                        {
                            "color": "#808080"
                        },
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#dcdfe6"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#ffffff"
                        },
                        {
                            "weight": 1.8
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#d7d7d7"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#ebebeb"
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#a7a7a7"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#efefef"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#696969"
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#737373"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "labels",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#d6d6d6"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {},
                {
                    "featureType": "poi",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#dadada"
                        }
                    ]
                }
            ]
        });
    }


})(jQuery)

//================== Custom Jquery and Stuff ==========================
// $.ajaxSetup({
//     headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') }
// });
//Send the activation link to the user , this action comes from the profile page in case the use account is not active.
$('#send_activate_link').click(function(){
    var ActionRoute = $(this).attr('action-route');
    var UserId = $(this).attr('user-id');
    $.ajax({
        url : ActionRoute,
        method: 'POST',
        data : {'id':UserId},
        success : function(response){
            ShowNoto('noto-success' , response , 'Success');
        },
        error: function(response){
            ShowNoto('noto-danger' , response , 'Error');
        },
    });
});
//Ask Question about a Product
$("#submit-ask-question-about-product-form").click(function(e){
    e.preventDefault();
    var ActionRoute = $(this).attr('action-route');
    var FormData = $(this).parent().parent().serialize();
    $.ajax({
        url : ActionRoute,
        method: 'POST',
        data : FormData,
        success : function(response){
            ShowNoto('noto-success' , response , 'Success');
        },
        error: function(response){
            ShowNoto('noto-danger' , response.responseJSON[0] , 'Error');
        },
    });
});
//Toggle Navbr Sidebar
//Open
$('.open-sidebar').click(function(){
    $(this).parent().next('.sidebar-item').fadeIn('fast').css('right' , 0);
})
//Close
$('.close-sidebar').click(function(){
    $(this).parent().parent().css('right' , '-25%').fadeOut('fast');
});
//Like Items
$('.like_item').click(function(){
    $(this).toggleClass('bg-danger').toggleClass('text-white');
    var ProductId = $(this).attr('product-id');
    var UserId = $('meta[name=user_id]').attr("content");
    $.ajax({
        'method':'post',
        'url' : $('meta[name=base_url]').attr('content') + '/api/like-item',
        'data' : {
            'user_id' : UserId ,
            'product_id' : ProductId
        },
        success: function(response){
            ShowNoto('noto-success' , response , 'Success');
        },
        error: function (response){
            ShowNoto('noto-danger' , response.responseText , 'Error');
        }
    })
});
//Add to Cart
//Set the User Global Cookies
var GuestId = makeid(10);
if(Cookies.get('guest_id') == undefined){
    Cookies.set('guest_id', GuestId, { expires: 365 });
}
$('.add-to-cart').click(function(){
    var ProductId = $(this).data('id');
    var Quantity = $(this).parent().prev().find('.qty').val();
    var UserId = $('meta[name=user_id]').attr('content');
    $.ajax({
        'method':'get',
        'url' : $('meta[name=base_url]').attr('content') + '/api/add-item-to-cart',
        'data' : {
            '_token' : $('meta[name=csrf_token]').attr('content'),
            'product_id' : ProductId,
            'user_id' : UserId,
            'qty' : Quantity,
        },
        success: function(response){
            ShowNoto('noto-success' , response , 'Success');
        },
        error: function (response){
            ShowNoto('noto-danger' , response.responseText , 'Error');
        }
    })
});
$('.cart-qty').keydown(function (e) {
    if(e.keyCode == 38 || e.keyCode == 40){
        e.preventDefault();
        return false;
    }
});
$('.cart-qty').change(function(){
    var ActionRoute = $(this).data('target');
    var ItemId = $(this).data('id');
    var UserId = $(this).data('user');
    var TheItem = $(this);
    var ItemValue = $(this).val();
    $.ajax({
        'method':'post',
        'url' : ActionRoute,
        'data' : {
            'item_id' : ItemId,
            'qty' : ItemValue,
            'user_id' : UserId,
        },
        success: function(response){
            //Get the refresh icon and show it
            TheItem.parent().parent().next('td').find('.update-cart-icon').removeClass('d-none');
            ShowNoto('noto-success' , response , 'Success');
            $('.update-cart-btn').html('Update Cart Data <i class="fas fa-circle text-success"></i>');
        },
        error: function (response){
            ShowNoto('noto-danger' , response.responseText , 'Error');
        }
    });
});
$('#calculate-shipping-cost').click(function(){
  var ActionRoute = $('meta[name=base_url]').attr('content') + '/api/calculate-shipping-cost';
  var CountryName = $('select[name="country_name"]').val();
  var Weight  = $('input[name="order_weight"]').val();
  var CartTax = $('input[name="cart_tax_avg"]').val();
  $.ajax({
      'method':'post',
      'url' : ActionRoute,
      'data' : {
          'country_name' : CountryName,
          'order_weight' : Weight,
          'cart_tax_avg' : CartTax
      },
      success: function(response){
          $('#shipping-cost-res').removeClass('d-none').html(response);
      },
      error: function (response){
        $('#shipping-cost-res').addClass('d-none').html(response);
          ShowNoto('noto-danger' , response.responseText , 'Error');
      }
  });
});
