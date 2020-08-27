<?php
/*

Template Name: Listado

*/

?>

 
<?php


get_header(); 
  echo "<h3 id='mensaje-list'>Inicie sesion por favor.</h3>";
if(is_user_logged_in()){
   
     

?>
<script>
    jQuery("#mensaje-list").css('display','none');
    jQuery("#menu-item-304").css('display','none');
</script>


<h2>Lista de planillas</h2>
<div class="entry-content">
<table  id="listado-vehiculos">
<tr>
	<td>ID</td>
	<td>Apellido y Nombre</td>
	<td>Marca</td>
	<td>Modelo</td>
	<td>Año</td>
	<td>Acciones</td>
</tr>
<?php
 $user=wp_get_current_user();//obtiene el usuario actual
 if($user->roles[0]=="administrator")
{
	$myposts = get_posts('numberposts=-1&');
}else{
	switch($user->roles[0]){
		case "tecnico":{$value="revision";break;}
		case "gerente":{$value="pendiente";break;}
		case "vendedor":{$value="pendiente";break;}
	}
	if($user->roles[0]=="vendedor"){
		$myposts= get_posts(array(
			'meta_key' => 'estado',
			'meta_value' => $value,
			'meta_compare'=>'!='
		
		));
		
	}else{
		$myposts= get_posts(array(
			'meta_key' => 'estado',
			'meta_value' => $value
		
		));
	}
	
}

if(count($myposts)==0){
	?>
	<tr><td colspan="6" align="middle"><h4>No se encontraron elementos.</h4></td></tr>
	<?php
}else
	
	foreach($myposts as $post) : 
		$valor=get_field('field_5c4cfffeac1d9');
		$apellido=get_field('field_5c4cffebac1d8');
		$nombre=get_field('field_5c4cfffeac1d9');
		$marca=get_field('field_5c4d000cac1da');
		$modelo=get_field('field_5c4d0020ac1db');
		$anio=get_field('field_5c5a504b2e124');
		?>
		<tr>
			<td><?php echo $post->ID;?></td>
			<td><?php echo $apellido." ".$nombre;?></td>
			<td><?php echo $marca;?></td>
			<td><?php echo $modelo;?></td>
			<td><?php echo $anio;?></td>
			<td><a class="editar"href="<?php the_permalink(); ?>">Editar</a></td>
		</tr>
		
		<?php
		$user=wp_get_current_user();//obtiene el usuario actual
		$us=$user->roles[0];
		update_field('field_5c736de96b6a7',$us , $post->ID);
	endforeach; 
	?>
	
</table>
</div>
 
<?php }
get_footer(); ?>
