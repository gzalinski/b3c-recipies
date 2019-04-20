<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;


add_action( 'carbon_fields_register_fields', 'b3c_custom_fields_register_callback' );
function b3c_custom_fields_register_callback() {


	/* UPDATE TAXONOMIES 
		NEED screept
		https://stackoverflow.com/questions/27613167/wordpress-publish-post-hook-not-firing-for-custom-post-type
	*/

	/*...............................................................
	:	#Details 													:
	...............................................................*/	 
	Container::make( 'post_meta', 'Recipe' )
	->show_on_post_type( 'b3c_recipes' )

	->add_tab('Details', array(

		Field::make('text', 'ricipe_servings', __('Servings','b3c-recipes'))
			->set_attribute( 'type', 'number' )
			->set_width( 25 ),

		Field::make('text', 'recipe_prep_time', __('Prep time','b3c-recipes'))
			->set_attribute( 'type', 'number' )
			->set_width( 25 ),

		Field::make('text', 'recipe_coock_time', __('Coock time','b3c-recipes'))
			->set_attribute( 'type', 'number' )
			->set_width( 25 ),

		Field::make('text', 'recipe_total_time', __('Total time','b3c-recipes'))
			->set_attribute( 'type', 'number' )
			->set_width( 25 ),
	))




	/*...............................................................
	:	#INSTRUCTIONS 												:
	...............................................................*/

	 ->add_tab( 'Instructions', array(
			Field::make( 'complex', 'recipe_instructions', '' )
			//->set_layout('tabbed-vertical')
			->add_fields( array(
				Field::make( 'image', 'instruction_image', '' )
					 ->set_width( 10 ),
				Field::make( 'rich_text', 'instruction_text', '' )
					 ->set_width( 80 )
					 
			 )
			)
			->set_layout('tabbed-horizontal')
			->help_text( 'Add instruction item.' ),
	 ) )



	/*...............................................................
	:	#INGREDIENTS 												:
	...............................................................*/

	 ->add_tab( 'Ingredients', array(
		Field::make( 'complex', 'recipe_ingredients', '' )
		//->set_layout('tabbed-vertical')
		->add_fields('recipe_ingredient', 'Ingredient', array(
					Field::make( 'text', 'recipe_ingredient_amount', 'Amount' )
						 ->set_attribute( 'type', 'number' )
						 ->set_width( 10 ),
					Field::make( 'select', 'recipe_ingredient_measurement', 'Measurement' )
						  ->add_options( get_ingredient_measurement() ) //from options.php
						 ->set_width( 20 ),
					Field::make( 'association', 'recipe_ingredient_item' )
					->set_types( array( array( 'type' => 'term', 'taxonomy' => 'ingredients' ) ) )
					->set_min( 1 )
					->set_max( 1 )
						 ->set_width( 70 ),
		 )) 
		 ->set_collapsed( true )
		 ->set_header_template( "<%- recipe_ingredient_item[0]['title']  %>" )

		 ->add_fields('recipe_ingredient_sections',  __('Section','b3c-recipes') , array(
			 Field::make('text', 'recipe_ingredient_section',  __('Section','b3c-recipes') )
		 ))
		 ->set_header_template( '<% if (recipe_ingredient_section) { %> <%- recipe_ingredient_section %> <% } %>' )

	 ) )


	/*...............................................................
	:	#NUTRITIONS 												:
	...............................................................*/

	 ->add_tab( 'Nutritions', array(

			Field::make("html", "crb_information_text", 'Nutritions facts')
			->set_html('<div style="width:50%; float:left">Nutritions</div>'),


		Field::make( 'complex', 'recipe_post_nutritions_items', '' )
        ->set_layout( 'tabbed-vertical' )
        ->add_fields( array(
            Field::make( 'text', 'amount', 'Amount' )
            	->set_attribute( 'type', 'number' )
            	->set_attribute('step','any')
            	->set_width( 20 ),

			Field::make( 'select', 'property', 'Nutrition property' )
				->add_options( get_ingredient_nutrition_property() ) //from options.php
				->set_width( 80 ),
        ) )
        ->set_header_template( '<% if (property) { %> <%- $_index %>. <%- property %> <% } %>' ),


	 ) )
	 //Media
	 ->add_tab( 'Video', array(

		Field::make("html", "recipe_media_html")
 		->set_html('<div><b>Video</b></div>'),
 			
		Field::make('oembed', 'recipe_video', '')

		//Field::make( 'media_gallery', 'recipe_gallery', __( 'Media Gallery' ) )

	 ) )
	 //Shortcodes
	 ->add_tab( 'Shortcodes', array(

		Field::make("html", "recipe_shortcodes")
 		->set_html('<div><b>Shortcodes</b></div>'),
					

	) );
			 
}