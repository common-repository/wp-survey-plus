<?php
if ( ! defined( 'ABSPATH' ) ) exit;

global $wpdb;
//echo __('Survey ID','wp-survey-plus').': '.$_POST['survey_id'];
$sql="select survey_name from {$wpdb->prefix}sp_survey where id=".$_POST['survey_id'];
$survey=$wpdb->get_row($sql);

$sql="select id,question_type,multiple_choice_single_ans,question,answers,priority,date_created,
		TIMESTAMPDIFF(MONTH,date_modified,UTC_TIMESTAMP()) as date_modified_month,
		TIMESTAMPDIFF(DAY,date_modified,UTC_TIMESTAMP()) as date_modified_day,
		TIMESTAMPDIFF(HOUR,date_modified,UTC_TIMESTAMP()) as date_modified_hour,
 		TIMESTAMPDIFF(MINUTE,date_modified,UTC_TIMESTAMP()) as date_modified_min,
 		TIMESTAMPDIFF(SECOND,date_modified,UTC_TIMESTAMP()) as date_modified_sec  
		from {$wpdb->prefix}sp_survey_question where survey_id=".$_POST['survey_id'].' order by priority';
$questions = $wpdb->get_results( $sql );
$total_questions=$wpdb->num_rows;
$questionCount=0;
?>
<h2>
	<button class="btn btn-primary" onclick="getSurveyList();">« <?php _e('Back To Surveys','wp-survey-plus');?></button>
	<button class="btn btn-primary" onclick="changeSurveyTitle(<?php echo $_POST['survey_id'];?>);"><?php _e('Change Title','wp-survey-plus');?></button>
	<button class="btn btn-primary" onclick="getAddQuestionScreen(<?php echo $_POST['survey_id'];?>);"><?php _e('Add Question','wp-survey-plus');?></button>
	<button class="btn btn-danger" onclick="deleteSurvey(<?php echo $_POST['survey_id'];?>);"><?php _e('Delete Survey','wp-survey-plus');?></button>
</h2>
<h2><?php echo __('Edit Survey: ','wp-survey-plus').stripcslashes(htmlspecialchars_decode($survey->survey_name,ENT_QUOTES));?></h2>
<div class="table-responsive">
	<table class="table table-striped" style="width: 98%;">
		<tr>
			<th><?php _e('Question','wp-survey-plus');?></th>
			<th><?php _e('Created','wp-survey-plus');?></th>
			<th><?php _e('Modified','wp-survey-plus');?></th>
			<th><?php _e('Action','wp-survey-plus');?></th>
		</tr>
		<?php 
		foreach ($questions as $question){
			$modified='';
			if ($question->date_modified_month) $modified=$question->date_modified_month.' months ago';
			else if ($question->date_modified_day) $modified=$question->date_modified_day.' days ago';
			else if ($question->date_modified_hour) $modified=$question->date_modified_hour.' hours ago';
			else if ($question->date_modified_min) $modified=$question->date_modified_min.' minutes ago';
			else $modified=$question->date_modified_sec.' seconds ago';
			
			$questionCount++;
			
			$moveUpOnClick='questionMoveUp('.$_POST['survey_id'].','.$question->id.','.$question->priority.');';
			if($questionCount==1) $moveUpOnClick='';
			$moveDownOnClick='questionMoveDown('.$_POST['survey_id'].','.$question->id.','.$question->priority.');';
			if($questionCount==$total_questions) $moveDownOnClick='';
			?>
			<tr>
				<td class="survey_title_list" onclick="getEditMultipleChoiceQuestionScreen(<?php echo $question->id;?>);"><b><?php echo stripcslashes(htmlspecialchars_decode($question->question,ENT_QUOTES));?></b></td>
				<td><?php echo $question->date_created;?></td>
				<td><?php echo $modified;?></td>
				<td>
					<img onclick="getEditMultipleChoiceQuestionScreen(<?php echo $question->id;?>);" class="survey_list_action_img" data-toggle="tooltip" data-placement="top" title="<?php _e('Edit','wp-survey-plus');?>" src="<?php echo WSP_PLUGIN_URL.'asset/images/edit_btn.png'?>" >
					<img onclick="deleteQuestion(<?php echo $question->id.','.$_POST['survey_id'];?>);" class="survey_list_action_img" title="<?php _e('Delete','wp-survey-plus');?>" src="<?php echo WSP_PLUGIN_URL.'asset/images/delete_btn.png'?>" >
					<img onclick="<?php echo $moveUpOnClick;?>" class="survey_list_action_img" title="<?php _e('Move Up','wp-survey-plus');?>" src="<?php echo WSP_PLUGIN_URL.'asset/images/move_up_arrow.png'?>" >
					<img onclick="<?php echo $moveDownOnClick;?>" class="survey_list_action_img" title="<?php _e('Move Down','wp-survey-plus');?>" src="<?php echo WSP_PLUGIN_URL.'asset/images/move_down_arrow.png'?>" >
				</td>
			</tr>
			<?php 
		}
		?>
	</table>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.survey_list_action_img').tooltip();
});
</script>