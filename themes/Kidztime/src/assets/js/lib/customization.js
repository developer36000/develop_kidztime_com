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

let render_texteditor_form = ( event, active ) => {
  _doc.find(".main-canvas-wrap .fabric-texteditor-wrap").remove();
  let btnLeft = event.target.oCoords.mt.x,
    btnTop = event.target.oCoords.mt.y - 140, // +116
    widthadjust = event.target.width/2,
    new_btnLeft = btnLeft+16;

  if ( _window.width() < 480 ) {
    new_btnLeft = 0;
  }

  let eidtor_wrap = '<div class="fabric-texteditor-wrap" style="top:'+btnTop+'px; left:'+new_btnLeft+'px;' +
    ' display:block;"><form action="/" id="fabric-texteditor" method="POST"><div id="text-controls"><label class="btn-label font-color" for="text-color"><span class="icon color"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 172 172" style="fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M56.53548,14.97721c-2.91373,0.00645 -5.53358,1.77617 -6.62736,4.47682c-1.09378,2.70065 -0.44378,5.79468 1.64429,7.82689l17.07682,17.07682l-41.4043,40.11653l-0.04199,0.042c-8.26713,8.26713 -8.26713,21.93925 0,30.20637l36.5472,36.5472c8.26714,8.26713 21.58008,8.62629 29.49251,0.71386l36.54721,-36.5472c8.26713,-8.26714 8.26713,-21.93924 0,-30.20638l-13.92741,-13.91341c-0.12955,-0.14543 -0.26496,-0.28552 -0.40592,-0.41992l-53.75,-53.75c-1.35266,-1.39047 -3.21117,-2.17327 -5.15104,-2.1696zM78.74935,54.49186l26.55306,26.53907l14.33333,14.33333c1.59977,1.59976 2.39356,3.28442 2.39356,4.96907h-86.93783c-0.25887,-1.92147 0.39909,-3.85644 2.22559,-5.68294zM143.33333,117.53614c-1.13592,0 -2.27228,0.54836 -2.96744,1.63769c-4.19967,6.56467 -11.36589,18.58384 -11.36589,24.15951c0,7.88333 6.45,14.33333 14.33333,14.33333c7.88333,0 14.33333,-6.45 14.33333,-14.33333c0,-5.57567 -7.16622,-17.59484 -11.36589,-24.15951c-0.69517,-1.08933 -1.83153,-1.63769 -2.96744,-1.63769z"></path></g></g></svg></span><input type="color" value="#ffffff" id="text-color" name="text-color" size="10"></label><label class="btn-label font-size" for="text-font-size"><input type="number" value="36" min="1" step="1" id="text-font-size" name="text-font-size"></label><label class="btn-label-select" for="font-family"><select id="font-family" name="font-family"><option value="Plaster" style="font-family: \'Plaster\';">Plaster</option><option value="Engagement" style="font-family: \'Engagement\';">Engagement</option><option value="Pacifico" style="font-family: \'Pacifico\';">Pacifico</option> <option value="VT323" style="font-family: \'VT323\';">VT323</option><option value="Quicksand" style="font-family: \'Quicksand\';">Quicksand</option><option value="Inconsolata" style="font-family: \'Inconsolata\';">Inconsolata</option><option value="Oswald" style="font-family: \'Oswald\';">Oswald</option><option value="Oxygen" style="font-family: \'Oxygen\';">Oxygen</option><option value="Tangerine" style="font-family: \'Tangerine\';">Tangerine</option><option value="Ranchers" style="font-family: \'Ranchers\';">Ranchers</option><option value="Ribeye" style="font-family: \'Ribeye\';">Ribeye</option><option value="Lora" style="font-family: \'Lora\';">Lora</option><option value="Croissant One" style="font-family: \'Croissant One\';">Croissant One</option><option value="Emblema One" style="font-family: \'Emblema One\';">Emblema One</option><option value="Hammersmith One" style="font-family: \'Hammersmith One\';">Hammersmith One</option><option value="Krona One" style="font-family: \'Krona One\';">Krona One</option><option value="Graduate" style="font-family: \'Graduate\';">Graduate</option><option value="Indie Flower" style="font-family: \'Indie Flower\';">Indie Flower</option><option value="Courgette" style="font-family: \'Courgette\';">Courgette</option></select></label></div><div id="text-controls-style"><label class="btn-label" for="text-cmd-bold"><input type="checkbox" value="bold" name="fonttype" id="text-cmd-bold" ><span class="icon bold"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none"  font-size="none"  style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M50.16667,21.5c-7.83362,0 -14.33333,6.49972 -14.33333,14.33333v35.83333v14.33333v50.16667c0,7.83362 6.49972,14.33333 14.33333,14.33333h45.19759c20.33453,0 38.65078,-14.89919 40.62044,-35.56739c1.63279,-17.11874 -7.93401,-32.39394 -22.21386,-39.31868c4.58645,-5.0661 8.0625,-12.33489 8.0625,-21.86393c0,-14.93056 -8.52274,-24.36863 -16.50293,-28.35872c-7.98018,-3.99009 -15.74707,-3.89128 -15.74707,-3.89128zM50.16667,35.83333h39.41667c0,0 4.77478,0.09881 9.33626,2.37956c4.56148,2.28074 8.58041,5.38433 8.58041,15.53711c0,10.15278 -4.01892,13.25637 -8.58041,15.53711c-4.56148,2.28074 -9.33626,2.37956 -9.33626,2.37956h-39.41667zM50.16667,86h39.41667h0.71386h6.4528c14.75507,0 26.41754,12.41253 24.97135,27.57487c-1.22668,12.87181 -13.00829,22.5918 -26.35709,22.5918h-45.19759z"></path></g></g></svg></span></label><label class="btn-label" for="text-cmd-italic"><input type="checkbox" value="italic" name="fonttype" id="text-cmd-italic" ><span class="icon italic"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"width="24" height="24"viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M71.66667,21.5c-3.956,0 -7.16667,3.21067 -7.16667,7.16667c0,3.956 3.21067,7.16667 7.16667,7.16667h13.88542l-14.75326,100.33333h-13.46549c-3.956,0 -7.16667,3.21067 -7.16667,7.16667c0,3.956 3.21067,7.16667 7.16667,7.16667h43c3.956,0 7.16667,-3.21067 7.16667,-7.16667c0,-3.956 -3.21067,-7.16667 -7.16667,-7.16667h-14.5433l14.75326,-100.33333h14.12337c3.956,0 7.16667,-3.21067 7.16667,-7.16667c0,-3.956 -3.21067,-7.16667 -7.16667,-7.16667z"></path></g></g></svg></span></label><label class="btn-label" for="text-cmd-underline"><input type="checkbox" value="underline" name="fonttype" id="text-cmd-underline" ><span class="icon underline"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"  stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path  d="M50.05469,14.23535c-3.95253,0.06178 -7.10881,3.312 -7.05469,7.26465v64.5c0,23.66165 19.33835,43 43,43c23.66165,0 43,-19.33835 43,-43v-64.5c0.03655,-2.58456 -1.32136,-4.98858 -3.55376,-6.29153c-2.2324,-1.30295 -4.99342,-1.30295 -7.22582,0c-2.2324,1.30295 -3.59031,3.70697 -3.55376,6.29153v64.5c0,15.91269 -12.75398,28.66667 -28.66667,28.66667c-15.91268,0 -28.66667,-12.75398 -28.66667,-28.66667v-64.5c0.02653,-1.93715 -0.73227,-3.80254 -2.10349,-5.17112c-1.37122,-1.36858 -3.23806,-2.12378 -5.17516,-2.09353zM50.16667,143.33333c-3.956,0 -7.16667,3.21067 -7.16667,7.16667c0,3.956 3.21067,7.16667 7.16667,7.16667h71.66667c3.956,0 7.16667,-3.21067 7.16667,-7.16667c0,-3.956 -3.21067,-7.16667 -7.16667,-7.16667z"></path></g></g></svg></span></label></div><div id="text-controls-align"><label class="btn-label checked" for="text-align-left"><input type="checkbox" value="left" name="fontalign" id="text-align-left" checked ><span class="icon left"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 172 172" style=" fill:#000000;"><g  fill="none" fill-rule="nonzero" stroke="none"  stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path  d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M28.66667,21.5c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h114.66667c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM28.66667,50.16667c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h78.83333c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM28.66667,78.83333c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h114.66667c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM28.66667,107.5c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h78.83333c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM28.66667,136.16667c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h114.66667c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376z"></path></g></g></svg></span></label><label class="btn-label" for="text-align-center"><input type="checkbox" value="center" name="fontalign" id="text-align-center" ><span class="icon center"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none"  stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path  d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M28.66667,21.5c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h114.66667c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM43,50.16667c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h86c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM28.66667,78.83333c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h114.66667c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM43,107.5c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h86c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM28.66667,136.16667c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h114.66667c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376z"></path></g></g></svg></span></label><label class="btn-label" for="text-align-right"><input type="checkbox" value="right" name="fontalign" id="text-align-right" ><span class="icon right"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 172 172" style="fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M28.66667,21.5c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h114.66667c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM64.5,50.16667c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h78.83333c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM28.66667,78.83333c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h114.66667c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM64.5,107.5c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h78.83333c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM28.66667,136.16667c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h114.66667c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376z"></path></g></g></svg></span></label></div><div id="text-controls-additional"><label class="btn-label"  for="text-cmd-capitalize"><input type="checkbox" value="capitalize" name="fonttransform"  id="text-cmd-capitalize" ><span class="icon capitalize"><svg xmlns="http://www.w3.org/2000/svg" x="0px"  y="0px" width="24" height="24" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero"  stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"  stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode:  normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M28.66667,21.5c-3.956,0 -7.16667,3.21067 -7.16667,7.16667c0,3.956 3.21067,7.16667 7.16667,7.16667h35.83333v107.5c0,3.956 3.21067,7.16667 7.16667,7.16667c3.956,0 7.16667,-3.21067 7.16667,-7.16667v-107.5h35.83333c3.956,0 7.16667,-3.21067 7.16667,-7.16667c0,-3.956 -3.21067,-7.16667 -7.16667,-7.16667zM100.33333,78.83333c-3.956,0 -7.16667,3.21067 -7.16667,7.16667c0,3.956 3.21067,7.16667 7.16667,7.16667h14.33333v50.16667c0,3.956 3.21067,7.16667 7.16667,7.16667c3.956,0 7.16667,-3.21067 7.16667,-7.16667v-50.16667h14.33333c3.956,0 7.16667,-3.21067 7.16667,-7.16667c0,-3.956 -3.21067,-7.16667 -7.16667,-7.16667z"></path></g></g></svg></span> </label> <label class="btn-label" for="text-cmd-uppercase"> <input type="checkbox" value="uppercase" name="fonttransform" id="text-cmd-uppercase" > <span class="icon uppercase"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M14.33333,28.66667c-3.956,0 -7.16667,3.21067 -7.16667,7.16667c0,3.956 3.21067,7.16667 7.16667,7.16667h21.5v93.16667c0,3.956 3.21067,7.16667 7.16667,7.16667c3.956,0 7.16667,-3.21067 7.16667,-7.16667v-93.16667h21.5c3.956,0 7.16667,-3.21067 7.16667,-7.16667c0,-3.956 -3.21067,-7.16667 -7.16667,-7.16667zM100.33333,28.66667c-3.956,0 -7.16667,3.21067 -7.16667,7.16667c0,3.956 3.21067,7.16667 7.16667,7.16667h21.5v93.16667c0,3.956 3.21067,7.16667 7.16667,7.16667c3.956,0 7.16667,-3.21067 7.16667,-7.16667v-93.16667h21.5c3.956,0 7.16667,-3.21067 7.16667,-7.16667c0,-3.956 -3.21067,-7.16667 -7.16667,-7.16667z"></path></g></g></svg></span></label><label class="btn-label" for="text-cmd-lowercase"><input type="checkbox" value="lowercase" name="fonttransform" id="text-cmd-lowercase" ><span class="icon lowercase"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24"  viewBox="0 0 172 172" style="fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M50.05469,21.40202c-3.95253,0.06178 -7.10881,3.312 -7.05469,7.26465v21.5h-7.16667c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h7.16667v64.45801c0,11.02611 8.52107,20.13235 19.27441,21.27604l0.5319,0.26595h1.69368c3.21833,0 6.17641,-0.31075 8.84635,-0.82584c2.58408,-0.41156 4.73852,-2.19861 5.62057,-4.66211c0.88205,-2.4635 0.35151,-5.2119 -1.38408,-7.1701c-1.73559,-1.9582 -4.40038,-2.81498 -6.95198,-2.23517c-1.66518,0.32128 -3.6013,0.4901 -5.71094,0.51791h-0.44792c-4.03653,-0.02203 -7.13867,-3.13398 -7.13867,-7.16667v-64.45801h7.16667c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376h-7.16667v-21.5c0.02653,-1.93715 -0.73227,-3.80254 -2.10349,-5.17112c-1.37122,-1.36858 -3.23806,-2.12378 -5.17516,-2.09353zM107.38802,21.40202c-3.95253,0.06178 -7.10881,3.312 -7.05469,7.26465v21.5h-7.16667c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h7.16667v64.45801c0,11.02611 8.52107,20.13235 19.27441,21.27604l0.5319,0.26595h1.69368c3.14539,0 6.03529,-0.29792 8.66439,-0.79785c2.54998,-0.44198 4.66365,-2.22431 5.5299,-4.66303c0.86625,-2.43872 0.35053,-5.15503 -1.34925,-7.10656c-1.69979,-1.95153 -4.31962,-2.83516 -6.85415,-2.31179c-1.62033,0.30817 -3.5058,0.47703 -5.57097,0.50391h-0.44792c-4.03653,-0.02198 -7.13867,-3.13398 -7.13867,-7.16667v-64.45801h7.16667c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376h-7.16667v-21.5c0.02653,-1.93715 -0.73227,-3.80254 -2.10349,-5.17112c-1.37122,-1.36858 -3.23806,-2.12378 -5.17516,-2.09353z"></path></g></g></svg></span></label></div></form></div>';

  _doc.find(".canvas-container:nth-child(2)").append(eidtor_wrap);

  if ( active ) {
    let eidtor_html = _doc.find('.main-canvas-wrap .fabric-texteditor-wrap'),
        active_family = active.fontFamily,
        active_align = active.textAlign,
        active_fontSize = active.fontSize,
        active_fill = active.fill,
        active_fontStyle = active.fontStyle,
        active_underline = active.underline,
        active_fontWeight = active.fontWeight;

    eidtor_html.find('[name="text-font-size"]').val( active_fontSize );
    eidtor_html.find('[name="text-color"]').val( active_fill );
    eidtor_html.find('[name="font-family"]').val(active_family);
    eidtor_html.find('[name="fontalign"]').map( (index, element) => {
      if ( $(element).val() === active_align ) {
        eidtor_html.find('[name="fontalign"]').parent('label').removeClass('checked');
        $(element).parent('label').addClass('checked');
      }
    });
    eidtor_html.find('[name="fonttype"]').map( (index, element) => {
      let value = $(element).val();
      if ( value === active_fontWeight || value === active_fontStyle ) {
        $(element).parent('label').addClass('checked');
      } else if ( value === 'underline' && active_underline === true ) {
        $(element).parent('label').addClass('checked');
      }
    });

  }



};
/*
let adjustTextWidth = (evt: fabric.IEvent) => {
  if (evt.target instanceof fabric.IText) {
    const text = evt.target.text || "";
    while (evt.target.textLines.length > text.split("\n").length) {
      evt.target.set({width: evt.target.getScaledWidth() + 1})
    }
  }
};*/

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
    _doc.find('form#customize_product_text_form [name="customize_product_text"]').val(object.text);
  }
};
let download = ( url, name ) => {
  // make the link. set the href and download. emulate dom click
  $('<a>').attr({
    href: url,
    download: name
  })[0].click();
};
let downloadFabric = ( canvas, name ) => {
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
let addImageToCanvas = ( canvas, imgSrc ) => {
  fabric.Image.fromURL(imgSrc, function(myImg) {
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

let addDrawToBig = ( canvas_from, canvas_to, rect_aCoords, scale_ratio ) => {
  console.log('---------addDrawToBig---------');
  let is_bottle = canvas_from.contextTop.canvas.previousSibling.attributes[4].name;
  const zoom  = canvas_to.getZoom() * scale_ratio;
  console.log('--------------------');
  console.log({scale_ratio});
  console.log(rect_aCoords.top);
  console.log(rect_aCoords.top/scale_ratio);
  console.log('--------------------');

  fabric.Image.fromURL( canvas_from.toDataURL(), (oImg) => {
    canvas_to.add(oImg);
    oImg.center().setCoords();
    oImg.set('width', canvas_from.getWidth());
    oImg.set('height', canvas_from.getHeight());

    if ( is_bottle !== 'data-is_bottle' ) {
      oImg.scaleToWidth( canvas_from.getWidth() );
      oImg.scaleToHeight( canvas_from.getHeight() );
      oImg.set('top', (rect_aCoords.top/scale_ratio));
    } else {
      oImg.set('top', (rect_aCoords.top/scale_ratio));
    //  oImg.set('top', rect_aCoords.top);
    }
    canvas_to.renderAll();
  });


/*  let sticker_png_url = c_canvas.toDataURL({
    format: 'png'
  });*/

  let svg = canvas_from.toSVG(),
    from_top = canvas_from._offset.top - canvas_to._offset.top,
    from_left = canvas_from._offset.left - canvas_to._offset.left;
  console.log(rect_aCoords.top);
  console.log({from_top});
  console.log({from_left});
  console.log({svg});

/*  fabric.loadSVGFromString( svg, function(objects, options) {
      let obj = fabric.util.groupSVGElements(objects, options);
      canvas_to.add(obj);
      obj.scaleToWidth( canvas_from.getWidth() );
      obj.scaleToHeight( canvas_from.getHeight() );
      canvas_to.centerObject(obj);
      obj.set('top', rect_aCoords.top);
      obj.set('left', from_left);
      obj.setCoords();
      canvas_to.renderAll();

    });*/

  if ( rect_aCoords ) {
   // canvas_to.parent().css('top', rect_aCoords.top+'px');
  }


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

    $(document.body).addClass('customize_product_tmpl');

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
      text_editor_form = _doc.find('#fabric-texteditor');


    var rect_aCoords = canvas_aCoords_str ? JSON.parse( canvas_aCoords_str ) : '';

    var c_canvas_bg = new fabric.Canvas("c_product_canvas_bg", {selection: false}),
        c_canvas = new fabric.Canvas("c_product_canvas");

    addImageToCanvas(c_canvas_bg, c_main_bg_url);

    console.log({scale_ratio});
    console.log({devicePixelRatio});

    //c_canvas_bg.dispose();
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
        if ( rect_aCoords ) {
          c_canvas_obj.parent().css('top', rect_aCoords.top+'px');
        }

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
      _doc.find(".main-canvas-wrap .fabric-texteditor-wrap").remove();
      let active = c_canvas.getActiveObject();
      console.log( e.target );
      if( active ) {
        render_delet_icon(e);
        if ( active.type === 'textbox' ) {
          render_texteditor_form(e, active);
        } else {
          _doc.find(".main-canvas-wrap .fabric-texteditor-wrap").remove();
        }
      } else {
        _doc.find(".deleteBtn").remove();
        _doc.find(".main-canvas-wrap .fabric-texteditor-wrap").remove();
      }
    });

    c_canvas.on('object:modified', (e) => {
      _doc.find(".deleteBtn").remove();
      _doc.find(".main-canvas-wrap .fabric-texteditor-wrap").remove();
      let active = c_canvas.getActiveObject();
      if( active ) {
        render_delet_icon(e);
        if ( active.type === 'textbox' ) {
          render_texteditor_form(e, active);
        } else {
          _doc.find(".main-canvas-wrap .fabric-texteditor-wrap").remove();
        }
      }  else {
        _doc.find(".deleteBtn").remove();
        _doc.find(".main-canvas-wrap .fabric-texteditor-wrap").remove();
      }
    });
    c_canvas.on('mouse:down', (e) => {
      let active = c_canvas.getActiveObject();
      if( active ) {
        render_delet_icon(e);
        if ( active.type === 'textbox' ) {
          render_texteditor_form(e, active);
        } else {
          _doc.find(".main-canvas-wrap .fabric-texteditor-wrap").remove();
        }
      } else {
        _doc.find(".deleteBtn").remove();
        _doc.find(".main-canvas-wrap .fabric-texteditor-wrap").remove();
      }
    });
    c_canvas.on('object:moving', (e) => {
      _doc.find(".deleteBtn").remove();
      _doc.find(".main-canvas-wrap .fabric-texteditor-wrap").remove();
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
      _doc.find(".main-canvas-wrap .fabric-texteditor-wrap").remove();
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

    //c_canvas.on("text:changed", adjustTextWidth);

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

    // ---------------------------------------------------------------------------
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

           addDrawToBig(c_canvas, c_canvas_bg, rect_aCoords, scale_ratio);



      }

    });
    // ---------------------------------------------------------------------------



    // add text to canvas
    _doc.find('#customize_product_text_form').on('submit', function(e) {
      e.preventDefault();
      let form_param = get_form_param( $(this) ),
        form_text = form_param.customize_product_text;

      let text = new fabric.Textbox(form_text, {
        cursorColor : "#58448B",
        top : 10,
        left : 10,
      });
      text.set({width: text.getScaledWidth() + 1});
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
    _doc.on('keyup change paste', '[name="text-color"]', function (e) {
      let active = c_canvas.getActiveObject(),
        value = $(this).val();
      if ( active && active.type === 'textbox' ) {
        active.set( 'fill', value );
        c_canvas.renderAll();
      }
    });
    _doc.on('keyup change paste', '[name="text-font-size"]', function(e) {
      let active = c_canvas.getActiveObject(),
        value = $(this).val();
      if ( active && active.type === 'textbox' ) {
        active.set( 'fontSize', value );
        c_canvas.renderAll();
      }
    });
    _doc.on('keyup change paste', '[name="font-family"]', function(e) {
      let active = c_canvas.getActiveObject(),
        value = $(this).val();
      if ( active && active.type === 'textbox' ) {
        loadAndUse( c_canvas, value );
      }
    });
    _doc.on('keyup change paste', '[name="fontalign"]', function(e) {
      let active = c_canvas.getActiveObject(),
        value = $(this).val();
      $(this).parents('form').find('[name="fontalign"]').parent('label').removeClass('checked');
      $(this).parent('label').toggleClass('checked');
      if ( active && active.type === 'textbox' ) {
        active.set( 'textAlign', value );
        c_canvas.renderAll();
      }
    });
    _doc.on('keyup change paste', '[name="fonttransform"]', function(e) {
      let active = c_canvas.getActiveObject(),
        value = $(this).val();
      $(this).parents('form').find('[name="fonttransform"]').parent('label').removeClass('checked');
      if ( active && active.type === 'textbox' ) {
        let text = active.text;
        if ( $(this).parent('label').hasClass('checked') ) {
          $(this).parent('label').removeClass('checked');
          active.text = fabric.util.string.capitalize(text);
        } else {
          $(this).parent('label').addClass('checked');
          if ( value === 'uppercase' ) {
            active.text =  text.toUpperCase();
          } else if ( value === 'lowercase' ) {
            active.text = text.toLowerCase();
          } else if ( value === 'capitalize' ) {
            active.text = fabric.util.string.capitalize(text);
          }

        }
        c_canvas.renderAll();
      }
    });
    _doc.on('keyup change paste', '[name="fonttype"]', function(e) {
      let active = c_canvas.getActiveObject(),
        value = $(this).val();
      if ( active && active.type === 'textbox' ) {
        if ( $(this).parent('label').hasClass('checked') ) {

          $(this).parent('label').removeClass('checked');
          if ( value === 'bold' ) {
            active.set( 'fontWeight', 'normal' );
          } else if ( value === 'italic' ) {
            active.set( 'fontStyle', 'normal' );
          } else if ( value === 'underline' ) {
            active.set( 'underline', false );
          }

        } else {

          $(this).parent('label').addClass('checked');
          if ( value === 'bold' ) {
            active.set( 'fontWeight', value );
          } else if ( value === 'italic' ) {
            active.set( 'fontStyle', value );
          } else if ( value === 'underline' ) {
            active.set( 'underline', true );
          }

        }
        c_canvas.renderAll();
      }
    });



     // END ==> Text Editor Actions


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


