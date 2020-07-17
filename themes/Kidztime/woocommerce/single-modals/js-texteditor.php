<?php
?>

<div class="fabric-texteditor-wrap">
	<form action="/" id="fabric-texteditor" method="POST">
		<div id="text-controls">

			<label class="btn-label font-color" for="text-color">
				<span class="icon color"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
				                              width="24" height="24"
				                              viewBox="0 0 172 172"
				                              style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none"  font-size="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M56.53548,14.97721c-2.91373,0.00645 -5.53358,1.77617 -6.62736,4.47682c-1.09378,2.70065 -0.44378,5.79468 1.64429,7.82689l17.07682,17.07682l-41.4043,40.11653l-0.04199,0.042c-8.26713,8.26713 -8.26713,21.93925 0,30.20637l36.5472,36.5472c8.26714,8.26713 21.58008,8.62629 29.49251,0.71386l36.54721,-36.5472c8.26713,-8.26714 8.26713,-21.93924 0,-30.20638l-13.92741,-13.91341c-0.12955,-0.14543 -0.26496,-0.28552 -0.40592,-0.41992l-53.75,-53.75c-1.35266,-1.39047 -3.21117,-2.17327 -5.15104,-2.1696zM78.74935,54.49186l26.55306,26.53907l14.33333,14.33333c1.59977,1.59976 2.39356,3.28442 2.39356,4.96907h-86.93783c-0.25887,-1.92147 0.39909,-3.85644 2.22559,-5.68294zM143.33333,117.53614c-1.13592,0 -2.27228,0.54836 -2.96744,1.63769c-4.19967,6.56467 -11.36589,18.58384 -11.36589,24.15951c0,7.88333 6.45,14.33333 14.33333,14.33333c7.88333,0 14.33333,-6.45 14.33333,-14.33333c0,-5.57567 -7.16622,-17.59484 -11.36589,-24.15951c-0.69517,-1.08933 -1.83153,-1.63769 -2.96744,-1.63769z"></path></g></g></svg></span>
				<input type="color" value="#ffffff" id="text-color" name="text-color" size="10">
			</label>
			<label class="btn-label font-size" for="text-font-size">
				<input type="number" value="36" min="1" step="1" id="text-font-size" name="text-font-size">
			</label>
			<label class="btn-label-select" for="font-family">
				<select id="font-family" name="font-family">
					<option value="Plaster" style="font-family: 'Plaster';">Plaster</option>
					<option value="Engagement" style="font-family: 'Engagement';">Engagement</option>
					<option value="Pacifico" style="font-family: 'Pacifico';">Pacifico</option>
					<option value="VT323" style="font-family: 'VT323';">VT323</option>
					<option value="Quicksand" style="font-family: 'Quicksand';">Quicksand</option>
					<option value="Inconsolata" style="font-family: 'Inconsolata';">Inconsolata</option>
					<option value="Oswald" style="font-family: 'Oswald';">Oswald</option>
					<option value="Oxygen" style="font-family: 'Oxygen';">Oxygen</option>
					<option value="Tangerine" style="font-family: 'Tangerine';">Tangerine</option>
					<option value="Ranchers" style="font-family: 'Ranchers';">Ranchers</option>
					<option value="Ribeye" style="font-family: 'Ribeye';">Ribeye</option>
					<option value="Lora" style="font-family: 'Lora';">Lora</option>
					<option value="Croissant One" style="font-family: 'Croissant One';">Croissant One</option>
					<option value="Emblema One" style="font-family: 'Emblema One';">Emblema One</option>
					<option value="Hammersmith One" style="font-family: 'Hammersmith One';">Hammersmith One</option>
					<option value="Krona One" style="font-family: 'Krona One';">Krona One</option>
					<option value="Graduate" style="font-family: 'Graduate';">Graduate</option>
					<option value="Indie Flower" style="font-family: 'Indie Flower';">Indie Flower</option>
					<option value="Courgette" style="font-family: 'Courgette';">Courgette</option>
				</select>
			</label>
		</div>
		<div id="text-controls-style">
			<label class="btn-label" for="text-cmd-bold">
				<input type="checkbox" value="bold" name="fonttype_bold" id="text-cmd-bold" >
				<span class="icon bold"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
				                             width="24" height="24"
				                             viewBox="0 0 172 172"
				                             style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none"  font-size="none"  style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M50.16667,21.5c-7.83362,0 -14.33333,6.49972 -14.33333,14.33333v35.83333v14.33333v50.16667c0,7.83362 6.49972,14.33333 14.33333,14.33333h45.19759c20.33453,0 38.65078,-14.89919 40.62044,-35.56739c1.63279,-17.11874 -7.93401,-32.39394 -22.21386,-39.31868c4.58645,-5.0661 8.0625,-12.33489 8.0625,-21.86393c0,-14.93056 -8.52274,-24.36863 -16.50293,-28.35872c-7.98018,-3.99009 -15.74707,-3.89128 -15.74707,-3.89128zM50.16667,35.83333h39.41667c0,0 4.77478,0.09881 9.33626,2.37956c4.56148,2.28074 8.58041,5.38433 8.58041,15.53711c0,10.15278 -4.01892,13.25637 -8.58041,15.53711c-4.56148,2.28074 -9.33626,2.37956 -9.33626,2.37956h-39.41667zM50.16667,86h39.41667h0.71386h6.4528c14.75507,0 26.41754,12.41253 24.97135,27.57487c-1.22668,12.87181 -13.00829,22.5918 -26.35709,22.5918h-45.19759z"></path></g></g></svg></span>
			</label>
			<label class="btn-label" for="text-cmd-italic">
				<input type="checkbox" value="italic" name="fonttype_italic" id="text-cmd-italic" >
				<span class="icon italic"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
				                               width="24" height="24"
				                               viewBox="0 0 172 172"
				                               style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M71.66667,21.5c-3.956,0 -7.16667,3.21067 -7.16667,7.16667c0,3.956 3.21067,7.16667 7.16667,7.16667h13.88542l-14.75326,100.33333h-13.46549c-3.956,0 -7.16667,3.21067 -7.16667,7.16667c0,3.956 3.21067,7.16667 7.16667,7.16667h43c3.956,0 7.16667,-3.21067 7.16667,-7.16667c0,-3.956 -3.21067,-7.16667 -7.16667,-7.16667h-14.5433l14.75326,-100.33333h14.12337c3.956,0 7.16667,-3.21067 7.16667,-7.16667c0,-3.956 -3.21067,-7.16667 -7.16667,-7.16667z"></path></g></g></svg></span>
			</label>
			<label class="btn-label" for="text-cmd-underline">
				<input type="checkbox" value="underline" name="fonttype_underline" id="text-cmd-underline" >
				<span class="icon underline"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
				                                  width="24" height="24"
				                                  viewBox="0 0 172 172"
				                                  style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M50.05469,14.23535c-3.95253,0.06178 -7.10881,3.312 -7.05469,7.26465v64.5c0,23.66165 19.33835,43 43,43c23.66165,0 43,-19.33835 43,-43v-64.5c0.03655,-2.58456 -1.32136,-4.98858 -3.55376,-6.29153c-2.2324,-1.30295 -4.99342,-1.30295 -7.22582,0c-2.2324,1.30295 -3.59031,3.70697 -3.55376,6.29153v64.5c0,15.91269 -12.75398,28.66667 -28.66667,28.66667c-15.91268,0 -28.66667,-12.75398 -28.66667,-28.66667v-64.5c0.02653,-1.93715 -0.73227,-3.80254 -2.10349,-5.17112c-1.37122,-1.36858 -3.23806,-2.12378 -5.17516,-2.09353zM50.16667,143.33333c-3.956,0 -7.16667,3.21067 -7.16667,7.16667c0,3.956 3.21067,7.16667 7.16667,7.16667h71.66667c3.956,0 7.16667,-3.21067 7.16667,-7.16667c0,-3.956 -3.21067,-7.16667 -7.16667,-7.16667z"></path></g></g></svg></span>
			</label>
		</div>
		<div id="text-controls-align">
			<label class="btn-label checked" for="text-align-left">
				<input type="checkbox" value="left" name="fontalign" id="text-align-left" checked >
				<span class="icon left"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
				                             width="24" height="24"
				                             viewBox="0 0 172 172"
				                             style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M28.66667,21.5c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h114.66667c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM28.66667,50.16667c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h78.83333c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM28.66667,78.83333c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h114.66667c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM28.66667,107.5c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h78.83333c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM28.66667,136.16667c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h114.66667c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376z"></path></g></g></svg></span>
			</label>
			<label class="btn-label" for="text-align-center">
				<input type="checkbox" value="center" name="fontalign" id="text-align-center" >
				<span class="icon center"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
				                               width="24" height="24"
				                               viewBox="0 0 172 172"
				                               style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M28.66667,21.5c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h114.66667c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM43,50.16667c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h86c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM28.66667,78.83333c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h114.66667c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM43,107.5c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h86c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM28.66667,136.16667c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h114.66667c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376z"></path></g></g></svg></span>
			</label>
			<label class="btn-label" for="text-align-right">
				<input type="checkbox" value="right" name="fontalign" id="text-align-right" >
				<span class="icon right"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
				                              width="24" height="24"
				                              viewBox="0 0 172 172"
				                              style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M28.66667,21.5c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h114.66667c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM64.5,50.16667c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h78.83333c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM28.66667,78.83333c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h114.66667c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM64.5,107.5c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h78.83333c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376zM28.66667,136.16667c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h114.66667c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376z"></path></g></g></svg></span>
			</label>
		</div>
		<div id="text-controls-additional">
			<label class="btn-label" for="text-cmd-capitalize">
				<input type="checkbox" value="capitalize" name="fonttransform" id="text-cmd-capitalize" >
				<span class="icon capitalize"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
				                                   width="24" height="24"
				                                   viewBox="0 0 172 172"
				                                   style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M28.66667,21.5c-3.956,0 -7.16667,3.21067 -7.16667,7.16667c0,3.956 3.21067,7.16667 7.16667,7.16667h35.83333v107.5c0,3.956 3.21067,7.16667 7.16667,7.16667c3.956,0 7.16667,-3.21067 7.16667,-7.16667v-107.5h35.83333c3.956,0 7.16667,-3.21067 7.16667,-7.16667c0,-3.956 -3.21067,-7.16667 -7.16667,-7.16667zM100.33333,78.83333c-3.956,0 -7.16667,3.21067 -7.16667,7.16667c0,3.956 3.21067,7.16667 7.16667,7.16667h14.33333v50.16667c0,3.956 3.21067,7.16667 7.16667,7.16667c3.956,0 7.16667,-3.21067 7.16667,-7.16667v-50.16667h14.33333c3.956,0 7.16667,-3.21067 7.16667,-7.16667c0,-3.956 -3.21067,-7.16667 -7.16667,-7.16667z"></path></g></g></svg></span>
			</label>
			<label class="btn-label" for="text-cmd-uppercase">
				<input type="checkbox" value="uppercase" name="fonttransform" id="text-cmd-uppercase" >
				<span class="icon uppercase"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
				                                  width="24" height="24"
				                                  viewBox="0 0 172 172"
				                                  style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M14.33333,28.66667c-3.956,0 -7.16667,3.21067 -7.16667,7.16667c0,3.956 3.21067,7.16667 7.16667,7.16667h21.5v93.16667c0,3.956 3.21067,7.16667 7.16667,7.16667c3.956,0 7.16667,-3.21067 7.16667,-7.16667v-93.16667h21.5c3.956,0 7.16667,-3.21067 7.16667,-7.16667c0,-3.956 -3.21067,-7.16667 -7.16667,-7.16667zM100.33333,28.66667c-3.956,0 -7.16667,3.21067 -7.16667,7.16667c0,3.956 3.21067,7.16667 7.16667,7.16667h21.5v93.16667c0,3.956 3.21067,7.16667 7.16667,7.16667c3.956,0 7.16667,-3.21067 7.16667,-7.16667v-93.16667h21.5c3.956,0 7.16667,-3.21067 7.16667,-7.16667c0,-3.956 -3.21067,-7.16667 -7.16667,-7.16667z"></path></g></g></svg></span>
			</label>
			<label class="btn-label" for="text-cmd-lowercase">
				<input type="checkbox" value="lowercase" name="fonttransform" id="text-cmd-lowercase" >
				<span class="icon lowercase"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
				                                  width="24" height="24"
				                                  viewBox="0 0 172 172"
				                                  style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M50.05469,21.40202c-3.95253,0.06178 -7.10881,3.312 -7.05469,7.26465v21.5h-7.16667c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h7.16667v64.45801c0,11.02611 8.52107,20.13235 19.27441,21.27604l0.5319,0.26595h1.69368c3.21833,0 6.17641,-0.31075 8.84635,-0.82584c2.58408,-0.41156 4.73852,-2.19861 5.62057,-4.66211c0.88205,-2.4635 0.35151,-5.2119 -1.38408,-7.1701c-1.73559,-1.9582 -4.40038,-2.81498 -6.95198,-2.23517c-1.66518,0.32128 -3.6013,0.4901 -5.71094,0.51791h-0.44792c-4.03653,-0.02203 -7.13867,-3.13398 -7.13867,-7.16667v-64.45801h7.16667c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376h-7.16667v-21.5c0.02653,-1.93715 -0.73227,-3.80254 -2.10349,-5.17112c-1.37122,-1.36858 -3.23806,-2.12378 -5.17516,-2.09353zM107.38802,21.40202c-3.95253,0.06178 -7.10881,3.312 -7.05469,7.26465v21.5h-7.16667c-2.58456,-0.03655 -4.98858,1.32136 -6.29153,3.55376c-1.30295,2.2324 -1.30295,4.99342 0,7.22582c1.30295,2.2324 3.70697,3.59031 6.29153,3.55376h7.16667v64.45801c0,11.02611 8.52107,20.13235 19.27441,21.27604l0.5319,0.26595h1.69368c3.14539,0 6.03529,-0.29792 8.66439,-0.79785c2.54998,-0.44198 4.66365,-2.22431 5.5299,-4.66303c0.86625,-2.43872 0.35053,-5.15503 -1.34925,-7.10656c-1.69979,-1.95153 -4.31962,-2.83516 -6.85415,-2.31179c-1.62033,0.30817 -3.5058,0.47703 -5.57097,0.50391h-0.44792c-4.03653,-0.02198 -7.13867,-3.13398 -7.13867,-7.16667v-64.45801h7.16667c2.58456,0.03655 4.98858,-1.32136 6.29153,-3.55376c1.30295,-2.2324 1.30295,-4.99342 0,-7.22582c-1.30295,-2.2324 -3.70697,-3.59031 -6.29153,-3.55376h-7.16667v-21.5c0.02653,-1.93715 -0.73227,-3.80254 -2.10349,-5.17112c-1.37122,-1.36858 -3.23806,-2.12378 -5.17516,-2.09353z"></path></g></g></svg></span>
			</label>
		</div>
	</form>
</div>
