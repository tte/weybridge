<?php

class SiteController extends Controller {

	public $layout = 'main';

	public function actionIndex() {
		$items = ['items' => $this->getLastCurrencies()];

		if(Yii::app()->request->isAjaxRequest) {
			echo CJSON::encode($items);
			Yii::app()->end();
		}

		$this->render('index', $items);
	}

	protected function getLastCurrencies() {
		$sql = 'SELECT t.*
			FROM exchange_rate t
			LEFT JOIN exchange_rate er ON er.provider = t.provider AND er.currency = t.currency AND er.id > t.id
			WHERE er.id IS NULL';

		return Yii::app()->db->createCommand($sql)->queryAll();
	}
}