<?php

add_action('widgets_init',
     create_function('', 'return register_widget("NS_ClasButtonsWidget");')
);

class NS_ClasButtonsWidget extends WP_Widget
{

	private static $CLAS_CONNECTIONS = array(
		array(
			'title' => 'CLAS Connections',
			'link' => 'http://clasconnections.uncc.edu',
			'url' => '/images/button-clas-connections-nb.png',
		),
	);
	
	private static $THINKING_MATTERS = array(
		array(
			'title' => 'Thinking Matters',
			'link' => 'http://thinkingmatters.uncc.edu',
			'url' => '/images/button-thinking-matters-nb.png',
		),
	);
	
	private static $EXCHANGE_ONLINE = array(
		array(
			'title' => 'Exchange Online',
			'link' => 'http://exchange.uncc.edu',
			'url' => '/images/button-exchange-online-nb.png',
		),
		array(
			'title' => 'Post to Exchange Online',
			'link' => 'http://exchange.uncc.edu/post',
			'url' => '/images/button-exchange-online-post-nb.png',
		),
	);


	/**
	 * Sets up the widgets name etc
	 */
	public function __construct()
	{
		// widget actual processes
		
		//ns_print('construct');
		
		parent::__construct(
			'nsclas_buttons_widget', // Base ID
			__("CLAS Buttons", 'text_domain'), // Name
			array( 
				'description' => __( 'Displays the three CLAS buttons.', 'text_domain' ), 
			) // Args
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
		global $ns_config;

		if( isset($instance['clas-connections']) ) $cc = $instance['clas-connections'];
		else $cc = 0;

		if( isset($instance['thinking-matters']) ) $tm = $instance['thinking-matters'];
		else $tm = 0;

		if( isset($instance['exchange-online']) ) $eo = $instance['exchange-online'];
		else $eo = 0;
		?>

		<div id="clas-buttons">
			
			<?php 
			
			self::$CLAS_CONNECTIONS[$cc]['key'] = 'clas-connections';
			ns_image( self::$CLAS_CONNECTIONS[$cc] );

			self::$THINKING_MATTERS[$tm]['key'] = 'thinking-matters';
			ns_image( self::$THINKING_MATTERS[$tm] );

			self::$EXCHANGE_ONLINE[$eo]['key'] = 'exchange-online';
			ns_image( self::$EXCHANGE_ONLINE[$eo] );
			
			?>
			
		</div>

		<?php
	}

	/**
	 * Ouputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance )
	{
		if( isset($instance['clas-connections']) ) $cc = $instance['clas-connections'];
		else $cc = 0;

		if( isset($instance['thinking-matters']) ) $tm = $instance['thinking-matters'];
		else $tm = 0;

		if( isset($instance['exchange-online']) ) $eo = $instance['exchange-online'];
		else $eo = 0;
		?>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'clas-connections' ); ?>"><?php _e( 'CLAS Connections:' ); ?></label><br/>
		<?php
		for( $i = 0; $i < count(self::$CLAS_CONNECTIONS); $i++ )
		{
			self::$CLAS_CONNECTIONS[$i]['key'] = 'clas-connections';
			unset(self::$CLAS_CONNECTIONS[$i]['link']);
			?><input type="radio" name="<?php echo $this->get_field_name( 'clas-connections' ); ?>" value="<?php echo $i; ?>" <?php if($i==$cc) echo 'checked'; ?>><?php
			ns_image( self::$CLAS_CONNECTIONS[$i] );
			echo '<br/>';
		}
		?>		
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'thinking-matters' ); ?>"><?php _e( 'Thinking Matters:' ); ?></label><br/>
		<?php
		for( $i = 0; $i < count(self::$THINKING_MATTERS); $i++ )
		{
			self::$THINKING_MATTERS[$i]['key'] = 'thinking-matters';
			unset(self::$THINKING_MATTERS[$i]['link']);
			?><input type="radio" name="<?php echo $this->get_field_name( 'thinking-matters' ); ?>" value="<?php echo $i; ?>" <?php if($i==$tm) echo 'checked'; ?>><?php
			ns_image( self::$THINKING_MATTERS[$i] );
			echo '<br/>';
		}
		?>		
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'exchange-online' ); ?>"><?php _e( 'Exchange Online:' ); ?></label><br/>
		<?php
		for( $i = 0; $i < count(self::$EXCHANGE_ONLINE); $i++ )
		{
			self::$EXCHANGE_ONLINE[$i]['key'] = 'exchange-online';
			unset(self::$EXCHANGE_ONLINE[$i]['link']);
			?><input type="radio" name="<?php echo $this->get_field_name( 'exchange-online' ); ?>" value="<?php echo $i; ?>" <?php if($i==$eo) echo 'checked'; ?>><?php
			ns_image( self::$EXCHANGE_ONLINE[$i] );
			echo '<br/>';
		}
		?>		
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
		$instance = array();
		$instance['clas-connections'] = ( !empty($new_instance['clas-connections']) ? intval($new_instance['clas-connections']) : 0 );
		$instance['thinking-matters'] = ( !empty($new_instance['thinking-matters']) ? intval($new_instance['thinking-matters']) : 0 );
		$instance['exchange-online'] = ( !empty($new_instance['exchange-online']) ? intval($new_instance['exchange-online']) : 0 );

		return $instance;		
	}

}


