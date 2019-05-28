<?php
if(!defined('BASEPATH')) exit('no file allowed');
function logincheck(){
	$current_user = wp_get_current_user();
	if(!isset($current_user->user_login )){
		redirect('failure/locked');
	}
}
