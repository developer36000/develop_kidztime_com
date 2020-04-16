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

$(document).ready(function () {

  // main menu close
  $(document).on('click', '.mobile-off-canvas-menu-close', function (e) {
    e.preventDefault();
    $(document).find('.mobile-off-canvas-menu.off-canvas').removeClass('is-open')
      .addClass('is-closed');
    $(document).find('.js-off-canvas-overlay').removeClass('is-visible').removeClass('is-closable');
    $(document).find('.off-canvas-content').removeClass('is-open-right');
  });


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

    $(document).find('.mobile-off-canvas-menu.off-canvas').removeClass('is-open')
      .addClass('is-closed');
    $(document).find('.js-off-canvas-overlay').removeClass('is-visible').removeClass('is-closable');
    $(document).find('.off-canvas-content').removeClass('is-open-right');

    modal.addClass('show');
    modal.parents('.cta-modal-window').find('#cta_overlay').addClass('show');
  });
  // close modals
  $(document).find('.cta-close, #cta_overlay').click(function (e) {
    e.preventDefault();
    $(document).find('.cta_modal, #cta_overlay').removeClass('show');
  });
  // end ->> Custom modals

  /* CF7 Successfully Modal after form sent */
  document.addEventListener( 'wpcf7mailsent', function( event ) {
    if( $(document).find('#cta_modal_successfully').length > 0 ) {
      let modal = $(document).find('#cta_modal_successfully');
      modal.parents('.cta-modal-window').find('#cta_overlay').addClass('show');
      modal.addClass('show');
    }
  }, false );

});
