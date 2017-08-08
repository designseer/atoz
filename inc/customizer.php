<?php
/**
 * AtoZ Theme Customizer
 *
 * @package AtoZ
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

/*
 * Custom Scripts
 */

function atoz_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->remove_control('blogdescription');
    $wp_customize->remove_section('header_image');
    $wp_customize->remove_section('background_image');
	$wp_customize->get_setting( 'header_textcolor' )->default   = '#454545';
	$wp_customize->get_section( 'title_tagline' )->title  = __( 'Branding', 'atoz' );	 
    $wp_customize->remove_control('background_color');
    
	 /* Selective Refresh */
	if ( isset( $wp_customize->selective_refresh ) ) {	
	/*Search section */	
		$wp_customize->selective_refresh->add_partial( 'atoz_search_check', array(
			'selector'        => 'form#searchform',
			'render_callback' => 'atoz_customize_partial_searchcheck',
		) ); 
	/*Blog Listing*/
		$wp_customize->selective_refresh->add_partial( 'atoz_post_title', array(
			'selector'        => 'h2.blogpost_title',
			'render_callback' => 'atoz_customize_partial_blogtitle',
		) ); 
		$wp_customize->selective_refresh->add_partial( 'atoz_post_desc', array(
			'selector'        => 'p.blogpost_desc',
			'render_callback' => 'atoz_customize_partial_blogdesc',
		) ); 
	/*Featured items*/
		$wp_customize->selective_refresh->add_partial( 'atoz_title', array(
			'selector'        => '.serv-content h4',
			'render_callback' => 'atoz_customize_partial_serv_content',
		) ); 		
		$wp_customize->selective_refresh->add_partial( 'atoz_feat_desc', array(
			'selector'        => '.serv-content p',
			'render_callback' => 'atoz_customize_partial_atoz_feat_desc',
		) ); 
		$wp_customize->selective_refresh->add_partial( 'atoz_url_title', array(
			'selector'        => '.serv-content a',
			'render_callback' => 'atoz_customize_partial_atoz_url_title',
		) ); 
		$wp_customize->selective_refresh->add_partial( 'atoz_image', array(
			'selector'        => '.serv-img',
			'render_callback' => 'atoz_customize_partial_atoz_image',
		) ); 		
	}	
	/* A theme info panel */
	require get_template_directory() . '/inc/lib/theme-info.php';	
	$wp_customize->add_section( 'atoz_theme_info', array(
		'title'    => __( 'Theme INFO', 'atoz' ),
		'priority' => 0,
	) );
	$wp_customize->add_setting( 'atoz_theme_info', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new atoz_info( $wp_customize, 'atoz_theme_info', array(
		'section'  => 'atoz_theme_info',
		'priority' => 10,
	) ) );
	/*Accent color*/   
	$wp_customize->add_setting( 'atoz_nav_text_color', array(
            'default'                     => '#cdcfd1',
            'transport'                   => 'postMessage',
            'sanitize_callback'           => 'sanitize_hex_color',
    ) );    
    $wp_customize->add_control ( new WP_Customize_Color_Control (
        $wp_customize, 'atoz_nav_text_color', array(
            'label'                       => esc_attr__( 'Navigation Text', 'atoz' ),
            'section'                     => 'colors',
    ) ) );    	
	$wp_customize->add_setting( 'atoz_nav_bg', array(
            'default'                     => '#777',
            'transport'                   => 'postMessage',
            'sanitize_callback'           => 'sanitize_hex_color',
    ) );    
	$wp_customize->add_setting( 'atoz_submenu_bg', array(
            'default'                     => '#000',
            'transport'                   => 'postMessage',
            'sanitize_callback'           => 'sanitize_hex_color',
    ) );   
    $wp_customize->add_control ( new WP_Customize_Color_Control (
        $wp_customize, 'atoz_submenu_bg', array(
            'label'                       => esc_attr__( 'Sub Menu Bg', 'atoz' ),
            'section'                     => 'colors',
    ) ) ); 
	$wp_customize->add_setting( 'atoz_menu_hover', array(
            'default'                     => '#000',
            'transport'                   => 'refresh',
            'sanitize_callback'           => 'sanitize_hex_color',
    ) );   
    $wp_customize->add_control ( new WP_Customize_Color_Control (
        $wp_customize, 'atoz_menu_hover', array(
            'label'                       => esc_attr__( 'Menu Hover Color', 'atoz' ),
            'section'                     => 'colors',
    ) ) );  	
    $wp_customize->add_control ( new WP_Customize_Color_Control (
        $wp_customize, 'atoz_nav_bg', array(
            'label'                       => esc_attr__( 'Navigation Background', 'atoz' ),
            'section'                     => 'colors',
    ) ) );   
     $wp_customize->add_setting( 'atoz_accent_color', 
            array(
                'default' => '#fe9c46',  
                'transport' => 'postMessage', 
                'sanitize_callback' => 'sanitize_hex_color', 
            ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'atoz_accent_color', 
           array(
			'label'      => esc_attr__( 'Accent Color', 'atoz' ),
			'description' => esc_attr__( 'Add Accent Color to post,button.', 'atoz' ),
			'section'    => 'colors',
		) ) ); 
    $wp_customize->add_setting( 'atoz_footer_text_color', array(
            'default'                     => '#cdcfd1',
            'transport'                   => 'postMessage',
            'sanitize_callback'           => 'sanitize_hex_color',
    ) );    
    $wp_customize->add_control ( new WP_Customize_Color_Control (
        $wp_customize, 'atoz_footer_text_color', array(
            'label'                       => esc_attr__( 'Footer Text', 'atoz' ),
            'section'                     => 'colors',
    ) ) );    
    $wp_customize->add_setting( 'atoz_footer_bck_color', array(
            'default'                     => '#44484b',
            'transport'                   => 'postMessage',
            'sanitize_callback'           => 'sanitize_hex_color',
    ) );    
    $wp_customize->add_control ( new WP_Customize_Color_Control (
        $wp_customize, 'atoz_footer_bck_color', array(
            'label'                       => esc_attr__( 'Footer Background', 'atoz' ),
            'section'                     => 'colors',
    ) ) );  
	$wp_customize->add_setting( 'atoz_fontawesome_icons', array(
            'default'                     => '#fff',
            'transport'                   => 'postMessage',
            'sanitize_callback'           => 'sanitize_hex_color',
    ) );    
    $wp_customize->add_control ( new WP_Customize_Color_Control (
        $wp_customize, 'atoz_fontawesome_icons', array(
            'label'                       => esc_attr__( 'Font Awesome Icons', 'atoz' ),
            'section'                     => 'colors',
    ) ) ); 	
	$wp_customize->add_setting( 'atoz_social_icon_color', array(
            'default'                     => '#fff',
            'transport'                   => 'postMessage',
            'sanitize_callback'           => 'sanitize_hex_color',
    ) );    
    $wp_customize->add_control ( new WP_Customize_Color_Control (
        $wp_customize, 'atoz_social_icon_color', array(
            'label'                       => esc_attr__( 'Social Icons', 'atoz' ),
            'section'                     => 'colors',
    ) ) );  
    /*Slider*/
    $wp_customize->add_section( 'atoz_slider_options' , array(
    'title'      => __('Slider','atoz'),
    'priority'   => 42,
   ) );
   		  $wp_customize->add_setting( 'atoz_slider_check', 
				   array( 
					   'default' 	=> 0,
					   'transport' 	=> 'refresh',
					   'sanitize_callback' => 'sanitize_text_field',
				   ) );
			
		   $wp_customize->add_control( 'atoz_slider_check', array(
					'type'		=> 'checkbox',
					'label' 	=> __( 'Enable slider section', 'atoz' ),			
					'section'  	=> 'atoz_slider_options',
					
			) );
		global $options_categories;
            $wp_customize->add_setting('atoz_slide_categories', array(
                'default' => '',
                'type' => 'option',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'atoz_sanitize_slidecat'
            ));
            $wp_customize->add_control('atoz_slide_categories', array(
                'label' => __('Slider Category', 'atoz'),
                'section' => 'atoz_slider_options',
                'type'    => 'select',
                'description' => __('Select a category for the featured post slider', 'atoz'),
                'choices'    => $options_categories
            ));
			$wp_customize->add_setting(
			'atoz_slide_number',
				array(
					'sanitize_callback' => 'atoz_sanitize_integer'
				)
			);
			$wp_customize->add_control(
			'atoz_slide_number',
			array(
				'type' => 'integer',
				'default' => 3,
				'label' => __('Number Of Slides To Show - i.e 10 (default is 3)','atoz'),
				'section' => 'atoz_slider_options',
				
				)
			);    
    /*Search*/    
    $wp_customize->add_section( 'atoz_search' , array(
    'title'      => __('Search Section','atoz'),
    'priority'   => 43,
   ) );
    $wp_customize->add_setting( 'atoz_search_check', 
           array( 
               'default' => 0,
               'transport' => 'refresh',
               'sanitize_callback' => 'sanitize_text_field',
           ) );
    
	   $wp_customize->add_control( 'atoz_search_check', array(
				'type'										=> 'checkbox',
				'label' 									=> __( 'Enable search form on homepage', 'atoz' ),			
				'section'  								=> 'atoz_search',
				
		) );
    
    /* Blog Settings*/
    
     $wp_customize->add_section('atoz_post_section', array(
        'title'    => __('Blog Settings', 'atoz'),
        'description' => 'Add Title & Description to the blog listing on homepage. Post count can be changed from Settings -> Reading -> Blog pages show at most',
        'priority' => 44,
    ));   
   $wp_customize->add_setting( 'atoz_post_title', 
           array( 
               'default' => 'Add blog title here' ,
               'transport' => 'postMessage',
               'sanitize_callback' => 'sanitize_text_field',
           ) );
	$wp_customize->add_control( 'atoz_post_title', 
           array(
			'type' => 'text',
			'section' => 'atoz_post_section', 
			'label' => __( "Blog Title", 'atoz' ),
		) ); 
    $wp_customize->add_setting( 'atoz_post_desc', 
           array( 
               'default' => 'Add Description here' ,
               'transport' => 'postMessage',
               'sanitize_callback' => 'sanitize_text_field',
           ) );
	$wp_customize->add_control( 'atoz_post_desc', 
           array(
			'type' => 'text',
			'section' => 'atoz_post_section',
			'label' => __( "Description", 'atoz' ),
		) );
    $wp_customize->add_setting( 'atoz_related_post_check', 
           array( 
               'default' => 1,
               'transport' => 'refresh',
               'sanitize_callback' => 'sanitize_text_field',
           ) );
    
   $wp_customize->add_control( 'atoz_related_post_check', array(
			'type'		=> 'checkbox',
			'label' 	=> __( 'Enable/Disable Related Post', 'atoz' ),			
			'section'  	=> 'atoz_post_section',
			
	) );
      $wp_customize->add_setting( 'atoz_post_related_post_count', 
           array( 
               'default' => '3' ,
               'transport' => 'refresh',
               'sanitize_callback' => 'sanitize_text_field',
           ) );
	$wp_customize->add_control( 'atoz_post_related_post_count', 
           array(
			'type' => 'text',
			'section' => 'atoz_post_section', 
			'label' => __( "Related Post Count", 'atoz' ),
		) ); 
    
    /* Featured item*/
    
		 $wp_customize->add_section('atoz_calender', array(
			'title'    		=> __('Featured Item', 'atoz'),
			'description' 	=> 'Link to your favorite post/page/link from here. Change the default values as it will not reflect on homepage.',
			'priority' 		=> 45,
		));
		  $wp_customize->add_setting( 'atoz_Featured_check', 
				   array( 
					   'default' 	=> 0,
					   'transport' 	=> 'refresh',
					   'sanitize_callback' => 'sanitize_text_field',
				   ) );
			
		   $wp_customize->add_control( 'atoz_Featured_check', array(
					'type'		=> 'checkbox',
					'label' 	=> __( 'Enable this section', 'atoz' ),			
					'section'  	=> 'atoz_calender',
					
			) );
		$wp_customize->add_setting( 'atoz_title', 
			   array( 
				   'default' => 'Title of the item' ,
				   'transport' => 'postMessage',
				   'sanitize_callback' => 'sanitize_text_field',
			   ) );
		$wp_customize->add_control( 'atoz_title', 
			   array(
				'type' => 'text',
				'section' => 'atoz_calender',
				'label' => __( "Heading", 'atoz' ),			
			) );
		 $wp_customize->add_setting( 'atoz_feat_desc', 
			   array( 
				   'default' => 'Morbi scelerisque massa quis scelerisque fermentum. Phasellus ac nunc vehicula, malesuada orci ac, cursus turpis. Nunc eu nibh diam. Cras posuere hendrerit purus euismod tincidunt. Etiam posuere vel libero at ornare. Nulla sit amet iaculis mauris.' ,
				   'transport' => 'postMessage',
				   'sanitize_callback' => 'sanitize_text_field',
			   ) );
		$wp_customize->add_control( 'atoz_feat_desc', 
			   array(
				'type' => 'textarea',
				'section' => 'atoz_calender',
				'label' => __( "Description", 'atoz' ),
			) );    
		$wp_customize->add_setting( 'atoz_url_title', 
			   array( 
				   'default' => 'Add Button Text' ,
				   'transport' => 'postMessage',
				   'sanitize_callback' => 'sanitize_text_field',
			   ) );
		$wp_customize->add_control( 'atoz_url_title', 
			   array(
				'type' => 'text',
				'section' => 'atoz_calender',
				'label' => __( "Button Text", 'atoz' ),			
			) );    
		$wp_customize->add_setting( 'atoz_url_link', 
			   array( 
				   'default' => '#' ,
				   'transport' => 'postMessage',
				   'sanitize_callback' => 'sanitize_text_field',
			   ) );
		$wp_customize->add_control( 'atoz_url_link', 
			   array(
				'type' => 'text',
				'section' => 'atoz_calender',
				'label' => __( "Button Link", 'atoz' ),
			) );       
	   $wp_customize->add_setting( 'atoz_image', array(
				'default'           => get_template_directory_uri(). '/img/ser-1.png',
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'transport' => 'postMessage',
				'sanitize_callback' => 'esc_url_raw',
			) );

		$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize,
					'atoz_image',
					array(
						'label'    => __( 'Add a featured image', 'atoz' ),
						'section'  => 'atoz_calender',
						'settings' => 'atoz_image',
						'context'  => 'a_2_z_image',
						
					)
				)
			);
	   $wp_customize->add_setting( 'atoz_bg_image', array(
				'default'           => get_template_directory_uri(). '/img/article-bg.jpg',
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
			) );
		$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize,
					'atoz_bg_image',
					array(
						'label'    => __( 'Add a background image', 'atoz' ),
						'section'  => 'atoz_calender',
						'settings' => 'atoz_bg_image',
						'context'  => 'atoz_bg_image',						
					)
				)
			);        
		$wp_customize->add_setting( 'atoz_quote_bg_color', 
				array(
					'default' => '#fe9c46', 
					'transport' => 'postMessage', 
					'sanitize_callback' => 'sanitize_hex_color', 
				) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'atoz_quote_bg_color', 
			   array(
				'label'      => esc_attr__( 'Background Color', 'atoz' ),
				'description' => esc_attr__( 'Add a background overlay to add contrast to headings & descriptions.', 'atoz' ),
				'section'    => 'atoz_calender',
			) ) );			
		$wp_customize->add_setting( 'atoz_transparnt', 
			   array( 
				   'default' => __( '.95', 'atoz' ),
				   'transport' => 'refresh',
				   'sanitize_callback' => 'sanitize_text_field',
			   ) );
		$wp_customize->add_control( 'atoz_transparnt', 
			   array(
				'type' => 'text',
				'section' => 'atoz_calender',
				'label' => esc_attr__( "Background Transparency", 'atoz' ),
				'description' => esc_attr__( 'Change the opacity of the above background color.', 'atoz' ),
			) );
}
add_action( 'customize_register', 'atoz_customize_register' );


function atoz_sanitize_integer( $input ) {
    	if( is_numeric( $input ) ) {
        return intval( $input );
   	}
	}

function atoz_sanitize_slidecat( $input ) {
    global $options_categories;
    if ( array_key_exists( $input, $options_categories ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function atoz_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function atoz_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
/*Blog listing */
function atoz_customize_partial_blogtitle(){
	echo get_theme_mod( 'atoz_post_title' );
}
function atoz_customize_partial_blogdesc(){
	echo get_theme_mod( 'atoz_post_desc' );
}

/*Featured Item - Render */
function atoz_customize_partial_serv_content() {
	echo get_theme_mod( 'atoz_title' );
}

function atoz_customize_partial_atoz_feat_desc(){
	echo get_theme_mod('atoz_feat_desc');
}
function atoz_customize_partial_atoz_url_title(){
	echo get_theme_mod('atoz_url_title');
}
function atoz_customize_partial_atoz_image(){
	echo '<img src="'.get_theme_mod('atoz_image').'" class="img-responsive wow  fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">';
}
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function atoz_customize_preview_js() {
	wp_enqueue_script( 'atoz_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'atoz_customize_preview_js' );
?>

<?php
add_action( 'customize_controls_print_scripts', 'atoz_head_scripts', 20 );
function atoz_head_scripts() { ?>
<style>
#customize-controls .description {
    color: #73757d;
    border: 1px solid rgba(254, 156, 70, 0.38);
    padding: 10px;
    line-height: 22px;
    border-radius: 10px;
    background: #fff;
    font-style: italic;
}
.atoz-theme-info {
    background: #fff;
    padding: 10px;
    border-radius: 6px;
}
.atoz-theme-info a {
    padding: 10px;
    color: #fe9c46;
	text-decoration: none;
	    font-family: Roboto;
    font-size: 14px;
	    display: block;
}
.atoz-theme-info a:hover {
    text-decoration: underline;
}
</style>
<?php }?>

<?php
add_action( 'customize_controls_print_footer_scripts', 'customizer_custom_scripts' );
function customizer_custom_scripts() { ?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        /* This one shows/hides the an option when a checkbox is clicked. */
        jQuery('#customize-control-atoz-atoz_slide_categories, #customize-control-atoz-atoz_slide_number').hide();
            jQuery('#customize-control-atoz-atoz_slide_categories, #customize-control-atoz-atoz_slide_number').fadeToggle(400);
        
            jQuery('#customize-control-atoz-atoz_slide_categories, #customize-control-atoz-atoz_slide_number').show();
       
    });
</script>

<?php }?>