<?php 
if ( ! defined( 'ABSPATH' ) ) exit;

global $wpdb;
$values=array(
		'multiple_choice_single_ans'=>$_POST['showCheckboxes'],
		'question'=>htmlspecialchars($_POST['question'],ENT_QUOTES),
		'answers'=>htmlspecialchars($_POST['answers'],ENT_QUOTES),
		'date_modified'=>current_time('mysql', 1)
);
$wpdb->update($wpdb->prefix.'sp_survey_question',$values,array('id'=>$_POST['question_id']));

$values=array(
		'date_modified'=>current_time('mysql', 1)
);

$wpdb->update($wpdb->prefix.'sp_survey',$values,array('id'=>$_POST['survey_id']));
?>