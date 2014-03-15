<?php
/**
 * @var $model User
 * @var $this Controller
 */
?>

Здравствуйте! <br>
Имя компании: <b></b><br>
Имя контакта: <b></b><br>
Перейдите по
<?php echo CHtml::link(
	'<b>этой ссылке.</b>',
	$this->createAbsoluteUrl('/site/activate', array('key' => $model->key))
); ?>
