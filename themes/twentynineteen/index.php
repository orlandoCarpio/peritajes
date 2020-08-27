<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();

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
		if ( have_posts() ) {
			$user=wp_get_current_user();//obtiene el usuario actual
			// Load posts loop.
			while ( have_posts() ) {
				the_post();
				if($user->roles[0]=="administrator")
					get_template_part( 'template-parts/content/content' );
			}
			
			if($user->roles[0]=="administrator")
			{
				// Previous/next page navigation.
				twentynineteen_the_posts_navigation();
			}

		} else {

			// If no content, include the "No posts found" template.
			get_template_part( 'template-parts/content/content', 'none' );

		}
		?>

		</main><!-- .site-main -->
		
	</section><!-- .content-area -->

<?php }
get_footer();