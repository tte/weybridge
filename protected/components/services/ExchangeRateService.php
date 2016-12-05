<?php


class ExchangeRateService implements IExchangeRateProvider {

	public function getRateValues($currencies = 'USD, EUR') {
		$result = [];
		foreach($this->getProvidersList() as $provider)
			$result = array_merge($result, $provider->getRateValues($currencies));

		return $result;
	}

	protected function getProvidersList() {
		return [
			new YahooRateProvider(),
			new CbrRateProvider()
		];
	}

	public function save(Array $items) {
		foreach($items as $item) {
			$model = new ExchangeRate();
			$model->setAttributes($item);
			if(!$model->save()) {
				Yii::log(CJSON::encode($model->getErrors()), CLogger::LEVEL_ERROR);
			}
		}
	}

	public static function getLastCurrencies() {
		$sql = 'SELECT t.*
			FROM exchange_rate t
			LEFT JOIN exchange_rate er ON er.provider = t.provider AND er.currency = t.currency AND er.id > t.id
			WHERE er.id IS NULL';

		return Yii::app()->db->createCommand($sql)->queryAll();
	}

}