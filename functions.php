<?php


/* ---------------------------------------------------------------------------------------------
   THEME SETUP
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'kiwi_setup' ) ) {

	function kiwi_setup() {
		
		// Automatic feed
		add_theme_support( 'automatic-feed-links' );
		
		// Custom background
		add_theme_support( 'custom-background' );
		
		// Post formats
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
		
		// Post thumbnails
		add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
		add_image_size( 'post-image', 766, 9999 );
		
		// Title tag
		add_theme_support( 'title-tag' );

		// Set content width
		global $content_width;
		if ( ! isset( $content_width ) ) $content_width = 766;

		// Custom header (logo)
		$custom_header_args = array( 'width' => 200, 'height' => 200, 'header-text' => false );
		add_theme_support( 'custom-header', $custom_header_args );
		
		// Add nav menu
		register_nav_menu( 'primary', 'Primary Menu' );
		
		// Make the theme translation ready
		load_theme_textdomain('kiwi', get_template_directory() . '/languages');
		
		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable($locale_file) )
		require_once($locale_file);
		
	}
	add_action( 'after_setup_theme', 'kiwi_setup' );

}


/* ---------------------------------------------------------------------------------------------
   ENQUEUE SCRIPTS
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'kiwi_load_javascript_files' ) ) {

	function kiwi_load_javascript_files() {

		if ( ! is_admin() ) {
			wp_enqueue_script( 'kiwi_flexslider', get_template_directory_uri().'/js/flexslider.min.js', array('jquery'), '', true  );
			wp_enqueue_script( 'kiwi_global', get_template_directory_uri().'/js/global.js', array('jquery'), '', true );
			if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'kiwi_load_javascript_files' );

}


/* ---------------------------------------------------------------------------------------------
   ENQUEUE STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'kiwi_load_style' ) ) {

	function kiwi_load_style() {
		if ( ! is_admin() ) {

			$dependencies = array();

			/**
			 * Translators: If there are characters in your language that are not
			 * supported by the theme fonts, translate this to 'off'. Do not translate
			 * into your own language.
			 */
			$google_fonts = _x( 'on', 'Google Fonts: on or off', 'kiwi' );

			if ( 'off' !== $google_fonts ) {

				// Register Google Fonts
				wp_register_style( 'kiwi_google_fonts', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic|Raleway:600,500,400' );
				$dependencies[] = 'kiwi_google_fonts';

			}

			wp_enqueue_style( 'kiwi_style', get_stylesheet_uri(), $dependencies );
		}
	}
	add_action( 'wp_print_styles', 'kiwi_load_style' );

}


/* ---------------------------------------------------------------------------------------------
   ADD EDITOR STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'kiwi_add_editor_styles' ) ) {

	function kiwi_add_editor_styles() {
		add_editor_style( 'kiwi-editor-styles.css' );
		$font_url = '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic|Raleway:600,500,400';
		add_editor_style( str_replace( ',', '%2C', $font_url ) );
	}
	add_action( 'init', 'kiwi_add_editor_styles' );

}


/* ---------------------------------------------------------------------------------------------
   ADD FOOTER WIDGET AREAS
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'kiwi_sidebar_registration' ) ) {

	function kiwi_sidebar_registration() {

		register_sidebar( array(
			'after_title' 	=> '</h3>',
			'after_widget' 	=> '</div><div class="clear"></div></div>',
			'before_title' 	=> '<h3 class="widget-title">',
			'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
			'description' 	=> __( 'Los widgets en esta área se mostrarán en la primera columna del pie de página.', 'kiwi' ),
			'id' 			=> 'footer-a',
			'name' 			=> __( 'Pie de página A', 'kiwi' ),
		) );

		register_sidebar( array(
			'after_title' 	=> '</h3>',
			'after_widget' 	=> '</div><div class="clear"></div></div>',
			'before_title' 	=> '<h3 class="widget-title">',
			'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
			'description' 	=> __( 'Los widgets en esta área se mostrarán en la segunda columna del pie de página.', 'kiwi' ),
			'id' 			=> 'footer-b',
			'name' 			=> __( 'Pie de página B', 'kiwi' ),
		) );

		register_sidebar( array(
			'after_title' 	=> '</h3>',
			'after_widget' 	=> '</div><div class="clear"></div></div>',
			'before_title' 	=> '<h3 class="widget-title">',
			'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
			'description' 	=> __( 'Los widgets en esta área se mostrarán en la tercera columna del pie de página.', 'kiwi' ),
			'id' 			=> 'footer-c',
			'name' 			=> __( 'Pie de página C', 'kiwi' ),
		) );

	}
	add_action( 'widgets_init', 'kiwi_sidebar_registration' ); 

}
	

/* ---------------------------------------------------------------------------------------------
   INCLUDE THEME WIDGETS
   --------------------------------------------------------------------------------------------- */


require_once( get_template_directory() . "/widgets/dribbble-widget.php" );
require_once( get_template_directory() . "/widgets/flickr-widget.php" );


/* ---------------------------------------------------------------------------------------------
   CHECK FOR JAVASCRIPT
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'kiwi_html_js_class' ) ) {

	function kiwi_html_js_class() {
		echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";
	}
	add_action( 'wp_head', 'kiwi_html_js_class', 1 );

}


/* ---------------------------------------------------------------------------------------------
   ADD CLASSES TO PAGINATION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'kiwi_posts_link_attributes_1' ) ) {

	function kiwi_posts_link_attributes_1() {
		return 'class="post-nav-older"';
	}
	add_filter( 'next_posts_link_attributes', 'kiwi_posts_link_attributes_1' );

}

if ( ! function_exists( 'kiwi_posts_link_attributes_2' ) ) {

	function kiwi_posts_link_attributes_2() {
		return 'class="post-nav-newer"';
	}
	add_filter( 'previous_posts_link_attributes', 'kiwi_posts_link_attributes_2' );

}


/* ---------------------------------------------------------------------------------------------
   MENU WALKER ADDING HAS-CHILDREN
   --------------------------------------------------------------------------------------------- */


class kiwi_nav_walker extends Walker_Nav_Menu {

    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

		$id_field = $this->db_fields['id'];
		
        if ( ! empty( $children_elements[ $element->$id_field ] ) ) {
            $element->classes[] = 'has-children';
		}
		
        Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
	
}


/* ---------------------------------------------------------------------------------------------
   BODY CLASSES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'kiwi_body_classes' ) ) {

	function kiwi_body_classes( $classes ) {

		// When there's a post thumbnail
		if ( has_post_thumbnail() ) { 
			$classes[] = 'has-featured-image';
		}

		return $classes;
	}
	add_action( 'body_class', 'kiwi_body_classes' );

}


/* ---------------------------------------------------------------------------------------------
   CUSTOM MORE LINK TEXT
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'kiwi_custom_more_link' ) ) {

	function kiwi_custom_more_link( $more_link, $more_link_text ) {
		return str_replace( $more_link_text, __( 'Sigue leyendo', 'kiwi' ), $more_link );
	}
	add_filter( 'the_content_more_link', 'kiwi_custom_more_link', 10, 2 );

}


/* ---------------------------------------------------------------------------------------------
   FLEXSLIDER OUTPUT FOR IMAGE GALLERY FORMAT
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'kiwi_flexslider' ) ) {

	function kiwi_flexslider( $size = 'thumbnail' ) {

		$attachment_parent = is_page() ? $post->ID : get_the_ID();

		$images = get_posts( array(
			'orderby'        	=> 'menu_order',
			'order'          	=> 'ASC',
			'post_mime_type' 	=> 'image',
			'post_parent'    	=> $attachment_parent,
			'post_status'    	=> null,
			'post_type'      	=> 'attachment',
			'posts_per_page'    => -1,
		) );

		if ( $images ) : ?>
		
			<div class="flexslider">
			
				<ul class="slides">
		
					<?php foreach( $images as $image ) { 

						$attimg = wp_get_attachment_image( $image->ID, $size ); 
						
						?>
						
						<li>
							<?php echo $attimg; ?>
							<?php if ( ! empty( $image->post_excerpt ) ) : ?>
								<div class="media-caption-container">
									<p class="media-caption"><?php echo $image->post_excerpt; ?></p>
								</div>
							<?php endif; ?>
						</li>
						
						<?php 
					} ?>
			
				</ul>
				
			</div><!-- .flexslider -->
			
			<?php
			
		endif;
	}

}


/* ---------------------------------------------------------------------------------------------
   META FUNCTION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'kiwi_meta' ) ) {

	function kiwi_meta() { ?>
		
		<div class="post-meta">
		
			<span class="post-date"><a href="<?php the_permalink(); ?>" title="<?php the_time( get_option( 'time_format' ) ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></span>
			
			<span class="date-sep"> / </span>
				
			<span class="post-author"><?php the_author_posts_link(); ?></span>
			
			<?php if ( comments_open() ) : ?>
			
				<span class="date-sep"> / </span>
				
				<?php comments_popup_link( '<span class="comment">' . __( '0 Comentarios', 'kiwi' ) . '</span>', __( '1 Comentario', 'kiwi' ), __( '% Comentarios', 'kiwi' ) ); ?>
			
			<?php endif; ?>
			
			<?php if ( is_sticky() && ! has_post_thumbnail() ) : ?> 
			
				<span class="date-sep"> / </span>
			
				<?php _e( 'Sticky', 'kiwi' ); ?>
			
			<?php endif; ?>
			
			<?php edit_post_link(__( 'Editar', 'kiwi' ), '<span class="date-sep"> / </span>' ); ?>
									
		</div><!-- .post-meta -->
		<?php	
	}

}


/* ---------------------------------------------------------------------------------------------
   STYLE THE ADMIN AREA
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'kiwi_admin_style' ) ) {

	function kiwi_admin_style() {
	echo '<style type="text/css">
	
			#postimagediv #set-post-thumbnail img {
				max-width: 100%;
				height: auto;
			}

		</style>';
	}
	add_action( 'admin_head', 'kiwi_admin_style' );

}


/* ---------------------------------------------------------------------------------------------
   kiwi COMMENT
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'kiwi_comment' ) ) {
	
	function kiwi_comment( $comment, $args, $depth ) {
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		
			<?php __( 'Pingback:', 'kiwi' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Editar)', 'kiwi' ), '<span class="edit-link">', '</span>' ); ?>
			
		</li>
		<?php
				break;
			default :
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		
			<div id="comment-<?php comment_ID(); ?>" class="comment">
			
				<div class="comment-meta comment-author vcard">
								
					<?php echo get_avatar( $comment, 120 ); ?>

					<div class="comment-meta-content">
												
						<?php printf( '<cite class="fn">%1$s %2$s</cite>',
							get_comment_author_link(),
							( $comment->user_id === $post->post_author ) ? '<span class="post-author"> ' . __( '(Publicar autor)', 'kiwi' ) . '</span>' : ''
						); ?>
						
						<p><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php echo get_comment_date() . ' &mdash; ' . get_comment_time() ?></a></p>
						
					</div><!-- .comment-meta-content -->
					
					<div class="comment-actions">
					
						<?php edit_comment_link( __( 'Editar', 'kiwi' ), '', '' ); ?>
						
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Respuesta', 'kiwi' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
										
					</div><!-- .comment-actions -->
					
					<div class="clear"></div>
					
				</div><!-- .comment-meta -->

				<div class="comment-content post-content">
				
					<?php if ( '0' == $comment->comment_approved ) : ?>
					
						<p class="comment-awaiting-moderation"><?php __( 'Tu comentario está esperando ser moderado.', 'kiwi' ); ?></p>
						
					<?php endif; ?>
				
					<?php comment_text(); ?>
					
					<div class="comment-actions">
					
						<?php edit_comment_link( __( 'Editar', 'kiwi' ), '', '' ); ?>
						
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Respuesta', 'kiwi' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						
						<div class="clear"></div>
					
					</div><!-- .comment-actions -->
					
				</div><!-- .comment-content -->

			</div><!-- .comment-## -->
		<?php
			break;
		endswitch;
	}
}


/* ---------------------------------------------------------------------------------------------
   kiwi THEME OPTIONS
   --------------------------------------------------------------------------------------------- */


class kiwi_customize {

	public static function kiwi_register( $wp_customize ) {

		// Add our kiwi options section
		$wp_customize->add_section( 'kiwi_options', array(
			'capability' 	=> 'edit_theme_options', 
			'description' 	=> __( 'Le permite personalizar la configuración del tema para kiwi.', 'kiwi' ), 
			'priority' 		=> 35, 
			'title' 		=> __( 'Opciones para kiwi', 'kiwi' ), 
		) );

		// Add a setting for accent color
		$wp_customize->add_setting( 'accent_color', array(
			'default' 			=> '#1abc9c', 
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' 		=> 'postMessage', 
			'type' 				=> 'theme_mod', 
		) );

		// And one for the logo
		$wp_customize->add_setting( 'kiwi_logo', array( 
			'sanitize_callback' => 'esc_url_raw'
		) );

		// Add a control to go along with the accent color setting
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kiwi_accent_color', array(
			'label' 	=> __( 'Acentuar el color', 'kiwi' ), 
			'priority' 	=> 10,
			'section' 	=> 'colors', 
			'settings' 	=> 'accent_color', 
		) ) );

		// Set the bloginfo values to be updated via postMessage (live JS preview)
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	}

	// Function handling our header output of styles
	public static function kiwi_header_output() {

		echo '<style type="text/css">';

		self::kiwi_generate_css( 'body a', 'color', 'accent_color' );
		self::kiwi_generate_css( 'body a:hover', 'color', 'accent_color' );
		self::kiwi_generate_css( '.header', 'background', 'accent_color' );
		self::kiwi_generate_css( '.post-bubbles a:hover', 'background-color', 'accent_color' );
		self::kiwi_generate_css( '.post-nav a:hover', 'background-color', 'accent_color' );
		self::kiwi_generate_css( '.comment-meta-content cite a:hover', 'color', 'accent_color' );
		self::kiwi_generate_css( '.comment-meta-content p a:hover', 'color', 'accent_color' );
		self::kiwi_generate_css( '.comment-actions a:hover', 'background-color', 'accent_color' );
		self::kiwi_generate_css( '.widget-content .textwidget a:hover', 'color', 'accent_color' );
		self::kiwi_generate_css( '.widget_archive li a:hover', 'color', 'accent_color' );
		self::kiwi_generate_css( '.widget_categories li a:hover', 'color', 'accent_color' );
		self::kiwi_generate_css( '.widget_meta li a:hover', 'color', 'accent_color' );
		self::kiwi_generate_css( '.widget_nav_menu li a:hover', 'color', 'accent_color' );
		self::kiwi_generate_css( '.widget_rss .widget-content ul a.rsswidget:hover', 'color', 'accent_color' );
		self::kiwi_generate_css( '#wp-calendar thead', 'color', 'accent_color' );
		self::kiwi_generate_css( '.widget_tag_cloud a:hover', 'background', 'accent_color' );
		self::kiwi_generate_css( '.search-button:hover .genericon', 'color', 'accent_color' );
		self::kiwi_generate_css( '.flexslider:hover .flex-next:active', 'color', 'accent_color' );
		self::kiwi_generate_css( '.flexslider:hover .flex-prev:active', 'color', 'accent_color' );
		self::kiwi_generate_css( '.post-title a:hover', 'color', 'accent_color' );

		self::kiwi_generate_css( '.post-content a', 'color', 'accent_color' );
		self::kiwi_generate_css( '.post-content a:hover', 'color', 'accent_color' );
		self::kiwi_generate_css( '.post-content a:hover', 'border-bottom-color', 'accent_color' );
		self::kiwi_generate_css( '.post-content fieldset legend', 'background', 'accent_color' );
		self::kiwi_generate_css( '.post-content input[type="submit"]:hover', 'background', 'accent_color' );
		self::kiwi_generate_css( '.post-content input[type="button"]:hover', 'background', 'accent_color' );
		self::kiwi_generate_css( '.post-content input[type="reset"]:hover', 'background', 'accent_color' );
		self::kiwi_generate_css( '.post-content .has-accent-color', 'color', 'accent_color' );
		self::kiwi_generate_css( '.post-content .has-accent-background-color', 'background-color', 'accent_color' );

		self::kiwi_generate_css( '.comment-header h4 a:hover', 'color', 'accent_color' );
		self::kiwi_generate_css( '.form-submit #submit:hover', 'background-color', 'accent_color' );

		echo '</style>';

	}

	// Enqueue javascript for the live preview, with the customize preview as a dependency
	public static function kiwi_live_preview() {
		wp_enqueue_script( 'kiwi-themecustomizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'jquery', 'customize-preview' ), '', true );
	}

	// Function for spitting out CSS code
	public static function kiwi_generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
		$return = '';
		$mod = get_theme_mod( $mod_name );
		if ( ! empty( $mod ) ) {
			$return = sprintf( '%s { %s:%s; }', $selector, $style, $prefix.$mod.$postfix );
			if ( $echo ) echo $return;
		}
		return $return;
	}
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'kiwi_customize' , 'kiwi_register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'kiwi_customize' , 'kiwi_header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'kiwi_customize' , 'kiwi_live_preview' ) );


/* ---------------------------------------------------------------------------------------------
   SPECIFY GUTENBERG SUPPORT
------------------------------------------------------------------------------------------------ */


if ( ! function_exists( 'kiwi_add_gutenberg_features' ) ) :

	function kiwi_add_gutenberg_features() {

		/* Gutenberg Palette --------------------------------------- */

		$accent_color = get_theme_mod( 'accent_color' ) ? get_theme_mod( 'accent_color' ) : '#1abc9c';

		add_theme_support( 'editor-color-palette', array(
			array(
				'name' 	=> _x( 'Acento', 'Nombre del color de acento en la paleta Gutenberg', 'kiwi' ),
				'slug' 	=> 'accent',
				'color' => $accent_color,
			),
			array(
				'name' 	=> _x( 'Negro', 'Nombre del color negro en la paleta Gutenberg.', 'kiwi' ),
				'slug' 	=> 'black',
				'color' => '#111',
			),
			array(
				'name' 	=> _x( 'Gris más oscuro', 'Nombre del color gris más oscuro en la paleta Gutenberg.', 'kiwi' ),
				'slug' 	=> 'darkest-gray',
				'color' => '#444',
			),
			array(
				'name' 	=> _x( 'Gris oscuro', 'Nombre del color gris oscuro en la paleta Gutenberg.', 'kiwi' ),
				'slug' 	=> 'dark-gray',
				'color' => '#555',
			),
			array(
				'name' 	=> _x( 'Gris', 'Nombre del color gris en la paleta Gutenberg.', 'kiwi' ),
				'slug' 	=> 'gray',
				'color' => '#666',
			),
			array(
				'name' 	=> _x( 'Gris claro', 'Nombre del color gris claro en la paleta Gutenberg.', 'kiwi' ),
				'slug' 	=> 'light-gray',
				'color' => '#EEE',
			),
			array(
				'name' 	=> _x( 'Gris más claro', 'Nombre del color gris más claro en la paleta Gutenberg.', 'kiwi' ),
				'slug' 	=> 'lightest-gray',
				'color' => '#f4f4f4',
			),
			array(
				'name' 	=> _x( 'Blanco', 'Nombre del color blanco en la paleta Gutenberg.', 'kiwi' ),
				'slug' 	=> 'white',
				'color' => '#FFF',
			),
		) );

		/* Gutenberg Font Sizes --------------------------------------- */

		add_theme_support( 'editor-font-sizes', array(
			array(
				'name' 		=> _x( 'Pequeño', 'Nombre del tamaño de letra pequeño en Gutenberg', 'kiwi' ),
				'shortName' => _x( 'S', 'Nombre corto del tamaño de fuente pequeño en el editor Gutenberg.', 'kiwi' ),
				'size' 		=> 16,
				'slug' 		=> 'small',
			),
			array(
				'name' 		=> _x( 'Regular', 'Nombre del tamaño de fuente regular en Gutenberg', 'kiwi' ),
				'shortName' => _x( 'M', 'Nombre corto del tamaño de fuente normal en el editor Gutenberg.', 'kiwi' ),
				'size' 		=> 19,
				'slug' 		=> 'regular',
			),
			array(
				'name' 		=> _x( 'Grande', 'Nombre del tamaño de letra grande en Gutenberg', 'kiwi' ),
				'shortName' => _x( 'L', 'Nombre corto del tamaño de fuente grande en el editor Gutenberg.', 'kiwi' ),
				'size' 		=> 23,
				'slug' 		=> 'large',
			),
			array(
				'name' 		=> _x( 'Más grande', 'Nombre del tamaño de letra más grande en Gutenberg', 'kiwi' ),
				'shortName' => _x( 'XL', 'Nombre corto del tamaño de fuente más grande en el editor Gutenberg.', 'kiwi' ),
				'size' 		=> 30,
				'slug' 		=> 'larger',
			),
		) );

	}
	add_action( 'after_setup_theme', 'kiwi_add_gutenberg_features' );

endif;


/* ---------------------------------------------------------------------------------------------
   GUTENBERG EDITOR STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'kiwi_block_editor_styles' ) ) :

	function kiwi_block_editor_styles() {

		$dependencies = array();

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$google_fonts = _x( 'on', 'Google Fonts: on or off', 'kiwi' );

		if ( 'off' !== $google_fonts ) {

			// Register Google Fonts
			wp_register_style( 'kiwi-block-editor-styles-font', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic|Raleway:600,500,400', false, 1.0, 'all' );
			$dependencies[] = 'kiwi-block-editor-styles-font';

		}

		// Enqueue the editor styles
		wp_enqueue_style( 'kiwi-block-editor-styles', get_theme_file_uri( '/kiwi-gutenberg-editor-style.css' ), $dependencies, '1.0', 'all' );

	}
	add_action( 'enqueue_block_editor_assets', 'kiwi_block_editor_styles', 1 );

endif;


?>