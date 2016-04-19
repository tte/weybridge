<?php

/**
 * Class ExchangeRate
 * @property string $provider
 * @property string $currency
 * @property float $rate
 */
class ExchangeRate extends CActiveRecord {

	/**
	 * @param string $className
	 * @return ExchangeRate
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string
	 */
	public function tableName() {
		return 'exchange_rate';
	}

	/**
	 * @return array
	 */
	public function rules() {
		return array(
			array('currency, rate, provider', 'required'),
			array('currency, rate, provider', 'safe'),
			array('rate', 'numerical')
		);
	}

}