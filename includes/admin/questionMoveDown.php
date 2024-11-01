<?php 
if ( ! defined( 'ABSPATH' ) ) exit;

global $wpdb;

$values=array(
		'priority'=>($_POST['question_priority'])
);
$wpdb->update($wpdb->prefix.'sp_survey_question',$values,array('priority'=>($_POST['question_priority']+1)));

$values=array(
		'priority'=>($_POST['question_priority']+1),
		'date_modified'=>current_time('mysql', 1)
);
$wpdb->update($wpdb->prefix.'sp_survey_question',$values,array('id'=>$_POST['question_id']));

$values=array(
		'date_modified'=>current_time('mysql', 1)
);

$wpdb->update($wpdb->prefix.'sp_survey',$values,array('id'=>$_POST['survey_id']));
?>