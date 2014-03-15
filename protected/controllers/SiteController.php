<?php

class SiteController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
			array(
				'deny',
				'actions' => array('login', 'activate'),
				'users' => array('@'),
			),
		);
	}

	public function actions()
	{
		return array(
			'page' => array(
				'class' => 'CViewAction',
			),
		);
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionError()
	{
		$this->layout = '//layouts/column1';
		if ($error = Yii::app()->errorHandler->error) {
			if (Yii::app()->request->isAjaxRequest) {
				echo $error['message'];
			} else {
				$this->render('error', $error);
			}
		}
	}

	public function actionLogin()
	{
		$this->layout = '//layouts/column1';
		$model = new LoginForm;
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if (isset($_POST['LoginForm'])) {
			$model->attributes = $_POST['LoginForm'];
			if ($model->validate() && $model->login()) {
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		$this->render('login', array('model' => $model));
	}

	public function actionRegister()
	{
		$this->layout = '//layouts/column1';
		$user = new User('register');
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'register-form') {
			echo CActiveForm::validate($user);
			Yii::app()->end();
		}
		if (isset($_POST['User'])) {
			$user->attributes = $_POST['User'];
			if ($user->validate()) {
				$profile = new Profile();
				if ($profile->createUser($user)) {
					// отправка письма с подтверждением регистрации
					$mailer = new Mailer();
					$mailer->subject = 'Добро пожаловать - Регистрация на Bandee.Ru';
					$mailer->html = $this->renderPartial('//templates/activate', array('model' => $user), true);
					$mailer->to = CHtml::encode($user->mail);
					$mailer->send();
					Yii::app()->user->setFlash(
						Constants::MSG_SUCCESS,
						'Вы успешно зарегистрированы. Вам на почту <b>'
						. CHtml::encode($user->mail) . '</b> придет инструкция для подтверждения регистрации.'
					);
					$this->redirect('index');
				} else {
					Yii::app()->user->setFlash(Constants::MSG_DANGER, Constants::ERROR_SAVE);
				}
			}
		}
		$this->render('registerForm', array('model' => $user));
	}

	/**
	 * Активация аккаунта пользователя
	 * @param string $key
	 */
	public function actionActivate($key)
	{
		$user = User::model()->find('`key` =:MD5 AND `status` = 0', array(':MD5' => $key));
		if ($user === null) {
			throw new CHttpException(404, Constants::ERROR_NOT_FOUND);
		}
		$user->status = User::STATUS_CONFIRM;
		if ($user->save(false)) {
			Yii::app()->user->login(new Auth($user));
			Yii::app()->user->setFlash(Constants::MSG_SUCCESS, 'Поздравляем! Вы успешно завершили регистрацию!');
		} else {
			Yii::app()->user->setFlash(Constants::MSG_DANGER, Constants::ERROR_SAVE);
		}
		$this->redirect('index');
	}

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}