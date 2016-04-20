<?php


class FetchRateCommand extends CConsoleCommand {

	public function run() {
		while(TRUE) {
			$service = new ExchangeRateService();
			$service->save($service->getRateValues(['USD', 'CAD', 'EUR']));
			sleep(2);
		}
	}
} 