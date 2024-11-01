<?php 
if ( ! defined( 'ABSPATH' ) ) die(); // Exit if accessed directly

global $wpdb;

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
?>
<h2><button class="btn btn-primary" onclick="getSurveyList();">« <?php _e('Back To Surveys','wp-survey-plus');?></button></h2>
<h2><?php echo __('Survey Report: ','wp-survey-plus').stripcslashes(htmlspecialchars_decode($survey->survey_name,ENT_QUOTES));?></h2>
<?php 
$queCount=0;
foreach ($questions as $question){
	$queCount++;
	$sql="SELECT count(DISTINCT(user_id)) as questionUserCount FROM {$wpdb->prefix}sp_survey_results where question_id=".$question->id;
	$questionUserCount=$wpdb->get_row($sql);
	$questionUserCount=$questionUserCount->questionUserCount;
	
	echo "<h4 class='reportQuestion'>Q. ".stripcslashes(htmlspecialchars_decode($question->question,ENT_QUOTES))."</h4>";
	$answers=explode('|||', $question->answers);
	$ansCount=0;
	?>
	<div class="reportAnsContainer">
	<?php
	foreach ($answers as $answer){
		echo ++$ansCount.'. '.stripcslashes(htmlspecialchars_decode($answer,ENT_QUOTES)).'<br>';
		$sql="SELECT count(DISTINCT(user_id)) as ansUserCount FROM {$wpdb->prefix}sp_survey_results where question_id=".$question->id." and answer='".addslashes($answer)."'";
		$ansUserCount=$wpdb->get_row($sql);
		$ansUserCount=$ansUserCount->ansUserCount;
		$ansPercent=($ansUserCount/$questionUserCount)*100;
		$ansPercent=round($ansPercent,2);
		?>
		<div class="answerProgressBar">
			<div id="ans<?php echo $queCount.$ansCount;?>"></div>
		    <script>
		        jQuery('#ans<?php echo $queCount.$ansCount;?>').simple_progressbar({value: <?php echo $ansPercent;?>, showValue: true, backgroundColor: '#C5D7EB', valueText: '<?php echo $ansPercent.'%  ('.$ansUserCount.' out of '.$questionUserCount.')';?>'});
		    </script>
		</div>
		<?php 
	}
	?>
	</div>
	<?php 
}
?>