<?php
/*
* Plugin Name: RENTAL
* Plugin URI: https://dreamreflectionmedia.com/
* Description: Welcome to the Rental plugin you can easly create multiple rental posts by the help of rental plugin it will help you to grow your business
* Version: 1.0
* Requires at least: 5.2
* Author: Pankaj Bachhal
* Author URI: https://www.instagram.com/pankaj_bachhal/
* License: GPL v2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: rental
* Tags: rental products, wordpress rental, rent, posts, daynamic posts, rental, dream reflection media
*/

defined('ABSPATH') || die("You Can't Access this File Directly");
define('DREAMRENTAL_DIR_PATH', __FILE__); // PLUGIN_DIR_PATH - Global variable

class Rental
{
function __construct(){
$this->plugin = plugin_basename(__FILE__);

function load_media_files() {
wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'load_media_files' );
}
}
$Rental = new Rental();

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'rtl_lnk' );

function rtl_lnk ( $actions ) {
$mylinks = array(
'<a href="' . admin_url( 'admin.php?page=custom-plugin2' ) .'">Settings</a>',
);
$actions = array_merge( $actions, $mylinks );
return $actions;
}


register_activation_hook(__FILE__, function(){
global $wpdb;

$table_name = $wpdb->prefix.'rentaldata';

$charset_collate = $wpdb->get_charset_collate();

$sql = "CREATE TABLE $table_name (
id int(11) NOT NULL AUTO_INCREMENT,
featured_image varchar(1000) NOT NULL,
slider_images varchar(20000) NOT NULL,
price varchar(255) NOT NULL,
productname varchar(400) NOT NULL,
producttype varchar(255) NOT NULL,
hosted varchar(255) NOT NULL,
features varchar(500) NOT NULL,
reviews varchar(500) NOT NULL,
category varchar(255) NOT NULL,
locations varchar(1000) NOT NULL,
numberofguests varchar(255) NOT NULL,
vehiclemake varchar(255) NOT NULL,
descriptions varchar(2000) NOT NULL,
PRIMARY KEY (id)
) $charset_collate;";

 // creating second table in database

 $table_name_2 = $wpdb->prefix . 'checkavailabity';
//  $charset_collate2 = $wpdb->get_charset_collate();
 $sql_2 = "CREATE TABLE $table_name_2 (
 id int(11) NOT NULL AUTO_INCREMENT,
 start_date varchar(200) NOT NULL,
 starttime varchar(200) NOT NULL,
 end_date varchar(200) NOT NULL,
 endtime varchar(200) NOT NULL,
 productlocation varchar(200) NOT NULL,
 ClientEmailid varchar(200) NOT NULL,
 PRIMARY KEY  (id)
 );";


require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
dbDelta( $sql_2 );
});


register_deactivation_hook(__FILE__,function(){
global $wpdb;
$table_name = $wpdb->prefix . 'rentaldata';
$sql = "DROP TABLE IF EXISTS $table_name";
$wpdb->query($sql);

$table_name_2 = $wpdb->prefix .'checkavailabity';
$sql_2 = "DROP TABLE IF EXISTS $table_name_2";
$wpdb->query($sql_2);


});


//backend
add_action('admin_enqueue_scripts','rental_fl_scr');

function rental_fl_scr(){
wp_enqueue_style('custom_style_my', plugins_url('/assets/css/style.css', __FILE__) );
wp_enqueue_script('custompluggin_dev_script', plugins_url('/assets/js/script.js',  __FILE__));
wp_enqueue_script('jquery');
wp_localize_script('custompluggin_dev_script','ajax_object',admin_url("admin-ajax.php"));
}



//frontend



add_action('wp_enqueue_scripts','rntal_sr_rental');


function rntal_sr_rental(){

wp_enqueue_style('custom_style_my', plugins_url('/assets/css/style.css', __FILE__) );
wp_enqueue_style('custom_style_my', plugins_url('/assets/all.min.css', __FILE__) );
wp_enqueue_style('btminstyle',  plugins_url('assets/css/bootstrap.min.css', __FILE__) );
wp_enqueue_script('fStyle', plugins_url('/assets/js/icon.js', __FILE__));
wp_enqueue_script('jquery');


// check check

wp_enqueue_script('custompluggin_dev_script', plugins_url('/assets/js/script.js', __FILE__));

wp_localize_script('custompluggin_dev_script','ajax_object',admin_url("admin-ajax.php"));


}


function adding_rental_menu(){
add_menu_page(
"rentalplugin", //page title
"RENTAL", //menu title
"manage_options", //admin level
"rental", //page slug ~ parent slug
"rental_main_fun", //callback function
"dashicons-admin-site", //icon url
"null" //position
);

add_submenu_page(
"rental", //parent slug
"All Rental", //page title
"All Rental", //menu title
"manage_options", //capability = user level access
"all-rental", //menu slug
"rental_main_fun" //callback function
);

add_submenu_page(
"rental", //parent slug
"Create rental", //page title
"Create rental", //menu title
"manage_options", //capability = user level access
"custom-plugin2", //menu slug
"rental_add_new_function" //callback function
);
add_submenu_page(
    "rental", //parent slug
    "My Clients", //page title
    "My Clients", //menu title
    "manage_options", //capability = user level access
    "my-client", //menu slug
    "rental_client_fun" //callback function
    );

}

add_action("admin_menu","adding_rental_menu");

function rental_admin_view(){
echo "<h1>Dream Reflection Media</h1>";
}


function rental_main_fun(){
//all page functions
require_once plugin_dir_path( __FILE__ )."/views/all-pages.php";
wp_enqueue_script('fStyle', plugins_url('/assets/js/icon.js', __FILE__));
}

function rental_add_new_function(){
require_once plugin_dir_path( __FILE__ )."/views/datasubmit.php";
wp_enqueue_script('fStyle', plugins_url('/assets/js/icon.js', __FILE__));
}
function rental_client_fun(){
require_once plugin_dir_path( __FILE__ )."/views/Myclient.php";
wp_enqueue_script('fStyle', plugins_url('/assets/js/icon.js', __FILE__));   
}


add_action('wp_ajax_addingdata','rtld_data_submit');

add_action('wp_ajax_nopriv_addingdata','rtld_data_submit');

function rtld_data_submit(){
         // Check for nonce security      
if (!isset($_REQUEST['submit-nonce']) || !wp_verify_nonce( $_REQUEST['submit-nonce'], 'addingdata' ) ) {
    wp_send_json_error(['message' => 'invalid nonce']);
}
else if($_REQUEST['param']=='save_plugin'){
    global $wpdb;
    $prefix = $wpdb->prefix;
    $table1 = $prefix.'rentaldata';
    $featuredImg = sanitize_text_field($_REQUEST['featuredImg']);
    $sliderImg = sanitize_text_field($_REQUEST['sliderImg']);
    $price = sanitize_text_field($_REQUEST['price']);
    $productname = sanitize_text_field($_REQUEST['productname']);
    $producttype = sanitize_text_field($_REQUEST['producttype']);
    $hosted = sanitize_text_field($_REQUEST['hosted']);
    $features = sanitize_text_field($_REQUEST['productfeatures']);
    $reviews = sanitize_text_field($_REQUEST['reviews']);
    $category = sanitize_text_field($_REQUEST['category']);
    $location = sanitize_text_field($_REQUEST['location']);
    $numberofguests = sanitize_text_field($_REQUEST['numberofguests']);
    $vehiclemake = sanitize_text_field($_REQUEST['vehiclemake']);
    $description = sanitize_text_field($_REQUEST['description']);

    $data = array(
        "featured_image"=> $featuredImg,
        "slider_images"=> $sliderImg,
        "price" => $price,
        "productname" => $productname,
        "producttype" => $producttype,
        "hosted" => $hosted,
        "features" => $features,
        "reviews" => $reviews,
        "category" => $category,
        "locations" => $location,
        "numberofguests" => $numberofguests,
        "vehiclemake" => $vehiclemake,
        "descriptions" => $description
    );
    $wpdb->insert($table1, $data);
    
    $success = sanitize_text_field('success');
    $statusval = sanitize_text_field(1);

     echo json_encode(array("status"=>esc_attr($statusval),"msg"=>esc_attr($success)));
}
wp_die();
}

//edit

add_action('wp_ajax_editdata','ed_edit_rntl_data');

add_action('wp_ajax_nopriv_editdata','ed_edit_rntl_data');

function ed_edit_rntl_data(){

     // Check for nonce security      
if (!isset($_REQUEST['rdm-nonce']) || ! wp_verify_nonce( $_REQUEST['rdm-nonce'], 'editdata' ) ) {
    wp_send_json_error(['message' => 'Error']);
}
  else if($_REQUEST['param']=='save_plugin'){
global $wpdb;
$prefix = $wpdb->prefix;
$table5 = $prefix.'rentaldata';
$featuredImg = sanitize_text_field($_REQUEST['featuredImg']);
$sliderImg = sanitize_text_field($_REQUEST['sliderImg']);
$price = sanitize_text_field($_REQUEST['myprice']);
$productname = sanitize_text_field($_REQUEST['myproductname']);
$producttype = sanitize_text_field($_REQUEST['myproducttype']);
$hosted = sanitize_text_field($_REQUEST['myhosted']);
$features = sanitize_text_field($_REQUEST['productfeatures']);
$reviews = sanitize_text_field($_REQUEST['reviews']);
$category = sanitize_text_field($_REQUEST['mycategory']);
$location = sanitize_text_field($_REQUEST['mylocation']);
$numberofguests = sanitize_text_field($_REQUEST['mynumberofguests']);
$vehiclemake = sanitize_text_field($_REQUEST['myvehiclemake']);
$description = sanitize_text_field($_REQUEST['mydescription']);

$data5 = array(
    "featured_image"=> $featuredImg,
    "slider_images"=> $sliderImg,
    "price" => $price,
    "productname" => $productname,
    "producttype" => $producttype,
    "hosted" => $hosted,
    "features" => $features,
    "reviews" => $reviews,
    "category" => $category,
    "locations" => $location,
    "numberofguests" => $numberofguests,
    "vehiclemake" => $vehiclemake,
    "descriptions" => $description  
    );

$where5 = array( 'id' => sanitize_text_field($_REQUEST['id']) );
$wpdb->update($table5, $data5, $where5);

$success = sanitize_text_field('success');
$statusval = sanitize_text_field(1);

 echo json_encode(array("status"=>esc_attr($statusval),"msg"=>esc_attr($success)));
 echo json_encode(array("status"=>esc_attr($statusval),"msg"=>esc_attr($success)));


  }
wp_die();
}


//delete
add_action('wp_ajax_deletemyrantaldata','dl_rentl_dat_now');

add_action('wp_ajax_nopriv_deletemyrantaldata','dl_rentl_dat_now');

function dl_rentl_dat_now(){
if($_REQUEST['param']=='save_plugin'){

global $wpdb;
$prefix = $wpdb->prefix;
$table = $prefix.'rentaldata';
$where = array( 'id' => sanitize_text_field($_REQUEST['id']) );
$wpdb->delete($table, $where);

$success = sanitize_text_field('success');
$statusval = sanitize_text_field(1);

 echo json_encode(array("status"=>esc_attr($statusval),"msg"=>esc_attr($success)));

}
wp_die();

}

// check Availabity

add_action('wp_ajax_subcheck','cksf_submt_fn');

add_action('wp_ajax_nopriv_subcheck','cksf_submt_fn');

function cksf_submt_fn(){
        // Check for nonce security      
if (!isset($_REQUEST['cks-nonce']) || ! wp_verify_nonce( $_REQUEST['cks-nonce'], 'subcheck' ) ) {
    wp_send_json_error(['message' => 'Error']);
}
   if($_REQUEST['param']=='save_plugin'){

global $wpdb;
$prefix = $wpdb->prefix;
$table1 = $prefix.'checkavailabity';
$start_date = sanitize_text_field($_REQUEST['start_date']);
$starttime = sanitize_text_field($_REQUEST['starttime']);
$end_date = sanitize_text_field($_REQUEST['end_date']);
$endtime = sanitize_text_field($_REQUEST['endtime']);
$productlocation = sanitize_text_field($_REQUEST['productlocation']);
$checkavailabilityEmails = sanitize_text_field($_REQUEST['checkavailabilityEmails']);

$data = array(
"start_date"=> $start_date,
"starttime"=> $starttime,
"end_date" => $end_date,
"endtime" => $endtime,
"productlocation" => $productlocation,
"ClientEmailid" => $checkavailabilityEmails

);
$wpdb->insert($table1, $data);

$success = sanitize_text_field('success');
$statusval = sanitize_text_field(1);

 echo json_encode(array("status"=>esc_attr($statusval),"msg"=>esc_attr($success)));


}
wp_die();
}

// checkavailabity delete
add_action('wp_ajax_checkavailabitydatadelete','dlfcf_del_one');

add_action('wp_ajax_nopriv_checkavailabitydatadelete','dlfcf_del_one');

function dlfcf_del_one(){
if($_REQUEST['param']=='save_plugin'){

global $wpdb;
$prefix = $wpdb->prefix;
$table = $prefix.'checkavailabity';
$where = array( 'id' => sanitize_text_field($_REQUEST['id']) );
$wpdb->delete($table, $where);

$success = sanitize_text_field('success');
$statusval = sanitize_text_field(1);

 echo json_encode(array("status"=>esc_attr($statusval),"msg"=>esc_attr($success)));
}
wp_die();

}

//shortcode function


add_shortcode("rental-code","rental_sh_cd");

function rental_sh_cd($params){

$values = shortcode_atts(
array(
"product_type"=>'try'
),$params,
'custom-plugin-parameter'

);
ob_start();

include plugin_dir_path( __FILE__ )."/views/popup.php"; // we have attached php file to this shortcode
wp_enqueue_script('mixbtjs', plugins_url('/assets/js/bootstrap.min.js',__FILE__));
return ob_get_clean();
}


?>