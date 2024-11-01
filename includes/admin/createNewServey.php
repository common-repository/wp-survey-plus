<?php 
if ( ! defined( 'ABSPATH' ) ) exit;

global $wpdb;

$values=array(
		'survey_name'=>htmlspecialchars($_POST['survey_name'],ENT_QUOTES),
		'date_created'=>current_time('mysql', 1),
		'date_modified'=>current_time('mysql', 1)
);
$wpdb->insert($wpdb->prefix.'sp_survey',$values);
$survey_id=$wpdb->insert_id;

echo '{"survey_id":"'.$survey_id.'"}';
?>