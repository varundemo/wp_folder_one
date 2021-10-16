<?php

/**
 * Plugin Name:       Add Hooks
 * Plugin URI:        https://quadlayers.com/portfolio/instagram-feed-gallery/
 * Description:       Display Custom Hooks.
 * Version:           1.0.0
 * Author:            Varun
 * Author URI:        https://quadlayers.com
 * License:           GPLv3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       add_hooks
 * Domain Path:       /languages
 */

// echo plugin_dir_url(__FILE__);
// die();

function add_custom_admin_bar($wp_admin_bar){
    $args = array(
        "id"=>"online_blog",
        "title"=>"Online Blog",
        "href"=>"https://paynbox.com/",
        "meta"=>array(
            "class"=>"online-blog-call",
            "target"=>"_blank",
            "rel"=>"my relation",
            "alt"=>"online blog",
            "onclick"=>"subfunc(e)"
        )
    );

    $wp_admin_bar->add_node($args);

     $submenu1 = array(
        "id"=>"submenu1",
        "title"=>"Submenu One",
        "href"=>"https://google.com/",
        "parent"=>"online_blog",
        "meta"=>array(
            "class"=>"submenu-one",
            "target"=>"_blank",
            
        )
    );

    $wp_admin_bar->add_node($submenu1);

}

// add_action("admin_bar_menu","add_custom_admin_bar",999);


// To show a meta box on the admin panel
function add_my_custom_meta(){
    add_meta_box( 'custom_meta_id', 'My Custom Meta Box', 'custom_meta_func', 'post', 'side', 'core' );
}

function custom_meta_func($post){
    echo "This is custom meta function";
    ?>
    <label for="">Name</label>
    <input type="text" value="<?php echo get_post_meta($post->ID,"custom_meta_id",true); ?>" name="txtname" placeholder="Enter Your Name">
    <?php
}

add_action("add_meta_boxes","add_my_custom_meta");

// To save value in the post meta table
add_action("save_post","save_custom_meta");
function save_custom_meta($post_id){
    $custom_txt = isset($_REQUEST['txtname']) ? trim($_REQUEST['txtname']) : '';
    // pirnt($custom_txt);
    // die("this data");
    if(!empty($custom_txt)){
        update_post_meta($post_id,"custom_meta_id",$custom_txt);
    }
}

// add_action("wp_enqueue_script","add_file_to_login");
// To add any file in login page
function add_file_to_login(){
    // die("no file");
    wp_enqueue_style("owt-css", plugin_dir_url(__FILE__)."assets/css/login_file.css");
}

add_action("login_enqueue_scripts","add_file_to_login");

// to add any custom asset in header or footer
function custom_head_file_css(){
    echo '<link rel="stylesheet" href="'.plugin_dir_url(__FILE__).'assets/css/header_css.css" />';
}

add_action("wp_head","custom_head_file_css");
// add_action("wp_footer","custom_head_file_css");

// To add custom field in the login form
function add_login_custom_field(){
    $cust_name = isset($_POST['cust_name']) ? $_POST['cust_name'] : '';
    ?>
    <label for="name">Name</label>
    <input type="text" name="cust_name" class="input" size="25" value="<?php echo $cust_name; ?>">
    <?php
}

add_action("login_form","add_login_custom_field");

// validate coustom login fields
function custom_field_error(){
    global $error;
    if(empty($_POST['cust_name'])){
        $error = "Please fill the name field";
    }
}

add_action("login_head","custom_field_error");

// wp_login hook call immediately after user login
function fetch_login_data_func(){
    // we can add different functionality here like show verify email before login and so on....
    print_r($_REQUEST);
    die();
}

// add_action("wp_login","fetch_login_data_func");
add_filter("the_title","add_custom_title");

function add_custom_title($title){
    return "Admin-".$title;
}
