<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Регистрация на bandee.com';
$this->breadcrumbs = array(
	'Login',
);
?>

<div class="page-header">
	<h1 class="text-info">Регистрация
		<small>Введите свой email и пароль.</small>
	</h1>
</div>

<div class="form">
	<?php $form = $this->beginWidget(
		'CActiveForm',
		array(
			'id' => 'register-form',
			'enableAjaxValidation' => true,
			'enableClientValidation' => false,
			'clientOptions' => array(
				'validateOnSubmit' => true,
			),
			'htmlOptions' => array(
				'role' => 'form',
				'class' => 'form-horizontal',
			)
		)
	); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model, 'mail', array('class' => 'col-sm-3 control-label text-primary')); ?>
		<div class="col-sm-5">
			<?php echo $form->textField(
				$model,
				'mail',
				array(
					'class' => 'form-control',
					'data-toggle' => 'popover',
					'data-placement' => 'left',
					'data-content' => 'Подсказка для поля email.',
					'data-trigger' => 'focus',
					'container' => 'body',
					'autocomplete' => 'off',
				)
			); ?>
			<?php echo $form->error($model, 'mail'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model, 'password', array('class' => 'col-sm-3 control-label text-primary')); ?>
		<div class="col-sm-5">
			<?php echo $form->passwordField(
				$model,
				'password',
				array(
					'class' => 'form-control',
					'data-toggle' => 'popover',
					'data-placement' => 'left',
					'data-content' => 'Подсказка для поля password.',
					'data-trigger' => 'focus',
					'container' => 'body',
					'autocomplete' => 'off',
				)
			); ?>
			<?php echo $form->error($model, 'password'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model, 'repeatPassword', array('class' => 'col-sm-3 control-label text-primary')); ?>
		<div class="col-sm-5">
			<?php echo $form->passwordField($model, 'repeatPassword', array('class' => 'form-control')); ?>
			<?php echo $form->error($model, 'repeatPassword'); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-5">
			<?php echo CHtml::submitButton('Регистрация', array('class' => 'btn btn-primary btn-lg')); ?>
		</div>
	</div>

	<?php $this->endWidget(); ?>
</div><!-- form -->

<script>
	jQuery(function ($) {
		$('[data-toggle=popover]').popover();
	})
</script>
