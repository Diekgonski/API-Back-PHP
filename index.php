<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once './Controller/ApiClientes.php';

$api = new ApiClientes();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['cedula'])) {
            $cedula = $_GET['cedula'];
            $api->getByCedula($cedula);
        } else {
            $api->getAll();
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if ($data != null) {

            if ($api->add($data)) {
                http_response_code(200);
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(405);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        if ($data != null) {

            if ($api->update($data)) {
                http_response_code(200);
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(405);
        }
        break;

    case 'DELETE':
        if (isset($_GET['cedula'])) {
            if ($api->delete($_GET['cedula'])) {
                http_response_code(200);
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(405);
        }
}
?>