<?php

class SiteController extends Controller {

	public $layout = 'main';

	public function actionIndex() {
		$items = ['items' => ExchangeRateService::getLastCurrencies()];

		if(Yii::app()->request->isAjaxRequest) {
			echo CJSON::encode($items);
			Yii::app()->end();
		}

		$this->render('index', $items);
	}

}