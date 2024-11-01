<?php 
global $wpdb;

$sql="SELECT DISTINCT ( user_id ) FROM {$wpdb->prefix}sp_survey_results r
		INNER JOIN {$wpdb->prefix}sp_survey_question q ON r.question_id = q.id
		WHERE q.survey_id =".$_POST['survey_id'];
$survey_users=$wpdb->get_results($sql);

echo '{';

echo '"users":[';
$userCount=0;
foreach ($survey_users as $user){
	$sql="select name, email from {$wpdb->prefix}sp_survey_user_info where id=".$user->user_id;
	$user_info=$wpdb->get_row($sql);
	echo ($userCount)?',':'';
	echo '{';
		echo '"name":"'.stripcslashes($user_info->name).'",';
		echo '"email":"'.$user_info->email.'",';
		echo '"questions":[';
		
		$sql="SELECT q.question AS question, r.answer AS answer
				FROM {$wpdb->prefix}sp_survey_question q
				INNER JOIN {$wpdb->prefix}sp_survey_results r ON q.id = r.question_id
				WHERE r.user_id =".$user->user_id;
		$questions=$wpdb->get_results($sql);
		$queCount=0;
		foreach ($questions as $question){
			echo ($queCount)?',':'';
			echo '{';
				echo '"question":"'.str_replace('"',"'",stripcslashes(htmlspecialchars_decode($question->question,ENT_QUOTES))).'",';
				echo '"answer":"'.str_replace('"',"'",stripcslashes(htmlspecialchars_decode($question->answer,ENT_QUOTES))).'"';
			echo '}';
			$queCount++;
		}
		
		echo ']';
	echo '}';
	$userCount++;
}
echo ']';

echo '}';
?>