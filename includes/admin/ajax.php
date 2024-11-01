<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

final class WPSurveyPlusAjax {
	
	function getSurveyList(){
		include_once( WSP_PLUGIN_DIR.'includes/admin/getSurveyList.php' );
		die();
	}
	
	function getAddNewSurveySceen(){
		include_once( WSP_PLUGIN_DIR.'includes/admin/getAddNewSurveySceen.php' );
		die();
	}
	
	function getEditSurveySceen(){
		include_once( WSP_PLUGIN_DIR.'includes/admin/getEditSurveySceen.php' );
		die();
	}
	
	function createNewServey(){
		include_once( WSP_PLUGIN_DIR.'includes/admin/createNewServey.php' );
		die();
	}
	
	function changeSurveyTitle(){
		include_once( WSP_PLUGIN_DIR.'includes/admin/changeSurveyTitle.php' );
		die();
	}
	
	function updateSurveyTitle(){
		include_once( WSP_PLUGIN_DIR.'includes/admin/updateSurveyTitle.php' );
		die();
	}
	
	function getAddQuestionScreen(){
		include_once( WSP_PLUGIN_DIR.'includes/admin/getAddQuestionScreen.php' );
		die();
	}
	
	function insertMultipleChoiceQuestion(){
		include_once( WSP_PLUGIN_DIR.'includes/admin/insertMultipleChoiceQuestion.php' );
		die();
	}
	
	function getEditMultipleChoiceQuestionScreen(){
		include_once( WSP_PLUGIN_DIR.'includes/admin/getEditMultipleChoiceQuestionScreen.php' );
		die();
	}
	
	function updateMultipleChoiceQuestion(){
		include_once( WSP_PLUGIN_DIR.'includes/admin/updateMultipleChoiceQuestion.php' );
		die();
	}
	
	function questionMoveUp(){
		include_once( WSP_PLUGIN_DIR.'includes/admin/questionMoveUp.php' );
		die();
	}
	
	function questionMoveDown(){
		include_once( WSP_PLUGIN_DIR.'includes/admin/questionMoveDown.php' );
		die();
	}
	
	function getNextQuestion(){
		include_once( WSP_PLUGIN_DIR.'includes/getNextQuestion.php' );
		die();
	}
	
	function submitMultipleChoiceAnswer(){
		include_once( WSP_PLUGIN_DIR.'includes/submitMultipleChoiceAnswer.php' );
		die();
	}
	
	function submitSurveyUserInfo(){
		include_once( WSP_PLUGIN_DIR.'includes/submitSurveyUserInfo.php' );
		die();
	}
	
	function getReportSceen(){
		include_once( WSP_PLUGIN_DIR.'includes/admin/getReportSceen.php' );
		die();
	}
	
	function exportSurveyResult(){
		include_once( WSP_PLUGIN_DIR.'includes/admin/export_survey_result.php' );
		die();
	}
	
	function deleteSurvey(){
		include_once( WSP_PLUGIN_DIR.'includes/admin/deleteSurvey.php' );
		die();
	}
	
	function deleteQuestion(){
		include_once( WSP_PLUGIN_DIR.'includes/admin/deleteQuestion.php' );
		die();
	}
}
?>