<?php
/*
 * Plugin Name: B3C Recipes
 *
*/

//const plugin_dir =  WP_PLUGIN_DIR.'/b3c-recipes/';
//const carbon_fields_url = plugin_dir.'carbon-fields/';

define( 'plugin_dir', WP_PLUGIN_DIR.'/b3c-recipes/' );
define( 'carbon_fields_url', plugin_dir.'carbon-fields/' );




/*
 * Carbon Fields 
 */

//Init Carbon Fields
require_once( 'carbon-fields/carbon-fields-plugin.php' );
add_action( 'after_setup_theme', 'carbon_fields_load' );
function carbon_fields_load() {
    require_once( carbon_fields_url.'vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}

// Include Recipes Custom Fields
require_once( 'includes/custom-post-type.php' );
// Include Settings Page
require_once( 'includes/settings-page.php' );

// Include Recipes Taxonomy Fields
require_once( 'includes/taxonomy-fields.php' );
// Include Recipes Custom Fields
require_once( 'includes/custom-fields.php' );

//Shortcodes
require_once( 'includes/shortcodes.php' );
//Functions
require_once( 'includes/functions.php' );

require_once( 'includes/options.php' );
/*
* TEMPLATES
*/

//Single Content
add_action( 'the_content', 'b3c_recipes_add_template_part_content' );
function b3c_recipes_add_template_part_content( $content ) {

    global $post;

    if ( 'b3c_recipes' == get_post_type() && is_single() ){
       
        remove_filter( 'the_content', 'b3c_recipes_add_template_part_content' );
        
        ob_start();
        	echo do_shortcode('[recipe-template]');
        return ob_get_clean();
    }

    return $content;

}



//REGISTER SCRIPT & STYLE
add_action('init', 'register_recipe_gallery_script');
function register_recipe_gallery_script() {
    wp_enqueue_script( 'b3c-recipes', plugins_url('assets/b3c-recipes.js', __FILE__) , array('jquery'), '1.0', true);
    wp_enqueue_style( 'b3c-recipes', plugins_url('assets/b3c-recipes.css', __FILE__) ,  '1.0', true);
}

//ADMIN CSS
function admin_style() {
  wp_enqueue_style('b3c-recipes-admin', plugins_url('assets/b3c-admin.css', __FILE__));
}
add_action('admin_enqueue_scripts', 'admin_style');

//PRINT CSS
add_action('wp_header', 'print_recipe_gallery_style');
function print_recipe_gallery_style() {
    global $add_recipe_gallery_style;
    if ( !  $add_recipe_gallery_style ) return;
    wp_print_styles('b3c-recipes');
}

//PRINT JS
add_action('wp_footer', 'print_recipe_gallery_script');
function print_recipe_gallery_script() {
    global $add_recipe_gallery_script;
    if ( !  $add_recipe_gallery_script ) return;
    wp_print_scripts('b3c-recipes');
}


//https://misha.blog/wordpress/translations.html
add_action( 'plugins_loaded', 'true_load_plugin_textdomain' );
function true_load_plugin_textdomain() {
  load_plugin_textdomain( 'b3c-recipes', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
}