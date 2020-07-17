var _window = $(window),
  _doc = $(document);
/**
 * Get product link for customize by category id
 * */
let generate_customize_link = ( cat_id, customize_btn ) => {
  let ajax_data = {
    action : 'get_product_link_by_cat_id',
    nonce_rest : wpApi.nonce_rest,
    product_cat_id : cat_id
  };
  $.ajax( {
    url: wpApi.ajaxurl,
    method: 'POST',
    data: ajax_data,
    success: function( res ) {
      if ( res ) {
        customize_btn.attr('href', res);
        sessionStorage.setItem("is_customized", false);
      }
    }
  });
};

let make_active_list_gallery_slide = ( slider, customize_btn ) => {
  let last_slide = slider.find('.gallery-item.last-slide'),
    last_slide_cat_id = last_slide.data('cat_id'),
    last_slide_idx = last_slide.data('slick-index');
  slider.slick( 'slickGoTo', last_slide_idx );
  _doc.find('.kt-front-cat-list .list-item').map((idx, el) => {
    if ( $(el).data('cat_id') === last_slide_cat_id ) {
      _doc.find('.kt-front-cat-list .list-item').removeClass('is_active');
      $(el).addClass('is_active');
    }
  });
  //  Get product link for customize by category id
  generate_customize_link( last_slide_cat_id, customize_btn );
};

_doc.ready(function () {

  /* Product Front Slider */
  var choose_section = _doc.find('.kt-section__choose-product'),
    customize_btn = choose_section.find('.kt-product-to-customize'),
    product_cat_slider_wrap = _doc.find('.kt-front-cat-gallery'),
    product_cat_slider = product_cat_slider_wrap.find('.cat-gallery-slider');

  if ( product_cat_slider_wrap.length > 0 ) {
    const _class = product_cat_slider_wrap.find('.cat-gallery-controls');
    product_cat_slider.slick({
      easing: 'linear',
      lazyLoad: 'ondemand',
      fade: false,
      autoplay: false,
      infinite: false,
      dots: false,
      arrow: true,
      draggable: true,
      focusOnSelect: true,
      speed: 300,
      rtl: true,
      variableWidth: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      appendArrows: _class,
      prevArrow: '<button class="slick-prev slick-arrow controls-item"><svg width="27" height="40" viewBox="0 0 27 40" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" class="arrow" d="M1.75706 1.75766C4.10005 -0.585654 7.89904 -0.585919 10.2423 1.75706L24.2443 15.7571C25.3697 16.8823 26.002 18.4086 26.002 20C26.002 21.5914 25.3697 23.1177 24.2443 24.2429L10.2423 38.2429C7.89904 40.5859 4.10005 40.5857 1.75706 38.2423C-0.585919 35.899 -0.585654 32.1 1.75766 29.7571L11.5161 20L1.75766 10.2429C-0.585654 7.89995 -0.585919 4.10096 1.75706 1.75766Z" fill="white" fill-opacity="1" stroke="white" stroke-opacity="1" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"/> <circle class="round" cx="4.00195" cy="6" r="2" fill="#FF653D"/> <circle class="round" cx="16.002" cy="15" r="3" fill="#FF653D"/> <circle class="round" opacity="0.7" cx="10.002" cy="32" r="2" fill="#FF653D"/> <circle class="round" cx="19.502" cy="22.5" r="1.5" fill="#FF653D"/> </svg></button>',
      nextArrow: '<button class="slick-next slick-arrow controls-item"><svg width="27" height="40" viewBox="0 0 27 40" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" class="arrow" d="M1.75706 1.75766C4.10005 -0.585654 7.89904 -0.585919 10.2423 1.75706L24.2443 15.7571C25.3697 16.8823 26.002 18.4086 26.002 20C26.002 21.5914 25.3697 23.1177 24.2443 24.2429L10.2423 38.2429C7.89904 40.5859 4.10005 40.5857 1.75706 38.2423C-0.585919 35.899 -0.585654 32.1 1.75766 29.7571L11.5161 20L1.75766 10.2429C-0.585654 7.89995 -0.585919 4.10096 1.75706 1.75766Z" fill="white" fill-opacity="1" stroke="white" stroke-opacity="1" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"/> <circle class="round" cx="4.00195" cy="6" r="2" fill="#FF653D"/> <circle class="round" cx="16.002" cy="15" r="3" fill="#FF653D"/> <circle class="round" opacity="0.7" cx="10.002" cy="32" r="2" fill="#FF653D"/> <circle class="round" cx="19.502" cy="22.5" r="1.5" fill="#FF653D"/> </svg></button>',
/*      responsive: [
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            variableWidth: false,
          }
        }

      ]*/
    });
    // make the last slide active
    make_active_list_gallery_slide( product_cat_slider, customize_btn );

    product_cat_slider.find('.gallery-item').on('focus', function () {
      let slide_cat_id = $(this).data('cat_id');

      _doc.find('.kt-front-cat-list .list-item').map((idx, el) => {
        let list_cat_id =  $(el).data('cat_id');
        if ( list_cat_id === slide_cat_id ) {
          _doc.find('.kt-front-cat-list .list-item').removeClass('is_active');
          $(el).addClass('is_active');
        }
      });

      //  Get product link for customize by category id
      generate_customize_link( slide_cat_id, customize_btn );

    });

    // On after slide change
    product_cat_slider.on('beforeChange', function(event, slick, currentSlide, nextSlide) {

      let next_slide_cat_id = $(slick.$slides.get(nextSlide)).data('cat_id'),
          next_slide_counter = $(slick.$slides.get(nextSlide)).data('slide_counter'),
          slider_numbers = $(slick.$prevArrow).next('.current-slides-number');

      slider_numbers.find('.current').text(next_slide_counter);
      _doc.find('.kt-front-cat-list .list-item').map((idx, el) => {
        let list_cat_id =  $(el).data('cat_id');
        if ( list_cat_id === next_slide_cat_id ) {
          _doc.find('.kt-front-cat-list .list-item').removeClass('is_active');
          $(el).addClass('is_active');
        }
      });

      //  Get product link for customize by category id
      generate_customize_link( next_slide_cat_id, customize_btn );

    });

  }
  // end ->> Product Front Slider

  /**
   * Get product link for customize by category id for categories list
   * */
  _doc.find('.kt-front-cat-list .list-item').on('click', function (e) {
    _doc.find('.kt-front-cat-list .list-item').removeClass('is_active');
    $(this).addClass('is_active');
    let product_cat_id = $(this).data('cat_id');
    if ( product_cat_slider.length > 0 ) {
      product_cat_slider.find('.gallery-item').map((idx, el) => {
        let slide_cat_id = $(el).data('cat_id');
        if (product_cat_id === slide_cat_id) {
          let slide_idx = $(el).data('slick-index');
          product_cat_slider.find('.gallery-item').removeClass('slick-current slick-active');
          $(el).addClass('slick-current slick-active');
          product_cat_slider.slick('slickGoTo', slide_idx);
        }

      });
    }
    //  Get product link for customize by category id
    generate_customize_link( product_cat_id, customize_btn );

  });
});
