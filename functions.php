<?php

add_action( 'init', 'create_event_taxonomies', 0 );
function create_event_taxonomies() {
    $labels = array(
        'name'                       => _x( 'Companies', 'taxonomy general name', 'wp19' ),
        'singular_name'              => _x( 'Company', 'taxonomy singular name', 'wp19' ),
        'search_items'               => __( 'Search Companies', 'wp19' ),
        'popular_items'              => __( 'Popular Companies', 'wp19' ),
        'all_items'                  => __( 'All Companies', 'wp19' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Ccompany', 'wp19' ),
        'update_item'                => __( 'Update Company', 'wp19' ),
        'add_new_item'               => __( 'Add New Company', 'wp19' ),
        'new_item_name'              => __( 'New Company Name', 'wp19' ),
        'separate_items_with_commas' => __( 'Separate companies with commas', 'wp19' ),
        'add_or_remove_items'        => __( 'Add or remove companies', 'wp19' ),
        'choose_from_most_used'      => __( 'Choose from the most used companies', 'wp19' ),
        'not_found'                  => __( 'No company found.', 'wp19' ),
        'menu_name'                  => __( 'Companies', 'wp19' ),
    );
    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'companies' ),
    );
    register_taxonomy( 'companies', 'events', $args );



    $labels = array(
        'name'                       => _x( 'Positions', 'taxonomy general name', 'wp19' ),
        'singular_name'              => _x( 'Position', 'taxonomy singular name', 'wp19' ),
        'search_items'               => __( 'Search Positions', 'wp19' ),
        'popular_items'              => __( 'Popular Positions', 'wp19' ),
        'all_items'                  => __( 'All Positions', 'wp19' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Position', 'wp19' ),
        'update_item'                => __( 'Update Position', 'wp19' ),
        'add_new_item'               => __( 'Add New Position', 'wp19' ),
        'new_item_name'              => __( 'New Position Name', 'wp19' ),
        'separate_items_with_commas' => __( 'Separate positions with commas', 'wp19' ),
        'add_or_remove_items'        => __( 'Add or remove positions', 'wp19' ),
        'choose_from_most_used'      => __( 'Choose from the most used positions', 'wp19' ),
        'not_found'                  => __( 'No position found.', 'wp19' ),
        'menu_name'                  => __( 'Positions', 'wp19' ),
    );
    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'positions' ),
    );
    register_taxonomy( 'positions', 'speakers', $args );



    $labels = array(
        'name'                       => _x( 'Topics', 'taxonomy general name', 'wp19' ),
        'singular_name'              => _x( 'Topic', 'taxonomy singular name', 'wp19' ),
        'search_items'               => __( 'Search Topics', 'wp19' ),
        'popular_items'              => __( 'Popular Topics', 'wp19' ),
        'all_items'                  => __( 'All Topics', 'wp19' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Topic', 'wp19' ),
        'update_item'                => __( 'Update Topic', 'wp19' ),
        'add_new_item'               => __( 'Add New Topic', 'wp19' ),
        'new_item_name'              => __( 'New Topic Name', 'wp19' ),
        'separate_items_with_commas' => __( 'Separate topics with commas', 'wp19' ),
        'add_or_remove_items'        => __( 'Add or remove topics', 'wp19' ),
        'choose_from_most_used'      => __( 'Choose from the most used topics', 'wp19' ),
        'not_found'                  => __( 'No topics found.', 'wp19' ),
        'menu_name'                  => __( 'Topics', 'wp19' ),
    );
    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'topics' ),
    );
    register_taxonomy( 'topics', array( 'events', 'speakers' ), $args );
}

function create_post_type() {
  register_post_type( 'events',
    array(
      'labels' => array(
        'name' => __( 'Schedule', 'wp19' ),
        'singular_name' => __( 'Schedule Item', 'wp19' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'agenda'),
      'taxonomies'  => array( 'speakers', 'companies', 'topics' ),
      'menu_icon' => 'dashicons-clock',
      'supports' => array( 'title', 'editor', 'custom-fields', 'page-attributes', 'thumbnail' ),
    )
  );
  register_post_type( 'speakers',
    array(
      'labels' => array(
        'name' => __( 'Speakers', 'wp19' ),
        'singular_name' => __( 'Speaker', 'wp19' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'speakers'),
      'taxonomies'  => array( 'companies', 'topics' ),
      'menu_icon' => 'dashicons-businessman',
      'supports' => array( 'title', 'editor', 'custom-fields', 'page-attributes', 'thumbnail' ),
    )
  );
}
add_action( 'init', 'create_post_type' );
