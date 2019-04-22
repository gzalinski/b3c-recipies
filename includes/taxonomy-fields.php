<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;
require_once plugin_dir."includes/options.php";

add_action( 'carbon_fields_register_fields', 'b3c_taxonomy_fields_register_callback' );
function b3c_taxonomy_fields_register_callback() {
	
	Container::make( 'term_meta', 'ingredients' )
	 ->where( 'term_taxonomy', '=', 'ingredients' )

	->add_tab('Image', array(

		Field::make('image', 'tax_ingredient_image','')

	))

	/*...............................................................
	:	#NUTRITIONS 												:
	...............................................................*/

	 ->add_tab(  __('Nutritions','b3c-recipes'), array(

	
		Field::make( 'complex', 'tax_nutritions_items', '' )
        ->set_layout( 'tabbed-horizontal' )
        ->add_fields( array(
            Field::make( 'text', 'tax_nutritions_item_amount', __('Amount','b3c-recipes') )
            	->set_attribute( 'type', 'number' )
            	->set_attribute('step','any')
            	->set_width( 15 ),

			Field::make( 'select', 'tax_nutritions_item_unit', __('Unite','b3c-recipes') )
				->add_options( get_ingredient_nutrition_unit() ) //from options.php
				->set_width( 15 ),

			Field::make( 'select', 'tax_nutritions_item_name', __('Nutrition property','b3c-recipes') )
				->add_options( get_ingredient_nutrition_property() ) //from options.php
				->set_width( 70 ),
        ) )
        ->set_header_template( '<% if (tax_nutritions_item_name) { %> <%- $_index %>. <%- tax_nutritions_item_name %> <% } %>' ),

	 ) );

}