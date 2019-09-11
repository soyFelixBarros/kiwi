<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" value="<?php _e( 'Escribe y presiona enter', 'kiwi' ); ?>" onfocus=" if ( this.value == '<?php _e( 'Escribe y presiona enter', 'kiwi' ); ?>' ) this.value = '';" onblur="if ( this.value == '' ) this.value = '<?php _e( 'Escribe y presiona enter', 'kiwi' ); ?>';" name="s" id="s" /> 
	<input type="submit" id="searchsubmit" value="<?php _e( 'Buscar', 'kiwi' ); ?>" class="button hidden">
</form>