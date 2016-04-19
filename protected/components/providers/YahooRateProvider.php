<?php


class YahooRateProvider implements IExchangeRateProvider {

	public $type = 'yahoo';
	private $_currencies;
	private $_currency = 'RUB'; // to const

	public function getRateValues($currencies = 'USD, EUR') {
		$this->setCurrencies($currencies);
		$data = $this->_validateResponse($this->fetch());

		return $this->adapter($data);
	}

	public function setCurrencies($currencies) {
		if(is_string($currencies))
			$currencies = array_map('trim', explode(',', $currencies));

		if(!is_array($currencies))
			throw new YahooRateProviderException('Не верный формат кодов валют');

		$this->_currencies = $currencies;
	}

	public function fetch() {
		$url = $this->_getUrl();
		$response = RESTHelper::getInstance()->curlGet($url);

		if($response['code'] !== 200)
			throw new YahooRateProviderException('Не удалось выполнить запрос');

		return $response['response'];
	}

	private function _getUrl() {
		$currencies = implode(',', array_map(function($item) {
			return $item . $this->_currency;
		}, $this->_currencies));

		$url = 'https://query.yahooapis.com/v1/public/yql?'
			.'q=select+*+from+yahoo.finance.xchange+where+pair+=+%22'
			.$currencies
			.'%22&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=';

		return $url;
	}

	private function _validateResponse($data) {
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
					? preg_replace(sprintf("/()%s/", $this->_currency), '', $item['id'])
					: NULL,
				'rate' => isset($item['Rate']) ? $item['Rate'] : NULL,
				'provider' => $this->type
			];
		}, $data);
	}

	public function getCurrencies() {
		return $this->_currencies;
	}
}

class YahooRateProviderException extends Exception {}