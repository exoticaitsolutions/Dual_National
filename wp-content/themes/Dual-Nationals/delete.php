<?php 
$db_config = mysqli_connect('localhost', 'mgga5wZI', 'YYH36Q3NUgQ2Weec53Na44lvvqG3woOYED2zdUDI1rMRyvHV', 'dualnationalscom');


 
 global $wpdb;
 //print_r($_POST);
 //$tablename = $wpdb->prefix.'Wishlist_data_list';
$id  = $_POST['id'];
$delete = "DELETE FROM wp_Wishlist_data_list WHERE id=$id";

$query = mysqli_query($db_config, $delete);
