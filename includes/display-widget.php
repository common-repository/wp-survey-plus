<?php 
$post_id=get_the_ID();
$survey_id=get_post_meta( $post_id, 'wsp_survey_id', true );

if($survey_id){?>

<a class='inline_survey' href="#wsp_container_<?php echo $survey_id;?>">
	<img id="wsp_survey_btn" src="<?php echo WSP_PLUGIN_URL.'asset/images/take_survey.png';?>" />
</a>

<div style="display: none;">
	<div id="wsp_container_<?php echo $survey_id;?>" >
		<div id="question_container" style="display: none;min-height: 300px;"></div>
		<div id="wsp_wait" style="height: 100px; text-align: center;">
			<img style="margin-top: 50px;" src="<?php echo WSP_PLUGIN_URL;?>asset/images/colorbox/loading.gif">
		</div>
	</div>
</div>

<script type="text/javascript">
	var wsp_ajax_url="<?php echo admin_url( 'admin-ajax.php' );?>";
	jQuery(document).ready(function(){
		jQuery(".inline_survey").colorbox({inline:true, width:"300px"});
		getNextQuestion<?php echo $survey_id;?>();
	});

	function getNextQuestion<?php echo $survey_id;?>(priority=0,user_id=0){
		jQuery('#wsp_container_<?php echo $survey_id;?> #question_container').hide();
		jQuery('#wsp_container_<?php echo $survey_id;?> #wsp_wait').show();

		var data = {
			'action': 'getNextQuestion',
			'survey_id': <?php echo $survey_id;?>,
			'priority' : priority,
			'user_id' : user_id
		};

		jQuery.post(wsp_ajax_url, data, function(response) {
			jQuery('#wsp_container_<?php echo $survey_id;?> #wsp_wait').hide();
			jQuery('#wsp_container_<?php echo $survey_id;?> #question_container').html(response);
			jQuery('#wsp_container_<?php echo $survey_id;?> #question_container').show();
		});
	}

	function submitMultipleChoiceAnswer<?php echo $survey_id;?>(showCheckbox,question_id,user_id){
		var answers=new Array();
		if(showCheckbox){
			jQuery('#wsp_container_<?php echo $survey_id;?> .chkAns').each(function(){
				if(jQuery(this).is(':checked')){
					answers.push(jQuery(this).val());
				}
			});
			if(!answers.length) return;
		}
		else {
			if(! jQuery('#wsp_container_<?php echo $survey_id;?> input[name=rdbAns]').is(':checked')){
				return;
			}
			answers.push(jQuery('input[name=rdbAns]:checked').val());
		}

		jQuery('#wsp_container_<?php echo $survey_id;?> #question_container').hide();
		jQuery('#wsp_container_<?php echo $survey_id;?> #wsp_wait').show();

		var data = {
			'action': 'submitMultipleChoiceAnswer',
			'survey_id': <?php echo $survey_id;?>,
			'question_id' : question_id,
			'answers': answers.join('|||'),
			'user_id' : user_id
		};

		jQuery.post(wsp_ajax_url, data, function(response) {
			var jsonObj=jQuery.parseJSON(response);
			getNextQuestion<?php echo $survey_id;?>(jsonObj.priority,jsonObj.user_id);
		});
	}

	function submitSurveyUserInfo<?php echo $survey_id;?>(user_id){
		var user_name=jQuery('#wsp_container_<?php echo $survey_id;?> .user_name').val().trim();
		var user_mail=jQuery('#wsp_container_<?php echo $survey_id;?> .user_email').val().trim();

		if(!user_name){
			alert('<?php _e( 'Please Enter your name', 'wp-survey-plus' );?>');
			jQuery('#wsp_container_<?php echo $survey_id;?> .user_name').val(user_name);
			jQuery('#wsp_container_<?php echo $survey_id;?> .user_name').focus();
			return;
		}

		if(!user_mail){
			alert('<?php _e( 'Please Enter your email', 'wp-survey-plus' );?>');
			jQuery('#wsp_container_<?php echo $survey_id;?> .user_email').val(user_mail);
			jQuery('#wsp_container_<?php echo $survey_id;?> .user_email').focus();
			return;
		}

		if(!IsEmail<?php echo $survey_id;?>(user_mail)){
			alert('<?php _e( 'Incorrect Email', 'wp-survey-plus' );?>');
			jQuery('#wsp_container_<?php echo $survey_id;?> .user_email').val(user_mail);
			jQuery('#wsp_container_<?php echo $survey_id;?> .user_email').focus();
			return;
		}

		jQuery('#wsp_container_<?php echo $survey_id;?> #question_container').hide();
		jQuery('#wsp_container_<?php echo $survey_id;?> #wsp_wait').show();

		var data = {
			'action': 'submitSurveyUserInfo',
			'user_id': user_id,
			'user_name' : user_name,
			'user_mail' : user_mail
		};

		jQuery.post(wsp_ajax_url, data, function(response) {
			jQuery('#wsp_container_<?php echo $survey_id;?> #wsp_wait').hide();
			jQuery('#wsp_container_<?php echo $survey_id;?> #question_container').html(response);
			jQuery('#wsp_container_<?php echo $survey_id;?> #question_container').show();
		});
	}

	function IsEmail<?php echo $survey_id;?>(email) {
	  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  return regex.test(email);
	}
</script>

<?php }?>