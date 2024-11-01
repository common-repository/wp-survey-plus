<?php 
if ( ! defined( 'ABSPATH' ) ) exit;

global $wpdb;

//get priority
$sql="select priority from  {$wpdb->prefix}sp_survey_question where id=".$_POST['question_id'];
$question=$wpdb->get_row($sql);
$priority=$question->priority;

//set user_id and 
$user_id=$_POST['user_id'];
if(!$user_id){
	$sql="update {$wpdb->prefix}sp_survey set responses=(responses+1) where id=".$_POST['survey_id'];
	$wpdb->query($sql);
	$values=array(
		'name'=>'',
		'email'=>''
	);
	$wpdb->insert("{$wpdb->prefix}sp_survey_user_info",$values);
	$user_id=$wpdb->insert_id;
}

//get answer
$answers=explode('|||', $_POST['answers']);
foreach ($answers as $answer){
	$ans=stripcslashes(htmlspecialchars_decode($answer,ENT_QUOTES));
	$values=array(
			'user_id'=>$user_id,
			'question_id'=>$_POST['question_id'],
			'answer'=>htmlspecialchars($ans,ENT_QUOTES)
	);
	$wpdb->insert("{$wpdb->prefix}sp_survey_results",$values);
}

echo '{
			"priority":"'.$priority.'",
			"user_id":"'.$user_id.'"
	   }';
?>