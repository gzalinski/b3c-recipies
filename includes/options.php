<?php

function get_ingredient_measurement(){
	return array(
			  '' => '--',
			  'g' => __('g','b3c-recipes'),
			  'kg' => __('kg','b3c-recipes'),
			  'mg' => __('mg','b3c-recipes'),
			  'cups' => __('cups','b3c-recipes'),
			  'tsp' => __('tsp','b3c-recipes'),
			  'tbsp' => __('tbsp','b3c-recipes'),
			  'ml' => __('ml','b3c-recipes'),
			  'l' => __('l','b3c-recipes'),
			  'sticks' => __('sticks','b3c-recipes'),
			  'lbs' => __('lbs','b3c-recipes'),
			  'dashes' => __('dashes','b3c-recipes'),
			  'drops' => __('drops','b3c-recipes'),
			  'gals' => __('gals','b3c-recipes'),
			  'pinches' => __('pinches','b3c-recipes'),
			  'pt' => __('pt','b3c-recipes'),
			  'qts' => __('qts','b3c-recipes')
			);
}

function get_ingredient_nutrition_unit(){
	return array(
			  '' => '',
			  'g' => __('g','b3c-recipes'),
			  'mg' => __('mg','b3c-recipes'),
			  'mcg' => __('μg','b3c-recipes'), //microgram (ug/1000 = mg)
			  'iu' => __('IU','b3c-recipes'), //International Unit ( [iu to mcg] iu × 0.3 = mcg )
			);
}

function get_ingredient_nutrition_property(){
		return array(
	  	'' => '--',
	  	'calories' => __('Calories','b3c-recipes'),
		'calories_fat' => __('Calories from Fat','b3c-recipes'),
		'all_fat' => __('Total fat','b3c-recipes'),
		'saturated_fat' => __('Saturated fat','b3c-recipes'),
		'trans_fat' => __('Trans fat','b3c-recipes'),
		'all_carbohydrate' => __('Total carbohydrate','b3c-recipes'),
		'dietary_fiber' => __('Dietary fiber','b3c-recipes'),
		'sugars' => __('Sugars','b3c-recipes'),
		'protein' => __('Protein','b3c-recipes'),
		'cholesterol' => __('Cholesterol','b3c-recipes'),
		'sodium' => __('Sodium','b3c-recipes'),
		'potassium' => __('Potassium','b3c-recipes'),
		'phosphorus' => __('Phosphorus','b3c-recipes'),
		'iodine' => __('Iodine','b3c-recipes'),
		'calcium' => __('Calcium','b3c-recipes'),
		'chloride' => __('Chloride','b3c-recipes'),
		'magnesium' => __('Magnesium','b3c-recipes'),
		'zinc' => __('Zinc','b3c-recipes'),
		'selenium' => __('Selenium','b3c-recipes'),
		'iron' => __('Iron','b3c-recipes'),
		'copper' => __('Copper','b3c-recipes'),
		'manganese' => __('Manganese','b3c-recipes'),
		'chromium' => __('Chromium','b3c-recipes'),
		'molybdenum' => __('Molybdenum','b3c-recipes'),
		'vitamin_a' => sprintf( __( 'Vitamin %s', 'A', 'b3c-recipes' ) , 'A' ),
		'vitamin_b' => sprintf( __( 'Vitamin %s', 'B', 'b3c-recipes' ) , 'B' ),
		'vitamin_c' => sprintf( __( 'Vitamin %s', 'C', 'b3c-recipes' ) , 'C' ),
		'vitamin_d' => sprintf( __( 'Vitamin %s', 'D', 'b3c-recipes' ) , 'D' ),
		'vitamin_e' => sprintf( __( 'Vitamin %s', 'E', 'b3c-recipes' ) , 'E' ),
		'vitamin_k' => sprintf( __( 'Vitamin %s', 'K', 'b3c-recipes' ) , 'K' ),
		'vitamin_b1' => sprintf( __( 'Vitamin %s', 'B1', 'b3c-recipes' ) , 'B1' ),
		'vitamin_b2' => sprintf( __( 'Vitamin %s', 'B2', 'b3c-recipes' ) , 'B2' ),
		'vitamin_b3' => sprintf( __( 'Vitamin %s', 'B3', 'b3c-recipes' ) , 'B3' ),
		'vitamin_b5' => sprintf( __( 'Vitamin %s', 'B5', 'b3c-recipes' ) , 'B5' ),
		'vitamin_b6' => sprintf( __( 'Vitamin %s', 'B6', 'b3c-recipes' ) , 'B6' ),
		'vitamin_b7' => sprintf( __( 'Vitamin %s', 'B7', 'b3c-recipes' ) , 'B7' ),
		'vitamin_b9' => sprintf( __( 'Vitamin %s', 'B9', 'b3c-recipes' ) , 'B9' ),
		'vitamin_b12' => sprintf( __( 'Vitamin %s', 'B12', 'b3c-recipes' ) , 'B12' ),
		'water' => __('Water','b3c-recipes')
	);
}