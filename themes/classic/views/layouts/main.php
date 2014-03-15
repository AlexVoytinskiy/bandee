<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="language" content="ru">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php Yii::app()->clientScript->registerCoreScript('bootstrap') ?>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->getRequest()->baseUrl; ?>/css/main.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->getRequest()->baseUrl; ?>/css/form.css"/>
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div id="wrap">
	<!-- Fixed navbar -->
	<div class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<?php echo CHtml::link(Yii::app()->name, '/', array('class' => 'navbar-brand')) ?>
			</div>

			<!-- Collect content for toggling -->
			<div class="collapse navbar-collapse">
				<?php
				$this->widget(
					'zii.widgets.CMenu',
					array(
						'items' => array(
							array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
						),
						'htmlOptions' => array(
							'class' => 'nav navbar-nav',
						)
					)
				);
				?>
				<?php
				$this->widget(
					'zii.widgets.CMenu',
					array(
						'items' => array(
							array(
								'label' => 'Регистрация',
								'url' => array('/site/register'),
								'visible' => Yii::app()->getUser()->isGuest,
							),
							array(
								'label' => '<span class="glyphicon glyphicon-log-in"></span> Войти',
								'url' => array('/site/login'),
								'visible' => Yii::app()->getUser()->isGuest
							),
							array(
								'label' => '<span class="glyphicon glyphicon-log-out"></span> Выйти (' . Yii::app()->user->name . ')',
								'url' => array('/site/logout'),
								'visible' => !Yii::app()->getUser()->isGuest
							),
						),
						'htmlOptions' => array(
							'class' => 'nav navbar-nav navbar-right',
						),
						'encodeLabel' => false,
					)
				);
				?>
			</div>
			<!--/.nav-collapse -->
		</div>
	</div>
	<div class="main-header"></div>
	<!-- Begin page content -->
	<div class="container">
		<?php
		$this->widget(
			'application.widgets.FlashWidget', array('flashes' => Yii::app()->getUser()->getFlashes())
		);
		?>
		<?php echo $content; ?>
	</div>
</div>
<div id="footer">
	<div class="container">
		<p class="text-muted credit text-center">Copyright &copy; <?php echo date('Y'); ?> by Bandee. All Rights
			Reserved.</p>
	</div>
</div>
</body>
</html>
