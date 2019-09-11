<?php get_header(); ?>

<div class="content section-inner">

	<div class="posts">

		<div class="post">
		
			<div class="content-inner">
	                
				<div class="post-header">
				        
		        	<h2 class="post-title"><?php _e( 'Error 404', 'kiwi' ); ?></h2>
		        	
		        </div>
			                                                	            
		        <div class="post-content">
		        	            
		            <p><?php _e( "Parece que has intentado abrir una página que no existe. Pudo haberse eliminado, movido o nunca existió. Le invitamos a buscar lo que está buscando con el siguiente formulario.", 'kiwi' ); ?></p>
		            
		            <?php get_search_form(); ?>
		            
		        </div><!-- .post-content -->
	        
	        </div><!-- .content-inner -->
	            	                        	
		</div><!-- .post -->
	
	</div><!-- .posts -->

</div><!-- .content -->

<?php get_footer(); ?>
