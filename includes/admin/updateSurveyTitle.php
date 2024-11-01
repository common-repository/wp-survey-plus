<?php
if ( ! defined( 'ABSPATH' ) ) exit;

global $wpdb;

$values=array(
		'survey_name'=>htmlspecialchars($_POST['survey_name'],ENT_QUOTES),
		'date_modified'=>current_time('mysql', 1)
);

$wpdb->update($wpdb->prefix.'sp_survey',$values,array('id'=>$_POST['survey_id']));
?>