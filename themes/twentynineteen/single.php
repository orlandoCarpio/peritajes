<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
acf_form_head();
get_header();
//inicio
  echo "<h3 id='mensaje-list'>Inicie sesion por favor.</h3>";
if(is_user_logged_in()){
?>
<script>
    jQuery("#mensaje-list").css('display','none');
    jQuery("#menu-item-304").css('display','none');
</script>



	<section id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php

			/* Start the Loop */
			while ( have_posts() ) :
			
				
				the_post();
				the_title( sprintf( '<h2 class="entry-title"><a href="#" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
				get_template_part( 'template-parts/content/content', 'single' );
				//actualiza en nombre del post
				$types=get_post_type(get_the_ID());
				if($types=='post'){
					$apellido=get_field('field_5c4cffebac1d8');
					$nombre=get_field('field_5c4cfffeac1d9');
					$marca=get_field('field_5c4d000cac1da');
					$modelo=get_field('field_5c4d0020ac1db');
					$anio=get_field('field_5c5a504b2e124');
					$titulo=$apellido." ".$nombre." ".$marca." ".$modelo;
					$my_post = array(
						'post_title'   => $titulo,
						
					);
					// Update the post into the database
					wp_update_post( $my_post );
				}
				
				if ( is_singular( 'attachment' ) ) {
					// Parent post navigation.
					the_post_navigation(
						array(
							/* translators: %s: parent post link */
							'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'twentynineteen' ), '%title' ),
						)
					);
				} elseif ( is_singular( 'post' ) ) {
					// Previous/next post navigation.paginacion
					//the_post_navigation(
					//	array(
					//		'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next Post', 'twentynineteen' ) . '</span> ' .
					//			'<span class="screen-reader-text">' . __( 'Next post:', 'twentynineteen' ) . '</span> <br/>' .
					//			'<span class="post-title">%title</span>',
					//		'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous Post', 'twentynineteen' ) . '</span> ' .
					//			'<span class="screen-reader-text">' . __( 'Previous post:', 'twentynineteen' ) . '</span> <br/>' .
					//			'<span class="post-title">%title</span>',
					//	)
					//);
				}
				
				//acf_form();
				
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					//comments_template();
				}

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php }
get_footer();