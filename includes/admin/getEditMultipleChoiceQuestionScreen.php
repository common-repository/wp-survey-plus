<?php
if ( ! defined( 'ABSPATH' ) ) exit;

global $wpdb;
$sql="select * from {$wpdb->prefix}sp_survey_question where id=".$_POST['question_id'];
$question = $wpdb->get_row( $sql );

$answerStr=stripcslashes(htmlspecialchars_decode($question->answers,ENT_QUOTES));

$answers=explode('|||', $answerStr);

$ansCount=0;

?>
<h2><?php _e('Edit a Question','wp-survey-plus');?></h2><br>
<h4><?php _e('Question:','wp-survey-plus');?></h4>
<input type="text" id="txtSurveyQuestion" class="surveyMultipleChoiceInput" value="<?php echo stripcslashes(htmlspecialchars_decode($question->question,ENT_QUOTES));?>" ><br><br>
<h4><?php _e('Answers:  ','wp-survey-plus');?><button onclick="addAnswer();" class="btn btn-primary"><?php _e('Add New','wp-survey-plus');?></button></h4>
<div id="multipleChoiceAnsContainer">
	
	<?php 
	foreach ($answers as $answer){
		$ansCount++;
	?>
	<div id="answer<?php echo $ansCount;?>" class="answer">
		<input type="text" name="answers[]" class="surveyMultipleChoiceInput" value="<?php echo $answer;?>" >
		<img onclick="deleteAns(<?php echo $ansCount;?>);" class="survey_list_action_img" title="<?php _e('Delete','wp-survey-plus');?>" src="<?php echo WSP_PLUGIN_URL.'asset/images/delete_btn.png'?>" >
	</div>
	<?php }?>
</div>
<br>
<input type="checkbox" <?php echo ($question->multiple_choice_single_ans)?'checked="checked"':'';?> id="allow_checkbox" > Allow more than one answer to this question (use checkboxes).
<br><br>
<button class="btn btn-success" onclick="getEditSurveySceen(<?php echo $question->survey_id;?>);"><?php _e('Cancel','wp-survey-plus');?></button>
<button class="btn btn-success" onclick="updateMultipleChoiceQuestion(<?php echo $_POST['question_id'];?>,<?php echo $question->survey_id;?>);"><?php _e('Update Question','wp-survey-plus');?></button>

<script type="text/javascript">
	var ans_count=<?php echo $ansCount;?>;
</script>