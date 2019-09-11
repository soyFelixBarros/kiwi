<?php get_header(); ?>

<div class="content section-inner">
			
		<div class="posts">
		
			<div class="page-title">
	
				<h4><?php if ( is_day() ) : ?>
					<?php printf( __( 'Fecha: %s', 'kiwi' ), '' . get_the_date() . '' ); ?>
				<?php elseif ( is_month() ) : ?>
					<?php printf( __( 'Mes: %s', 'kiwi' ), '' . get_the_date( _x( 'F Y', 'F = Month, Y = Year', 'kiwi' ) ) ); ?>
				<?php elseif ( is_year() ) : ?>
					<?php printf( __( 'Año: %s', 'kiwi' ), '' . get_the_date( _x( 'Y', 'Y = Year', 'kiwi' ) ) ); ?>
				<?php elseif ( is_category() ) : ?>
					<?php printf( __( 'Categoría: %s', 'kiwi' ), '' . single_cat_title( '', false ) . '' ); ?>
				<?php elseif ( is_tag() ) : ?>
					<?php printf( __( 'Etiqueta: %s', 'kiwi' ), '' . single_tag_title( '', false ) . '' ); ?>
				<?php elseif ( is_author() ) : ?>
					<?php $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?>
					<?php printf( __( 'Autor: %s', 'kiwi' ), $curauth->display_name ); ?>
				<?php else : ?>
					<?php _e( 'Archivo', 'kiwi' ); ?>
				<?php endif;
				
				$paged = get_query_var('paged') ? get_query_var('paged') : 1;
				
				if ( "1" < $wp_query->max_num_pages ) : ?>
				
					<span><?php printf( __( '(página %1$s de %2$s)', 'kiwi' ), $paged, $wp_query->max_num_pages ); ?></span>
				
				<?php endif; ?></h4>
				
				<?php
				$tag_description = tag_description();
				if ( ! empty( $tag_description ) ) {
					echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' );
				}
				?>
				
			</div><!-- .page-title -->
			
			<div class="clear"></div>
	
			<?php if ( have_posts() ) : ?>
					
				<?php while ( have_posts() ) : the_post(); ?>
				
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
						<?php get_template_part( 'content', get_post_format() ); ?>
						
						<div class="clear"></div>
						
					</div><!-- .post -->
					
				<?php endwhile; ?>
							
		</div><!-- .posts -->
					
		<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		
			<div class="post-nav archive-nav">
			
				<?php echo get_next_posts_link( __( 'Antiguas', 'kiwi' ) ); ?>
							
				<?php echo get_previous_posts_link( __( 'Nuevas', 'kiwi' ) ); ?>
				
				<div class="clear"></div>
				
			</div><!-- .post-nav archive-nav -->
			
			<div class="clear"></div>
			
		<?php endif; ?>
				
	<?php endif; ?>

</div><!-- .content -->

<?php get_footer(); ?>