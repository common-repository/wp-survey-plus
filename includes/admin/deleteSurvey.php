<?php 
if ( ! defined( 'ABSPATH' ) ) die(); // Exit if accessed directly
global $wpdb;

$wpdb->delete($wpdb->prefix.'sp_survey',array('id'=>$_POST['survey_id']));
?>