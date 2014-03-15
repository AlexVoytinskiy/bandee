<?php
/**
 * @var Controller $this
 * @var User $model
 */

$this->pageTitle = 'Настройки профиля';

Yii::app()->getClientScript()->registerScript('popover', 'jQuery("[data-toggle=popover]").popover();', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->getRequest()->baseUrl . '/js/enter_address.js', CClientScript::POS_END);
?>

<div class="page-header">
	<h1 class="text-info">Настройки профиля
		<small>Общая информация</small>
	</h1>
</div>

<?php $form = $this->beginWidget('application.widgets.BootstrapActiveFormWidget', array('id' => 'profile-info')); ?>
<?php // echo CHtml::errorSummary($model); ?>

<div class="row" data-block="address">
	<div class="col-md-3 col-md-offset-1">
		<div class="form-group has-feedback" data-input-type="country"
			 data-route="<?php echo Yii::app()->createUrl('/ajax/citiesByCountry'); ?>"
		>
			<?php echo $form->labelEx($model->profile, 'country'); ?>
			<?php echo $form->dropDownList(
				$model->profile,
				'country',
				Country::takeAll(),
				array(
					'empty' => $model->isEmptyCountry() ? '' : null,
					'class' => 'form-control',
					'data-toggle' => 'popover',
					'data-placement' => 'left',
					'data-content' => 'Выберите страну и затем город, это нужно, что бы отображать в поиске объявления, которые создаються в нужном вам месте.',
					'data-trigger' => 'focus',
					'container' => 'body',
					'options' => array($model->profile->city->id_country => array('selected' => true))
				)
			); ?>
			<?php echo $form->error($model->profile, 'country'); ?>
		</div>
	</div>

	<div class="col-md-3" >
		<div class="form-group has-feedback <?php echo $model->isEmptyCountry() ? 'hidden' : '' ?>"
			data-input-type="city" data-route="<?php echo Yii::app()->createUrl('/ajax/metroByCity'); ?>"
		>
			<?php echo $form->labelEx($model->profile, 'id_city'); ?>
			<?php echo $form->dropDownList(
				$model->profile,
				'id_city',
				City::takeAllById($model->profile->city->country->id),
				array(
					'empty' => $model->isEmptyCity() ? '' : null,
					'class' => 'form-control',
					'data-toggle' => 'popover',
					'data-placement' => 'top',
					'data-content' => 'Выберите город, это нужно, что бы отображать в поиске объявления, которые создаються в нужном вам месте.',
					'data-trigger' => 'focus',
					'container' => 'body',
					'options' => array($model->profile->city->id => array('selected' => true))
				)
			); ?>
			<?php echo $form->error($model->profile, 'id_city'); ?>
		</div>
	</div>

	<div class="col-md-3" >
		<div class="form-group has-feedback <?php echo $model->isEmptyCity() ? 'hidden' : '' ?>" data-input-type="metro">
			<?php echo $form->labelEx($model->profile, 'id_metro'); ?>
			<?php echo $form->dropDownList(
				$model->profile,
				'id_metro',
				Metro::takeAllById($model->profile->id_city),
				array(
					'empty' => $model->isEmptyMetro() ? '' : null,
					'class' => 'form-control',
					'data-toggle' => 'popover',
					'data-placement' => 'top',
					'data-content' => 'Выберите метро, это нужно, что бы отображать в поиске объявления, которые создаються в нужном вам месте.',
					'data-trigger' => 'focus',
					'container' => 'body',
					'options' => array($model->profile->metro->id => array('selected' => true))
				)
			); ?>
			<?php echo $form->error($model->profile, 'id_metro'); ?>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-7 col-md-offset-1">
		<div class="form-group has-feedback">
			<?php echo $form->labelEx($model, 'fio'); ?>
			<?php echo $form->textField(
				$model,
				'fio',
				array(
					'class' => 'form-control',
					'data-toggle' => 'popover',
					'data-placement' => 'left',
					'data-content' => 'Введите ваше имя, оно нужно для отображения в имени профиля.',
					'data-trigger' => 'focus',
					'container' => 'body',
				)
			); ?>
			<?php echo $form->error($model, 'fio'); ?>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group has-feedback">
			<?php echo $form->labelEx($model, 'sex'); ?>
			<?php echo $form->dropDownList(
				$model,
				'sex',
				array('' => '', User::SEX_MAN => 'Мужской', User::SEX_WOMAN => 'Женский'),
				array(
					'class' => 'form-control',
					'data-toggle' => 'popover',
					'data-placement' => 'right',
					'data-content' => 'Выбирите ваш пол, это нужно для корректного отображения вашего профиля.',
					'data-trigger' => 'focus',
					'container' => 'body',
				)
			); ?>
			<?php echo $form->error($model, 'sex'); ?>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4 col-md-offset-1">
		<div class="form-group has-feedback">
			<?php echo $form->labelEx($model, 'birthday'); ?>
			<?php $this->widget(
				'zii.widgets.jui.CJuiDatePicker',
				array(
					'model' => $model,
					'attribute' => 'birthday',
					'language' => Yii::app()->language,
					'value' => $model->birthday,
					'options' => array(
						'dateFormat' => 'yy-mm-dd',
						'changeYear' => true,
						'numberOfMonths' => 2,
					),
					'htmlOptions' => array(
						'class' => 'form-control',
						'data-toggle' => 'popover',
						'data-placement' => 'left',
						'data-content' => 'Выберите правильную дату рождения, для поиска более подходящих объявлений.',
						'data-trigger' => 'focus',
						'container' => 'body',
					),
				)
			); ?>
			<?php echo $form->error($model, 'birthday'); ?>
		</div>
	</div>

	<div class="col-md-5">
		<div class="form-group has-feedback">
			<?php echo $form->labelEx($model->profile, 'phone'); ?>
			<?php echo $form->textField(
				$model->profile,
				'phone',
				array(
					'class' => 'form-control',
					'data-toggle' => 'popover',
					'data-placement' => 'right',
					'data-content' => 'Телефон для дополнительной безопастности и связи с пользователями ресурса. Пример: 89215553344',
					'data-trigger' => 'focus',
					'container' => 'body',
				)
			); ?>
			<?php echo $form->error($model->profile, 'phone'); ?>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-5 col-md-offset-1">
		<div class="form-group has-feedback">
			<?php echo $form->labelEx($model->profile, 'vk'); ?>
			<?php echo $form->textField(
				$model->profile,
				'vk',
				array('class' => 'form-control')
			); ?>
			<?php echo $form->error($model->profile, 'vk'); ?>
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group has-feedback">
			<?php echo $form->labelEx($model->profile, 'facebook'); ?>
			<?php echo $form->textField(
				$model->profile,
				'facebook',
				array('class' => 'form-control')
			); ?>
			<?php echo $form->error($model->profile, 'facebook'); ?>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4 col-md-offset-1">
		<div class="form-group has-feedback">
			<?php echo $form->labelEx($model->profile, 'twitter'); ?>
			<?php echo $form->textField(
				$model->profile,
				'twitter',
				array('class' => 'form-control')
			); ?>
			<?php echo $form->error($model->profile, 'twitter'); ?>
		</div>
	</div>

	<div class="col-md-5">
		<div class="form-group has-feedback">
			<?php echo $form->labelEx($model->profile, 'googleplus'); ?>
			<?php echo $form->textField(
				$model->profile,
				'googleplus',
				array('class' => 'form-control')
			); ?>
			<?php echo $form->error($model->profile, 'googleplus'); ?>
		</div>
	</div>
</div>

<div class="text-left col-md-11 col-md-offset-1">
	<?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-primary btn-lg')); ?>
</div>

<?php $this->endWidget(); ?>
