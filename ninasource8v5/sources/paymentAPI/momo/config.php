<?php

// Thông tin cấu hình
$config_url_folder="/sourceteam/ninasource8v5";
$config_url=$_SERVER["SERVER_NAME"].$config_url_folder;

$momo_partner = 'MOMOBKUN20180529'; // Mã partner
$momo_access = 'klm05TvNBzhg7h7j'; // Mã access
$momo_secret = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa'; // Mã secret

// $momo_partner = 'MOMOLASG20220222'; // Mã partner
// $momo_access = 'rouBDwHfAgXkcETH'; // Mã access
// $momo_secret = 'jgLUdQFeEOnFEO4f1CVpY6h7yXbsOuRy'; // Mã secret
$momo_endpoint = 'https://payment.momo.vn/gw_payment/transactionProcessor';  // Mã endpoint

// Cấu hình môi trường chạy
// $momo_endpoint2 = "https://payment.momo.vn/v2/gateway/api/create";
$momo_endpoint2 = "https://test-payment.momo.vn/v2/gateway/api/create";

define('URL_DEMO', (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $config_url);
define('URL_CALLBACK', URL_DEMO . '/sources/paymentAPI/momo/result.php'); // URL đón nhận kết quả
define('URL_WEBHOOK', URL_DEMO . '/sources/paymentAPI/momo/ipn_momo.php'); // URL webhook