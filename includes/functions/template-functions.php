<?php


function the_ricipe_servings() {
	echo carbon_get_post_meta(get_the_ID(),'ricipe_servings');
}
function the_ricipe_preparation_time() {
	echo carbon_get_post_meta(get_the_ID(),'recipe_prep_time');
}
function the_ricipe_coocking_time() {
	echo carbon_get_post_meta(get_the_ID(),'recipe_coock_time');
}

function the_recipe_total_time() {
	echo carbon_get_post_meta(get_the_ID(),'recipe_total_time');
}

/**
* Return Ingredients
*/
function the_recipe_ingredients() {

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
					<span class="ingredient-item__amount">
						<?php echo $ingredient['recipe_ingredient_amount']; ?>
					</span>
					<span class="ingredient-item__measurement">
						<?php echo $ingredient['recipe_ingredient_measurement']; ?>
					</span>
					<span class="ingredient-item__item">
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
				<li class="ingredient-item ingredient-item--section">
					<span class="ingredient-item__item">
						<?php echo $ingredient['recipe_ingredient_section']; ?>
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

/**
* Return Instructions
*/
function the_recipe_instructions() {
	$instructions = carbon_get_post_meta(get_the_ID(),'recipe_instructions');
	if (!empty($instructions)): ?>
		<div class="recipe-instructions">
			<h3 class='recipe-section-title'> <span><?php _e('Instructions','b3c-recipes'); ?></span> </h3>
			<ul>
			<?php
			foreach ($instructions as $instruction): //$instructions as $key => $instruction
			?>
				<li class="instruction-item">
					<?php echo $instruction['instruction_text'] ?> 
				</li>
			<?php endforeach; ?>
			</ul>
		</div>
	<?php endif;
}

/**
* Return Gallery
*/
/*
function the_recipe_gallery() {
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
*/


/*
* Return Nutrition
*/

function the_recipe_nutrition(){
	?>
		<div class="nutritions">
			<h3 class='ingredients-title'> <span><?php _e('NUTRITIONS','b3c-recipes'); ?></span> </h3>
			<ul class="nutrition-tab">
				<?php
				echo "<pre><h1> POST array </h1>";
				print_r(  carbon_get_post_meta( get_the_ID(), 'recipe_post_nutritions_items' ) );
				echo "</pre>";
		
				?>
			</ul>
		</div>
	<?php 
}