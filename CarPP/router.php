<?php
$uri = parse_url($_SERVER["REQUEST_URI"])["path"];

$routes = require("routes.php");

if (array_key_exists($uri, $routes )) {
    foreach ($routes as $controller) {
        require_once "controllers/" . explode("@", $controller)[0] . ".php";
      }
      list($controller, $method) = explode('@', $routes[$uri]);
      $instance = new $controller();
      $instance->$method();
} else {
  http_response_code(404);
  echo "Lapa nav atrasta!";
  exit();
}