var _window = $(window),
  _doc = $(document);

var FontFaceObserver = require('fontfaceobserver');
var WebFont = require('webfontloader');

const getUrlVars = function() {
  var vars = {};
  var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
    vars[key] = value;
  });
  return vars;
};
var url_vars = getUrlVars();

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

let deleteObject = (eventData, target) => {
  let canvas = target.canvas;
  canvas.remove(target);
  canvas.requestRenderAll();
};

// Load all fonts using Font Face Observer
let loadAndUse = ( canvas, font ) => {
  let c_font = new FontFaceObserver( font );
  c_font.load()
    .then(function() {
      // when font is loaded, use it.
      canvas.getActiveObject().set("fontFamily", font);
      canvas.requestRenderAll();
    }).catch(function(e) {
    console.log(e);
  });
};

let uppercase = ( canvas ) => {
  var active = canvas.getActiveObject();
  if (!active) return;

  var text = active.text;
  active.text = text.toUpperCase();
  canvas.requestRenderAll();
};


let lowercase = ( canvas ) => {
  var active = canvas.getActiveObject();
  if (!active) return;

  var text = active.text;
  active.text = text.toLowerCase();
  canvas.requestRenderAll();

};

let render_delet_icon = ( event ) => {
  let deleteIcon = '<svg class="deleteBtn" width="28" height="28" viewBox="0 0 28 28" fill="none"' +
    ' xmlns="http://www.w3.org/2000/svg"><rect width="28" height="28" rx="3" fill="#FF7071"/><path fill-rule="evenodd" clip-rule="evenodd" d="M12.5405 7.59434C12.478 7.59434 12.4184 7.61913 12.3748 7.6626C12.3313 7.706 12.3072 7.7644 12.3072 7.82486V8.99784H15.6935V7.82486C15.6935 7.79489 15.6876 7.76515 15.676 7.73733C15.6645 7.70951 15.6475 7.6841 15.6259 7.6626C15.6043 7.64109 15.5786 7.62392 15.5502 7.61217C15.5217 7.60041 15.4911 7.59434 15.4602 7.59434H12.5405ZM17.0935 8.99784V7.82486C17.0935 7.61044 17.0511 7.39817 16.9689 7.2002C16.8866 7.00222 16.7661 6.82248 16.6144 6.67116C16.4626 6.51985 16.2825 6.39994 16.0845 6.31817C15.8865 6.2364 15.6744 6.19434 15.4602 6.19434H12.5405C12.108 6.19434 11.6928 6.36561 11.3863 6.67116C11.0798 6.97678 10.9072 7.39174 10.9072 7.82486V8.99784H9.10123C9.09713 8.99781 9.09301 8.99781 9.0889 8.99784H7.77812C7.39153 8.99784 7.07812 9.31125 7.07812 9.69784C7.07812 10.0844 7.39153 10.3978 7.77812 10.3978H8.43976L9.08897 20.0733C9.10327 20.5562 9.30203 21.0153 9.64439 21.3567C9.99103 21.7023 10.458 21.9003 10.9472 21.91L17.0397 21.9101L17.0535 21.91C17.5427 21.9003 18.0097 21.7023 18.3563 21.3567C18.6987 21.0153 18.8974 20.5562 18.9117 20.0733L19.5609 10.3978H20.2226C20.6092 10.3978 20.9226 10.0844 20.9226 9.69784C20.9226 9.31125 20.6092 8.99784 20.2226 8.99784H18.9118C18.9077 8.99781 18.9036 8.99781 18.8995 8.99784H17.0935ZM18.1578 10.3978H9.84291L10.4868 19.9941C10.4875 20.0051 10.488 20.0161 10.4882 20.0271C10.4908 20.1538 10.5424 20.275 10.6328 20.3652C10.7221 20.4542 10.8425 20.5062 10.9694 20.5101H17.0313C17.1582 20.5062 17.2786 20.4542 17.3678 20.3652C17.4583 20.275 17.5099 20.1538 17.5125 20.0271C17.5127 20.0161 17.5131 20.0051 17.5139 19.9941L18.1578 10.3978Z" fill="white"/></svg>';
  _doc.find(".deleteBtn").remove();
 // console.log(event.target.oCoords);
  let btnLeft = event.target.oCoords.mb.x,
      btnTop = event.target.oCoords.mb.y + 16,
      widthadjust = event.target.width/2,
      new_btnLeft = btnLeft-16;
  let deleteBtn = '<p" class="deleteBtn" title="Delete" style="position:absolute;top:'+btnTop+'px;left:'+new_btnLeft+'px;cursor:pointer;" title="Remove object">'+deleteIcon+'</p>';
  _doc.find(".canvas-container:nth-child(2)").append(deleteBtn);
  //.canvas-container is the parent div to the canvas positioned relative via CSS
};

let render_texteditor_form = ( event ) => {
  let eidtor_wrap =  _doc.find(".fabric-texteditor-wrap").clone();
  _doc.find(".main-canvas-wrap .fabric-texteditor-wrap").remove();
  let btnLeft = event.target.oCoords.mt.x,
    btnTop = event.target.oCoords.mt.y - 140, // +116
    widthadjust = event.target.width/2,
    new_btnLeft = btnLeft+16;

  if ( _window.width() < 480 ) {
    new_btnLeft = 0;
  }

  eidtor_wrap.css({
    top: btnTop,
    left: new_btnLeft,
    display: 'block'
  });
  _doc.find(".canvas-container:nth-child(2)").append(eidtor_wrap);
};

let attr_term_uncheck = ( target_key ) => {
  _doc.find(".deleteBtn").remove();
  _doc.find('.term-attr-item').map((index, element) => {
    if ( $(element).hasClass('checked') ) {
      let obj_key = $(element).data('cache_key').toString();
      if ( target_key === obj_key  ) {
        $(element).data('cache_key', '').removeClass('checked');
      }
    }
  });
};
let attr_term_check = ( object ) => {
  if ( object.type === 'image' ) {
    _doc.find('.term-attr-item').map((index, element) => {
      let obj_url = $(element).data('attr_image_url'),
        peripherals_url = $(element).data('peripherals_img');
      if ( object.src === obj_url || object.src === peripherals_url  ) {
        $(element).get(0).dataset.cache_key = object.cacheKey;
        $(element).addClass('checked');
      }
    });
  } else if ( object.type === 'textbox' ) {
    _doc.find('form#customize_product_text [name="customize_product_text"]').val(object.text);
  }
};
let download = (url, name) => {
  // make the link. set the href and download. emulate dom click
  $('<a>').attr({
    href: url,
    download: name
  })[0].click();
};
let downloadFabric = (canvas, name) => {
  //  convert the canvas to a data url and download it.
 // console.log(canvas);
  let _dataset = canvas.lowerCanvasEl.dataset;
  let bgImage = canvas.backgroundImage;
  canvas.backgroundImage = null;
  canvas.renderAll();
  let file = canvas.toDataURL({
    format: 'png',
    multiplier: 1, // Generate double scaled png dataURL
    width: _dataset.print_width,
    height: _dataset.print_height
  });
  download(file, name + '.png');
//  canvas.setBackgroundImage(bgImage, canvas.renderAll.bind(canvas))
};
let addImageToCanvas = (canvas, imgSrc) => {
  let canvas_dataset = canvas.lowerCanvasEl.dataset,
    print_w = canvas_dataset.print_width,
    print_h = canvas_dataset.print_height,
    rect_obj_str = canvas_dataset.r_acoords;
  fabric.Image.fromURL(imgSrc, function(myImg) {
    //oImg.scale(0.5).set('flipX', false);
    myImg.selectable = false;
    canvas.add(myImg);
    myImg.scaleToWidth(canvas.getWidth());
    myImg.scaleToHeight(canvas.getHeight());
    canvas.renderAll();
  });
};
let findByClipName = (canvas, name) => {
  return _(canvas.getObjects()).where({
    clipFor: name
  }).first()
};

let get_scale_ratio = ( canvas, rect_aCoords ) => {
  let c_main_wrap = _doc.find('.main-canvas-wrap'),
      containerWidth = c_main_wrap.width(), // Max width for the canvas
      containerHeight = c_main_wrap.height(),  // Max height for the canvas
      canvas_w = canvas.getWidth(),  // Current canvas width
      canvas_h = canvas.getHeight(), // Current canvas height
      ratio = 0; // Used for aspect ratio

  // Check if the current width is larger than the max
  if( canvas_w > containerWidth ){
    ratio = containerWidth / canvas_w;   // get ratio for scaling image
    const zoom2  = canvas.getZoom() * ratio;
    canvas.setDimensions({
      width: containerWidth,
      height: canvas_h * ratio
    });
    canvas.setViewportTransform([zoom2, 0, 0, zoom2, 0, 0]);
    canvas.calcOffset();
    canvas_h = canvas_h * ratio;    // Reset height to match scaled image
    canvas_w = canvas_w * ratio;    // Reset width to match scaled image
    canvas.renderAll();
    if ( rect_aCoords ) {
      _doc.find('#c_product_canvas').parent().css('top', (rect_aCoords.top*ratio)+'px');
    }
  }

  // Check if current height is larger than max
  if( canvas_h > containerWidth ){
    ratio = containerHeight / canvas_h; // get ratio for scaling image
    const zoom2  = canvas.getZoom() * ratio;
    canvas.setDimensions({
      width: canvas_w * ratio,
      height: canvas_h * ratio
    });
    canvas.setViewportTransform([zoom2, 0, 0, zoom2, 0, 0]);
    canvas.calcOffset();
    canvas_w = canvas_w * ratio;    // Reset width to match scaled image
    canvas_h = canvas_h * ratio;    // Reset height to match scaled image
    canvas.renderAll();
    if ( rect_aCoords ) {
      _doc.find('#c_product_canvas').parent().css('top', (rect_aCoords.top*ratio)+'px');
    }

  }
  //return Math.min(containerWidth/canvas.width, containerHeight/canvas.height);
};

let resize = ( canvas ) => {
  let c_main_wrap = _doc.find('.main-canvas-wrap');
  let iX = canvas.getWidth(), //current width of image in the client
      iY = canvas.getHeight(), //current height of image in the client
      cX = c_main_wrap.width(), //configured width
      cY = c_main_wrap.height(), //configured height
      fX = 0, //final width
      fY = 0; //final height

  let lE = iX > iY ? iX : iY,
    factor = 0;
  if ( cX < cY ) {
    factor = cX/lE;
  } else {
    factor = cY/lE;
  }

  fX = iX * factor;
  fY = iY * factor;

  console.log({factor, fX, fY});

  let zoom2  = canvas.getZoom() * factor;
  console.log({zoom2});
  canvas.setDimensions({
    width: fX,
    height: fY
  });
  canvas.setViewportTransform([zoom2, 0, 0, zoom2, 0, 0]);
  canvas.calcOffset();
  canvas.renderAll();

};
/*

let get_optimal_canvas_dimensions = ( canvas ) => {
  let available_width = $(".main-canvas-wrap").outerWidth(),
    canvas_w = 0,
    canvas_h = 0;
  if (canvas.getWidth() > available_width) {
    canvas_w = available_width;
    canvas_h = (canvas_w * canvas.getHeight()) / canvas.getWidth();
  }/!* else if ( (canvas.getHeight() > canvas.getWidth()) && (canvas.getWidth() < available_width) ) {
    canvas_w = canvas.getWidth();
    canvas_h = (canvas_w * canvas.getWidth()) / canvas.getHeight();
  } *!/else {
    canvas_w = canvas.getWidth();
    canvas_h = canvas.getHeight();
  }
  return [canvas_w, canvas_h];
};
let rescale_canvas_if_needed = ( canvas, rect_aCoords ) => {
  let optimal_dimensions = get_optimal_canvas_dimensions( canvas ),
    scaleFactor = Math.min(optimal_dimensions[0]/canvas.width, optimal_dimensions[1]/canvas.height);
  console.log({scaleFactor});
  if( scaleFactor !== 1 ) {
    _doc.find('#c_product_canvas').parent().css('top', rect_aCoords.top*scaleFactor+'px');
    canvas.setWidth(canvas.getWidth()*scaleFactor);
    canvas.setHeight(canvas.getHeight()*scaleFactor);
    canvas.setZoom(scaleFactor);
    canvas.calcOffset();
    canvas.renderAll();
  }
};
let rescale_canvas_if_needed_bg = ( canvas ) => {
  let optimal_dimensions = get_optimal_canvas_dimensions( canvas ),
    scaleFactor = Math.min(optimal_dimensions[0]/canvas.width, optimal_dimensions[1]/canvas.height);
  console.log({scaleFactor});
  if( scaleFactor !== 1 ) {
    canvas.setWidth(canvas.getWidth()*scaleFactor);
    canvas.setHeight(canvas.getHeight()*scaleFactor);
    canvas.setZoom(scaleFactor);
    canvas.calcOffset();
    canvas.renderAll();
  }
};

*/

let addDrawToBig = ( canvas_from, canvas_to ) => {
  var ao = canvas_from.getObjects();

  for(var i in ao) {
    canvas_to.add(ao[i]);
  }
  //var svg = canvas_from.toSVG();
//  var svg = canvas_from.getObjects();
//  var group = new fabric.Group(svg);
 // canvas_to.add(group).centerObject(group);
 // console.log({group});
  //fabric.loadSVGFromString(svg,function(objects, options) {
  //  var obj;
  //  obj = fabric.util.groupSVGElements(objects, options);
  //   c.add(obj).centerObject(obj).setActiveObject(obj);
  //});
};

let saveToStorage = ( name, obj ) => {
  localStorage.setItem(name, JSON.stringify(obj));
};
let loadFromStorage = ( name ) => {
  return JSON.parse(localStorage.getItem(name));
};


(function() {
  'use_strict';

  _doc.ready(function () {

    _doc.find('.prev-attr-btn').on('click', function(e) {
      e.preventDefault();
      $(this).parents('.term-child-attr-items-wrap').removeClass('is_active');
      $(this).parents('.customizer-container').find('.main-terms-atts-nav').removeClass('hide');
      if ( _window.width() < 1024 ) {
        _doc.find('.attribute-navigation').removeClass('hide');
      }
      _doc.find('.attribute-block').map( (index, element) => {
        if ( $(element).hasClass('is_active') ) {
          $(element).find('.term-attr-items > .term-attr-item').show();
        }
      } );

    });

    _doc.find('.attribute-back-btn').on('click', function(e) {
      e.preventDefault();
    });


  });

  /**
   * Product Canvas Customization
   * */
  if ( _doc.find('#c_product_canvas').length > 0 ) {
    //change default settings
    fabric.Canvas.prototype.freeDrawingCursor = "none";
    fabric.Canvas.prototype.rotationCursor = "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABmJLR0QA/wD/AP+gvaeTAAACdElEQVQ4jZ2UTUiUURSGn/N9U4yZpYK5kMhE3BQUblq4ER0zEV2k4lgEbvqxHzc59rNy588MTIQmuGkhosNoQUKTk0qblmZBCZlhIBRWRPnTmM58p4VOmI2m864u95z73Pflcq6wpprCO+lJ3xO+dY1dXGGdyvNakxITzQwAGzrTHXQtsoVs0YXKysR8SrgLuFXlaNlvYruGaiXCMbUUgBXA6XCPI9pv2uztPYH6uY1AiS6cDreCdgkyotAJpAq8tZCgwDSAwmFBi4Ec4CsqdX0jDf1bAWdBDgBTolrfO9L4JFas6gJPiWGoVyEHtLFvuNETrRkbDKcDKsIYIgW1+U32WEDfaEMgTOQE6ChIW42jrWIT4OqeKk4Lzi/tSkiNBQTwD9/8EcGqEJhU5N7Zkrv7/oocr6oLPCVi6GNRbveOuJpjOdyRfKMNAWBShSqIHTkeBYHj5066E21nSptTrGXTp4bp8g1dfxUPTUQ+qKosR4wMI7K0Ow2VIsJWYbz2VC0BsGxiGVbE/nHtmsx4gSCHALVr5JPhf3ZlQeHl2gTEq1PAeHfQtWismlM/kFNd4CnZKcnpcJcC2Yr6Ye2VTZu9HfhiGOqtcrTs3y6sNt+bDHhBZ0Mh7fgD7AnUz6FyWSHHxBjYDrQ235v8yxZ5AGQjUvfo+Y15ADPa8Ho6OHE0q2gR5IKJcfpIZvH7N9PBqc1ihg1rAMhVpcE37Lofrf0zejWOtgpFOoE04B0wpLr6fQmShWgxkA18RrjU99T1cP35mLNcntealGg3rqpQCeRuKL9Q1B8KaUc05n+B61VW1rTHvpBwEGBpb2hmcLDp51b9vwHv/uvmHUIE9QAAAABJRU5ErkJggg==) 12 12, auto";
    fabric.Object.prototype.set({
      hasRotatingPoint: true,
      rotatingPointOffset: 20,
      borderDashArray: [6, 6],
      borderColor: '#38355B',
      cornerColor: '#38355B',
      cornerSize: 8,
      transparentCorners: true,
      cornerStyle: 'rect', // circle
    });

    // load google fonts
    var WebFontConfig = {
      google: {
        families: [
          'Plaster',
          'Engagement',
          'Pacifico',
          'VT323',
          'Quicksand',
          'Inconsolata',
          'Croissant+One',
          'Emblema+One',
          'Graduate',
          'Hammersmith+One',
          'Oswald',
          'Oxygen',
          'Lora',
          'Krona+One',
          'Indie+Flower',
          'Courgette',
          'Ranchers',
          'Ribeye',
          'Tangerine'
        ]
      }
    };
    WebFont.load(WebFontConfig);

    var c_canvas_obj = _doc.find('#c_product_canvas'),
      c_main_wrap = c_canvas_obj.parents('.main-canvas-wrap'),
      c_canvas_data = c_canvas_obj.get(0).dataset,
      print_r_w = c_canvas_data.real_width,
      print_r_h = c_canvas_data.real_height,
      print_w = c_canvas_data.print_width,
      print_h = c_canvas_data.print_height,
      scale_ratio = c_canvas_data.scale_ratio,
      c_main_bg_url = c_canvas_data.default_img.toString(),
      canvas_aCoords_str = c_canvas_data.r_acoords,
      rect_aCoords = JSON.parse( canvas_aCoords_str ),
      text_editor_form = _doc.find('#fabric-texteditor');

    var c_canvas_bg = new fabric.Canvas("c_product_canvas_bg", {selection: false}),
      c_canvas = new fabric.Canvas("c_product_canvas");



    addImageToCanvas(c_canvas_bg, c_main_bg_url);

    console.log({scale_ratio});
    console.log({devicePixelRatio});
    console.log({rect_aCoords});

    //c_canvas_bg.dispose();
    console.log( $(window).width());
    console.log( $(window).on('load') );
    $(window).on('load resize orientationChange', function () {

      console.log( $(window).width());
      if ( $(window).width() > 1280 ) {
        console.log('_window.width() > 1280');
        console.log($(window).width() > 1280);
        const zoom  = c_canvas.getZoom() * scale_ratio;
        console.log(zoom);
        c_canvas.setDimensions({
          width: c_canvas.getWidth() * scale_ratio,
          height: c_canvas.getHeight() * scale_ratio
        });
        c_canvas.setViewportTransform([zoom, 0, 0, zoom, 0, 0]);
        c_canvas_obj.parent().css('top', rect_aCoords.top+'px');
        c_canvas.calcOffset();
        c_canvas.renderAll();

        const zoom2  = c_canvas_bg.getZoom() * scale_ratio;
        c_canvas_bg.setDimensions({
          width: c_canvas_bg.getWidth() * scale_ratio,
          height: c_canvas_bg.getHeight() * scale_ratio
        });
        c_canvas_bg.setViewportTransform([zoom2, 0, 0, zoom2, 0, 0]);
        c_canvas_bg.calcOffset();
        c_canvas_bg.renderAll();

        // resize(c_canvas_bg);
        // resize(c_canvas);
      } else if ( $(window).width() < 1280 ) {
        resize(c_canvas_bg);
        resize(c_canvas);
      } else if ( $(window).width() < 1024 ) {
        let atts_nav = _doc.find('.right-side .main-terms-atts-nav');
        _doc.find('.attribute-bottom-navigation').after(atts_nav);
        _doc.find('.right-side .main-terms-atts-nav').remove();
      }

    });

    if ( window.location.href.indexOf('edit_product=') >= 0 )  {
      let product_id = _doc.find('.ktwoo_single_form').data('product_id');
      if ( product_id ) {
        let c_obj_name = product_id+'_canvas_storage_json',
          c_bg_obj_name = product_id+'_canvas_bg_storage_json';

        _doc.find('[name="create_product_title"]').val(_doc.find('title').text());

        let c_canvas_json = loadFromStorage(c_obj_name),
          c_canvas_bg_json = loadFromStorage(c_bg_obj_name);

        if ( c_canvas_json && c_canvas_bg_json ) {
          c_canvas_bg.clear();
          c_canvas_bg.loadFromJSON(c_canvas_bg_json, function() {
            c_canvas_bg.renderAll();
          }, function( o, object ) {
            object.scaleToWidth(c_canvas_bg.getWidth());
            object.scaleToHeight(c_canvas_bg.getHeight());
            c_canvas_bg.renderAll();
            attr_term_check( object );
          });
          c_canvas.loadFromJSON(c_canvas_json, function() {
            c_canvas.renderAll();
          }, function( o, object ) {
            attr_term_check( object );
          });
        }


      }

    }

    // add custom remove button on events
    c_canvas.on('object:selected', (e) => {
      _doc.find(".deleteBtn").remove();
      c_main_wrap.find(".fabric-texteditor-wrap").remove();
      let active = c_canvas.getActiveObject();
      console.log( e.target );
      if( active ) {
        render_delet_icon(e);
        if ( active.type === 'textbox' ) {
          render_texteditor_form(e);
        } else {
          c_main_wrap.find(".fabric-texteditor-wrap").remove();
        }
      } else {
        _doc.find(".deleteBtn").remove();
        c_main_wrap.find(".fabric-texteditor-wrap").remove();
      }
    });

    c_canvas.on('object:modified', (e) => {
      _doc.find(".deleteBtn").remove();
      c_main_wrap.find(".fabric-texteditor-wrap").remove();
      let active = c_canvas.getActiveObject();
      if( active ) {
        render_delet_icon(e);
        if ( active.type === 'textbox' ) {
          render_texteditor_form(e);
        } else {
          c_main_wrap.find(".fabric-texteditor-wrap").remove();
        }
      }  else {
        _doc.find(".deleteBtn").remove();
        c_main_wrap.find(".fabric-texteditor-wrap").remove();
      }
    });
    c_canvas.on('mouse:down', (e) => {
      let active = c_canvas.getActiveObject();
      if( active ) {
        render_delet_icon(e);
        if ( active.type === 'textbox' ) {
          render_texteditor_form(e);
        } else {
          c_main_wrap.find(".fabric-texteditor-wrap").remove();
        }
      } else {
        _doc.find(".deleteBtn").remove();
        c_main_wrap.find(".fabric-texteditor-wrap").remove();
      }
    });
    c_canvas.on('object:moving', (e) => {
      _doc.find(".deleteBtn").remove();
      c_main_wrap.find(".fabric-texteditor-wrap").remove();
    });
    c_canvas.on('after:render', (e) => {
      let clear_btn = _doc.find('.attr-empty-canvas-data');
      if ( c_canvas.getObjects().length > 0 ) {
        if ( !clear_btn.hasClass('active') ) {
          clear_btn.addClass('active');
        }
      } else {
        clear_btn.removeClass('active');
      }

    });
    c_canvas.on('object:removed', (e) => {
      // console.log('c_canvas - object:removed ---------');
      let target_key = e.target.cacheKey;
      attr_term_uncheck( target_key );
    });
    // history
    c_canvas_bg.on('history:clear', (e) => {
      // console.log('c_canvas_bg - history:clear');
      _doc.find('.attr-prev-step').removeClass('active');
      _doc.find('.attr-next-step').removeClass('active');
    });
    c_canvas.on('history:append', (e) => {
      let c_result = JSON.parse( e.json );
      _doc.find('.attr-prev-step').addClass('active');
      _doc.find('.attr-next-step').addClass('active');
    });
    c_canvas.on('history:clear', (e) => {
      // console.log('c_canvas - history:clear');
      _doc.find('.attr-prev-step').removeClass('active');
      _doc.find('.attr-next-step').removeClass('active');
    });
    c_canvas.on('history:undo', (e) => {
      // console.log('c_canvas - history:undo');
    });
    c_canvas.on('history:redo', (e) => {
      // console.log('c_canvas - history:redo');
    });

    document.addEventListener('keyup', ({ keyCode, ctrlKey } = event) => {
      // Check Ctrl key is pressed.
      if (!ctrlKey) return;
      // Check pressed button is Z - Ctrl+Z.
      if (keyCode === 90) c_canvas.undo();
      // Check pressed button is Y - Ctrl+Y.
      if (keyCode === 89) c_canvas.redo();
    });

    // ---------------------------------------------------------------------------


    /**
     * delete click button event
     * */

    _doc.on('click', ".deleteBtn", function() {
      let active_obj = c_canvas.getActiveObject();
      if( active_obj ) {
        let active_obj_key = active_obj.cacheKey;
        c_canvas.remove(c_canvas.getActiveObject());
        //this would remove the currently active object on stage,
        $(this).remove();
        c_canvas.requestRenderAll();
        attr_term_uncheck( active_obj_key );
      }

    });

    /**
     * Remove all objects on the canvas
     * */
    _doc.on('click', ".attr-empty-canvas-data", function(e) {
      e.preventDefault();
      let c_objects = c_canvas.getObjects();
      //c_canvas.dispose();
      // c_canvas.remove(c_canvas.getObjects());
      _doc.find(".deleteBtn").remove();
      $(this).removeClass('active');
      _doc.find('.term-attr-item').map((index, element) => {
        if ( $(element).hasClass('checked') ) {
          $(element).data('cache_key', '').removeClass('checked');
        }
      });
      c_canvas.clear();
      c_canvas.clearHistory();
      c_canvas_bg.clear();
      c_canvas_bg.clearHistory();
      addImageToCanvas(c_canvas_bg, c_canvas_data.default_img);
      c_canvas_bg.requestRenderAll();
    });

    _doc.on('click', ".attr-prev-step", function(e) {
      e.preventDefault();
      _doc.find(".deleteBtn").remove();
      $(this).addClass('active');
      c_canvas.undo();
    });
    _doc.on('click', ".attr-next-step", function(e) {
      e.preventDefault();
      _doc.find(".deleteBtn").remove();
      $(this).addClass('active');
      c_canvas.redo();
    });

    _doc.on('click', '.attribute-done-btn', function(e) {
      e.preventDefault();
      console.log('attribute-done-btn');
      let product_id = $(this).data('product_id');
      if ( product_id ) {
        let c_obj_name = product_id+'_canvas_storage_json',
          c_bg_obj_name = product_id+'_canvas_bg_storage_json';
        saveToStorage(c_obj_name, c_canvas);
        saveToStorage(c_bg_obj_name, c_canvas_bg);
        console.log({c_canvas});
        //   addDrawToBig(c_canvas, c_canvas_bg);

        /*   fabric.Image.fromURL( c_canvas.toDataURL(), (oImg) => {
             c_canvas_bg.add(oImg);
             oImg.center().setCoords();
             oImg.set('width', c_canvas.getWidth());
             oImg.set('height', c_canvas.getHeight());
             console.log({oImg});
             c_canvas_bg.renderAll();
             console.log({c_canvas_bg});
           });*/

      }

    });

    // ---------------------------------------------------------------------------



    // add text to canvas
    _doc.find('#customize_product_text').on('submit', function(e) {
      $(document.body).addClass('customize_product_tmpl');
      e.preventDefault();
      let form_param = get_form_param( $(this) ),
        form_text = form_param.customize_product_text;
      //console.log({form_text});
      let text = new fabric.Textbox(form_text, {
        // width : 70,
        cursorColor : "#58448B",
        top : 10,
        left : 10,
      });
      c_canvas.add(text);
      _doc.find(".deleteBtn").remove();
      _doc.find(".main-canvas-wrap .fabric-texteditor-wrap").remove();
      c_canvas.setActiveObject(text);
      c_canvas.requestRenderAll();
      //c_canvas.remove(text);
    });

    /**
     * Text Editor Actions
     * */
    if ( text_editor_form.length > 0 ) {
      _doc.on('change', '[name="text-color"]', function (e) {
        let active = c_canvas.getActiveObject(),
          value = $(this).val();
        if ( active && active.type === 'textbox' ) {
          active.set( 'fill', value );
          c_canvas.renderAll();
        }
      });
      _doc.on('change', '[name="text-font-size"]', function(e) {
        let active = c_canvas.getActiveObject(),
          value = $(this).val();
        if ( active && active.type === 'textbox' ) {
          active.set( 'fontSize', value );
          c_canvas.renderAll();
        }
      });
      _doc.on('change', '[name="font-family"]', function(e) {
        let active = c_canvas.getActiveObject(),
          value = $(this).val();
        if ( active && active.type === 'textbox' ) {
          loadAndUse( c_canvas, value );
          //active.set( 'textAlign', value ); // left
          //active.set( 'underline', value );  // true or false
          //active.set( 'fontStyle', value );  // normal
          //active.set( 'fontWeight', value );  // normal
        }
      });
      _doc.on('change', '[name="fontalign"]', function(e) {
        let active = c_canvas.getActiveObject(),
          value = $(this).val();
        if ( active && active.type === 'textbox' ) {
          active.set( 'textAlign', value );
          c_canvas.renderAll();
        }
      });
      _doc.on('change', '[name="fonttype_bold"]', function(e) {
        let active = c_canvas.getActiveObject(),
          value = $(this).val();
        if ( active && active.type === 'textbox' ) {
          active.set( 'fontWeight', value );
          c_canvas.renderAll();
        }
      });
      _doc.on('change', '[name="fonttype_italic"]', function(e) {
        let active = c_canvas.getActiveObject(),
          value = $(this).val();
        if ( active && active.type === 'textbox' ) {
          active.set( 'fontStyle', value );
          c_canvas.renderAll();
        }
      });
      _doc.on('change', '[name="fonttype_underline"]', function(e) {
        let active = c_canvas.getActiveObject(),
          value = $(this).val();
        if ( active && active.type === 'textbox' ) {
          active.set( 'underline', value==='underline' );
          c_canvas.renderAll();
        }
      });

    } // END ==> Text Editor Actions


    _doc.find('.term-attr-item').on('click', function(e) {
      let _this = $(this),
        attr_term_id = _this.data('attr_term_id'),
        attr_term_slug = _this.data('attr_term_slug'),
        attr_term_obj = _this.find('.term-thumb > img'),
        attr_term_img_url = _this.find('.term-thumb > img').attr('src'),
        attr_term_key = _this.get(0).dataset.cache_key,
        parent_atts = _this.parents('.main-terms-atts');

      if ( _this.hasClass('is_hierarchical') && !_this.hasClass('is_peripherals')  ) {
        parent_atts.find('#'+attr_term_slug).addClass('is_active');
        _this.parents('.customizer-container').find('.main-terms-atts-nav').addClass('hide');
        _doc.find('.attribute-block').map( (index, element) => {
          if ( $(element).hasClass('is_active') ) {
            $(element).find('.term-attr-items > .term-attr-item').hide();
          }
        } );
        if ( _window.width() < 1024 ) {
          _doc.find('.attribute-navigation').addClass('hide');
        }
      }
      else if ( !_this.hasClass('is_hierarchical') && !_this.hasClass('is_peripherals') ) {
        if ( _this.hasClass('checked') ) {
          let c_objects = c_canvas.getObjects();
          for (let i = 0; c_objects.length >= i; i++) {
            if (c_objects.length > 0 && (c_objects[i].cacheKey === attr_term_key)) {
              c_canvas.remove(c_objects[i]);
              _doc.find(".deleteBtn").remove();
              _this.removeClass('checked');
              c_canvas.requestRenderAll();
              break;
            }
          }
        }
        else {
          _this.toggleClass('checked');
          if (attr_term_img_url) {
            let c_image_width = attr_term_obj.get(0).width > c_canvas.width ? (c_canvas.width * .8) : (attr_term_obj.get(0).width * .95);
            fabric.Image.fromURL(attr_term_img_url, (oImg) => {
              oImg.scaleToWidth(c_image_width);
              // scale image down, and flip it, before adding it onto canvas
              //oImg.scale(0.5).set('flipX', false);
              _this.get(0).dataset.cache_key = oImg.cacheKey;
              c_canvas.add(oImg);
            });
          }
        }

      }
      else if ( _this.hasClass('is_peripherals') ) {
        let default_img = c_canvas_data.default_img,
          peripherals_img = $(this).data('peripherals_img');
        _doc.find('.term-attr-item.is_peripherals').removeClass('checked');
        if ( _this.hasClass('checked') ) {
          _this.removeClass('checked');
          c_canvas_bg.clear();
          c_canvas_bg.clearHistory();
          addImageToCanvas(c_canvas_bg, default_img);
          c_canvas_bg.renderAll();
        } else {
          _this.toggleClass('checked');
          c_canvas_bg.clear();
          c_canvas_bg.clearHistory();
          addImageToCanvas(c_canvas_bg, peripherals_img);
          c_canvas_bg.renderAll();
        }

      }

    });


    // console.log(JSON.stringify(c_canvas));
    // console.log(c_canvas.toObject());//logs canvas as an object
    // console.log(c_canvas.toSVG());


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

        let multiplierFactor = Math.min(print_w/c_canvas.getWidth(), print_h/c_canvas.getHeight()),
          scaleMultiplierX = print_w / c_canvas.getWidth(),
          scaleMultiplierY = print_h / c_canvas.getHeight();

        let canvas_thumb = c_canvas_bg.toDataURL({
          format: 'png',
          multiplier: 1
        });
        console.log({canvas_thumb});
        let sticker_png_url = c_canvas.toDataURL({
          format: 'png',
          multiplier: multiplierFactor, // Generate double scaled png dataURL
        });

        let ajax_data = {
          action : action,
          nonce_rest : wpApi.nonce_rest,
          product_id : product_id,
          form_param : form_param,
          canvas_svg_url_data : sticker_png_url,
          canvas_thumb : canvas_thumb
        };

        if ( action === 'kt_create_product_title' && form_param.create_product_title === '' ) {
          $(this).find('.error-label').addClass('show');
        } else if ( action === 'kt_create_product_title' && form_param.create_product_title ) {
          $(this).find('.error-label').removeClass('show');
          _this.find('.spinner-btn').addClass('load-page');
          $.ajax( {
            url: wpApi.ajaxurl,
            method: 'POST',
            data: ajax_data,
            beforeSend: function () {
              _this.find('.spinner-btn').find('.load-icon').html('<div class="app-loading"><svg class="spinner" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>').fadeIn();
            },
            success: function( res ) {
              // console.log(res);
              _this.find('.spinner-btn').removeClass('load-page');
              setTimeout(function () {
                window.location.href = res;
              }, 500)
            }
          });
        }

      });
    } // end ->> Edit Product title


  }

}());


