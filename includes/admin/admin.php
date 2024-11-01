<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

final class WPSurveyPlusAdmin {
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'loadScripts') );
		add_action( 'admin_menu', array($this,'custom_menu_page') );
		
		add_action( 'load-post.php', array( $this, 'survey_meta_box') );
		add_action( 'load-post-new.php', array( $this, 'survey_meta_box') );
	}
	
	function loadScripts(){
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
	}
	
	function custom_menu_page(){
		add_menu_page( 'WP Survey Plus', 'Surveys', 'manage-survey-plus', 'wp-survey-plus', array($this,'surveys'),WSP_PLUGIN_URL.'asset/images/survey.png', '51.76' );
	}
	
	function surveys(){
		wp_enqueue_script('wpsp_bootstrap', WSP_PLUGIN_URL . 'asset/js/bootstrap/js/bootstrap.min.js');
		wp_enqueue_style('wpsp_bootstrap', WSP_PLUGIN_URL . 'asset/js/bootstrap/css/bootstrap.min.css');
		wp_enqueue_script('wpsp_survey_list', WSP_PLUGIN_URL . 'asset/js/survey_list.js');
		wp_enqueue_style('wpsp_survey_list', WSP_PLUGIN_URL . 'asset/css/survey_list.css');
		wp_enqueue_script('wpsp_survey_report_progress', WSP_PLUGIN_URL . 'asset/js/jquery_simple_progressbar.js');
		
		$localize_script_data=array(
				'ajax_url'=>admin_url( 'admin-ajax.php' ),
				'site_url'=>site_url(),
				'plugin_url'=>WSP_PLUGIN_URL,
				'plugin_dir'=>WSP_PLUGIN_DIR
		);
		wp_localize_script( 'wpsp_survey_list', 'survey_data', $localize_script_data );
		include_once( WSP_PLUGIN_DIR.'includes/admin/survey_list.php' );
		
// 		if(isset($_REQUEST['export'])){
// 			include_once( WSP_PLUGIN_DIR.'includes/admin/export_survey_result.php' );
// 		}
	}
	
	function survey_meta_box(){
		add_action( 'add_meta_boxes', array( $this, 'add_post_meta_boxes') );
		add_action( 'save_post', array( $this, 'save_post_meta'), 10, 2 );
	}
	
	function add_post_meta_boxes(){
		add_meta_box(
			'wp-survey-plus',      // Unique ID
			__( "Survey", 'wp-survey-plus' ),    // Title
			array( $this, 'setPageSurvey'),   // Callback function
			'page',         // Admin page (or post type)
			'side',         // Context
			'default'         // Priority
		);
		add_meta_box(
			'wp-survey-plus',      // Unique ID
			__( "Survey", 'wp-survey-plus' ),    // Title
			array( $this, 'setPageSurvey'),   // Callback function
			'post',         // Admin page (or post type)
			'side',         // Context
			'default'         // Priority
		);
	}
	
	function save_post_meta($post_id, $post){
		if ( !isset( $_POST['wsp_survey_id'] )  || !wp_verify_nonce( $_POST['wp_survey_plus_nonce'], basename( __FILE__ ) ) )
			return $post_id;
		
		/* Get the post type object. */
		$post_type = get_post_type_object( $post->post_type );
		
		/* Check if the current user has permission to edit the post. */
		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
			return $post_id;
		
		/* Get the posted data and sanitize it for use as an HTML class. */
		$new_meta_value = ( isset( $_POST['wsp_survey_id'] ) ? $_POST['wsp_survey_id'] : '' );
		
		update_post_meta( $post_id, 'wsp_survey_id', $new_meta_value );
	}
	
	function setPageSurvey($object, $box){
		wp_nonce_field( basename( __FILE__ ), 'wp_survey_plus_nonce' );
		$post_survey_id=get_post_meta( $object->ID, 'wsp_survey_id', true );
		
		global $wpdb;
		$sql="select id,survey_name from {$wpdb->prefix}sp_survey
		ORDER BY survey_name";
		$surveys = $wpdb->get_results( $sql );
		?>
		<select id="wp_survey_plus_id" name="wsp_survey_id">
			<option value=""><?php _e('None','wp-survey-plus');?></option>
			<?php 
			foreach ($surveys as $survey){
				?>
				<option <?php echo ($survey->id==$post_survey_id)?'selected="selected"':'';?> value="<?php echo $survey->id;?>"><?php echo stripcslashes(htmlspecialchars_decode($survey->survey_name,ENT_QUOTES));?></option>
				<?php 
			}
			?>
		</select>
		<?php 
	}
}

$GLOBALS['WPSurveyPlusAdmin'] =new WPSurveyPlusAdmin();
?>