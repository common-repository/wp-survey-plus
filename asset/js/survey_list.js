jQuery(document).ready(function(){
	getSurveyList();
	jQuery('.survey_list_action_img').tooltip();
});

function getSurveyList(){
	jQuery('#survey_list').hide();
	jQuery('#survey_wait').show();
	
	var data = {
		'action': 'getSurveyList'
	};

	jQuery.post(survey_data.ajax_url, data, function(response) {
		jQuery('#survey_wait').hide();
		jQuery('#survey_list').html(response);
		jQuery('#survey_list').show();
	});
}

function getAddNewSurveySceen(){
	jQuery('#survey_list').hide();
	jQuery('#survey_wait').show();
	
	var data = {
		'action': 'getAddNewSurveySceen'
	};

	jQuery.post(survey_data.ajax_url, data, function(response) {
		jQuery('#survey_wait').hide();
		jQuery('#survey_list').html(response);
		jQuery('#survey_list').show();
	});
}

function createNewServey(){
	if(jQuery('#txtSurveyName').val().trim()==''){
		alert("Please Enter Survey Name!");
		jQuery('#txtSurveyName').focus();
		return;
	}
	jQuery('#survey_list').hide();
	jQuery('#survey_wait').show();
	
	var data = {
		'action': 'createNewServey',
		'survey_name': jQuery('#txtSurveyName').val().trim()
	};

	jQuery.post(survey_data.ajax_url, data, function(response) {
		result=jQuery.parseJSON(response);
		getEditSurveySceen(result.survey_id);
	});
}

function getEditSurveySceen(survey_id){
	jQuery('#survey_list').hide();
	jQuery('#survey_wait').show();
	
	var data = {
		'action': 'getEditSurveySceen',
		'survey_id': survey_id
	};

	jQuery.post(survey_data.ajax_url, data, function(response) {
		jQuery('#survey_wait').hide();
		jQuery('#survey_list').html(response);
		jQuery('#survey_list').show();
	});
}

function changeSurveyTitle(survey_id){
	jQuery('#survey_list').hide();
	jQuery('#survey_wait').show();
	
	var data = {
		'action': 'changeSurveyTitle',
		'survey_id': survey_id
	};

	jQuery.post(survey_data.ajax_url, data, function(response) {
		jQuery('#survey_wait').hide();
		jQuery('#survey_list').html(response);
		jQuery('#survey_list').show();
	});
}

function updateSurveyTitle(survey_id){
	if(jQuery('#txtSurveyName').val().trim()==''){
		alert('Please Enter Survey Name');
		jQuery('#txtSurveyName').focus();
		return;
	}
	jQuery('#survey_list').hide();
	jQuery('#survey_wait').show();
	
	var data = {
		'action': 'updateSurveyTitle',
		'survey_id': survey_id,
		'survey_name': jQuery('#txtSurveyName').val().trim()
	};

	jQuery.post(survey_data.ajax_url, data, function(response) {
		getEditSurveySceen(survey_id);
	});
}

function getAddQuestionScreen(survey_id){
	jQuery('#survey_list').hide();
	jQuery('#survey_wait').show();
	
	var data = {
		'action': 'getAddQuestionScreen',
		'survey_id': survey_id
	};

	jQuery.post(survey_data.ajax_url, data, function(response) {
		jQuery('#survey_wait').hide();
		jQuery('#survey_list').html(response);
		jQuery('#survey_list').show();
	});
}

function deleteAns(ans_id){
	if(confirm("Are You sure?")){
		jQuery('#answer'+ans_id).remove();
	}
}

function addAnswer(){
	ans_count++;
	var html='<div id="answer'+ans_count+'" class="answer">'
			  +'<input type="text" name="answers[]" class="surveyMultipleChoiceInput" >'
			  +'<img onclick="deleteAns('+ans_count+');" class="survey_list_action_img" title="Delete" src="'+survey_data.plugin_url+'asset/images/delete_btn.png" >'
			  +'</div>';
	jQuery('#multipleChoiceAnsContainer').append(html);
}

function insertMultipleChoiceQuestion(survey_id,question_type,priority){
	
	if(jQuery('#txtSurveyQuestion').val().trim()==''){
		alert('Please enter question text.');
		return;
	}
	
	var answers=new Array();
	var flag=false;
	jQuery('.answer').each(function(){
		var txtAns=jQuery(this).find(jQuery('.surveyMultipleChoiceInput')).val();
		if(txtAns.trim()==''){
			flag=true;
		} else {
			answers.push(txtAns.trim());
		}
	});
	
	if(flag){
		alert('Answer Field can not be empty.');
		return;
	}
	
	if(answers.length<2){
		alert('Question should have more than one answers');
		return;
	}
	
	jQuery('#survey_list').hide();
	jQuery('#survey_wait').show();
	
	var showCheckboxes=0;
	if(jQuery('#allow_checkbox').is(':checked')){
		showCheckboxes=1;
	}
	
	var data = {
		'action': 'insertMultipleChoiceQuestion',
		'survey_id': survey_id,
		'question_type': question_type,
		'priority': priority,
		'showCheckboxes': showCheckboxes,
		'question': jQuery('#txtSurveyQuestion').val().trim(),
		'answers': answers.join('|||')
	};

	jQuery.post(survey_data.ajax_url, data, function(response) {
		getEditSurveySceen(survey_id);
	});
}

function getEditMultipleChoiceQuestionScreen(question_id){
	jQuery('#survey_list').hide();
	jQuery('#survey_wait').show();
	
	var data = {
			'action': 'getEditMultipleChoiceQuestionScreen',
			'question_id': question_id
		};

		jQuery.post(survey_data.ajax_url, data, function(response) {
			jQuery('#survey_wait').hide();
			jQuery('#survey_list').html(response);
			jQuery('#survey_list').show();
		});
}

function updateMultipleChoiceQuestion(question_id,survey_id){
	
	if(jQuery('#txtSurveyQuestion').val().trim()==''){
		alert('Please enter question text.');
		return;
	}
	
	var answers=new Array();
	var flag=false;
	jQuery('.answer').each(function(){
		var txtAns=jQuery(this).find(jQuery('.surveyMultipleChoiceInput')).val();
		if(txtAns.trim()==''){
			flag=true;
		} else {
			answers.push(txtAns.trim());
		}
	});
	
	if(flag){
		alert('Answer Field can not be empty.');
		return;
	}
	
	if(answers.length<2){
		alert('Question should have more than one answers');
		return;
	}
	
	jQuery('#survey_list').hide();
	jQuery('#survey_wait').show();
	
	var showCheckboxes=0;
	if(jQuery('#allow_checkbox').is(':checked')){
		showCheckboxes=1;
	}
	
	var data = {
		'action': 'updateMultipleChoiceQuestion',
		'survey_id': survey_id,
		'question_id': question_id,
		'showCheckboxes': showCheckboxes,
		'question': jQuery('#txtSurveyQuestion').val().trim(),
		'answers': answers.join('|||')
	};

	jQuery.post(survey_data.ajax_url, data, function(response) {
		getEditSurveySceen(survey_id);
	});
}

function questionMoveUp(survey_id,question_id,question_priority){
	jQuery('#survey_list').hide();
	jQuery('#survey_wait').show();
	
	var data = {
		'action': 'questionMoveUp',
		'survey_id': survey_id,
		'question_id': question_id,
		'question_priority': question_priority
	};
	
	jQuery.post(survey_data.ajax_url, data, function(response) {
		getEditSurveySceen(survey_id);
	});
}

function questionMoveDown(survey_id,question_id,question_priority){
	jQuery('#survey_list').hide();
	jQuery('#survey_wait').show();
	
	var data = {
		'action': 'questionMoveDown',
		'survey_id': survey_id,
		'question_id': question_id,
		'question_priority': question_priority
	};
	
	jQuery.post(survey_data.ajax_url, data, function(response) {
		getEditSurveySceen(survey_id);
	});
}

function getReportSceen(survey_id){
	jQuery('#survey_list').hide();
	jQuery('#survey_wait').show();
	
	var data = {
		'action': 'getReportSceen',
		'survey_id': survey_id
	};

	jQuery.post(survey_data.ajax_url, data, function(response) {
		jQuery('#survey_wait').hide();
		jQuery('#survey_list').html(response);
		jQuery('#survey_list').show();
	});
}

function exportSurveyResult(survey_id){
	jQuery('#survey_list').hide();
	jQuery('#survey_wait').show();
	
	var data = {
		'action': 'exportSurveyResult',
		'survey_id': survey_id
	};

	jQuery.post(survey_data.ajax_url, data, function(response) {
		var res=jQuery.parseJSON(response);
		
		var A = [['Sr.No.','Name','Email','Question','Answer']];
		A.push(['', '', '', '', '']);
		
		for(var k=0; k<res.users.length; k++){
			var sr_no=k+1;
			for(var m=0; m<res.users[k].questions.length; m++){
				sr_no=(m==0)?sr_no:'';
				var name=(m==0)?res.users[k].name:'';
				var email=(m==0)?res.users[k].email:'';
				var question= res.users[k].questions[m].question;
				var answer= res.users[k].questions[m].answer;
				
				A.push([sr_no, name, email, question, answer]);
			}
			A.push(['', '', '', '', '']);
		}

		var csvRows = [];

		for(var i=0, l=A.length; i<l; ++i){
		    csvRows.push(A[i].join(','));
		}

		var csvString = csvRows.join("\r\n");
		var a         = document.createElement('a');
		a.href     = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csvString);
		a.target      = '_blank';
		a.download    = 'survey.csv';

		document.body.appendChild(a);
		a.click();
		
		getSurveyList();
	});
}

function deleteSurvey(survey_id){
	if(confirm('Are you sure to delete?\nThis can not be undone')){
		jQuery('#survey_list').hide();
		jQuery('#survey_wait').show();
		
		var data = {
			'action': 'deleteSurvey',
			'survey_id': survey_id
		};
		
		jQuery.post(survey_data.ajax_url, data, function(response) {
			getSurveyList();
		});
	}
}

function deleteQuestion(question_id,survey_id){
	if(confirm('Are you sure to delete?\nThis can not be undone')){
		jQuery('#survey_list').hide();
		jQuery('#survey_wait').show();
		
		var data = {
			'action': 'deleteQuestion',
			'question_id': question_id
		};
		
		jQuery.post(survey_data.ajax_url, data, function(response) {
			getEditSurveySceen(survey_id);
		});
	}
}