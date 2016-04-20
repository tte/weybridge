<?php


class CbrRateProvider extends RateProvider {

	public $type = 'cbr';

	protected function getUrl() {
		return 'http://www.cbr.ru/scripts/XML_daily.asp';
	}

	protected function validateResponse($data) {
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
		}, $this->filterResponse($data));
	}

	protected function filterResponse($data) {
		return array_filter($data, function($item) {
			return in_array($item['CharCode'], $this->getCurrencies());
		});
	}

}

class CbrRateProviderException extends Exception {}