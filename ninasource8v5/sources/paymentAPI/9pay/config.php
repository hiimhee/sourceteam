<?php

#	Loại thẻ	Thông tin thẻ

// Nội địa (Vietcombank)	
// Số thẻ: 9704000000000018
// Họ tên chủ thẻ: NGUYEN VAN A
// Ngày hết hạn: 03/07
// Mã OTP: otp

// Quốc tế (Visa)	
// Số thẻ: 4440000009900010
// Họ tên chủ thẻ: NGUYEN VAN A
// Ngày hết hạn:    05/25
// Mã OTP: 123

// Quốc tế (MasterCard)	
// Số thẻ: 5123450000000008
// Họ tên chủ thẻ: NGUYEN VAN A
// Ngày hết hạn:    05/25
// Mã OTP: 123

# Thông tin thư mục
$config_url_folder="/sourceteam/ninasource8v5";
$config_url=$_SERVER["SERVER_NAME"].$config_url_folder;

# Thông tin cấu hình
const MERCHANT_KEY = 'y1C0Nm'; // thông tin key của merchant wallet
const MERCHANT_SECRET_KEY = '7mebyCRGt0lKM1vHuEhdveDX8wkiGkJ5D3W';  // thông tin secret key của merchant
const END_POINT = 'https://sand-payment.9pay.vn';

define('URL_DEMO', (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $config_url);
define('URL_CALLBACK', URL_DEMO . '/sources/paymentAPI/9pay/result.php'); // URL đón nhận kết quả