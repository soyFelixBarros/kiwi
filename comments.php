<?php 

if ( post_password_required() ) {
	return;
}

if ( have_comments() ) : ?>
	
	<a name="comments"></a>

	<div class="comments">
			
		<h2 class="comments-title">
		
			<?php 
			$comment_count = count( $wp_query->comments_by_type['comment'] );
			echo $comment_count . ' ' . _n( 'Comentario', 'Comentarios', $comment_count, 'kiwi' ); ?>
			
		</h2>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'type' => 'comment', 'callback' => 'kiwi_comment' ) ); ?>
		</ol>
		
		<?php if ( ! empty( $comments_by_type['pings'] ) ) : ?>
		
			<div class="pingbacks">
			
				<div class="pingbacks-inner">
			
					<h3 class="pingbacks-title">

						<?php 
						$pingback_count = count( $wp_query->comments_by_type['pings'] );
						echo $pingback_count . ' ' . _n( 'Pingback', 'Pingbacks', $pingback_count, 'kiwi' ); ?>
					
					</h3>
				
					<ol class="pingbacklist">
						<?php wp_list_comments( array( 'type' => 'pings', 'callback' => 'kiwi_comment' ) ); ?>
					</ol>
					
				</div>
				
			</div>
		
		<?php endif; ?>
			
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		
			<div class="comment-nav-below post-nav" role="navigation">
			
				<h3 class="assistive-text section-heading"><?php _e( 'Comentario de navegación', 'kiwi' ); ?></h3>
				
				<div class="post-nav-older"><?php previous_comments_link( '&laquo; ' . __('Más viejo','kiwi') . '<span> ' . __('Comentarios', 'kiwi') . '</span>'); ?></div>
				
				<div class="post-nav-newer"><?php next_comments_link( __('Más nuevo','kiwi') . '<span> ' . __('Comentarios', 'kiwi') . '</span>  &raquo;' ); ?></div>
				
				<div class="clear"></div>
				
			</div><!-- .comment-nav-below -->
			
		<?php endif; ?>
		
	</div><!-- .comments -->
	
	<?php 
endif;

if ( ! comments_open() && !is_page() ) : ?>

	<p class="nocomments"><?php _e( 'Los comentarios están cerrados.', 'kiwi' ); ?></p>
	
<?php endif;

comment_form();

?>