<?php

function b3c_register_post_type_callback()
{
    register_post_type('b3c_recipes',
                       array(
                           'labels'      => array(
                               'name'          => __('Recipes','b3c-recipes'),
                               'singular_name' => __('Recipe','b3c-recipes'),
                           ),
                           'supports'     => array('title','excerpt','thumbnail','editor'),
                           'public'      => true,
                           'has_archive' => true,
                           'rewrite'     => array( 'slug' => "recipes" ),
                           'menu_icon' => 'dashicons-carrot',
                           'show_in_rest' => true,
                           'public' => true,
                       )
    );



  $labels = array(
    'name'                       => _x( 'Ingredients', 'Taxonomy General Name', 'b3c-recipes' ),
    'singular_name'              => _x( 'Ingredient', 'Taxonomy Singular Name', 'b3c-recipes' ),
    'menu_name'                  => __( 'Ingredients', 'b3c-recipes' ),
    'all_items'                  => __( 'All ingredients', 'b3c-recipes' ),
    'parent_item'                => __( 'Parent Item', 'b3c-recipes' ),
    'parent_item_colon'          => __( 'Parent Ingredient:', 'b3c-recipes' ),
    'new_item_name'              => __( 'New ingredient Name', 'b3c-recipes' ),
    'add_new_item'               => __( 'Add New ingredient', 'b3c-recipes' ),
    'edit_item'                  => __( 'Edit ingredient', 'b3c-recipes' ),
    'update_item'                => __( 'Update ingredient', 'b3c-recipes' ),
    'view_item'                  => __( 'View Ingredient', 'b3c-recipes' ),
    'separate_items_with_commas' => __( 'Separate items with commas', 'b3c-recipes' ),
    'add_or_remove_items'        => __( 'Add or remove ingredient', 'b3c-recipes' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'b3c-recipes' ),
    'popular_items'              => __( 'Popular ingredients', 'b3c-recipes' ),
    'search_items'               => __( 'Search ingredients', 'b3c-recipes' ),
    'not_found'                  => __( 'Not Found', 'b3c-recipes' ),
    'no_terms'                   => __( 'No items', 'b3c-recipes' ),
    'items_list'                 => __( 'Ingredients list', 'b3c-recipes' ),
    'items_list_navigation'      => __( 'Ingredients list navigation', 'b3c-recipes' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => false,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'show_in_rest'               => true,
    'public' => true,
  );
  register_taxonomy( 'ingredients', array( 'b3c_recipes' ), $args );
}
add_action('init', 'b3c_register_post_type_callback',0);



