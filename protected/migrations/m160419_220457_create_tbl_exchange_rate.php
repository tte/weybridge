<?php

class m160419_220457_create_tbl_exchange_rate extends CDbMigration
{
	public function up() {
		$this->createTable(
			'exchange_rate',
			[
				'id' => 'INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT',
				'provider' => 'VARCHAR(255) NOT NULL',
				'currency' => 'ENUM(\'AUD\', \'AZN\', \'GBP\', \'AMD\', \'BYR\', \'BGN\', \'BRL\', \'HUF\', \'DKK\', \'USD\', \'EUR\', \'INR\', \'KZT\', \'CAD\', \'KGS\', \'CNY\', \'MDL\', \'NOK\', \'PLN\', \'RON\', \'XDR\', \'SGD\', \'TJS\', \'TRY\', \'TMT\', \'UZS\', \'UAH\', \'CZK\', \'SEK\', \'CHF\', \'ZAR\', \'KRW\', \'JPY\') NOT NULL',
				'rate' => 'FLOAT(8,4) UNSIGNED NOT NULL',
				'date_create' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
			],
			'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci'
		);

		$this->createIndex('provider', 'exchange_rate', 'provider');
	}

	public function down()
	{
		$this->dropTable('exchange_rate');
		echo "m160419_220457_create_tbl_exchange_rate does not support migration down.\n";
	}

}