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
	
	// if($("#acf-field_5c736de96b6a7").val()=="vendedor" || $("#acf-field_5c736de96b6a7").val()==""){
		
	// 		var v=document.querySelectorAll("#acf-form input");
	// 		v.forEach(function(a){
	// 			if(a.type == "checkbox" || a.type == "number"){
	// 				if($("#acf-field_5c6cf71829559").val()=="cotizacion"){
	// 					if(a.id!='acf-field_5c6ec8a91dd29')
	// 					a.disabled=false;
	// 				}else{
	// 					if((a.id=='acf-field_5c6ec8a91dd29') || (a.id=='acf-field_5c6ed45d3b946')|| (a.id=='acf-field_5c6ed4bc3b947')|| (a.id=='acf-field_5c6ed5243b948'))
	// 					a.disabled=false;
	// 				}
	// 			}
	// 		});
		
        
	// }
	$(".suma-interior input").focus(function(){
		var a = Number($("#gasto_interior input").val());
		var b= Number($(this).val());
		$("#gasto_interior input").val(a-b);
		
	});	
	$(".suma-interior input").blur(function(){
		var a = Number($("#gasto_interior input").val());
		var b= Number($(this).val());
		$("#gasto_interior input").val(a+b);
		
	});	

	$(".gasto-total input").focus(function(){
		var a = Number($("#total_gastos input").val());
		var b= Number($(this).val());
		
		$("#total_gastos input").val(a-b);
		var c=Number($("#total_gastos input").val());
		var d=Number($("#tasacion input").val());
		$("#tasacion-vehiculo-gastos input").val(d-c);
		
	});	
	$("#tasacion input").blur(function(){
		var c=Number($("#total_gastos input").val());
		var d=Number($("#tasacion input").val());
		$("#tasacion-vehiculo-gastos input").val(d-c);
	});
	$(".gasto-total input").blur(function(){
		var a = Number($("#total_gastos input").val());
		var b= Number($(this).val());
		$("#total_gastos input").val(a+b);

		var c=Number($("#total_gastos input").val());
		var d=Number($("#tasacion input").val());
		$("#tasacion-vehiculo-gastos input").val(d-c);
		
	});	
	$(".suma-mecanica input").focus(function(){
		var a = Number($("#gastos-mecanica input").val());
		var b= Number($(this).val());
		
		$("#gastos-mecanica input").val(a-b);
		
	});	
	$(".suma-mecanica input").blur(function(){
		var a = Number($("#gastos-mecanica input").val());
		var b= Number($(this).val());
		$("#gastos-mecanica input").val(a+b);
		
	});	
	$("#id-gastos-reparacion input").blur(function(){
		$("#gastos-carroceria input").val($(this).val());
	});
	
$("body").on("click",".overlay",function(){
        alert("entro");
		setTimeout(function(){
			$(".overlay").css({'display':'none'});
		},5000);
		
	});
	
})( jQuery );