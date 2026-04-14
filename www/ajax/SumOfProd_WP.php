<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

try {
    require_once(__DIR__ . "/../../lib/lib_oflor_WP.php"); 

    $objOflor = new oflor();
    $result = array();
    $result['ok'] = -1; 
    $result['msg'] = '';
    $result['content'] = $objOflor->HTML_SumOfProd2();  // Wywołanie nowej funkcji
    $result['ok'] = 0;

    echo json_encode($result);
} catch (Exception $e) {
    http_response_code(500);
    $result = array();
    $result['ok'] = $e->getCode();
    $result['msg'] = $e->getMessage();
    echo json_encode($result);
}
?>