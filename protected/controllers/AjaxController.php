<?php

class AjaxController extends CController
{

	public function filters()
	{
		return array(
			'ajaxOnly',
		);
	}

	public function actionTest()
	{
		print_r(City::model()->findAllByAttributes(array('id_country' => 1)));
	}

	public function actionCitiesByCountry()
	{
		$data = array('status' => 'fail');
		if (isset($_POST['id'])) {
			$cities = City::model()->findAllByAttributes(array('id_country' => $_POST['id']));
			if (!empty($cities)) {
				foreach ($cities as $city) {
					$data['items'][$city->id] = $city->name;
				}
				$data['status'] = 'ok';
			}
		}

		$this->renderJSON($data);
	}

	public function actionMetroByCity()
	{
		$data = array('status' => 'fail');
		if (isset($_POST['id'])) {
			$metro = Metro::model()->findAllByAttributes(array('id_city' => $_POST['id']));
			if (!empty($metro)) {
				foreach ($metro as $item) {
					$data['items'][$item->id] = $item->name;
				}
				$data['status'] = 'ok';
			}
		}

		$this->renderJSON($data);
	}

	private function renderJSON($data)
	{
		header('Content-type: application/json');
		echo CJSON::encode($data);
		Yii::app()->end();
	}
}