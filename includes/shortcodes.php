<?php




/*
 #STEP BY STEP
*/           
function b3c_tpl_step_by_step_callback( $atts ) {
extract( shortcode_atts( array (
     'count' => true
), $atts ) );

	$steps = carbon_get_post_meta(get_the_ID(),'recipe_steps');

	if (!empty($steps)): ?>
		
		<ul class="recipe-steps <?php if($count){ echo 'steps-count'; } ?>">
			<h3 class='recipe-section-title'> <span><?php _e('Instructions','b3c-recipes'); ?></span> </h3>
		<?php
		foreach ($steps as $step): //$steps as $key => $step
			$step_img_id = $step['step_image'];
			$step_img_url = wp_get_attachment_image_url($step_img_id, 'full');
		?>
			<li class="step-item">
				<div class="step-item_image">
					<img src="<?php echo $step_img_url; ?>" alt="">
				</div>
				<div class="step-item_text"> 
					<?php echo $step['step_text'] ?> 
				</div>
			</li>
		<?php endforeach; ?>
		</ul>

	<?php endif;
}
add_shortcode('recipe-steps', 'b3c_tpl_step_by_step_callback');

/*
 #INGREDIENTS
*/           
function b3c_tpl_ingredients_callback() {

	
	$ingredients = carbon_get_post_meta(get_the_ID(),'recipe_ingredients');

	if (!empty($ingredients )): ?>
		<div class="ingredients">
		<h3 class='ingredients-title'> <span><?php _e('Ingredients','b3c-recipes'); ?></span> </h3>
		<ul class="ingredients-list">
			<?php
			foreach ($ingredients as $ingredient):
				if($ingredient['_type'] == 'recipe_ingredient'):
			?>
				<li class="ingredient-item">
					<span class="ingredient-item_amount">
						<?php echo $ingredient['recipe_ingredient_amount']; ?>
					</span>
					<span class="ingredient-item_measurement">
						<?php echo $ingredient['recipe_ingredient_measurement']; ?>
					</span>
					<span class="ingredient-item_item">
						<?php //print_r( $ingredient['recipe_ingredient_item'] ); ?>
						<?php 
							$term = $ingredient['recipe_ingredient_item'][0]['subtype'];
						 	$id = $ingredient['recipe_ingredient_item'][0]['id']; 
							$term = get_term_by( 'id', $id, $term);
							echo $term->name;
						?>
					</span>
				</li>
			<?php else: ?>
				<li class="ingredient-item">
					<span class="ingredient-item_heading">
						<?php echo $ingredient['recipe_ingredient_heading']; ?>
					</span>
				</li>
			<?php 
				endif;
			endforeach; 
			?>
		</ul>
		</div>

	<?php endif;
}
add_shortcode('recipe-ingredients', 'b3c_tpl_ingredients_callback');











/*
 #RECIPE TEMPLATE
*/           
function b3c_recipe_template_callback() {

	/*
	 #NUTRITIONS
	*/ 

	$ingredients = carbon_get_post_meta(get_the_ID(),'recipe_ingredients');

	$array_nutritions_total = array();

	if (!empty($ingredients )): ?>
		<div class="nutritions">
			<h3 class='ingredients-title'> <span><?php _e('NUTRITIONS','b3c-recipes'); ?></span> </h3>
			<ul class="nutrition-tab">
				<?php
				//print_r($ingredients);

				foreach ($ingredients as $key => $ingredient):
					//print_r( $ingredient['recipe_ingredient_item'] );
					$taxonomy = $ingredient['recipe_ingredient_item'][0]['subtype']; //value = ingredients
					$tax_id = $ingredient['recipe_ingredient_item'][0]['id']; //value is ID of ingredients
					$ingredient = get_term_by( 'id', $tax_id, $taxonomy);
					echo "<b> $ingredient->name </b>";

						$array_nutritions_total[$key] = carbon_get_term_meta( $tax_id, 'tax_nutritions_items' );
		
				endforeach; 

		
				?>
			</ul>
		</div>
	<?php endif;


echo "<pre><h1> RESULT ARRAY</h1>";
print_r( get_taxonomy_total_nutrition_array(get_the_ID()) );
echo "</pre>";


}
add_shortcode('recipe-template', 'b3c_recipe_template_callback');



/*
 #GALLERY
*/           
function b3c_tpl_gallery_callback() {

	
	$gallery = carbon_get_post_meta(get_the_ID(),'recipe_gallery');

	if (!empty($gallery )): ?>

		<div class="owl-carousel owl-theme recipe-gallery">

			<?php
			foreach ($gallery as $img_id):
				$img_url = wp_get_attachment_image_url($img_id, 'full');
			?>
				<figure class="recipe-gallery_item">
					<img class="recipe-gallery_item__image" src="<?php echo $img_url; ?>" alt="">
				</figure>
			<?php 
			endforeach; 
			?>
		</div>
		
	<?php 


	endif;

}
add_shortcode('recipe-gallery', 'b3c_tpl_gallery_callback');


