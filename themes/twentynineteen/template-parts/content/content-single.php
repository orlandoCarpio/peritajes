<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( ! twentynineteen_can_show_post_thumbnail() ) : ?>
	<header class="entry-header">
		<?php 
			//quita los enlaces superiores del las entradas
			//get_template_part( 'template-parts/header/entry', 'header' ); ?>
	</header>
	<?php endif; ?>

	<div class="entry-content">
	
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentynineteen' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
				
			)
		);
  

		acf_form(array(
			'return'=>"listado/",
			'submit_value'=> 'Guardar Cambios',
			
		));


			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'twentynineteen' ),
					'after'  => '</div>',
				)
			);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php 
		//comentar esta lina para no mostrar los enlances de las entradas cuando se esta editando
		//twentynineteen_entry_footer(); ?>
	</footer><!-- .entry-footer -->

	<?php if ( ! is_singular( 'attachment' ) ) : ?>
	<?php get_template_part( 'template-parts/post/author', 'bio' ); ?>
	<?php endif; ?>

</article><!-- #post-${ID} -->
