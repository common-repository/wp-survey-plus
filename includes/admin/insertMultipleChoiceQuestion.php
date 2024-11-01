<?php 
if ( ! defined( 'ABSPATH' ) ) exit;

global $wpdb;
$values=array(
		'survey_id'=>$_POST['survey_id'],
		'question_type'=>$_POST['question_type'],
		'multiple_choice_single_ans'=>$_POST['showCheckboxes'],
		'question'=>htmlspecialchars($_POST['question'],ENT_QUOTES),
		'answers'=>htmlspecialchars($_POST['answers'],ENT_QUOTES),
		'priority'=>$_POST['priority'],
		'date_created'=>current_time('mysql', 1),
		'date_modified'=>current_time('mysql', 1)
);
$wpdb->insert($wpdb->prefix.'sp_survey_question',$values);

$values=array(
		'date_modified'=>current_time('mysql', 1)
);

$wpdb->update($wpdb->prefix.'sp_survey',$values,array('id'=>$_POST['survey_id']));
?>