<?php 

if (!defined("HOME")) {
    die('Сторінка не доступна.');
}

function add_action_tack_add(){
	add_task();
	show_template_site("task_form","my_task");
	if (has_errors()) {
    	print_errors();
    }
    else{
    	show_template("good_rezult");
    }
}

function action_tack_delete(){	
	delete_task($_GET['id']);
	show_template_site("task_form","my_task");	
}

function action_task_todos(){	
	$id=$_GET['id'];
	$mark=task_todos($id);
	if ($mark==1) {
		$mark=0;
	}
	else{
		$mark=1;
	}
	task_mark($id,$mark);
	show_template_site("task_form","my_task");	
}

?>