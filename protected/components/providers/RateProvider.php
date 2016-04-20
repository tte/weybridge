<?php


abstract class RateProvider implements IExchangeRateProvider {

	public $type;
	protected $currencies;

	public function getRateValues($currencies = 'USD, EUR') {
		$this->setCurrencies($currencies);
		$data = $this->validateResponse($this->fetch());

		return $this->adapter($data);
	}

	public function setCurrencies($currencies) {
		if(is_string($currencies))
			$currencies = array_map('trim', explode(',', $currencies));

		if(!is_array($currencies))
			throw new RateProviderException('Не верный формат кодов валют');

		$this->currencies = $currencies;
	}

	public function getCurrencies() {
		return $this->currencies;
	}

	public function fetch() {
		$url = $this->getUrl();
		$response = RESTHelper::getInstance()->curlGet($url);

		if($response['code'] !== 200)
			throw new RateProviderException('Не удалось выполнить запрос');

		return $response['response'];
	}

	abstract protected function getUrl();

	abstract protected function validateResponse($data);

	abstract protected function adapter($data);

}

class RateProviderException extends Exception {}