<?php

class BootstrapActiveFormWidget extends CActiveForm
{
	public $labelClass = 'control-label text-primary';

	public function init()
	{
		parent::init();
		$this->enableClientValidation = true;
		$this->errorMessageCssClass = 'text-danger';
		$this->clientOptions = array(
			'validateOnChange' => true,
			'errorCssClass' => 'has-error',
			'successCssClass' => 'has-success',
			'beforeValidateAttribute' => 'js:function (form, attribute) {
				$("#" + attribute.inputID)
					.closest("div")
					.find("span.form-control-feedback, div." + attribute.errorMessageCssClass)
					.remove();
				return true;
			}',
			'afterValidateAttribute' => 'js:function (form, attribute, data, hasError) {
				var self = $("#" + attribute.inputID);
				var icon = $("<span></span>").addClass("glyphicon form-control-feedback");
				if (self.closest("div.has-feedback").hasClass(attribute.errorCssClass)) {
					icon.addClass("glyphicon-remove");
				} else if (self.closest("div.has-feedback").hasClass(attribute.successCssClass)) {
					icon.addClass("glyphicon-ok");
				}
				$("#" + attribute.inputID).after(icon);
			}',
		);
		$this->htmlOptions = array(
			'role' => 'form',
		);

		Yii::app()->getClientScript()->registerScript(
			'autocomplete_off',
			'jQuery(".form-control").attr("autocomplete", "off");',
			CClientScript::POS_END
		);
	}

	public function label($model, $attribute, $htmlOptions = array())
	{
		$htmlOptions['class'] = $this->labelClass;

		return parent::label($model, $attribute, $htmlOptions);

	}

	public function labelEx($model, $attribute, $htmlOptions = array())
	{
		$htmlOptions['class'] = $this->labelClass;

		return parent::labelEx($model, $attribute, $htmlOptions);
	}
}