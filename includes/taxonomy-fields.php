<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

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
        ->set_layout( 'tabbed-vertical' )
        ->add_fields( array(
            Field::make( 'text', 'tax_nutritions_item_amount', 'Amount' )
            	->set_attribute( 'type', 'number' )
            	->set_attribute('step','any')
            	->set_width( 20 ),

			Field::make( 'select', 'tax_nutritions_item_name', 'Nutrition property' )
				->add_options( get_ingredient_nutrition_property() ) //from options.php
				->set_width( 80 ),
        ) )
        ->set_header_template( '<% if (tax_nutritions_item_name) { %> <%- $_index %>. <%- tax_nutritions_item_name %> <% } %>' ),

	 ) );

}