var _window = $(window),
  _doc = $(document);

const getUrlVars = function() {
  var vars = {};
  var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
    vars[key] = value;
  });
  return vars;
};
var url_vars = getUrlVars();


/**
 * Woo Account Orders Sort function
 * */
let sort = (el) => {
  let col_sort = el.get(0).innerHTML;
  let tr = el.get(0).parentNode;
  let table = tr.parentNode.parentNode;
  let tbody = table.tBodies[0];
  let td, arrow, col_sort_num;

  for (var i=0; (td = tr.getElementsByTagName("td").item(i)); i++) {
    if (td.innerHTML == col_sort) {
      col_sort_num = i;
      if (td.prevsort == "y"){
        arrow = td.firstChild;
        el.up = Number(!el.up);
      }else{
        td.prevsort = "y";
        arrow = td.insertBefore(document.createElement("span"),td.firstChild);
        el.up = 0;
      }
      arrow.innerHTML = el.up?"↑ ":"↓ ";
    }else{
      if (td.prevsort == "y"){
        td.prevsort = "n";
        if (td.firstChild) td.removeChild(td.firstChild);
      }
    }
  }

  let a = [];

  for(let i=1; i < tbody.rows.length; i++) {
    a[i-1] = [];
    a[i-1][0]=tbody.rows[i].getElementsByTagName("td").item(col_sort_num).innerHTML;
    a[i-1][1]=tbody.rows[i];
  }

  a.sort();
  if(el.up) a.reverse();

  for(let i=0; i < a.length; i++)
    tbody.appendChild(a[i][1]);

};

/**
 * Checkout change billing fields for live checkout
 * function that shows or hide checkout fields
 * */
let show_hide_checkout_fields = ( selector = '', action = 'show' ) => {

  if( action === 'show' ) {
    // The checkout field <p> container selector
    $('p#'+selector+'_field').each(function () {
      $(this).show( 200, function() {
        $(this).addClass("validate-required");
      });
    });
  } else if ( action === 'hide' ) {
    // hide
    // The checkout field <p> container selector
    $('p#'+selector+'_field').each(function () {
      $(this).hide( 200, function() {
        $(this).removeClass("validate-required");
      });
      $(this).removeClass("woocommerce-validated");
      $(this).removeClass("woocommerce-invalid woocommerce-invalid-required-field");
    });

  }

};

/**
 * Redirect to Customize new product single page
 * */
let redirect_to_new_product = () => {
  _doc.find('.kt-product-to-customize').on('click', function (e) {
    e.preventDefault();

   // console.log('kt-product-to-customize');

    let _this = $(this);
    if ( _this.attr('href').indexOf('new_product=1') >= 0 ) {
      let _this_vars = {},
        parts = _this.attr('href').replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
          _this_vars[key] = value;
        }),
        default_prod_id = _this_vars ? _this_vars.default_prod_id : 0,
        ajax_data = {
          action : 'kt_create_product_customize',
          nonce_rest : wpApi.nonce_rest,
          default_prod_id : default_prod_id
        };
      _this.addClass('load-page');
      $.ajax( {
        url: wpApi.ajaxurl,
        method: 'POST',
        data: ajax_data,
        beforeSend: function () {
          _this.find('.load-icon').html('<div class="app-loading"><svg class="spinner" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>').fadeIn();
        },
        success: function( res ) {
          _this.removeClass('load-page');
         // console.log({res});
          let result = $.parseJSON( res );
         // console.log(result );
          if ( result ) {
            sessionStorage.setItem("customize_product_id", result.new_product_id);
            window.location.href = result.new_product_link;
          }

        }
      });
    }

  });
};

/**
 * Get all values from form
 * */
const get_form_param = ( form ) => {
  form = form.serializeArray();
  var	param = {};
  for ( var a = 0; a < form.length; a++ ) {
    param[form[a].name] = form[a].value;
  }
  return param;
};

_doc.find('#cta_modal_added_product_msg').parents('.woocommerce-notices-wrapper')
  .addClass('with-modal');

_doc.ready(function () {


  /**
  * Redirect to Customize new product single page
  * */
  redirect_to_new_product();

  /*
 * Render html for login with social use YITH WOOCOMMERCE SOCIAL LOGIN PREMIUM
 * */
  if ( _doc.find('.wc-social-login').length > 0 ) {
    const socials_wrapper = _doc.find('.wc-social-login'),
      socials_label = socials_wrapper.find('.ywsl-label').text();
    socials_wrapper.find('.ywsl-social').map((index, elem) => {
      const elem_label = $(elem).attr('data-social');
      $(elem).append('<span class="social-label">'+socials_label+' <span class="social-name">'+elem_label+'</span></span>');
    });
  } // end ->> Render for login with social use YITH WOOCOMMERCE SOCIAL LOGIN PREMIUM

  /**
   * Woo Account Navigation
   * */
  if ($('.woo-account__navigation').length > 0 || $('.attribute-navigation').length > 0 ) {
    let terms_attr_nav_first = _doc.find('.attribute-navigation li:first-child'),
        terms_attr_nav_last = _doc.find('.attribute-navigation li.last');
    $('.woo-account__navigation li, .attribute-navigation li').map((index, element) => {
      if ( $(element).hasClass('is-active') ) {
        $(element).prev().addClass('is-active-prev');
        $(element).next().addClass('is-active-next');
      }
    });

    terms_attr_nav_first.addClass('is-active');
    if ( terms_attr_nav_first.hasClass('is-active') ) {
      let first_href = terms_attr_nav_first.find('a').attr('href'),
          first_block = _doc.find(first_href);
      first_block.addClass('is_active');
      _doc.find('.main-terms-atts-nav .woo-btn--back').addClass('no-active');
    }

    _doc.find('.attribute-navigation li a').on('click', function (e) {
       e.preventDefault();
      let href = $(this).attr('href'),
          block = _doc.find(href);
      $('.attribute-navigation li')
        .removeClass('is-active')
        .removeClass('is-active-prev')
        .removeClass('is-active-next');
      $(this).parent('li').addClass('is-active');
      block.parents('.customizer-container').find('.attribute-block').removeClass('is_active');
      block.addClass('is_active');
      _doc.find('.main-terms-atts-nav').removeClass('hide');
      if ( $(this).parent('li').hasClass('is-active') ) {
        $(this).parent('li').prev().addClass('is-active-prev');
        $(this).parent('li').next().addClass('is-active-next');
      }
      if ( terms_attr_nav_first.hasClass('is-active') ) {
        _doc.find('.main-terms-atts-nav .woo-btn--back').addClass('no-active');
      } else {
        _doc.find('.main-terms-atts-nav .woo-btn--back').removeClass('no-active');
      }
      if ( terms_attr_nav_last.hasClass('is-active') ) {
        _doc.find('.main-terms-atts-nav .kt-btn--next').addClass('no-active');
      } else {
        _doc.find('.main-terms-atts-nav .kt-btn--next').removeClass('no-active');
      }
    });
    _doc.find('.main-terms-atts-nav .kt-btn--next').on('click', function (e) {
      e.preventDefault();
      let parent = $(this).parents('.customizer-container'),
        attr_nav_wrap = parent.find('.attribute-navigation'),
        current_block = attr_nav_wrap.find('li.is-active'),
        next_href = current_block.next('li').find('a').attr('href'),
        next_block =  _doc.find(next_href);

      _doc.find('.main-terms-atts-nav .woo-btn--back').removeClass('no-active');
      parent.find('.attribute-block').removeClass('is_active');
      next_block.addClass('is_active');
      attr_nav_wrap.find('li').not(":last").removeClass('is-active');
      current_block.next('li').addClass('is-active');

      if ( !terms_attr_nav_last.hasClass('is-active') ) {
        _doc.find('.main-terms-atts-nav .kt-btn--next').removeClass('no-active');
      } else {
        $(this).addClass('no-active');
      }

    });
    _doc.find('.main-terms-atts-nav .woo-btn--back').on('click', function (e) {
      e.preventDefault();
      let parent = $(this).parents('.customizer-container'),
        attr_nav_wrap = parent.find('.attribute-navigation'),
        current_block = attr_nav_wrap.find('li.is-active'),
        prev_href = current_block.prev('li').find('a').attr('href'),
        prev_block =  _doc.find(prev_href);

      _doc.find('.main-terms-atts-nav .kt-btn--next').removeClass('no-active');
      parent.find('.attribute-block').removeClass('is_active');
      prev_block.addClass('is_active');
      attr_nav_wrap.find('li').not(":first").removeClass('is-active');
      current_block.prev('li').addClass('is-active');

      if ( !terms_attr_nav_first.hasClass('is-active') ) {
        _doc.find('.main-terms-atts-nav .woo-btn--back').removeClass('no-active');
      } else {
        $(this).addClass('no-active');
      }

    });

  } // end ->> Woo Account Navigation

  /**
   * Woo Account Orders
   * */
  if ( _doc.find('.woocommerce-orders-table__header').length > 0 ) {

    _doc.find('table.woocommerce-orders-table')
      .on('click', '.woocommerce-orders-table__header.sortable', function () {
        var index = $(this).index(),
          rows = [],
          thClass = $(this).hasClass('asc') ? 'desc' : 'asc';

        $('table.woocommerce-orders-table th.sortable').removeClass('asc desc');
        $(this).addClass(thClass);

        $('table.woocommerce-orders-table tbody tr').each(function (index, row) {
          rows.push($(row).detach());
        });

        rows.sort(function (a, b) {
          var aValue = $(a).find('td').eq(index).text(),
            bValue = $(b).find('td').eq(index).text();

          return aValue > bValue
            ? 1
            : aValue < bValue
              ? -1
              : 0;
        });

        if ($(this).hasClass('desc')) {
          rows.reverse();
        }

        $.each(rows, function (index, row) {
          $('table.woocommerce-orders-table tbody').append(row);
        });
      });

  } // end ->> Woo Account Orders

  /**
   * Custom Woocommerce quantity input
   * */
  _doc.on( "click", ".quantity input", function() {
    return false;
  });
  _doc.on( "change input", ".quantity .qty", function() {
    var add_to_cart_button = $( this ).closest( ".product" ).find( ".add_to_cart_button" );
    // For AJAX add-to-cart actions
    add_to_cart_button.attr( "data-quantity", $( this ).val() );
    // For non-AJAX add-to-cart actions
    add_to_cart_button.attr( "href", "?add-to-cart=" + add_to_cart_button.attr("data-product_id") + "&quantity=" + $(this).val() );
  });
  // end ->> Custom Woocommerce quantity input

  /**
   * History back button
   * */
  _doc.find('.woo-btn__cart-back').on('click', function (e) {
    e.preventDefault();
    window.history.back();
  }); // end ->> History back button

  /**
   * Print button
   * */
  _doc.find('.woo-btn__print').on('click', function (e) {
    e.preventDefault();
    window.print();
  }); // end ->> Print button

  /**
   * Checkout tabs navigation
   *
   * Conditional Show hide checkout fields based on chosen payment methods
   * */
  if ( $(document.body).hasClass('kt_woo_checkout_tmpl') ) {
    let payment_method_input = '#payment input[name="payment_method"]',
      live_input = '[name="cod_live_checkout"]';
    _doc.find(payment_method_input).first().prop('checked', true);
    _doc.find(live_input).val('Digital Checkout');

    _doc.find('.mobile-order-summary').on('click', function () {
      $(this).toggleClass('is_active');
      if ( $(this).hasClass('is_active') ) {
        $(this).find('.mobile-order-summary--title').text('Hide Order Summary');
      } else {
        $(this).find('.mobile-order-summary--title').text('Show Order Summary');
      }
      $(this).parents('.woo-checkout__column').find('.woo-checkout__order-review').toggleClass('is_active');
    });

    _doc.ajaxComplete(function () {
      _doc.find(payment_method_input).first().prop('checked', true);
      _doc.find(payment_method_input).parents('li').removeClass('is_active');
      _doc.find(payment_method_input+':checked').parents('li').addClass('is_active');

      _doc.on( 'change', '#payment input[name="payment_method"]', function () {
        console.log( $(this) );
        _doc.find(payment_method_input).parents('li').removeClass('is_active');
        if ( $(this).prop('checked') ) {
          $(this).parents('li.payment_methods--item').addClass('is_active');
          console.log($(this).parents('li.payment_methods--item'));
        }

      });

    });

    _doc.on( 'click', '.woo-checkout__tabs .woo-checkout__tabs--item', function (e) {
      let link = $(this).attr('data-link'),
        parent = $(this).parents('.woo-checkout__column'),
        _billing_fields = ['billing_address_2', 'billing_country', 'billing_postcode', 'billing_city', 'billing_phone'];

      _doc.find('.woo-checkout__tabs .woo-checkout__tabs--item').removeClass('is_active');
      $(this).addClass('is_active');

      if ( link === 'live' ) {

        _doc.find(payment_method_input).parents('li').removeClass('is_active');

        $(this).find('input#payment_method_cod').prop('checked', true);
        parent.find('p#billing_email_field').each(function() {
          $(this).removeClass('form-row-first').addClass('form-row-wide');
        });
        _billing_fields.map((element) => {
          show_hide_checkout_fields( element, 'hide' );
        });

        _doc.find(live_input).val('Live Checkout');

      }
      else {

        _doc.find(payment_method_input).parents('li').removeClass('is_active');
        parent.find('input#payment_method_cod').prop('checked', false);

        parent.find(payment_method_input).first()
          .parents('li.payment_methods--item').addClass('is_active');
        parent.find(payment_method_input).first().prop('checked', true);

        _billing_fields.map((element) => {
          show_hide_checkout_fields( element, 'show' );
        });
        parent.find('p#billing_email_field').each(function() {
          $(this).addClass('form-row-first').removeClass('form-row-wide');
        });
        _doc.find('[name="woocommerce_checkout_place_order"]')
          .text('Confirm Order').val('Confirm Order').attr('data-value', 'Confirm Order');

        _doc.find(live_input).val('Digital Checkout');

      }

      parent.find('.tab-content').each(function () {
        let _id = $(this).attr('data-id');
        if (_id === link) {
          $(this).addClass('is_active');
        } else {
          $(this).removeClass('is_active');
        }
      });

    });

  } // end ->> Checkout tabs navigation && Conditional Show hide checkout fields based on chosen payment methods

  /**
  * Edit Product Title
  * */
  let kt_modal_form = _doc.find('.ktwoo_single_form');
  if ( kt_modal_form.length > 0 ) {
    kt_modal_form.on('submit', function (e) {
      e.preventDefault();
      let _this = $(this),
        product_id = _this.data('product_id'),
        action = _this.attr('data-action'),
        form_param = get_form_param( _this );
       let customize_product_id = _doc.find('#customize_product_id').val();

      let ajax_data = {
          action : action,
          nonce_rest : wpApi.nonce_rest,
          product_id : product_id,
          customize_product_id : customize_product_id,
          product_title : form_param.edit_product_title,
          form_param : form_param,
          is_edit_product: window.location.href.indexOf('edit_product='),
          is_new_product: window.location.href.indexOf('new_product=')
        };
      if ( action !== 'kt_create_product_title' ) {
        _this.find('.spinner-btn').addClass('load-page');
        $.ajax( {
          url: wpApi.ajaxurl,
          method: 'POST',
          data: ajax_data,
          beforeSend: function () {
            _this.find('.spinner-btn').find('.load-icon').html('<div class="app-loading"><svg class="spinner" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>').fadeIn();
          },
          success: function( res ) {
            _this.find('.spinner-btn').removeClass('load-page');
            if ( action === 'kt_edit_product_title' ) {
              location.reload();
            } else if ( action === 'kt_close_product_go_back' ) {
              //console.log(res);
              window.location.href = res;
            }
          }
        });
      }
      return false;
    });
  } // end ->> Edit Product title



});
