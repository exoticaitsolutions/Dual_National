<?php

 

function custom_post_type() {
  
    // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'Football Players', 'Post Type General Name', 'twentytwentyone' ),
            'singular_name'       => _x( 'Football Players', 'Post Type Singular Name', 'twentytwentyone' ),
            'menu_name'           => __( 'Football Playerss', 'twentytwentyone' ),
            'parent_item_colon'   => __( 'Parent Football Players', 'twentytwentyone' ),
            'all_items'           => __( 'All Football Playerss', 'twentytwentyone' ),
            'view_item'           => __( 'View Football Players', 'twentytwentyone' ),
            'add_new_item'        => __( 'Add New Football Players', 'twentytwentyone' ),
            'add_new'             => __( 'Add New', 'twentytwentyone' ),
            'edit_item'           => __( 'Edit Football Players', 'twentytwentyone' ),
            'update_item'         => __( 'Update Football Players', 'twentytwentyone' ),
            'search_items'        => __( 'Search Football Players', 'twentytwentyone' ),
            'not_found'           => __( 'Not Found', 'twentytwentyone' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwentyone' ),
			 'rewrite' => array( 'slug' => 'Footballs_Player' ),
        );
          
    // Set other options for Custom Post Type
          
        $args = array(
            'label'               => __( 'Football Playerss', 'twentytwentyone' ),
            'description'         => __( 'Football Players news and reviews', 'twentytwentyone' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
            // You can associate this CPT with a taxonomy or custom taxonomy. 
            'taxonomies'          => array( 'genres' ),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest' => true,
      
        );
          
        // Registering your Custom Post Type
        register_post_type( 'Footballs_Player', $args );
      
    }
      
    /* Hook into the 'init' action so that the function
    * Containing our post type registration is not 
    * unnecessarily executed. 
    */
      
    add_action( 'init', 'custom_post_type', 0 );



    
  /* start code of Testimonials cpt */

  $labels = array(
    'name'                => _x( 'Testimonials', 'Post Type General Name', 'twenty-twenty-one-child' ),
    'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'twenty-twenty-one-child' ),
    'menu_name'           => __( 'Testimonials', 'twenty-twenty-one-child' ),
    'parent_item_colon'   => __( 'Parent Testimonial', 'twenty-twenty-one-child' ),
    'all_items'           => __( 'All Testimonials', 'twenty-twenty-one-child' ),
    'view_item'           => __( 'View Testimonial', 'twenty-twenty-one-child' ),
    'add_new_item'        => __( 'Add New Testimonial', 'twenty-twenty-one-child' ),
    'add_new'             => __( 'Add New', 'twenty-twenty-one-child' ),
    'edit_item'           => __( 'Edit Testimonial', 'twenty-twenty-one-child' ),
    'update_item'         => __( 'Update Testimonial', 'twenty-twenty-one-child' ),
    'search_items'        => __( 'Search Testimonial', 'twenty-twenty-one-child' ),
    'not_found'           => __( 'Not Found', 'twenty-twenty-one-child' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'twenty-twenty-one-child' ),
);
  
// Set other options for Custom Post Type
  
$args = array(
    'label'               => __( 'Testimonials', 'twenty-twenty-one-child' ),
    'description'         => __( 'Testimonial news and reviews', 'twenty-twenty-one-child' ),
    'labels'              => $labels,
    // Features this CPT supports in Post Editor
    'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
    // You can associate this CPT with a taxonomy or custom taxonomy. 
    'taxonomies'          => array( 'genres' ),
    /* A hierarchical CPT is like Pages and can have
    * Parent and child items. A non-hierarchical CPT
    * is like Posts.
    */
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 5,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
    'show_in_rest' => true,

);
  
// Registering your Custom Post Type
register_post_type( 'testimonials', $args );

$labels = array(
    'name' => _x( 'Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Categories' ),
    'all_items' => __( 'All Categories' ),
    'parent_item' => __( 'Parent Category' ),
    'parent_item_colon' => __( 'Parent Category:' ),
    'edit_item' => __( 'Edit Category' ), 
    'update_item' => __( 'Update Category' ),
    'add_new_item' => __( 'Add New Category' ),
    'new_item_name' => __( 'New Category Name' ),
    'menu_name' => __( 'Categories' ),
  );    
  
// Now register the taxonomy
  register_taxonomy('testimonial_types',array('testimonials'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'testimonial_type' ),
  ));

  /* End code of testimonials cpt */


?>