<?php



/* 
*	#TOTAL TAXONOMY NUTRITION ARRAY
* 	This function summing all nutrition proprety from taxonomy 
*	ingredients and make final nutrition array of all product
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

			/*
			// TEST CODE -- START
				echo "  <table>
						<caption style='color:red' > $ingredient->name </caption>
						<thead><td> amount </td> <td> unit </td> <td> value </td> </thead>";

				foreach ($array_nutritions_total[$key] as $value) {
					echo "<tr>".
							"<td>".$value['tax_nutritions_item_amount'].
					    	"</td><td>".$value['tax_nutritions_item_unit'].
					    	"</td><td>".$value['tax_nutritions_item_name'].
					     	"</td>".
					     "</tr>";
				}
			echo "</table>";
			// TEST CODE -- END
			*/

		endforeach; 

 	endif;


 
	//#SUM ARRAY OF ARRAY
	$numargs = count($array_nutritions_total);
	$out = array();

	// Loop through each of the arguments
	for ($i = 0; $i < $numargs; $i++) { // <-- INGREDIENTS
		$in = $array_nutritions_total[$i]; // This will be equal to each array passed as an argument
		// Loop through each of the arrays passed as arguments
		foreach($in as $key => $value) { // <-- NUTRIOTION PROPERTY
			// If the same key exists in the $out array
			 $name = $in[$key]['tax_nutritions_item_name'];
			 $amount = $in[$key]['tax_nutritions_item_amount'];
 			 $unit = $in[$key]['tax_nutritions_item_unit'];
 			 
			if(array_key_exists($name, $out)) { 
	
				if($out[$name]['unit'] == $unit):
					$out[$name]['amount'] = $out[$name]['amount'] + $amount;
				else:
					if( $out[$name]['unit'] == "g" || $unit == "g"):
						//mg to g
						if( $out[$name]['unit'] == 'mg'):
							$out[$name]['amount'] = convert_unit( $out[$name]['amount'] , 'mg_to_g' ) + $amount;
							$out[$name]['unit'] = 'g';
						endif;
						if($unit == "mg"):
							$out[$name]['amount'] = $out[$name]['amount'] + convert_unit($amount ,'mg_to_g');
						endif;
						//mcg to g
						if( $out[$name]['unit'] == 'mcg'):
							$out[$name]['amount'] = convert_unit( $out[$name]['amount'] , 'mcg_to_g' ) + $amount;
							$out[$name]['unit'] = 'g';
						endif;
						if($unit == "mcg"):
							$out[$name]['amount'] = $out[$name]['amount'] + convert_unit($amount ,'mcg_to_g');
						endif;
						//iu to g - is very small value
					endif;

					if( $out[$name]['unit'] == "mg" || $unit == "mg"):
						//mcg to mg
						if( $out[$name]['unit'] == 'mcg'):
							$out[$name]['amount'] = convert_unit( $out[$name]['amount'] , 'mcg_to_mg' ) + $amount;
							$out[$name]['unit'] = 'mg';
						endif;
						if($unit == "mcg"):
							$out[$name]['amount'] = $out[$name]['amount'] + convert_unit($amount ,'mcg_to_mg');
						endif;
						//iu to mg
						if( $out[$name]['unit'] == 'iu'):
							$out[$name]['amount'] = convert_unit( $out[$name]['amount'] , 'iu_to_mg' ) + $amount;
							$out[$name]['unit'] = 'mg';
						endif;
						if($unit == "iu"):
							$out[$name]['amount'] = $out[$name]['amount'] + convert_unit($amount ,'iu_to_mg');
						endif;
					endif;

					if( $out[$name]['unit'] == "mcg" || $unit == "mcg"):
						//iu to mcg
						if( $out[$name]['unit'] == 'iu'):
							$out[$name]['amount'] = convert_unit( $out[$name]['amount'] , 'iu_to_mcg' ) + $amount;
							$out[$name]['unit'] = 'mcg';
						endif;
						if($unit == "iu"):
							$out[$name]['amount'] = $out[$name]['amount'] + convert_unit($amount ,'iu_to_mcg');
						endif;
					endif;
				endif;

			} else {
				$out[$name]['amount'] = $amount;
				$out[$name]['unit'] = $unit;
			}
		}
	}

	return $out;
}
	



/**
*	#UPDATE TAX
*   Summing all ingredient propriety use get_taxonomy_total_nutrition_array, 
*	and put array value in POST NUTRITION FIELDS
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
			$unit_key = '_recipe_post_nutritions_items|unit|'.$i.'|0|value';
			$property_key = '_recipe_post_nutritions_items|property|'.$i.'|0|value';

		 	update_post_meta( $post_id, $amount_key , $value['amount'] );
			update_post_meta( $post_id, $unit_key , $value['unit'] );
			update_post_meta( $post_id, $property_key , $key );
			$i++;
		}
	endif;
}


function convert_unit( $unit_value, $unit_to_new_unit){
	switch ($unit_to_new_unit) {
    	//to gram
        case "mg_to_g": return $unit_value * 0.001; break;
        case "g_to_mg": return $unit_value / 1.000; break;
        case "mcg_to_g": return $unit_value * 0.0000010; break;
        //to miligram
        case "mg_to_mcg": return $unit_value / 1.000;  break;
        case "mcg_to_mg": return $unit_value * 0.001; break;
        //to iu
        case "mcg_to_iu": return $unit_value / 0.3; break;
        case "iu_to_mg": return ($unit_value * 0.3) * 0.001; break;
        case "iu_to_mcg": return $unit_value * 0.3; break;
    }
}
