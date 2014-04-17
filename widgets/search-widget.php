<?php


add_action('widgets_init',
     create_function('', 'return register_widget("NH_SearchWidget");')
);

class NH_SearchWidget extends WP_Widget
{

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct()
	{
		parent::__construct(
			'nh-clas-search-widget',
			'CLAS Search',
			array( 
				'description' => 'Displays a custom made search textbox.',
			)
		);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance )
	{
		echo $args['before_widget'];

		if( !empty($instance['title']) )
			echo $args['before_title'].$instance['title'].$args['after_title'];

		global $nh_clas_search_term;
		$search_term = '';
		if( is_search() )
		{
			$search_term = get_search_query();
		}
		else if( isset($nh_clas_search_term) )
		{
			$search_term = $nh_clas_search_term;
		}
		?>

		<form role="search" method="get" class="searchform" action="<?php echo home_url( '/' ); ?>" >
			<label class="screen-reader-text" for="s">Search for:</label>
			<div class="textbox_wrapper"><input type="text" value="<?php echo $search_term; ?>" name="s" id="search-widget-textbox" class="s" /></div>
			<input type="submit" id="searchsubmit" value="Search" />
		</form>

		<?php

		echo $args['after_widget'];
	}

	/**
	 * Ouputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance )
	{
		$title = ( isset($instance['title']) ? $instance['title'] : '' );
		?>
				
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance )
	{
		$instance = $new_instance;
		return $instance;		
	}

}


