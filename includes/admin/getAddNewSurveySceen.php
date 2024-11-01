<?php 
if ( ! defined( 'ABSPATH' ) ) die(); // Exit if accessed directly
?>

<h2><?php _e('Add New Survey','wp-survey-plus');?></h2><br>

<?php _e('Survey Title','wp-survey-plus');?>: <input id="txtSurveyName" type="text" style="width: 300px;" maxlength="40" /><br><br>
<button class="btn btn-success" onclick="getSurveyList();"><?php _e('Cancel','wp-survey-plus');?></button>
<button class="btn btn-success" onclick="createNewServey();"><?php _e('Save & Edit','wp-survey-plus');?></button>