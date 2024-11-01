<?php 
if ( ! defined( 'ABSPATH' ) ) exit;

global $wpdb;

if($_POST['priority']){
	$sql="select id,question_type,multiple_choice_single_ans,question,answers,priority
	from {$wpdb->prefix}sp_survey_question
	where survey_id=".$_POST['survey_id']." and priority > ".$_POST['priority'];
}
else {
	$sql="select id,question_type,multiple_choice_single_ans,question,answers,priority
	from {$wpdb->prefix}sp_survey_question
	where survey_id=".$_POST['survey_id']." and priority= (select min(priority) from {$wpdb->prefix}sp_survey_question where survey_id=".$_POST['survey_id'].")";
}

$question=$wpdb->get_row($sql);
$isQuestionAvailable=$wpdb->num_rows;

if(!$isQuestionAvailable){
	?>
	<p>
		<?php _e( 'Your Name', 'wp-survey-plus' )?>:<br>
		<input type="text" class="user_name">
	</p>
	<p>
		<?php _e( 'Your Email', 'wp-survey-plus' )?>:<br>
		<input type="text" class="user_email">
	</p>
	<p>
		<button onclick="submitSurveyUserInfo<?php echo $_POST['survey_id'];?>(<?php echo $_POST['user_id'];?>);">Submit</button>
	</p>
	<?php 
	die();
}

//$answerStr=stripcslashes(htmlspecialchars_decode($question->answers,ENT_QUOTES));
$answers=explode('|||', $question->answers);
?>
<div style="font-weight: bold;margin-bottom: 10px;">
	<?php echo stripcslashes(htmlspecialchars_decode($question->question,ENT_QUOTES));?>
</div>
<div>
	<?php if($question->multiple_choice_single_ans){?>
		<table style="border: none;">
			<?php foreach ($answers as $answer){?>
			<tr style="border: none;">
				<td style="vertical-align: middle;border: none; width: 12px; padding: 5px 0;text-align: left;">
					<input type="checkbox" class="chkAns" value="<?php echo $answer;?>">
				</td>
				<td style="vertical-align: middle;border: none;padding: 5px 0 5px 6px;text-align: left;">
					<?php echo stripcslashes(htmlspecialchars_decode($answer,ENT_QUOTES));?>
				</td>
			</tr>
			<?php }?>
		</table>
	<?php } else {?>
		<table style="border: none;">
			<?php foreach ($answers as $answer){?>
			<tr style="border: none;">
				<td style="vertical-align: middle;border: none; width: 12px; padding: 5px 0;text-align: left;">
					<input type="radio" name="rdbAns" value="<?php echo $answer;?>">
				</td>
				<td style="vertical-align: middle;border: none;padding: 5px 0 5px 6px;text-align: left;">
					<?php echo stripcslashes(htmlspecialchars_decode($answer,ENT_QUOTES));?>
				</td>
			</tr>
			<?php }?>
		</table>
		
	<?php }?>
	<button onclick="submitMultipleChoiceAnswer<?php echo $_POST['survey_id'];?>(<?php echo $question->multiple_choice_single_ans.','.$question->id.','.$_POST['user_id'];?>);">Submit</button>
</div>