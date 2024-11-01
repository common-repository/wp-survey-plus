<?php
if ( ! defined( 'ABSPATH' ) ) exit;

global $wpdb;
$sql="select id from {$wpdb->prefix}sp_survey_question where survey_id=".$_POST['survey_id'];
$questions = $wpdb->get_results( $sql );
$total_questions=$wpdb->num_rows;
$priority=$total_questions+1;

?>
<h2><?php _e('Add a Question','wp-survey-plus');?></h2><br>
<h4><?php _e('Question:','wp-survey-plus');?></h4>
<input type="text" id="txtSurveyQuestion" class="surveyMultipleChoiceInput" ><br><br>
<h4><?php _e('Answers:  ','wp-survey-plus');?><button onclick="addAnswer();" class="btn btn-primary"><?php _e('Add New','wp-survey-plus');?></button></h4>
<div id="multipleChoiceAnsContainer">
	
	<div id="answer1" class="answer">
		<input type="text" name="answers[]" class="surveyMultipleChoiceInput" >
		<img onclick="deleteAns(1);" class="survey_list_action_img" title="<?php _e('Delete','wp-survey-plus');?>" src="<?php echo WSP_PLUGIN_URL.'asset/images/delete_btn.png'?>" >
	</div>
	
	<div id="answer2" class="answer">
		<input type="text" name="answers[]" class="surveyMultipleChoiceInput" >
		<img onclick="deleteAns(2);" class="survey_list_action_img" title="<?php _e('Delete','wp-survey-plus');?>" src="<?php echo WSP_PLUGIN_URL.'asset/images/delete_btn.png'?>" >
	</div>
	
</div>
<br>
<input type="checkbox" id="allow_checkbox" > Allow more than one answer to this question (use checkboxes).
<br><br>
<button class="btn btn-success" onclick="getEditSurveySceen(<?php echo $_POST['survey_id'];?>);"><?php _e('Cancel','wp-survey-plus');?></button>
<button class="btn btn-success" onclick="insertMultipleChoiceQuestion(<?php echo $_POST['survey_id'];?>,1,<?php echo $priority;?>);"><?php _e('Save Question','wp-survey-plus');?></button>

<script type="text/javascript">
	var ans_count=2;
</script>