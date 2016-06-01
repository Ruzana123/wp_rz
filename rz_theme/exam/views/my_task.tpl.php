<div class="panel-heading" style="text-align:center;">
	<h3>My task</h3>
	<ul class="list-group"  style="text-align:center">
  		<?php 
  		$tasks=all_task();
  		foreach ($tasks as $key => $value) { ?>
  		<?php 
  			if ($value['mark']==0) {
  				?><li class="list-group-item" style="text-align:center;"><?php echo $value['text']; ?><a href="<?php echo 'index.php?action=task_todos' . "&id=" . $value['0']  ?>">   <span class="glyphicon glyphicon-check" aria-hidden="true" style="color:green"></span></a>
					<a href="<?php echo 'index.php?action=task_delete' . "&id=" . $value['id']  ?>"> <span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red"></span></a></li>
  			<?php } 
  			else{ ?>
  				<li class="list-group-item" style="text-align:center;"><strike><?php echo $value['text']; ?></strike><a href="<?php echo 'index.php?action=task_todos' . "&id=" . $value['0']  ?>"><span class="glyphicon glyphicon-repeat" aria-hidden="true" style="color:green"></span></a>
					<a href="<?php echo 'index.php?action=task_delete' . "&id=" . $value['id']  ?>"> <span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red"></span></a></li>
  			<?php }
  		} ?>
	</ul>
</div>

  	
  	