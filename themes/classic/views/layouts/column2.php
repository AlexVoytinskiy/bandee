<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
	<div class="row main-content">
		<div class="col-md-9">
			<!-- search form -->
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<input type="text" class="form-control">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</span>
					</div>
				</div>
			</div>
			<!-- end search form  -->
			<?php echo $content; ?>
		</div>
		<div class="col-md-3">
			<?php
			$this->widget(
				'application.widgets.ListGroupWidget',
				array(
					'items' => $this->menu,
					'htmlOptions' => array(
						'class' => 'list-group',
					),
					'encodeLabel' => false,
					'itemCssClass' => 'list-group-item',
				)
			);
			?>
			<div class="panel panel-default">
				<div class="panel-heading">Panel heading without title</div>
				<div class="panel-body">
					Panel content
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">Panel heading without title</div>
				<div class="panel-body">
					Panel content
				</div>
			</div>
		</div>
	</div>
<?php $this->endContent(); ?>