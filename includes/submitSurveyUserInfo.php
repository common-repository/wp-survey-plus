<?php 
if ( ! defined( 'ABSPATH' ) ) exit;

global $wpdb;

$values=array(
		'name'=>$_POST['user_name'],
		'email'=>$_POST['user_mail']
);

$wpdb->update("{$wpdb->prefix}sp_survey_user_info",$values,array('id'=>$_POST['user_id']));

//_e( 'Thank you for participating!!!', 'wp-survey-plus' );
?>
<img src="<?php echo WSP_PLUGIN_URL.'asset/images/thankyous.jpg';?>" style="height: 300px; width: 258px;" />