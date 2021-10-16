<?php
/*
Plugin Name: Room Booking
Plugin URI: https://room-booking.com/
Description: Just another Booking form.
Author: Varun Kumar
Author URI: https://room-booking.com/
Text Domain: Room Booking
Domain Path: /languages/
Version: 1.0.0
*/
// if(!defined("ABSPATH"))
// 	exit;

if(!defined("ROOM_BOOKING_DIR_PATH"))
	define("ROOM_BOOKING_DIR_PATH",plugin_dir_path(__FILE__));   // To add files
if(!defined("ROOM_BOOKING_PLUGIN_URL"))
	define("ROOM_BOOKING_PLUGIN_URL",plugins_url()."/room-booking");  //To add assets file

// print_r(ROOM_BOOKING_PLUGIN_URL);

// exit();

// To add Assets in plugin
function room_booking_assets(){
	// conditions to add file on specific pages
	$slug = '';
	$page_include = ['frontendpage','booking-list','new-booking','update-booking'];
	$current_page = $_GET['page'];
	if(empty($current_page)){
		$actual_link = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		// $actual_link = $_SERVER['REQUEST_URI'];
		if(preg_match("/my_book/",$actual_link)){
			$current_page = "frontendpage";
			// echo "link matches";
		}
		// die();
		// http://localhost/wordpress/my_book/
	}

	if(in_array($current_page, $page_include)){


	wp_enqueue_style("styleone",ROOM_BOOKING_PLUGIN_URL."/assets/css/style.css");
	wp_enqueue_style("bootstrapone",ROOM_BOOKING_PLUGIN_URL."/assets/css/bootstrap.css");
	wp_enqueue_style("data-table",ROOM_BOOKING_PLUGIN_URL."/assets/css/data-table.css");

	wp_enqueue_script('jquery');
	wp_enqueue_script("script-validate",ROOM_BOOKING_PLUGIN_URL."/assets/js/validate.min.js","","1.0.0");
	wp_enqueue_script("script-data-table",ROOM_BOOKING_PLUGIN_URL."/assets/js/data-table.js","","1.0.0");
	wp_enqueue_script("scriptone",ROOM_BOOKING_PLUGIN_URL."/assets/js/script.js","","1.0.0");
	wp_localize_script("scriptone","roombookingajax",admin_url("admin-ajax.php"));
	}
}
add_action("init","room_booking_assets");

// Adding menu to admin panel
function room_booking_menu(){
	add_menu_page("Room Booking","Room Booking","manage_options","booking-list","booking_list_function","dashicons-book-alt",30);
	add_submenu_page("booking-list","Booking List","Booking List", "manage_options", "booking-list", "booking_list_function");
	add_submenu_page("booking-list","Add New Booking","Add New Booking", "manage_options","new-booking", "add_booking_function" );
	// if(false){
	add_submenu_page("booking-list","","", "manage_options","update-booking", "update_booking_function" );
	// }
}
add_action("admin_menu","room_booking_menu");

function booking_list_function(){
	include_once ROOM_BOOKING_DIR_PATH."/views/booking-list.php";
}

function add_booking_function(){
	include_once ROOM_BOOKING_DIR_PATH."/views/add-booking.php";
}

function update_booking_function(){
	include_once ROOM_BOOKING_DIR_PATH."/views/update-booking.php";
}

// define("PLUGIN_DIR_PATH", plugin_dir_path(__FILE__));
// add_shortcode("booking-code","bookingfunction");
// function bookingfunction(){
// 	include_once PLUGIN_DIR_PATH.'/article/test.php';
// }

// To get table name
function booking_table(){
	global $wpdb;
	return $wpdb->prefix."booking";
}

function product_table(){
	global $wpdb;
	return $wpdb->prefix."product_list";
}

// To generate table
function booking_table_generate(){
	global $wpdb;
	require_once ABSPATH."/wp-admin/includes/upgrade.php";

	$sql = "CREATE TABLE `". booking_table() ."` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `name` varchar(255) COLLATE utf8_bin NOT NULL,
			  `checkin_date` date NOT NULL,
			  `checkout_date` date NOT NULL,
			  `payment` varchar(50) COLLATE utf8_bin NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin";
	dbDelta($sql);		

	$sql2 = "CREATE TABLE `". product_table() ."` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `product_name` varchar(255) COLLATE utf8_bin NOT NULL,
			  `prod_desc` text COLLATE utf8_bin NOT NULL,
			  `prod_image` varchar(255) COLLATE utf8_bin NOT NULL,
			  `prod_price` varchar(255) COLLATE utf8_bin NOT NULL,
			  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin";

	dbDelta($sql2);			

	// Create post object
			$my_post = array(
			  'post_title'    => "Book Page",
			  'post_content'  => "[book_page]", // shortcode
			  'post_status'   => "publish",
				'post_type' => "page",
				'post_name' => "my_book"			 
			);

	// Insert the post into the database
	$book_id = wp_insert_post( $my_post );
	add_option("my_book_id",$book_id);
 
}
register_activation_hook(__FILE__,"booking_table_generate");

//Add shortcode
function my_book_page_content(){
	include_once ROOM_BOOKING_DIR_PATH."/front_end/front_end_list.php";
}
add_shortcode("book_page","my_book_page_content");

// To drop table while deactivating plugin
function drop_booking_table(){
	global $wpdb;
	 $wpdb->query("DROP TABLE IF EXISTS ".booking_table());
	 $wpdb->query("DROP TABLE IF EXISTS ".product_table());

	 //To drop page from database
	 if(!empty(get_option("my_book_id"))){
	 	wp_delete_post(get_option("my_book_id"));
	 	delete_option("my_book_id");
	 }
}
//register_deactivation_hook(__FILE__,"drop_booking_table");

// To drop table while uninstalling plugin
 register_uninstall_hook(__FILE__,"drop_booking_table");

add_action("wp_ajax_booking_data","booking_ajax_handler");

function booking_ajax_handler(){
	global $wpdb;
	if($_REQUEST['param'] == 'save_booking'){
		// print_r($_REQUEST);
		$wpdb->insert(product_table(),array(
			'product_name'=>$_REQUEST['prod_name'],
			'prod_desc'=>$_REQUEST['prod_desc'],
			'prod_image'=>$_REQUEST['image_name'],
			'prod_price'=>$_REQUEST['prod_price']
		));
		echo json_encode(array("status"=>1,"message"=>"Product Created Successfully"));
	}
	elseif($_REQUEST['param'] == 'update_booking'){
		// print_r($_REQUEST);
	$up_prod = $wpdb->update(product_table(), array(
		'product_name'=>$_REQUEST['prod_name'],
		 'prod_desc'=>$_REQUEST['prod_desc'],
		  'prod_image'=>$_REQUEST['image_name'],
		  'prod_price'=>$_REQUEST['prod_price']
		), array('id'=>$_REQUEST['prod_id']));

	// print_r($up_prod);
	echo json_encode(array("status"=>1,"message"=>"Product Updated Successfully"));
	}
	die();

}


// function booking_ajax_update(){
// 		global $wpdb;
// 	if($_REQUEST['param'] == 'update_booking'){
// 		// print_r($_REQUEST);
// 	$up_prod = $wpdb->update('table_name', array(
// 		'product_name'=>$_REQUEST['prod_name'],
// 		 'prod_desc'=>$_REQUEST['prod_desc'],
// 		  'prod_image'=>$_REQUEST['image_name'],
// 		  'prod_price'=>$_REQUEST['prod_price']
// 		), array('id'=>$_REQUEST['prod_id']));

// 	print_r($up_prod);
// 	// echo json_encode(array("status"=>1,"message"=>"Product Updated Successfully"));
// 	}
// 	die();
// }


// add_action("wp_ajax_booking_update","booking_ajax_update");

add_filter("page_template","online_book_layout");

function online_book_layout($page_template){
	global $post;
	$page_slug = $post->post_name;
	if($page_slug == "my_book"){
		$page_template = ROOM_BOOKING_DIR_PATH."/front_end/front_end.php";
	}
	return $page_template;
}



