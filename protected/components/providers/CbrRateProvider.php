<?php


class CbrRateProvider implements IExchangeRateProvider {

	public $type = 'cbr';
	private $_currencies;

	public function getRateValues($currencies = 'USD, EUR') {
		$this->setCurrencies($currencies);
		$data = $this->_validateResponse($this->fetch());

		return $this->adapter($data);
	}

	public function setCurrencies($currencies) {
		if(is_string($currencies))
			$currencies = array_map('trim', explode(',', $currencies));

		if(!is_array($currencies))
			throw new CbrRateProviderException('Не верный формат кодов валют');

		$this->_currencies = $currencies;
	}

	public function fetch() {
		$url = $this->_getUrl();
		$response = RESTHelper::getInstance()->curlGet($url);

		if($response['code'] !== 200)
			throw new CbrRateProviderException('Не удалось выполнить запрос');

		return $response['response'];
	}

	private function _getUrl() {
		return 'http://www.cbr.ru/scripts/XML_daily.asp';
	}

	private function _validateResponse($data) {
		$data = simplexml_load_string($data);
		$data = json_decode(json_encode($data),TRUE);

		if(!isset($data['Valute']))
			throw new CbrRateProviderException('Не верный формат ответа');

		return $data['Valute'];
	}

	protected function adapter($data) {
		return array_map(function($item) {
			return [
				'currency' => isset($item['CharCode']) ? $item['CharCode'] : NULL,
				'rate' => isset($item['Value']) ? (float)preg_replace('/(,)/', '.', $item['Value']) : NULL,
				'provider' => $this->type
			];
		}, $this->_filterResponse($data));
	}

	private function _filterResponse($data) {
		return array_filter($data, function($item) {
			return in_array($item['CharCode'], $this->_currencies);
		});
	}

	public function getCurrencies() {
		return $this->_currencies;
	}
}

class CbrRateProviderException extends Exception {}