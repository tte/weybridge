<?php
/* @var $this SiteController
 * @var $items []
 * */

$this->pageTitle=Yii::app()->name;
?>

<div id="exchange_rates"></div>

<script>
	document.addEventListener("DOMContentLoaded", function(e) {
		ReactDOM.render(
			React.createElement(ExchangeRate, { items: <?= CJSON::encode($items) ?> }),
			document.getElementById('exchange_rates')
		);
	});
</script>