<?php
/**
 * Twenty Nineteen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

/**
 * Twenty Nineteen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

if ( ! function_exists( 'twentynineteen_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function twentynineteen_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Nineteen, use a find and replace
		 * to change 'twentynineteen' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'twentynineteen', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'twentynineteen' ),
				'footer' => __( 'Footer Menu', 'twentynineteen' ),
				'social' => __( 'Social Links Menu', 'twentynineteen' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 190,
				'width'       => 190,
				'flex-width'  => false,
				'flex-height' => false,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'twentynineteen' ),
					'shortName' => __( 'S', 'twentynineteen' ),
					'size'      => 19.5,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'twentynineteen' ),
					'shortName' => __( 'M', 'twentynineteen' ),
					'size'      => 22,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'twentynineteen' ),
					'shortName' => __( 'L', 'twentynineteen' ),
					'size'      => 36.5,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'twentynineteen' ),
					'shortName' => __( 'XL', 'twentynineteen' ),
					'size'      => 49.5,
					'slug'      => 'huge',
				),
			)
		);

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary', 'twentynineteen' ),
					'slug'  => 'primary',
					'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 33 ),
				),
				array(
					'name'  => __( 'Secondary', 'twentynineteen' ),
					'slug'  => 'secondary',
					'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 23 ),
				),
				array(
					'name'  => __( 'Dark Gray', 'twentynineteen' ),
					'slug'  => 'dark-gray',
					'color' => '#111',
				),
				array(
					'name'  => __( 'Light Gray', 'twentynineteen' ),
					'slug'  => 'light-gray',
					'color' => '#767676',
				),
				array(
					'name'  => __( 'White', 'twentynineteen' ),
					'slug'  => 'white',
					'color' => '#FFF',
				),
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'twentynineteen_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentynineteen_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'twentynineteen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'twentynineteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'twentynineteen_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function twentynineteen_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'twentynineteen_content_width', 640 );
}
add_action( 'after_setup_theme', 'twentynineteen_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function twentynineteen_scripts() {
	wp_enqueue_style( 'twentynineteen-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	wp_style_add_data( 'twentynineteen-style', 'rtl', 'replace' );

	if ( has_nav_menu( 'menu-1' ) ) {
		wp_enqueue_script( 'twentynineteen-priority-menu', get_theme_file_uri( '/js/priority-menu.js' ), array(), '1.1', true );
		wp_enqueue_script( 'twentynineteen-touch-navigation', get_theme_file_uri( '/js/touch-keyboard-navigation.js' ), array(), '1.1', true );
	}

	wp_enqueue_style( 'twentynineteen-print-style', get_template_directory_uri() . '/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'twentynineteen_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twentynineteen_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twentynineteen_skip_link_focus_fix' );

/**
 * Enqueue supplemental block editor styles.
 */
function twentynineteen_editor_customizer_styles() {

	wp_enqueue_style( 'twentynineteen-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.1', 'all' );

	if ( 'custom' === get_theme_mod( 'primary_color' ) ) {
		// Include color patterns.
		require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
		wp_add_inline_style( 'twentynineteen-editor-customizer-styles', twentynineteen_custom_colors_css() );
	}
}
add_action( 'enqueue_block_editor_assets', 'twentynineteen_editor_customizer_styles' );

/**
 * Display custom color CSS in customizer and on frontend.
 */
function twentynineteen_colors_css_wrap() {

	// Only include custom colors in customizer or frontend.
	if ( ( ! is_customize_preview() && 'default' === get_theme_mod( 'primary_color', 'default' ) ) || is_admin() ) {
		return;
	}

	require_once get_parent_theme_file_path( '/inc/color-patterns.php' );

	$primary_color = 199;
	if ( 'default' !== get_theme_mod( 'primary_color', 'default' ) ) {
		$primary_color = get_theme_mod( 'primary_color_hue', 199 );
	}
	?>

	<style type="text/css" id="custom-theme-colors" <?php echo is_customize_preview() ? 'data-hue="' . absint( $primary_color ) . '"' : ''; ?>>
		<?php echo twentynineteen_custom_colors_css(); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'twentynineteen_colors_css_wrap' );

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-twentynineteen-svg-icons.php';

/**
 * Custom Comment Walker template.
 */
require get_template_directory() . '/classes/class-twentynineteen-walker-comment.php';

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
// agregado
/**
 * add roles of user
 */
 $tecnico=add_role(
	'tecnico',
	_('Tecnico'),
	array(
		'read'=>true,
		'edit_posts'=>true,
		'delete_posts'=>false,
	)
 );
 $gerente=add_role(
	'gerente',
	_('Gerente'),
	array(
		'read'=>true,
		'edit_posts'=>true,
		'delete_posts'=>false,
	)
 );
 
$vendedor=add_role(
	'vendedor',
	_('Vendedor'),
	array(
		'read'=>true,
		'edit_posts'=>true,
		'delete_posts'=>false,
	)
 );
 
//agregar archivo script
add_action('wp_enqueue_scripts','nuevos_script_js');
function nuevos_script_js(){

	    
       
       
	wp_register_script('miscript',get_template_directory_uri().'/js/script.js',
		array('jquery'),'1',true);
		wp_enqueue_script('miscript');
		/*para bootstrap*/
	wp_register_script('bootstrap-script',get_stylesheet_directory_uri().'/js/bootstrap.min.js',
		array('jquery'),'4.3.1',false);
		wp_enqueue_script('bootstrap-script');

	
}

add_action( 'wp_enqueue_scripts', 'custom_enqueue_styles');
function custom_enqueue_styles() {

	
		
     
	wp_enqueue_style( 'custom-style', 
					  get_stylesheet_directory_uri() . '/custom.css', 
					  array(), 
					  wp_get_theme()->get('Version')
					);
					/*para bootstrap*/
	wp_enqueue_style( 'bootstrap-style', 
					  get_stylesheet_directory_uri() . '/css/bootstrap.min.css', 
					  array(), 
					  '4.3.1'
					);
					
}

//configurar imagen
//Agregar configuración de imagen predeterminada al campo de imagen
add_action('acf/render_field_settings/type=image',
           'add_default_value_to_image_field', 20);
function add_default_value_to_image_field($field) {
  $args = array(
    'label' => 'Default Image',
    'instructions' => 'Appears when creating a new post',
    'type' => 'image',
    'name' => 'default_value'
  );
  acf_render_field_setting($field, $args);
}
//Poner en cola los scripts de medios de WP en la página de edición del grupo de campo ACF
add_action('admin_enqueue_scripts', 'enqueue_uploader_for_image_default');
function enqueue_uploader_for_image_default() {
  $screen = get_current_screen();
  if ($screen && $screen->id && ($screen->id == 'acf-field-group')) {
    acf_enqueue_uploader();
  }
}
//Restablecer imagen predeterminada
add_filter('acf/load_value/type=image', 'reset_default_image', 10, 3);
function reset_default_image($value, $post_id, $field) {
  if (!$value) {
    $value = $field['default_value'];
  }
  return $value;
}


//agrega el usuario
add_action('acf/render_field_settings', 'my_admin_only_render_field_settings');

function my_admin_only_render_field_settings( $field ) {
	
	acf_render_field_setting( $field, array(
		'label'			=> __('Show field for User Rol'),
		'instructions'	=> '',
		'name'			=> 'admin_only',
		'type'			=> 'checkbox',
		'default_value' => array(''),
		'choices'    => array(
			'administrator'        => __("Administrador",'acf'),
			'gerente'        => __("Gerente",'acf'),
			'tecnico'		=>__("Tecnico",'acf'),
			'vendedor'		=>__("Vendedor",'acf'),
		), 
		'layout' => 'horizontal',	
		'ui'=> 1,
	), true);
	
}
//mostrar campos por usuarios
add_filter('acf/prepare_field', 'my_admin_only_prepare_field');

function my_admin_only_prepare_field( $field ) {
	
	// bail early if no 'admin_only' setting
	if( empty($field['admin_only']) ) {
		return $field;
	}
	
	

	$user=wp_get_current_user();//obtiene el usuario actual
	$n=$user->roles[0];
	if (is_array($field['admin_only'])){
		if(in_array($user->roles[0],$field['admin_only'])){
			return false;	
	
		 }
	}	 
	return ($field);

}
//solo lectura
add_action('acf/render_field_settings', 'add_readonly_and_disabled_to_text_field');
  function add_readonly_and_disabled_to_text_field($field) {
    acf_render_field_setting( $field, array(
	  
				'type' => 'checkbox',
				'label' => 'Disabled field for User Rol',
				'name' => 'user_roles',
				'instructions'	=> '',
				'required' => 0,
				'default_value' => array(''),
				'choices'    => array(
					'administrator'        => __("Administrador",'acf'),
					'gerente'        => __("Gerente",'acf'),
					'tecnico'		=>__("Tecnico",'acf'),
					'vendedor'		=>__("Vendedor",'acf'),
			    ), 
				'layout' => 'horizontal'	
	
	
    ));
  }
  add_filter('acf/prepare_field', 'prepare_disable');

function prepare_disable( $field ) {
	$user=wp_get_current_user();//obtiene el usuario actual
	$n=$user->roles[0];
	
	if (is_array($field['user_roles'])){
		if(in_array($user->roles[0],$field['user_roles'])){
			if($user->roles[0]=="vendedor" ){ 
				if( get_field('field_5c6cf71829559')=="revision" ){
					
							$field['disabled'] = false;
				}else{
					$field['disabled'] = true;	
				}
					
			}
			else{
				$field['disabled'] = true;
			}
			
	
		 }
	}	 
	return ($field);

}
function my_custom_login_redirect($redirect_to, $request, $user) {
	global $user;
   
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
	  if ( (in_array( 'gerente', $user->roles ))|| (in_array( 'vendedor', $user->roles ))||(in_array( 'tecnico', $user->roles )) ) {
		return home_url("listado");
	  }
	}
   
	return $redirect_to;
  }
  add_filter( 'login_redirect', 'my_custom_login_redirect', 10, 3 );
 
  ?>