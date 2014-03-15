<?php

class SettingsController extends Controller
{
	public $layout = '//layouts/column1';

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
				'allow',
				'users' => array('@'),
			),
			array(
				'deny',
				'users' => array('*'),
			),
		);
	}

	public function actionIndex()
	{
		$this->render('test');
	}

	public function actionCities()
	{
		if (isset($_POST['id'])) {
			$_POST['id'] = preg_replace("/\D/", "", $_POST['id']); //Оставляем в строке только цифры
			$city = City::model()->findAll('id_country = :Id_country', array(':Id_country' => $_POST['id']));
			if ($city) {
				$result = array();

				foreach ($city as $one) {
					$result[$one->id] = $one->name;
				}

				echo json_encode($result);
			} else {
				$result = array();
				echo json_encode($result);
			}
		}
	}

	public function actionMetro()
	{
		/*$result = array();
		if ($_POST["id"] == "2") echo json_encode(array("1" => "Академическая", "4" => "Площадь мужества"));
		elseif ($_POST["id"] == "1") echo json_encode(array("2" => "Московская", "3" => "Хуйпуталова"));
		else {echo json_encode($result);}*/
		if (isset($_POST['id'])) {
			$_POST['id'] = preg_replace("/\D/", "", $_POST['id']); //Оставляем в строке только цифры
			$metro = Metro::model()->findAll('id_city = :Id_city', array(':Id_city' => $_POST['id']));
			if ($metro) {
				$result = array();

				foreach ($metro as $one) {
					$result[$one->id] = $one->name;
				}

				echo json_encode($result);
			} else {
				$result = array();
				echo json_encode($result);
			}
		}
	}

	public function actionInfo()
	{
		$model = $this->loadModel();

		if (isset($_POST['User'], $_POST['Profile'])) {
			$model->attributes = $_POST['User'];
			$model->profile->attributes = $_POST['Profile'];

			if ($model->validate() && $model->profile->validate()) {
				if (Profile::model()->updateUser($model)) {
					Yii::app()->user->setFlash(Constants::MSG_SUCCESS, 'Вы успешно обновили настройки профиля.');
					$this->refresh();
				} else {
					Yii::app()->user->setFlash(Constants::MSG_DANGER, Constants::ERROR_SAVE);
				}
			}
		}

		$this->render('info', array('model' => $model));
	}

	/**
	 * Returns the data model.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	private function loadModel()
	{
		$model = User::model()->with('profile.city.country', 'profile.metro')->findByPk(Yii::app()->user->id);
		if ($model === null) {
			throw new HttpException(404, Constants::ERROR_NOT_FOUND);
		}

		return $model;
	}
}