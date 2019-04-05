<?php

use BestPlay\CurrencyConverter;

require __DIR__ . "/../vendor/autoload.php";

$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);

$result = [
    "from"      =>  "USD",
    "to"        =>  htmlentities(trim($queries['convert_to'])),
    "amount"    =>  htmlentities(trim($queries['amount'])),
    "result"    =>  0,
    "error"     =>  'Amount should be greater than 0'
];
if($queries['amount'] > 0 and $queries['convert_to']) {
    $converter = new CurrencyConverter();
    $converter->setCurrencyFrom("USD");
    $converter->setCurrencyTo(htmlentities(trim($queries['convert_to'])));
    $converter->setAmount(htmlentities(trim($queries['amount'])));

    $result = $converter->convertCurrency()->getResult();
    http_response_code(200);
} else {
    http_response_code(500);
}

echo json_encode($result);