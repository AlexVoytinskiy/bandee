<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Вход на bandee.com';
?>

<div class="form">
	<?php $form = $this->beginWidget(
		'CActiveForm',
		array(
			'id' => 'login-form',
			'enableClientValidation' => false,
			'clientOptions' => array(
				'validateOnSubmit' => true,
			),
			'htmlOptions' => array(
				'role' => 'form',
				'class' => 'form-horizontal'
			)
		)
	); ?>

	<div class="page-header">
		<h1 class="text-info">Войти
			<small>Введите свой email и пароль.</small>
		</h1>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model, 'username', array('class' => 'col-sm-3 control-label text-primary')); ?>
		<div class="col-sm-5">
			<?php echo $form->textField($model, 'username', array('class' => 'form-control')); ?>
			<?php echo $form->error($model, 'username'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model, 'password', array('class' => 'col-sm-3 control-label text-primary')); ?>
		<div class="col-sm-5">
			<?php echo $form->passwordField($model, 'password', array('class' => 'form-control')); ?>
			<?php echo $form->error($model, 'password'); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-5">
			<div class="checkbox">
				<?php echo $form->checkBox($model, 'rememberMe', array('class' => 'checkbox')); ?>
				<?php echo $form->label($model, 'rememberMe', array('class' => 'text-primary')); ?>
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-5">
			<?php echo CHtml::submitButton('Войти', array('class' => 'btn btn-primary btn-lg')); ?>
		</div>
	</div>

	<?php $this->endWidget(); ?>
</div><!-- form -->
