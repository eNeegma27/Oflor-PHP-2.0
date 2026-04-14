<?php
// simple logging endpoint; appends POSTed data to a file in ../logs/
// make sure the logs directory exists and is writable by the webserver.

$logDir = __DIR__ . '/../logs';
if (!is_dir($logDir)) {
    mkdir($logDir, 0755, true);
}

$logFile = $logDir . '/ajax_errors.log';

date_default_timezone_set('UTC');

$status = isset($_POST['status']) ? $_POST['status'] : '';
$statusText = isset($_POST['statusText']) ? $_POST['statusText'] : '';
$error = isset($_POST['error']) ? $_POST['error'] : '';
$url = isset($_POST['url']) ? $_POST['url'] : '';
$retryCount = isset($_POST['retryCount']) ? intval($_POST['retryCount']) : 0;

$entry = sprintf(
    "%s | status=%s statusText=%s retry=%d url=%s error=%s\n",
    date('Y-m-d H:i:s'),
    $status,
    $statusText,
    $retryCount,
    $url,
    str_replace("\n", " ", $error)
);

file_put_contents($logFile, $entry, FILE_APPEND | LOCK_EX);

// return a minimal JSON response so the AJAX caller isn't confused.
echo json_encode(['logged' => 1]);
