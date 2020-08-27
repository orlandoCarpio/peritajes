(function( $ ) {

	// make a "class" so we can have multiple of these fields in one form
	
	
	
	var image_mapping = (function( $field ) {

		var

		x,
		y,
		tempX,
		tempY,
		imgWidth,
		imgHeight,
		coordinates,
		 
		// this field's `img`
		$fieldImg = $field.find('.image_mapping-image img'),

		// this field's marker
		$fieldMarker = $field.find('.image_mapping-image span'),
		$fieldSpan=$field.find('.image_mapping-image'),

		// this field's `input`
		$fieldInput = $field.find('input.image_mapping-input'),

		// the label for the img to link to
		imgSelector = '[data-name="' + $fieldImg.attr('data-label') + '"]',

		// option for percent based coordinates
		percentageBased = parseInt( $fieldImg.attr('data-percent-based') ),
		
		// the image from which to catch the coordinates
		$img,

		// the source of the linked image
		imgSrc,

		// the ACF container of the linked image
		$imgCon,

		// repeater parent
		$repeaterParent = $field.parents('.acf-field-repeater'),
		



		// set up the `image_mapping` object
		init = function() {

			// set the linked image, and kill the function if we couldn't find it
			if ( ! setLinkedImg() ) return;

			// set up the field with for the current image
			loadImage();
			// set up a listener for when the user changes the image
			$img.on( 'load', loadImage );

			// set up the click handler to catch the coordinates
			$fieldSpan.on('click','span',clearPosition);
			$fieldImg.on( 'click', handleClick );
			
			$fieldInput.on( 'change input', handleInputChange );
			
			
		},
		
		
		clearPosition=function(){
				 obtenerCoordenadas=$fieldInput.val().split("-");
				 if(obtenerCoordenadas[0]=="")
				 	obtenerCoordenadas.splice(0,1);
				 posicionABuscar=$(this).data('left')+','+$(this).data('top');
				 var cantidadSpan =$('.image_mapping-image span');
				 var pos=obtenerCoordenadas.indexOf(posicionABuscar);
				 var subCadena="";
				//remueve el input
				 var listaInput=$('#repeat-detalle .acf-table tbody > .acf-row');
                 var r=listaInput[pos].children[3].children[0].children[2];
				 if(r.value!=""){
				 jQuery.get('/peritajes/wp-content/plugins/acf-image-mapping-hotspots/borrar-audio.php',{'url':r.value},function(data){
					 console.log(data);
				 })
                 }
				 listaInput[pos].remove();
				var linkNuevo = document.querySelector("#repeat-detalle .acf-repeater > .acf-actions a");
				linkNuevo.click();
				var listaInputs=$('#repeat-detalle .acf-table tbody > .acf-row');	
				listaInputs[listaInputs.length-2].remove();
				//hasta aqui
				 obtenerCoordenadas.forEach(function(elemento,index){
					if(index!=pos)
						subCadena=subCadena=="" ? elemento : subCadena+"-"+elemento; 
					if(index>pos){
						spans=$(cantidadSpan[index]);
						spans.text(index);
					}

				 });
				 $fieldInput.val(subCadena);
				 $(this).remove();
				
				
				
		},

		setImgDimensions = function() {

			// set the image width & height
			imgWidth  = $fieldImg.width();
			imgHeight = $fieldImg.height();

		},

		handleInputChange = function() {

			// get the coordinates
			coordinates = $fieldInput.val().split(',');

			// we need 2 coordinates to work with
			if ( 2 !== coordinates.length ) {
				return;
			}

			tempX = coordinates[0];
			tempY = coordinates[1];

			// make sure we have numbers & units
			if (
				NaN === parseInt( tempX )
				|| ( -1 === tempX.indexOf('%') && -1 === tempX.indexOf('px') )
				|| NaN === parseInt( tempY )
				|| ( -1 === tempY.indexOf('%') && -1 === tempY.indexOf('px') )
			) {
				return;
			}

			x = tempX;
			y = tempY;

			// handle the change
			moveMarker();

		},

		moveMarker = function() {

			var cantidadSapn =$('.image_mapping-image span');
			var orden=cantidadSapn.length+1;
			$fieldSpan.append('<span data-valor="'+orden+'" id="'+orden+'" data-left="'+x+'"data-top="'+y+'"style="left:'+x+';top:'+y+';">'+orden+'</span>');
			var linkNuevo = document.querySelector("#repeat-detalle .acf-repeater > .acf-actions a");
			linkNuevo.click();
			
		},

		handleClick = function( e ) {
			// make sure we have the right dimensions, having it on a 'load' listener doesn't work for page refreshes
			setImgDimensions();
			console.log(e);	
			// transform to percentage base if specified, 4 decimal precision
			x = ( parseInt( e.offsetX ) / imgWidth * 100 ).toFixed( 4 ) + '%';
			y = ( parseInt( e.offsetY ) / imgHeight * 100 ).toFixed( 4 )+'%';
			console.log("X="+x+"y="+y);
		/*	if(parseFloat(y)>16 && parseFloat(y)<40)
				y=parseFloat(y)-1;
			if(parseFloat(y)>=40 && parseFloat(y)<=66)
				y=parseFloat(y)-2;


			if(parseFloat(y)>66 && parseFloat(y)<100)
				y=parseFloat(y)-3;
			
			y=y+'%';*/
			
			 // move the marker
			moveMarker( x, y );
			
			// update the value
			if($fieldInput.val()!="")
				$fieldInput.val($fieldInput.val()+'-'+ x + ',' + y );
            else    
				$fieldInput.val(x + ',' + y );
		},

		setLinkedImg = function() {

			$imgCon = $field.siblings( imgSelector );

			// check all the repeater parents
			while ( ! $imgCon.length ) {

				// if there are no more, give up the search
				if ( ! $repeaterParent.length ) {
					console.log('Couldn\'t find a match for the linked image');
					return false;
				}

				// search for the img container
				$imgCon = $repeaterParent.siblings( imgSelector );
				console.log("valor de img"+imgSelector);

				// get the next repeater parent
				$repeaterParent = $repeaterParent.parents('.acf-field-repeater');
				

			}

			$img = $imgCon.find('img[data-name="image"]');

			return true;

		},

		loadImage = function() {

			// get the img src
			imgSrc = $img.attr('src');

			// we don't want to work with thumbnails so lets get the full size image
			var regex  = /([\s\S]*)-[0-9]+x[0-9]+(.[a-zA-Z]+)$/.exec( imgSrc );
			if ( regex ) {
				imgSrc = regex[1] + regex[2];
				
			}

			// add the source to the designated `img` tag
			$fieldImg.attr( 'src', imgSrc );

		};

		return init;

	});
	// $fieldImg.on( 'click', handleClicks );
	// handleClicks = function( e ) {
	// 	acf.addAction('new_field/type=text', myCallback);	
	// };
	

	if( typeof acf.add_action !== 'undefined' ) {
	
		/*
		*  ready append (ACF5)
		*
		*  These are 2 events which are fired during the page load
		*  ready = on page load similar to $(document).ready()
		*  append = on new DOM elements appended via repeater field
		*
		*  @type	event
		*  @date	20/07/13
		*
		*  @param	$el (jQuery selection) the jQuery element which contains the ACF fields
		*  @return	n/a
		*/
		
		acf.add_action('ready append', function( $el ){
			
			// search $el for fields of type 'image_mapping'
			acf.get_fields({ type : 'image_mapping'}, $el).each(function(){

				image_mapping( $(this) )();
				
			});
			
		});
		
		
	} else {
		
		
		/*
		*  acf/setup_fields (ACF4)
		*
		*  This event is triggered when ACF adds any new elements to the DOM. 
		*
		*  @type	function
		*  @since	1.0.0
		*  @date	01/01/12
		*
		*  @param	event		e: an event object. This can be ignored
		*  @param	Element		postbox: An element which contains the new HTML
		*
		*  @return	n/a
		*/
		
		// $(document).on('acf/setup_fields', function(e, postbox){
			
		// 	$(postbox).find('.field[data-field_type="image_mapping"]').each(function(){
				
		// 		initialize_field( $(this) );
				
		// 	});
		
		// });
	
	
	}


})(jQuery);