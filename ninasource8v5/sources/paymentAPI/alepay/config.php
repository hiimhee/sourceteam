<?php

//Thông tin cấu hình
$config_url_folder="/sourceteam/ninasource8v5";
$config_url=$_SERVER["SERVER_NAME"].$config_url_folder;

define('URL_DEMO', (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $config_url);
define('URL_CALLBACK', URL_DEMO . '/sources/paymentAPI/alepay/result.php'); // URL đón nhận kết quả

// VISA 4456530000001096 12/23  CVV 123 OTP: 1234 # Tài khoản ngân hàng test

// Alepay cung cấp
$configAlepay = array(
    "apiKey" => "J46KKbnlyxEJuilhvwdkQLAdcrL2ll", // Là key dùng để xác định tài khoản nào đang được sử dụng.
    "encryptKey" => "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCOsAWXLg0XAI9gVUDsmEeLA5GpC1yilsCF/MIha+giO7lNJmUPTVxuS9+GW/Zz1ju1EAuaeYIl91a9SG4I51RaCbxf9v1aTPj5FmWHQBcFJWIaK9ay59bSM7RwRiiyj59Xf2bYMaLegxZSNjec7wQEAomm6k9kxWrwZVIZOXOj5wIDAQAB", // Là key dùng để mã hóa dữ liệu truyền tới Alepay.
    "checksumKey" => "p0yp4KCH0RrPMQbtl1CPUCew41y970", // Là key dùng để tạo checksum data.
    "callbackUrl" => URL_CALLBACK,
    "env" => "test",
);

// key test live nội bộ
// $config = array(
//     "apiKey" => "qZQLNlFOR4rEy1Y9M6QmmjPKR45ZO6", //Là key dùng để xác định tài khoản nào đang được sử dụng.
//     "encryptKey" => "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDyorJNhD24RNNkF6+EUPnmBJ+gM1LL517meqVG/M7p66SlSD3/lD2cBKfl1IZf0GTyEO1ZUHQolylZ9QZketmYRanrbsNWKR2DpallamYBB6BLnphRMQjcKwtjoEijhbZDM+ZLBgqvzyTljhhH8ifBqOeBHAx6wz7QBkwUMqhRDQIDAQAB", //Là key dùng để mã hóa dữ liệu truyền tới Alepay.
//     "checksumKey" => "LVYjveGTLuEPbBu3yS7nkGl4kG3mN5", //Là key dùng để tạo checksum data. 
//     "callbackUrl" => URL_CALLBACK,
//     "env" => "live",
// );