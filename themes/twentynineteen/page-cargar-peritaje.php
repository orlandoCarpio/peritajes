<?php
/*

Template Name: Nuevo Peritaje

*/
acf_form_head();
get_header();
?>
	 <section id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php 
			     echo "<h3 id='mensaje-list'>Inicie Sesion por favor.</h3>";
				 if(!is_user_logged_in()){
			?>	      <script>
                      jQuery("#menu-item-304").css('display','block');
                        jQuery("#mensaje-list").css('display','block');
                    </script>
                 
			<?php	     
				 }else{
                ?>
                <script>
                        jQuery("#menu-item-304").css('display','none');
                        jQuery("#mensaje-list").css('display','none');
                </script>
			    <?php
			/* Start the Loop */
			while ( have_posts() ) :
			    
			   
			    
				the_post();
				$user=wp_get_current_user();//obtiene el usuario actual
				if($user->roles[0]=="gerente")
				{
					echo"<h3 style='text-align: -webkit-center;'>No tiene permiso en esta página</h3>";
				}else{
					//get_template_part( 'template-parts/content/content', 'page' );
					?><h1 class="entry-title title-h1">Nuevo Peritaje</h1>
						<div class='entry-content'>
							
					<?php
						acf_form(array(
								'return'=>"listado/",
								'post_id' =>'new_post',
								'new_post'=> array(
									'post_type'     =>    'post',
									'post_status'  => 'publish'
					
								),
								'submit_value'=> 'Guardar'
						)); 
					?></div>
					<?php
				}
				//$user=wp_get_current_user();//obtiene el usuario actual
				if($user->roles[0]=="vendedor"){
					?>
					<script>
						var a=document.getElementById('termina-vendedor');
						a.style.display='none';
					</script>
					<?php
				}
				
				
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					//comments_template();
				}
				
				
                 
			endwhile; // End of the loop.
                 }
			?>

		  </main> <!--#main  -->
	</section><!--#primary -->
<?php
get_footer();
?>