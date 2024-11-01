<?php 
/**
 * Plugin Name: WP Survey Plus
 * Plugin URI: http://wordpress.org/plugins/wp-survey-plus/
 * Description: Setup awesome surveys within few minutes!
 * License: GPL v3
 * Version: 1.0
 * Author: pradeepmakone07
 * Author URI: http://profiles.wordpress.org/pradeepmakone07/
 * Text Domain: wp-survey-plus
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

final class WPSurveyPlus{
	public function __construct() {
		
		add_action( 'init', array($this,'load_textdomain') );
		
		$this->define_constants();
		register_activation_hook( __FILE__, array($this,'installation') );
		$this->installation();
		$this->include_files();
	}

	private function define_constants() {
		define( 'WSP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		define( 'WSP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		define( 'WSP_VERSION', '2.0' );
	}

	private function include_files(){
		if (is_admin()) {
			include_once( WSP_PLUGIN_DIR.'includes/admin/admin.php' );
			include_once( WSP_PLUGIN_DIR.'includes/admin/ajax.php' );
			$ajax=new WPSurveyPlusAjax();
			add_action( 'wp_ajax_getSurveyList', array( $ajax, 'getSurveyList' ) );
 			add_action( 'wp_ajax_getAddNewSurveySceen', array( $ajax, 'getAddNewSurveySceen' ) );
 			add_action( 'wp_ajax_getEditSurveySceen', array( $ajax, 'getEditSurveySceen' ) );
 			add_action( 'wp_ajax_createNewServey', array( $ajax, 'createNewServey' ) );
 			add_action( 'wp_ajax_changeSurveyTitle', array( $ajax, 'changeSurveyTitle' ) );
 			add_action( 'wp_ajax_updateSurveyTitle', array( $ajax, 'updateSurveyTitle' ) );
 			add_action( 'wp_ajax_getAddQuestionScreen', array( $ajax, 'getAddQuestionScreen' ) );
 			add_action( 'wp_ajax_insertMultipleChoiceQuestion', array( $ajax, 'insertMultipleChoiceQuestion' ) );
 			add_action( 'wp_ajax_getEditMultipleChoiceQuestionScreen', array( $ajax, 'getEditMultipleChoiceQuestionScreen' ) );
 			add_action( 'wp_ajax_updateMultipleChoiceQuestion', array( $ajax, 'updateMultipleChoiceQuestion' ) );
 			add_action( 'wp_ajax_questionMoveUp', array( $ajax, 'questionMoveUp' ) );
 			add_action( 'wp_ajax_questionMoveDown', array( $ajax, 'questionMoveDown' ) );
 			add_action( 'wp_ajax_getReportSceen', array( $ajax, 'getReportSceen' ) );
 			add_action( 'wp_ajax_exportSurveyResult', array( $ajax, 'exportSurveyResult' ) );
 			add_action( 'wp_ajax_deleteSurvey', array( $ajax, 'deleteSurvey' ) );
 			add_action( 'wp_ajax_deleteQuestion', array( $ajax, 'deleteQuestion' ) );
 			
 			add_action( 'wp_ajax_getNextQuestion', array( $ajax, 'getNextQuestion' ) );
 			add_action( 'wp_ajax_nopriv_getNextQuestion', array( $ajax, 'getNextQuestion' ) );
 			add_action( 'wp_ajax_submitMultipleChoiceAnswer', array( $ajax, 'submitMultipleChoiceAnswer' ) );
 			add_action( 'wp_ajax_nopriv_submitMultipleChoiceAnswer', array( $ajax, 'submitMultipleChoiceAnswer' ) );
 			add_action( 'wp_ajax_submitSurveyUserInfo', array( $ajax, 'submitSurveyUserInfo' ) );
 			add_action( 'wp_ajax_nopriv_submitSurveyUserInfo', array( $ajax, 'submitSurveyUserInfo' ) );
		}
		else {
			include_once( WSP_PLUGIN_DIR.'includes/survey_button.php' );
		}
	}

	function installation(){
		include_once( WSP_PLUGIN_DIR.'includes/admin/installation.php' );
	}
	
	function load_textdomain(){
		load_plugin_textdomain( 'wp-survey-plus',plugin_dir_path( __FILE__ ).'/languages' , 'wp-survey-plus/languages' );
	}
	
}

$GLOBALS['WPSurveyPlus'] =new WPSurveyPlus();
?>
