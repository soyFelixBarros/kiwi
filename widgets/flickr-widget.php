<?php 

// Flickr widget for kiwi WordPress theme

class kiwi_flickr_widget extends WP_Widget {

	function __construct() {
        $widget_ops = array( 
			'classname' 	=> 'kiwi_flickr_widget', 
			'description' 	=> __( 'Muestra tus últimas fotos de Flickr.', 'kiwi' ) 
		);
        parent::__construct( 'kiwi_flickr_widget', __( 'Flickr Widget', 'kiwi' ), $widget_ops );
    }
	
	function widget( $args, $instance ) {
	
		// Outputs the content of the widget
		extract( $args ); // Make before_widget, etc available.
		
		$widget_title = apply_filters('widget_title', $instance['widget_title']);
		$fli_id = $instance['id'];
		$fli_number = $instance['number'];
		$unique_id = $args['widget_id'];
		
		echo $before_widget;
		
		
		if ( ! empty( $widget_title ) ) {
		
			echo $before_title . $widget_title . $after_title;
			
		} ?>
				
			<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $fli_number; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $fli_id; ?>"></script>
					
		<p class="widgetmore"><a href="http://www.flickr.com/photos/<?php echo "$fli_id"; ?>"><?php _e( 'Más sobre Flickr &raquo;', 'kiwi' ); ?></a></p>
		
		<?php echo $after_widget; 
	}
	
	
	function update( $new_instance, $old_instance ) {
	
		//update and save the widget
		return $new_instance;
		
	}
	
	function form( $instance ) {
	
		// Get the options into variables, escaping html characters on the way
		$widget_title = $instance['widget_title'];
		$fli_id = $instance['id'];
		$fli_number = $instance['number'];
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'widget_title' ); ?>"><?php  _e( 'Título', 'kiwi' ); ?>:
			<input id="<?php echo $this->get_field_id( 'widget_title' ); ?>" name="<?php echo $this->get_field_name( 'widget_title' ); ?>" type="text" class="widefat" value="<?php echo $widget_title; ?>" /></label>
		</p>
				
		
		<p>
			<label for="<?php echo $this->get_field_id( 'id' ); ?>"><?php _e( 'Flickr ID (use <a target="_blank" href="http://www.idgettr.com">idGettr</a>):', 'kiwi' ); ?>
			<input id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" type="text" class="widefat" value="<?php echo $fli_id; ?>" /></label>
		</p>
		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Número de imágenes para mostrar:', 'kiwi' ); ?>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" class="widefat" value="<?php echo $fli_number; ?>" /></label>
		</p>
		
		<?php
	}
}
register_widget( 'kiwi_flickr_widget' ); ?>