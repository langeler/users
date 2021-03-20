<?php

class App {

	private $data = [];

    function __construct($params) {
		foreach ($params as $k => $v) {
			$this->data[$k] = $v;
		}
    }

	function __set($name, $value) {
        $this->data[$name] = $value;
    }

    function __get($name) {
		switch ($name) {
			case 'route':
				if (!isset($this->data[$name])) {
					$this->data[$name] = new Route($this);
				}
			break;
		}
        return array_key_exists($name, $this->data) ? $this->data[$name] : null;
    }

	static function root_url() {
		$base_url = isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] === 'on' || $_SERVER['HTTPS'] === 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ? 'https' : 'http';
		$base_url .= '://' . rtrim($_SERVER['HTTP_HOST'], '/');
		$base_url .= $_SERVER['SERVER_PORT'] == 80 || $_SERVER['SERVER_PORT'] == 443 ? '' : ':' . $_SERVER['SERVER_PORT'];
		$base_url .= ltrim(substr(str_replace('\\', '/', realpath(__DIR__ . '/..')), strlen($_SERVER['DOCUMENT_ROOT'])), '/');
		return $base_url;
	}

	static function redirect($location) {
		header('Location: ' . App::root_url() . '/' . ltrim($location, '/'));
		exit;
	}

	static function print_r($value) {
		echo '<pre>';
		print_r($value);
		echo '</pre>';
	}

}
?>
