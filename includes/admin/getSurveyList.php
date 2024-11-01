<?php 
if ( ! defined( 'ABSPATH' ) ) die(); // Exit if accessed directly

global $wpdb;

$sql="select id,survey_name,responses,date_created, 
		TIMESTAMPDIFF(MONTH,date_modified,UTC_TIMESTAMP()) as date_modified_month,
		TIMESTAMPDIFF(DAY,date_modified,UTC_TIMESTAMP()) as date_modified_day,
		TIMESTAMPDIFF(HOUR,date_modified,UTC_TIMESTAMP()) as date_modified_hour,
 		TIMESTAMPDIFF(MINUTE,date_modified,UTC_TIMESTAMP()) as date_modified_min,
 		TIMESTAMPDIFF(SECOND,date_modified,UTC_TIMESTAMP()) as date_modified_sec 
		from {$wpdb->prefix}sp_survey 
		ORDER BY date_modified DESC";

$surveys = $wpdb->get_results( $sql );
$total_surveys=$wpdb->num_rows;
?>
<h2><?php _e('Surveys','wp-survey-plus');?> <button onclick="getAddNewSurveySceen();" class="btn btn-primary"><?php _e('Add New','wp-survey-plus');?></button></h2>

<div class="table-responsive">
	<table class="table table-striped" style="width: 98%;">
		<tr>
			<th><?php _e('Title','wp-survey-plus');?></th>
			<th><?php _e('Created','wp-survey-plus');?></th>
			<th><?php _e('Modified','wp-survey-plus');?></th>
			<th><?php _e('Responses','wp-survey-plus');?></th>
			<th><?php _e('Action','wp-survey-plus');?></th>
		</tr>
		<?php 
		foreach ($surveys as $survey){
			$modified='';
			if ($survey->date_modified_month) $modified=$survey->date_modified_month.' '.__('months ago','wp-survey-plus');
			else if ($survey->date_modified_day) $modified=$survey->date_modified_day.' '.__('days ago','wp-survey-plus');
			else if ($survey->date_modified_hour) $modified=$survey->date_modified_hour.' '.__('hours ago','wp-survey-plus');
			else if ($survey->date_modified_min) $modified=$survey->date_modified_min.' '.__('minutes ago','wp-survey-plus');
			else $modified=$survey->date_modified_sec.' '.__('seconds ago','wp-survey-plus');
			
			?>
			<tr>
				<td class="survey_title_list" onclick="getEditSurveySceen(<?php echo $survey->id;?>);"><b><?php echo stripcslashes(htmlspecialchars_decode($survey->survey_name,ENT_QUOTES));?></b></td>
				<td><?php echo $survey->date_created;?></td>
				<td><?php echo $modified;?></td>
				<td><?php echo $survey->responses;?></td>
				<td>
					<img onclick="getEditSurveySceen(<?php echo $survey->id;?>);" class="survey_list_action_img" data-toggle="tooltip" data-placement="top" title="<?php _e('Edit','wp-survey-plus');?>" src="<?php echo WSP_PLUGIN_URL.'asset/images/edit_btn.png'?>" >
					<img onclick="getReportSceen(<?php echo $survey->id;?>);" class="survey_list_action_img" title="<?php _e('View Report','wp-survey-plus');?>" src="<?php echo WSP_PLUGIN_URL.'asset/images/graph.png'?>" >
					<img onclick="exportSurveyResult(<?php echo $survey->id;?>);" class="survey_list_action_img" title="<?php _e('Export Results','wp-survey-plus');?>" src="<?php echo WSP_PLUGIN_URL.'asset/images/export-icon.png'?>" >
					<img onclick="deleteSurvey(<?php echo $survey->id;?>);" class="survey_list_action_img" title="<?php _e('Delete','wp-survey-plus');?>" src="<?php echo WSP_PLUGIN_URL.'asset/images/delete_btn.png'?>" >
				</td>
			</tr>
			<?php 
		}
		?>
	</table>
</div>
<?php if($total_surveys==0){?>
<h3 id="heading_not_found"><?php _e('No Surveys Found','wp-survey-plus');?></h3>
<?php }?>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.survey_list_action_img').tooltip();
});
</script>