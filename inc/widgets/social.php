<?php 

class AtoZ_Premium extends WP_Widget{

    /**
     * Register widget with WordPress.
     */
    function __construct() 
    {
        parent::__construct(
            'premium-widget', // Base ID
            esc_attr__( 'A to Z -Sidebar social widget', 'atoz' ), // Name
            array( 
                'description' => esc_attr__( 'Display a Premium or Feature description.', 'atoz' ),
				 'customize_selective_refresh' => true, // 1 Selective Refresh
            )
        );
		// 2 Enqueue style if widget is active (appears in a sidebar) or if in Customizer preview.
        if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
           
		function atoz_premium_widget_scripts(){
			wp_enqueue_media();
			wp_enqueue_script( 'atoz_premium_widget_script', get_template_directory_uri() . '/js/widget.js', false, '1.0', true );
		}
		add_action('admin_enqueue_scripts', 'atoz_premium_widget_scripts');
        }
    }
    
    /* *front-end widget form.
    front page view */
    public function widget( $args, $instance ){
    echo $args['before_widget'];

	?>
    
        <h2 class="widget-title"><?php if( !empty( $instance['social_title'] ) ): echo apply_filters( 'widget_title', $instance['social_title'] ); endif; ?></h2>
          <ul class="list-inline">
              <?php if( !empty( $instance['facebook_url'] ) ){?>
            <li ><a href="<?php if( !empty( $instance['facebook_url'] ) ): echo apply_filters( 'widget_title', esc_url($instance['facebook_url'] ) ); endif; ?>" title="facebook"><i class="fa fa-facebook"></i></a></li>
              <?php }?>
               <?php if( !empty( $instance['twitter_url'] ) ){?>
            <li ><a href="<?php if( !empty( $instance['twitter_url'] ) ): echo apply_filters( 'widget_title', esc_url($instance['twitter_url'] ) ); endif; ?>" title="twitter"><i class="fa  fa-twitter"></i></a></li>
               <?php }?>
              <?php if( !empty( $instance['google_url'] ) ){?>
            <li ><a href="<?php if( !empty( $instance['google_url'] ) ): echo apply_filters( 'widget_title', esc_url($instance['google_url'] ) ); endif; ?>" title="google-plus"><i class="fa  fa-google-plus"></i></a> </li>
              <?php }?>
			  <?php if( !empty( $instance['dribbble'] ) ){?>
            <li ><a href="<?php if( !empty( $instance['dribbble'] ) ): echo apply_filters( 'widget_title', esc_url($instance['dribbble'] ) ); endif; ?>" title="dribbble"><i class="fa fa-dribbble"></i></a> </li>
              <?php }?>
               <?php if( !empty( $instance['behance'] ) ){?>
            <li ><a href="<?php if( !empty( $instance['behance'] ) ): echo apply_filters( 'widget_title', esc_url($instance['behance'] ) ); endif; ?>" title="behance"><i class="fa fa-behance"></i></a> </li>
              <?php }?>
              <?php if( !empty( $instance['inst_title'] ) ){?>
            <li ><a href="<?php if( !empty( $instance['inst_title'] ) ): echo apply_filters( 'widget_title', esc_url($instance['inst_title'] ) ); endif; ?>" title="instagram"><i class="fa  fa-instagram"></i></a>
                <?php 
                    if( !empty($instance['text']) ):
                    
                        echo '<p>';
                            $wp_kses_args = array(
                                'br' => array(),
                                'em' => array(),
                                'strong' => array(),
                            );
                            echo htmlspecialchars_decode( wp_kses( apply_filters( 'widget_title', $instance['text'] ), $wp_kses_args ) );
                        echo '</p>';
                    endif;
                    ?>
            </li>
                <?php }?>
			<?php
			echo $args['after_widget'];

    }
    
    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {

        ?>
        
         <p>
            <label for="<?php echo esc_html($this->get_field_id('social_title')); ?>"><?php esc_html_e( 'Social Title', 'atoz' ); ?></label><br/>
            <input type="text" name="<?php echo $this->get_field_name('social_title'); ?>"
                   id="<?php echo esc_html($this->get_field_id('social_title')); ?>" value="<?php if( !empty( $instance['social_title'] ) ): echo esc_html($instance['social_title']); endif; ?>"
                   class="widefat"/>
        </p>        
         <p>
            <label for="<?php echo esc_html($this->get_field_id('facebook_url')); ?>"><?php esc_html_e( 'Facebook Url', 'atoz' ); ?></label><br/>
            <input type="text" name="<?php echo esc_html($this->get_field_name('facebook_url')); ?>"
                   id="<?php echo esc_html($this->get_field_id('facebook_url')); ?>" value="<?php if( !empty( $instance['facebook_url'] ) ): echo esc_html($instance['facebook_url']); endif; ?>"
                   class="widefat"/>
        </p>
        <p>
            <label for="<?php echo esc_html($this->get_field_id('twitter_url')); ?>"><?php esc_html_e( 'Twitter Url', 'atoz' ); ?></label><br/>
            <input type="text" name="<?php echo esc_html($this->get_field_name('twitter_url')); ?>"
                   id="<?php echo esc_html($this->get_field_id('twitter_url')); ?>" value="<?php if( !empty( $instance['twitter_url'] ) ): echo esc_html($instance['twitter_url']); endif; ?>"
                   class="widefat"/>
        </p>           
        <p>
            <label for="<?php echo esc_html($this->get_field_id('google_url')); ?>"><?php esc_html_e( 'Google Url', 'atoz' ); ?></label><br/>
            <input type="text" name="<?php echo esc_html($this->get_field_name('google_url')); ?>"
                   id="<?php echo esc_html($this->get_field_id('google_url')); ?>" value="<?php if( !empty( $instance['google_url'] ) ): echo esc_html($instance['google_url']); endif; ?>"
                   class="widefat"/>
        </p>       
        <p>
            <label for="<?php echo esc_html($this->get_field_id('inst_title')); ?>"><?php esc_html_e( 'Instagram Title', 'atoz' ); ?></label><br/>
            <input type="text" name="<?php echo esc_html($this->get_field_name('inst_title')); ?>"
                   id="<?php echo esc_html($this->get_field_id('inst_title')); ?>" value="<?php if( !empty( $instance['inst_title'] ) ): echo esc_html($instance['inst_title']); endif; ?>"
                   class="widefat"/>
        </p>
         <p>
            <label for="<?php echo esc_html($this->get_field_id('dribbble')); ?>"><?php esc_html_e( 'Dribbble Url', 'atoz' ); ?></label><br/>
            <input type="text" name="<?php echo esc_html($this->get_field_name('dribbble')); ?>"
                   id="<?php echo esc_html($this->get_field_id('dribbble')); ?>" value="<?php if( !empty( $instance['dribbble'] ) ): echo esc_html($instance['dribbble']); endif; ?>"
                   class="widefat"/>
        </p>              
        <p>
            <label for="<?php echo esc_html($this->get_field_id('behance')); ?>"><?php esc_html_e( 'Behance Url', 'atoz' ); ?></label><br/>
            <input type="text" name="<?php echo esc_html($this->get_field_name('behance')); ?>"
                   id="<?php echo esc_html($this->get_field_id('behance')); ?>" value="<?php if( !empty( $instance['behance'] ) ): echo esc_html($instance['behance']); endif; ?>"
                   class="widefat"/>
        </p>  
  
    <?php
    }
}
register_widget( 'AtoZ_Premium' );
?>