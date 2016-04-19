<?php

class SiteController extends Controller {

	public $layout = 'main';

	public function actionIndex() {
		$items = [
			[
				'provider' => 'cb',
				'rate' => time() + rand(0, 1000),
				'currency' => 'USD'
			],
			[
				'provider' => 'yahoo',
				'rate' => time() - rand(0, 1000),
				'currency' => 'EUR'
			],
		];

		$items = ['items' => $items];

		if(Yii::app()->request->isAjaxRequest) {
			echo CJSON::encode($items);
			Yii::app()->end();
		}

		$this->render('index', $items);
	}
}