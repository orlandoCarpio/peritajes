	
(function( $ ) {
	$("#acf-field_5c6ec7ea8c2ed").change(function() {
		if($('#acf-field_5c6ec7ea8c2ed').is(':checked')){
			if($("#acf-field_5c6cf71829559").val()=="revision")
				$("#acf-field_5c6cf71829559").val('pendiente');
		}
		else
				$("#acf-field_5c6cf71829559").val('revision');
	});
	$("#acf-field_5c735fce17f6d").change(function() {
		if($('#acf-field_5c735fce17f6d').is(':checked')){
			if($("#acf-field_5c6cf71829559").val()=="pendiente")
				$("#acf-field_5c6cf71829559").val('cotizacion');
		}
		else
				$("#acf-field_5c6cf71829559").val('pendiente');
	});
	$("#acf-field_5c6ec8a91dd29").change(function() {
		if($('#acf-field_5c6ec8a91dd29').is(':checked')){
			if($("#acf-field_5c6cf71829559").val()=="cotizacion")
				$("#acf-field_5c6cf71829559").val('cerrado');
		}
		else
				$("#acf-field_5c6cf71829559").val('cotizacion');
	});
	
	if($("#acf-field_5c736de96b6a7").val()=="vendedor" || $("#acf-field_5c736de96b6a7").val()==""){
		
			var v=document.querySelectorAll("#acf-form input");
			v.forEach(function(a){
				if(a.type == "checkbox" || a.type == "number"){
					if($("#acf-field_5c6cf71829559").val()=="cotizacion"){
						if(a.id!='acf-field_5c6ec8a91dd29')
						a.disabled=true;
					}else{
						if((a.id=='acf-field_5c6ec8a91dd29') || (a.id=='acf-field_5c6ed45d3b946')|| (a.id=='acf-field_5c6ed4bc3b947')|| (a.id=='acf-field_5c6ed5243b948'))
						a.disabled=true;
					}
				}
			});
		
        
	}
/*agregar clases al formulario*/	
$(".acf-input").addClass("form-group");
$("input").addClass("form-control");
$("select").addClass("form-control");
	
		
})( jQuery );