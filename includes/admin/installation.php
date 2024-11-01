<?php 
if ( ! defined( 'ABSPATH' ) ) exit;

global $wpdb;

//Roll & Capability
if(!get_role('wp_survey_plus_editor')){
	add_role( 'wp_survey_plus_editor', 'Survey Editor' );
	$role = get_role( 'wp_survey_plus_editor' );
	$role->add_cap( 'manage-survey-plus' );
	$role->add_cap( 'read' );
	$role = get_role( 'administrator' );
	$role->add_cap( 'manage-survey-plus' );
}

//Database
if ($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}sp_survey'") != $wpdb->prefix . 'sp_survey'){
	$wpdb->query("CREATE TABLE {$wpdb->prefix}sp_survey (
	id integer not null auto_increment,
	survey_name TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
	date_created datetime,
	date_modified datetime,
	responses int not null default 0,
		
	PRIMARY KEY (id)
	);");
}

if ($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}sp_survey_question'") != $wpdb->prefix . 'sp_survey_question'){
	$wpdb->query("CREATE TABLE {$wpdb->prefix}sp_survey_question (
	id integer not null auto_increment,
	survey_id integer,
	question_type integer,
	multiple_choice_single_ans integer null default null,
	question longtext,
	answers longtext,
	priority integer,
	date_created datetime,
	date_modified datetime,

	PRIMARY KEY (id)
	);");
}

if ($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}sp_survey_user_info'") != $wpdb->prefix . 'sp_survey_user_info'){
	$wpdb->query("CREATE TABLE {$wpdb->prefix}sp_survey_user_info (
	id integer not null auto_increment,
	name varchar(200),
	email varchar(200),

	PRIMARY KEY (id)
	);");
}

if ($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}sp_survey_results'") != $wpdb->prefix . 'sp_survey_results'){
	$wpdb->query("CREATE TABLE {$wpdb->prefix}sp_survey_results (
	id integer not null auto_increment,
	question_id integer,
	user_id integer,
	answer text,

	PRIMARY KEY (id)
	);");
}

?>