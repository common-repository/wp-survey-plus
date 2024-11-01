<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

final class WPSurveyPlusButton{
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'loadScripts') );
		add_action( 'wp_footer', array( $this, 'showButton') );
	}
	
	function loadScripts(){
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
 		wp_enqueue_style('wsp_survey_button', WSP_PLUGIN_URL . 'asset/css/survey_button.css');
 		wp_enqueue_style('wsp_colorbox', WSP_PLUGIN_URL . 'asset/css/colorbox.css');
 		wp_enqueue_script( 'wsp_colorbox', WSP_PLUGIN_URL . 'asset/js/jquery.colorbox-min.js');
	}
	
	function showButton(){
		include_once( WSP_PLUGIN_DIR.'includes/display-widget.php' );
	}
}

$GLOBALS['WPSurveyPlusButton'] =new WPSurveyPlusButton();
?>