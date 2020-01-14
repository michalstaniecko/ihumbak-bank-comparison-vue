<?php

/**
 * register custom post type
 */

class Ihumbak_Bank_Comparison_Post_Types {

  /**
   * Register custom post type
   */
  public function register_single_post_type($fields) {
    $labels = array(
      'name'                  => _x( 'Banks', 'Post Type General Name', 'ihumbak-bank-comparison' ),
      'singular_name'         => _x( 'Bank', 'Post Type Singular Name', 'ihumbak-bank-comparison' ),
      'menu_name'             => __( 'Bank', 'ihumbak-bank-comparison' ),
      'name_admin_bar'        => __( 'Bank', 'ihumbak-bank-comparison' ),
      'archives'              => __( 'Item Archives', 'ihumbak-bank-comparison' ),
      'attributes'            => __( 'Item Attributes', 'ihumbak-bank-comparison' ),
      'parent_item_colon'     => __( 'Parent Item:', 'ihumbak-bank-comparison' ),
      'all_items'             => __( 'All Items', 'ihumbak-bank-comparison' ),
      'add_new_item'          => __( 'Add New Item', 'ihumbak-bank-comparison' ),
      'add_new'               => __( 'Add New', 'ihumbak-bank-comparison' ),
      'new_item'              => __( 'New Item', 'ihumbak-bank-comparison' ),
      'edit_item'             => __( 'Edit Item', 'ihumbak-bank-comparison' ),
      'update_item'           => __( 'Update Item', 'ihumbak-bank-comparison' ),
      'view_item'             => __( 'View Item', 'ihumbak-bank-comparison' ),
      'view_items'            => __( 'View Items', 'ihumbak-bank-comparison' ),
      'search_items'          => __( 'Search Item', 'ihumbak-bank-comparison' ),
      'not_found'             => __( 'Not found', 'ihumbak-bank-comparison' ),
      'not_found_in_trash'    => __( 'Not found in Trash', 'ihumbak-bank-comparison' ),
      'featured_image'        => __( 'Featured Image', 'ihumbak-bank-comparison' ),
      'set_featured_image'    => __( 'Set featured image', 'ihumbak-bank-comparison' ),
      'remove_featured_image' => __( 'Remove featured image', 'ihumbak-bank-comparison' ),
      'use_featured_image'    => __( 'Use as featured image', 'ihumbak-bank-comparison' ),
      'insert_into_item'      => __( 'Insert into item', 'ihumbak-bank-comparison' ),
      'uploaded_to_this_item' => __( 'Uploaded to this item', 'ihumbak-bank-comparison' ),
      'items_list'            => __( 'Items list', 'ihumbak-bank-comparison' ),
      'items_list_navigation' => __( 'Items list navigation', 'ihumbak-bank-comparison' ),
      'filter_items_list'     => __( 'Filter items list', 'ihumbak-bank-comparison' ),
    );
    $post_types_fields[] = array(
      'slug' => 'bank',
      'label'                 => __( 'Bank', 'ihumbak-bank-comparison' ),
      'description'           => __( 'Bank', 'ihumbak-bank-comparison' ),
      'labels'                => $labels,
      'supports'              => array( 'title', 'thumbnail' ),
      'hierarchical'          => false,
      'public'                => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 5,
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => true,
      'can_export'            => true,
      'has_archive'           => false,
      'exclude_from_search'   => true,
      'publicly_queryable'    => true,
      'rewrite'               => false,
      'capability_type'       => 'page',
      'show_in_rest' => true
    );

    foreach ($post_types_fields as $post_types_field) {
      register_post_type($post_types_field['slug'], $post_types_field);
    }
  }
}

add_action('init', array('Ihumbak_Bank_Comparison_Post_Types','register_single_post_type'));
