<?php

class RESTHelper {

	private static $_instance = null;

	private function __construct() {}
	private function __clone() {}

	public static function getInstance() {
		if(self::$_instance === null)
			self::$_instance = new self();

		return self::$_instance;
	}

	public function curlGet($url, $http_headers=array()) {

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER,         true);
		curl_setopt($ch, CURLOPT_TIMEOUT,        10);

		if (!empty($http_headers)) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $http_headers);
		}

		$response = curl_exec($ch);

		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close ($ch);

		@list($response_headers, $body) = explode("\r\n\r\n", $response, 2);

		$response_headers = explode("\r\n", $response_headers, 64);

		foreach ($response_headers as $header) {
			@list($key, $value) = explode(':', $header, 2);
			if (!empty($value)) {
				$response_headers[$key] = trim($value);
			}
		}

		return array(
			'code'     => (int)$httpcode,
			'headers'  => $response_headers,
			'response' => $body
		);
	}

	public function curlPost($url, $http_headers=array(), $params=array(), $options = []) {

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER,         true);
		curl_setopt($ch, CURLOPT_TIMEOUT,        10);

		if($options && is_array($options)) {
			foreach($options as $key => $value) {
				curl_setopt($ch, $key, $value);
			}
		}

		curl_setopt($ch, CURLOPT_POST,           true);
		curl_setopt($ch, CURLOPT_POSTFIELDS,     $params);

		if (!empty($http_headers)) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $http_headers);
		}

		$response = curl_exec($ch);

		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);

		$response = str_replace("HTTP/1.1 100 Continue\r\n\r\n", "", $response);

		@list($response_headers, $body) = explode("\r\n\r\n", $response, 2);

		$response_headers = explode("\r\n", $response_headers, 64);

		foreach ($response_headers as $header) {
			@list($key, $value) = explode(':', $header, 2);
			if (!empty($value)) {
				$response_headers[$key] = trim($value);
			}
		}

		return array(
			'code'     => (int)$httpcode,
			'headers'  => $response_headers,
			'response' => $body
		);
	}

	public function curlPut($url, $http_headers=array(), $params=array()) {

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER,         true);
		curl_setopt($ch, CURLOPT_TIMEOUT,        10);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

		if (!empty($http_headers)) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $http_headers);
		}

		$response = curl_exec($ch);

		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);

		$response = str_replace("HTTP/1.1 100 Continue\r\n\r\n", "", $response);

		list($response_headers, $body) = explode("\r\n\r\n", $response, 2);

		$response_headers = explode("\r\n", $response_headers, 64);

		foreach ($response_headers as $header) {
			@list($key, $value) = explode(':', $header, 2);
			if (!empty($value)) {
				$response_headers[$key] = trim($value);
			}
		}

		return array(
			'code'     => (int)$httpcode,
			'headers'  => $response_headers,
			'response' => $body
		);
	}

	public function curlDelete($url, $http_headers=array(), $params=array()) {

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER,         true);
		curl_setopt($ch, CURLOPT_TIMEOUT,        10);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

		if (!empty($http_headers)) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $http_headers);
		}

		$response = curl_exec($ch);

		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);

		$response = str_replace("HTTP/1.1 100 Continue\r\n\r\n", "", $response);

		@list($response_headers, $body) = explode("\r\n\r\n", $response, 2);

		$response_headers = explode("\r\n", $response_headers, 64);

		foreach ($response_headers as $header) {
			@list($key, $value) = explode(':', $header, 2);
			if (!empty($value)) {
				$response_headers[$key] = trim($value);
			}
		}

		return array(
			'code'     => (int)$httpcode,
			'headers'  => $response_headers,
			'response' => $body
		);
	}

	public function curlOptions($url, $http_headers=array(), $params=array()) {

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER,         true);
		curl_setopt($ch, CURLOPT_TIMEOUT,        10);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'OPTIONS');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

		if (!empty($http_headers)) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $http_headers);
		}

		$response = curl_exec($ch);

		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);

		$response = str_replace("HTTP/1.1 100 Continue\r\n\r\n", "", $response);

		@list($response_headers, $body) = explode("\r\n\r\n", $response, 2);

		$response_headers = explode("\r\n", $response_headers, 64);

		foreach ($response_headers as $header) {
			@list($key, $value) = explode(':', $header, 2);
			if (!empty($value)) {
				$response_headers[$key] = trim($value);
			}
		}

		return array(
			'code'     => (int)$httpcode,
			'headers'  => $response_headers,
			'response' => $body
		);
	}


	/**
	 * @return array - кастомная функция получения списка заголовков, так как
	 * в PHP 5.3 нет функции getallheaders(), которая есть только начиная с
	 * PHP 5.4.
	 */
	public function parseRequestHeaders() {
		$headers = array();
		foreach($_SERVER as $key => $value) {
			if (mb_substr($key, 0, 5) <> 'HTTP_') {
				continue;
			}
			$header = str_replace(
				' ',
				'-',
				ucwords(str_replace('_', ' ', strtolower(substr($key, 5))))
			);
			$headers[$header] = $value;
		}

		return $headers;
	}

	public function parse_raw_http_request(array &$a_data) {
		// read incoming data
		$input = file_get_contents('php://input');

		// grab multipart boundary from content type header
		preg_match('/boundary=(.*)$/', $_SERVER['CONTENT_TYPE'], $matches);

		// content type is probably regular form-encoded
		if (!count($matches))
		{
			// we expect regular puts to containt a query string containing data
			parse_str(urldecode($input), $a_data);
			return $a_data;
		}

		$boundary = $matches[1];

		// split content by boundary and get rid of last -- element
		$a_blocks = preg_split("/-+$boundary/", $input);
		array_pop($a_blocks);

		// loop data blocks
		foreach ($a_blocks as $id => $block)
		{
			if (empty($block))
				continue;

			// you'll have to var_dump $block to understand this and maybe replace \n or \r with a visibile char

			// parse uploaded files
			if (strpos($block, 'application/octet-stream') !== FALSE)
			{
				// match "name", then everything after "stream" (optional) except for prepending newlines
				preg_match("/name=\"([^\"]*)\".*stream[\n|\r]+([^\n\r].*)?$/s", $block, $matches);
				$a_data['files'][$matches[1]] = $matches[2];
			}
			// parse all other fields
			else
			{
				// match "name" and optional value in between newline sequences
				preg_match('/name=\"([^\"]*)\"[\n|\r]+([^\n\r].*)?\r$/s', $block, $matches);
				$a_data[$matches[1]] = $matches[2];
			}
		}
	}
}