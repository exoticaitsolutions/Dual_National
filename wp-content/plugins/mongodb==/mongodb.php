<?php
/*
Plugin Name: mongodb-plugin
Description: A plugin to connect with mongodb and get all players data
Version: 1.1
Author: tws
*/


if (!defined('ABSPATH')) {
    die;
}


if (!function_exists('post_exists')) {
    require_once(ABSPATH . 'wp-admin/includes/post.php');
}
// ini_set('display_errors', 2);



class MongoDb
{

    public function __construct()
    {
         add_action('init', array($this, 'create_book_post_type'));
     
         add_filter('single_template', array($this, 'my_custom_template'));
         add_action('init', array($this, 'create_players'));
    
    }


        // function callback_for_setting_up_scripts()
        // {
        //     // wp_register_style('mongodb_style', plugins_url('css/style.css', __FILE__));
        //     // wp_register_style('goalkeeper_style', '/wp-content/themes/Dual-Nationals/assets/css/globals.css');
        //     // wp_register_style('global_style', '/wp-content/themes/Dual-Nationals/assets/css/globals.css');
        //     // wp_enqueue_style('mongodb_style');
        //     // wp_enqueue_style('goalkeeper_style');
        //     // wp_enqueue_style('global_style');
        // }


       public function create_book_post_type()
        {
        
            $args = array(
                'labels' => array(
                    'name' => 'Players',
                    'singular_name' => 'Players',
                ),
                'public' => true,
                'has_archive' => false,
                'rewrite' => array('slug' => 'player'),
                'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            );
            register_post_type('player', $args);
        }
       
        
    public function my_custom_template($single)
    {

        global $post;   
        $plugin_path = plugin_dir_path(__FILE__);
        /* Checks for single template by post type */
        if ($post->post_type == 'player') {    
            if (file_exists($plugin_path . '/single-player.php')) {
                return $plugin_path . '/single-player.php';
            }
        }
        return $single;
    }


    public function get_id_by_post_name($post_name)
    {
        global $wpdb;
        $id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '" . $post_name . "'");
        return $id;
    }


    public function create_players()
    {
        $mngdb = new MongoDB\Driver\Manager("mongodb+srv://mandelabyron:Mpendakuma001@mongo-intro.ywzthil.mongodb.net/?retryWrites=true&w=majority");
        $mngdbquery = new MongoDB\Driver\Query([]);
        $cursor = $mngdb->executeQuery("players_db.players_data_1", $mngdbquery);
        $rowsArr = $cursor->toArray();
        // print_r($rowsArr);
            
        foreach ($rowsArr as $row) {
            $wordpress_post = array(
                'post_title' => $row->name,
                'post_content' => '',
                'post_status' => 'publish',
                'post_author' => 1,
                'post_type' => 'player',
                'post_name' => $row->id,
                'post_excerpt' => '',
                'post_parent' => 0,
                'meta_input' => array(
                    'player_name' => $row->name,
                    'player_country' => $row->citizenship,
                    'player_id' => $row->id,
                    'position' => $row->main_position
                )
            );

            if (post_exists($row->name)) {
              
                $post_id =  $this->get_id_by_post_name($row->name);
                
                $wordpress_post = array(
                    'ID' =>  $post_id,
                    'post_content' => '',
                    'post_excerpt' => '',
                    'post_name' => $row->id,
                    'meta_input' => array(
                        'player_name' =>  $row->name,
                        'player_country' => $row->citizenship,
                        'player_id' => $row->id,
                        'position' => $row->main_position
                        )
                );
                wp_update_post($wordpress_post);
                
            } else {
                wp_insert_post($wordpress_post);
            }
        }
    }
}

new MongoDb;