<?php

/* 
	#TOTAL TAXONOMY NUTRITION ARRAY
*/
function get_taxonomy_total_nutrition_array($post_id){

	$ingredients = carbon_get_post_meta($post_id,'recipe_ingredients');
	$array_nutritions_total = array();
	//#MAKE ARRAY OF ARRAY
	if (!empty($ingredients )):
		foreach ($ingredients as $key => $ingredient):
			$taxonomy = $ingredient['recipe_ingredient_item'][0]['subtype']; //value = ingredients
			$tax_id = $ingredient['recipe_ingredient_item'][0]['id']; //value is ID of ingredients
			$ingredient = get_term_by( 'id', $tax_id, $taxonomy);
			$array_nutritions_total[$key] = carbon_get_term_meta( $tax_id, 'tax_nutritions_items' );
		endforeach; 
 	endif;

	//#SUM ARRAY OF ARRAY
	$numargs = count($array_nutritions_total) - 1;
	$out = array();

	// Loop through each of the arguments
	for ($i = 0; $i < $numargs; $i++) { // <-- INGREDIENTS
		$in = $array_nutritions_total[$i]; // This will be equal to each array passed as an argument
		// Loop through each of the arrays passed as arguments
		foreach($in as $key => $value) { // <-- NUTRIOTION PROPERTY
			// If the same key exists in the $out array
			 $nutritions_name = $in[$key]['tax_nutritions_item_name'];
			 $nutritions_amount = $in[$key]['tax_nutritions_item_amount'];

			if(array_key_exists($nutritions_name, $out)) { 
				$out[$nutritions_name] = $out[$nutritions_name] + $nutritions_amount;
			} else {
				$out[$nutritions_name] = $nutritions_amount;
			}
		}
	}

	return $out;
}


/*
	#UPDATE TAX
*/
add_action( 'carbon_fields_post_meta_container_saved', 'crb_after_save_event' );
function crb_after_save_event( $post_id ) {
    if ( get_post_type( $post_id ) !== 'b3c_recipes' ) {
        return false;
    }

	$array_tax_nutrition = get_taxonomy_total_nutrition_array($post_id);
	$recipe_post_nutrition = carbon_get_the_post_meta( 'recipe_post_nutritions_items' );

	 $i = 0;
	if(empty($recipe_post_nutrition)):
		foreach ($array_tax_nutrition as $key => $value) {
			$amount_key = '_recipe_post_nutritions_items|amount|'.$i.'|0|value';
			$property_key = '_recipe_post_nutritions_items|property|'.$i.'|0|value';
		 	update_post_meta( $post_id, $amount_key , $value );
			update_post_meta( $post_id, $property_key , $key );
			$i++;
		}
	endif;

    //$event_date = carbon_get_post_meta( $post_id, 'nutritions_calories' );
    //if ( $event_date ) {
       // $timestamp = strtotime( $event_date );
       // update_post_meta( $post_id, '_nutritions_calories', 300 );
    //}

 	
 	print_r($post_repeater);





}


