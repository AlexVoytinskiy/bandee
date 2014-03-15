<?php foreach ($msgs as $class => $msg): ?>
	<div class="alert fade in alert-<?php echo $class; ?>">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $msg; ?>
	</div>
<?php endforeach; ?>
