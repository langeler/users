<?php

// Define project directories
define("ROOT_DIR", dirname(__DIR__, 1));
define("APP_DIR", ROOT_DIR . DIRECTORY_SEPARATOR . "app");
define("CONFIG_DIR", ROOT_DIR . DIRECTORY_SEPARATOR . "config");
define("CORE_DIR", APP_DIR . DIRECTORY_SEPARATOR . "core");
define("CONTROLLER_DIR", APP_DIR . DIRECTORY_SEPARATOR . "controllers");
define("MODEL_DIR", APP_DIR . DIRECTORY_SEPARATOR . "models");
define("VIEWS_DIR", APP_DIR . DIRECTORY_SEPARATOR . "views");

require ROOT_DIR . "/vendor/autoload.php";
