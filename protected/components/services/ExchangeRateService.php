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

}