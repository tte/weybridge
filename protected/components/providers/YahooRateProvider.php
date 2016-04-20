<?php


class YahooRateProvider extends RateProvider {

	public $type = 'yahoo';
	protected $currencyPrefix = 'RUB';

	protected function getUrl() {
		$currencies = implode(',', array_map(function($item) {
			return $item . $this->currencyPrefix;
		}, $this->getCurrencies()));

		$url = 'https://query.yahooapis.com/v1/public/yql?'
			.'q=select+*+from+yahoo.finance.xchange+where+pair+=+%22'
			.$currencies
			.'%22&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=';

		return $url;
	}

	protected function validateResponse($data) {
		$data = CJSON::decode($data);

		if(!isset($data['query']['results']['rate']))
			throw new YahooRateProviderException('Не верный формат ответа');

		return $data['query']['results']['rate'];
	}

	protected function adapter($data) {
		if(isset($data['id'])) $data = [$data];

		return array_map(function($item) {
			return [
				'currency' => isset($item['id'])
					? preg_replace(sprintf("/()%s/", $this->currencyPrefix), '', $item['id'])
					: NULL,
				'rate' => isset($item['Rate']) ? $item['Rate'] : NULL,
				'provider' => $this->type
			];
		}, $data);
	}

}

class YahooRateProviderException extends Exception {}