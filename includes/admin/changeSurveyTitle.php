<?php
if ( ! defined( 'ABSPATH' ) ) exit;

global $wpdb;
//echo __('Survey ID','wp-survey-plus').': '.$_POST['survey_id'];
$sql="select survey_name from {$wpdb->prefix}sp_survey where id=".$_POST['survey_id'];
$survey=$wpdb->get_row($sql);
?>

<h2><?php _e('Change Survey Title','wp-survey-plus');?></h2>
<?php _e('Survey Title','wp-survey-plus');?>: <input id="txtSurveyName" type="text" value="<?php echo stripcslashes(htmlspecialchars_decode($survey->survey_name,ENT_QUOTES));?>" style="width: 300px;" maxlength="40" /><br><br>
<button class="btn btn-success" onclick="getEditSurveySceen(<?php echo $_POST['survey_id'];?>);"><?php _e('Cancel','wp-survey-plus');?></button>
<button class="btn btn-success" onclick="updateSurveyTitle(<?php echo $_POST['survey_id'];?>);"><?php _e('Save & Edit','wp-survey-plus');?></button>