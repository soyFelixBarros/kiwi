<?php

/* Template Name: Archive template */

get_header(); ?>

<div class="content section-inner">						
			
	<div class="posts">

		<div class="post">
		
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
				<div class="content-inner <?php if ( comments_open() ) echo ' comments-allowed'; ?>">
										
					<div class="post-header">
												
						<?php the_title( '<h2 class="post-title">', '</h2>' ); ?>
					    				    
				    </div><!-- .post-header -->
				   				        			        		                
					<div class="post-content">
								                                        
						<?php the_content(); ?>
						
						<div class="archive-box">
					
							<div class="archive-col">
												
								<h3><?php _e( 'Últimas 30 publicaciones', 'kiwi' ) ?></h3>
								            
					            <ul>
									<?php 

									$archive_30 = get_posts( array( 
										'post_status'		=> 'publish',
										'post_type'			=> 'post',
										'posts_per_page' 	=> 30,
									) );

						            foreach( $archive_30 as $post ) : ?>
						                <li>
						                	<a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo get_the_title( $post->ID );?> <span>(<?php echo get_the_time( get_option( 'date_format' ), $post->ID ); ?>)</span>
						                	</a>
						                </li>
						            <?php endforeach; ?>
					            </ul>
					            
					            <h3><?php _e( 'Archivos por categorías', 'kiwi' ); ?></h3>
					            
					            <ul>
					                <?php wp_list_categories( 'title_li=' ); ?>
					            </ul>
					            
					            <h3><?php _e( 'Archivos por etiquetas', 'kiwi') ?></h3>
					            
					            <ul>
									<?php 
									
									$tags = get_tags();
					                
					                if ( $tags ) {
					                    foreach ( $tags as $tag ) {
					                 	   echo '<li><a href="' . get_tag_link( $tag->term_id ) . '" title="' . sprintf( __( "Ver todas las publicaciones en %s", 'kiwi' ), $tag->name ) . '" ' . '>' . $tag->name.'</a></li> ';
					                    }
					                } ?>
					            </ul>
				            
				            </div><!-- .archive-col -->
				            
				            <div class="archive-col">
				            
				            	<h3><?php _e( 'Contribuyentes', 'kiwi' ); ?></h3>
				            	
				            	<ul>
				            		<?php wp_list_authors(); ?> 
				            	</ul>
				            	
				            	<h3><?php _e( 'Archivos por año', 'kiwi' ); ?></h3>
				            	
				            	<ul>
				            	    <?php wp_get_archives( 'type=yearly' ); ?>
				            	</ul>
				            	
				            	<h3><?php _e( 'Archivos por mes', 'kiwi' ); ?></h3>
				            	
				            	<ul>
				            	    <?php wp_get_archives( 'type=monthly' ); ?>
				            	</ul>
				            
					            <h3><?php _e( 'Archivos por día', 'kiwi' ); ?></h3>
					            
					            <ul>
					                <?php wp_get_archives( 'type=daily' ); ?>
					            </ul>
				            
				            </div><!-- .archive-col -->
				            
				            <div class="clear"></div>
		            
			            </div><!-- .archive-box -->
			            
			            <?php if ( current_user_can( 'manage_options' ) ) : ?>
																		
							<p><?php edit_post_link( __( 'Editar', 'kiwi' ) ); ?></p>
						
						<?php endif; ?>
															            			                        
					</div><!-- .post-content -->
					
					<?php wp_reset_query(); ?>
					
				</div><!-- .content-inner -->
				
				<div class="clear"></div>
				
				<?php comments_template( '', true ); ?>
			
			<?php endwhile; else: ?>
	
				<p><?php _e( "No pudimos encontrar ninguna publicación que coincida con su consulta. Inténtalo de nuevo.", "kiwi" ); ?></p>
		
			<?php endif; ?>

		</div><!-- .post -->
	
	</div><!-- .posts -->

	<div class="clear"></div>
	
</div><!-- .content section-inner -->
								
<?php get_footer(); ?>