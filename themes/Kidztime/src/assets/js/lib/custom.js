var _window = $(window),
    _doc = $(document);

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


$(window).bind('load resize orientationChange', function () {});

_window.on('scroll', function () {
  let blue_planet = _doc.find('#kt-fornt-bottom-svg #svg-blue-planet'),
    win_height = window.innerHeight;
  if ( blue_planet.length > 0 ) {
    let  blue_planet_top = blue_planet.offset().top;
    if ( _window.scrollTop() <= 300 && _window.scrollTop() >= 180 ) {

      if (  _window.width() >= 640 ) {
        blue_planet.animate({
          left : '8%',
          top : '38%'
        }, {
          duration: 1500,
          easing: "linear",
          queue : false
        } );
      }
    }
    else if ( _window.scrollTop() > 900 || _window.scrollTop() < 180 ) {

      if (  _window.width() >= 640 ) {
        blue_planet.animate({
          left : '1%',
          top : '17%'
        }, {
          duration: 1500,
          easing: "linear",
          queue : false
        } );
      }

    }
  }



});


_doc.ready(function () {

  _doc.find('.kt_scroll_down').on('click', function () {
    let hash = $(this).attr('href'),
        blue_planet = _doc.find('#kt-fornt-bottom-svg #svg-blue-planet');

    if (  _window.width() >= 640 ) {
      blue_planet.animate({
        left : '8%',
        top : '38%'
      }, {
        duration: 1500,
        easing: "linear",
        queue : false
      } );
    }


    $('html, body').animate({
      scrollTop: $(hash).offset().top
    }, 1500);

  });


  /**
  * Main menu close
  * */
    _doc.on('click', '.mobile-off-canvas-menu-close', function (e) {
      e.preventDefault();
      _doc.find('.mobile-off-canvas-menu.off-canvas').removeClass('is-open')
        .addClass('is-closed');
      _doc.find('.js-off-canvas-overlay').removeClass('is-visible').removeClass('is-closable');
      _doc.find('.off-canvas-content').removeClass('is-open-right');
    });
  // end ->> Main menu close

  /**
   *  Custom modals
   * */
    _doc.find('.btn-cta, .ktwoo-cta').on('click', function (e) {
      e.preventDefault();
      let href = $(this).attr('href'),
          modal = _doc.find(href);
      modal.addClass('show');
      modal.parents('.cta-modal-window').find('#cta_overlay').addClass('show');
    });

    _doc.find('.cta-mobile-subscribe').on('click',function (e) {
      e.preventDefault();
      let modal = _doc.find('#cta_modal');

      _doc.find('.mobile-off-canvas-menu.off-canvas')
        .removeClass('is-open')
        .addClass('is-closed');
      _doc.find('.js-off-canvas-overlay').removeClass('is-visible').removeClass('is-closable');
      _doc.find('.off-canvas-content').removeClass('is-open-right');

      modal.addClass('show');
      modal.parents('.cta-modal-window').find('#cta_overlay').addClass('show');
    });

    // close all modals
    _doc.find('.cta-close, #cta_overlay, .woo-btn__cancel-action, .woo-btn__stay-action').click(function (e) {
      e.preventDefault();
      _doc.find('.cta_modal, #cta_overlay').removeClass('show');
    });

    // product actions
    _doc.find('.woo-btn__skip-action').click(function (e) {
      e.preventDefault();
      $(this).parents('.cta_modal, #cta_overlay').removeClass('show');
      _doc.find($(this).data('open_modal')).addClass('show');
      _doc.find($(this).data('open_modal')).parents('.cta-modal-window').find('#cta_overlay').addClass('show');
    });


  // end ->> Custom modals

  /**
  * CF7 Successfully Modal after form sent
  * */
    document.addEventListener( 'wpcf7mailsent', function( event ) {
    if ( _doc.find('#cta_modal_successfully').length > 0 ) {
      let modal = _doc.find('#cta_modal_successfully');
      modal.parents('.cta-modal-window').find('#cta_overlay').addClass('show');
      modal.addClass('show');
    }
  }, false );
  // end ->> CF7 Successfully Modal








});
