<?php
declare(strict_types = 1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH' , $root . 'app' . DIRECTORY_SEPARATOR);
define('VIEW_PATH' , $root . 'views' . DIRECTORY_SEPARATOR);
define('TRANSACTION_PATH', $root  . 'transaction_files' . DIRECTORY_SEPARATOR);

require APP_PATH . "app.php";

$file = getTransactionFiles(TRANSACTION_PATH);
$tarnsactions = [];

foreach ($file as $_file) {
    $tarnsactions = array_merge($tarnsactions , extractData($_file));
}

$totals = totalSum($tarnsactions);
require VIEW_PATH . 'transactionfiles.php';

