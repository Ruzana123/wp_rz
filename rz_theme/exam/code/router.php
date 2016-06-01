<?php 
if (!defined("HOME")) {
    die('Сторінка не доступна.');
}

function router(){
	$action=$_GET['action'];
	switch ($action) {
		case '':
			show_template_site("task_form","my_task");			
			break;
		case 'task_add':		 	
			add_action_tack_add();
			break;
		case 'task_todos':
		 	action_task_todos();
			break;	
		case 'task_delete':
		 	action_tack_delete();
			break;			
		default:
			show_template("page404");			
			break;
	}
}

?>