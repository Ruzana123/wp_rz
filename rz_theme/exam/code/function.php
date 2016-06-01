<?php 

function show_template($name,$data=NUll){ 
	if ($data){ 
		extract($data); 
	} 
	include "views/" . $name . ".tpl.php"; 
};

function show_template_site($name,$name1,$data=NULL) { 
	if ($data){
		extract($data);
	}
	include "views/header.tpl.php"; 
	include "views/" . $name . ".tpl.php"; 
	include "views/" . $name1 . ".tpl.php"; 
	include "views/footer.tpl.php"; 
}

function add_errors($msg){
    if (!isset($_SESSION['errors'])) {
        $_SESSION['errors']= array();
    }
    array_push($_SESSION['errors'],$msg);
}

function has_errors(){
    if(!empty($_SESSION['errors'])){
        return true;
    }
    else return false;
}


function print_errors(){
    if (has_errors()) {
        ?><div class="alert alert-danger" role="alert"><?php
        foreach ($_SESSION['errors'] as $value) {
            echo $value;
            echo "<br>";
        }   
        ?></div><?php
        unset($_SESSION['errors']);
    }   
}

?>