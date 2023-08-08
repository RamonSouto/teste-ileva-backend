<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true');


require_once './vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$uri = $_SERVER["REQUEST_URI"];
$uri = explode("/",$uri);
$uri = array_values(array_filter($uri));

if(!empty($uri) && $uri[0] === 'api'){
    array_shift($uri);

    $controller = "App\Controller\\" .ucfirst($uri[0])."Controller";

    array_shift($uri);

    $method = strtolower($_SERVER["REQUEST_METHOD"]);

    try{
        $response = call_user_func_array(array(new $controller, $method), $uri);

        http_response_code(200);
        echo json_encode(array('status' => 'sucess', "data" => $response));
        exit;
    } catch (Exception $e){
        http_response_code(404);
        echo json_encode(array('status' => 'error', "data" => $e->getMessage()));
        exit;
    }
} else {
    echo json_encode(array('status' => 'error'));
}