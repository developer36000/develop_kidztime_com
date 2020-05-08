$.fn.equalHeight = function () {
  var tallest = 180;
  this.each(function () {
    var thisHeight = $(this).height();
    if (thisHeight > tallest) {
      tallest = thisHeight;
    }
  });
  return this.height(tallest);
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

$(document).ready(function () {

  /**
  * Main menu close
  * */
    $(document).on('click', '.mobile-off-canvas-menu-close', function (e) {
      e.preventDefault();
      $(document).find('.mobile-off-canvas-menu.off-canvas').removeClass('is-open')
        .addClass('is-closed');
      $(document).find('.js-off-canvas-overlay').removeClass('is-visible').removeClass('is-closable');
      $(document).find('.off-canvas-content').removeClass('is-open-right');
    });
  // end ->> Main menu close

  /**
   *  Custom modals
   * */
    $(document).find('.btn-cta').click(function (e) {
      e.preventDefault();
      let href = $(this).attr('href'),
        modal = $(document).find(href);
      modal.addClass('show');
      modal.parents('.cta-modal-window').find('#cta_overlay').addClass('show');
    });
    $(document).find('.cta-mobile-subscribe').on('click',function (e) {
      e.preventDefault();
      let modal = $(document).find('#cta_modal');

      $(document).find('.mobile-off-canvas-menu.off-canvas')
        .removeClass('is-open')
        .addClass('is-closed');
      $(document).find('.js-off-canvas-overlay').removeClass('is-visible').removeClass('is-closable');
      $(document).find('.off-canvas-content').removeClass('is-open-right');

      modal.addClass('show');
      modal.parents('.cta-modal-window').find('#cta_overlay').addClass('show');
    });
    // close all modals
    $(document).find('.cta-close, #cta_overlay').click(function (e) {
      e.preventDefault();
      $(document).find('.cta_modal, #cta_overlay').removeClass('show');
    });
  // end ->> Custom modals

  /**
  * CF7 Successfully Modal after form sent
  * */
    document.addEventListener( 'wpcf7mailsent', function( event ) {
    if ( $(document).find('#cta_modal_successfully').length > 0 ) {
      let modal = $(document).find('#cta_modal_successfully');
      modal.parents('.cta-modal-window').find('#cta_overlay').addClass('show');
      modal.addClass('show');
    }
  }, false );
  // end ->> CF7 Successfully Modal

  /*
  * Render html for login with social use YITH WOOCOMMERCE SOCIAL LOGIN PREMIUM
  * */
    if ( $(document).find('.wc-social-login').length > 0 ) {
      const socials_wrapper = $(document).find('.wc-social-login'),
            socials_label = socials_wrapper.find('.ywsl-label').text();
      socials_wrapper.find('.ywsl-social').map((index, elem) => {
        const elem_label = $(elem).attr('data-social');
        $(elem).append('<span class="social-label">'+socials_label+' <span class="social-name">'+elem_label+'</span></span>');
      });
    }
  // end ->> Render

  /**
  * Woo Account Navigation
  * */
    if ($('.woo-account__navigation').length > 0) {
      $('.woo-account__navigation li').map((index, element) => {
        if ( $(element).hasClass('is-active') ) {
          $(element).prev().addClass('is-active-prev');
          $(element).next().addClass('is-active-next');
        }
      });
    }
  // end ->> Woo Account Navigation

  /**
   * Woo Account Orders
   * */
    if ( $(document).find('.woocommerce-orders-table__header').length > 0 ) {

      $(document).find('table.woocommerce-orders-table')
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

    }
  // end ->> Woo Account Orders

  /**
  * Custom Woocommerce quantity input
  * */
    $(document).on( "click", ".quantity input", function() {
      return false;
    });
    $(document).on( "change input", ".quantity .qty", function() {
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
    $(document).find('.woo-btn__cart-back').on('click', function (e) {
      e.preventDefault();
      window.history.back();
    });
  // end ->> History back button

  /**
  * Print button
  * */
    $(document).find('.woo-btn__print').on('click', function (e) {
      e.preventDefault();
      window.print();
    });
  // end ->> Print button

  /**
  * Checkout tabs navigation
  *
  * Conditional Show hide checkout fields based on chosen payment methods
  * */
  if ( $(document.body).hasClass('kt_woo_checkout_tmpl') ) {
    $(document).find('.woo-checkout__tabs .woo-checkout__tabs--item').on('click', function (e) {
      e.preventDefault();
      let link = $(this).attr('data-link'),
        parent = $(this).parents('.woo-checkout__column');
        const _billing_fields = ['billing_address_2', 'billing_country', 'billing_postcode', 'billing_city', 'billing_phone'];
      $(document).find('.woo-checkout__tabs .woo-checkout__tabs--item').removeClass('is_active');
      $(this).addClass('is_active');
      if ( link === 'live' ) {
        $(this).find('input#payment_method_cod').prop('checked', true);
        parent.find('p#billing_email_field').each(function() {
          $(this).removeClass('form-row-first').addClass('form-row-wide');
        });
        _billing_fields.map((element) => {
          show_hide_checkout_fields( element, 'hide' );
        });

      } else {
        parent.find('input#payment_method_cod').prop('checked', false);
        parent.find('#payment input[name="payment_method"]').first().prop('checked', true);
        _billing_fields.map((element) => {
          show_hide_checkout_fields( element, 'show' );
        });
        parent.find('p#billing_email_field').each(function() {
          $(this).addClass('form-row-first').removeClass('form-row-wide');
        });
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
  }
  // end ->> Checkout tabs navigation && Conditional Show hide checkout fields based on chosen payment methods




});
