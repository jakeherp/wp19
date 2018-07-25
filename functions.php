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
      'supports' => array( 'title', 'editor', 'custom-fields', 'page-attributes', 'thumbnail', 'excerpt' ),
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

add_shortcode( 'wp19_agenda', 'wp19Agenda' );
function wp19Agenda( $atts ) {
    ob_start();

    extract( shortcode_atts( array (
        'type'      => 'events',
        'order'     => 'ASC',
        'orderby'   => 'start_time',
        'posts'     => -1,
    ), $atts ) );

    $options = array(
        'post_type'      => $type,
        'order'          => $order,
        'orderby'        => $orderby,
        'posts_per_page' => $posts,
    );

    $query = new WP_Query( $options );

    // Add variable to save previous_time:
    $previous_time = 0;
    // Add variable to check if there has been a list before:
    $first_list = true;

    if ( $query->have_posts() ) {
        echo '<div class="wp19-grid">';
        while ( $query->have_posts() ){
            $query->the_post();
            // Check if start_time is different than previous_time, if yes print agenda-header and start new ol list:
            if(get_field('start_time') !== $previous_time) {
                // Always close the last ol list, but not at the first loop, because there has no list been before:
                if(!$first_list){
                    echo '</ol>';
                } else {
                    $first_list = false;
                }
                echo '<div class="agenda-header">
                    <h2>'.get_field('start_time').' – '.get_field('end_time').'</h2>
                    </div>
                    <ol class="agenda-list">';
            }
            // Always insert list element:

            $time1 = strtotime(get_field('start_time'));
            $time2 = strtotime(get_field('end_time'));

            // Additional: If $time2 is after 0:00 add 1 day to $time2:
            if($time2 < $time1) {
                $time2 += 24 * 60 * 60;
            }

            // Difference in seconds:
            $diff = $time2 - $time1;

            // Convert seconds to duration and print it:
            $duration = gmdate("i", $diff) . ' mins';

            echo '<li><h3><a href="#'.get_the_ID().'">' . get_the_title() .'</a></h3>';
            echo '<em><i class="icon-clock"></i> '.$duration.'</em>';
        ?>
          <div class="lightboxes">
            <div id="<?php the_ID(); ?>" class="lightbox-by-id lightbox-content lightbox-white" style="max-width:600px;padding:20px">
              <?php the_post_thumbnail(); ?>
              <h2><?php the_title(); ?></h2>
              <em><i class="icon-clock"></i> <?php the_field('start_time') ?> – <?php the_field('end_time') ?></em>
              <p><?php the_content(); ?></p>
            </div>
          </div>
        <?php
              echo '</li>';
            $previous_time = get_field('start_time');
        }
        echo '</ol>';
        wp_reset_postdata();
        echo '</div>';
    }
    $myvariable = ob_get_clean();
    return $myvariable;
}
