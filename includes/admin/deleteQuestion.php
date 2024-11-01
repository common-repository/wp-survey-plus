<?php 
if ( ! defined( 'ABSPATH' ) ) die(); // Exit if accessed directly
global $wpdb;

$values=array(
		'survey_id'=>0
);
$wpdb->update($wpdb->prefix.'sp_survey_question',$values,array('id'=>$_POST['question_id']));
?>