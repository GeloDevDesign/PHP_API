<?php
// header('Content-Type: application/json');

define('BASE_URL', '/api/');
const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'vendor/autoload.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

require BASE_PATH . "playground.php";
die();

require BASE_PATH . "bootstrap.php";
require BASE_PATH . "routes.php";
require BASE_PATH . 'Core/functions.php';

try {

    Core\Router::route($uri, $method);

} catch (Exception $exception) {

    http_response_code(404);
    echo "Route not found or error occurred: " . $exception->getMessage();
}
