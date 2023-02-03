<?php
header('Content-type: text/html; charset=utf-8');
session_start();
@define ( 'LIBRARIES' , '../../../libraries/');
require_once LIBRARIES . "config.php";
require_once LIBRARIES . "config-type.php";
require_once LIBRARIES . 'autoload.php';
require_once('config.php');
new AutoLoad();
$injection = new AntiSQLInjection();
$d = new PDODb($config['database']);
$flash = new Flash();
$seo = new Seo($d);
$emailer = new Email($d);
$router = new AltoRouter();
$cache = new Cache($d);
$func = new Functions($d, $cache);
$breadcr = new BreadCrumbs($d);
$statistic = new Statistic($d, $cache);
$cart = new Cart($d);
$detect = new MobileDetect();
$addons = new AddonsOnline();
$css = new CssMinify($config['website']['debug-css'], $func);
$js = new JsMinify($config['website']['debug-js'], $func);
$data_donhang = $_SESSION['ALEPAY'];
$momo_order_code = $data_donhang['code'];
if($momo_partner=='' or $momo_access=='' or $momo_secret=='' or $momo_endpoint=='') {
    $func->transfer_api('Cấu hình thanh toán Momo không thành công.', $configBase, false);
}
if(!isset($_SESSION['ALEPAY'])) {
    $func->transfer_api('Cấu hình thanh toán Momo không thành công.', $configBase , false);
}
function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
}
$endpoint = $momo_endpoint2;
$partnerCode = $momo_partner;
$accessKey = $momo_access;
$serectkey = $momo_secret;
$orderInfo = 'Thanh toan don hang qua cong Momo. Ma hoa don ' . $data_donhang['code'] . ' tri gia ' . $data_donhang['total_price'] . 'VND';
$amount = $data_donhang['total_price'];
$orderId = $data_donhang['code'];
$redirectUrl = URL_CALLBACK;
$ipnUrl = URL_WEBHOOK;
$extraData = "";
$requestId = time() . "";
$requestType = "captureWallet";
$extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
// before sign HMAC SHA256 signature
$rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
$signature = hash_hmac("sha256", $rawHash, $serectkey);
$data = array('partnerCode' => $partnerCode,
    'partnerName' => "Test",
    "storeId" => "MomoTestStore",
    'requestId' => $requestId,
    'amount' => $amount,
    'orderId' => $orderId,
    'orderInfo' => $orderInfo,
    'redirectUrl' => $redirectUrl,
    'ipnUrl' => $ipnUrl,
    'lang' => 'vi',
    'extraData' => $extraData,
    'requestType' => $requestType,
    'signature' => $signature);
$result = execPostRequest($endpoint, json_encode($data));
$jsonResult = json_decode($result, true);  // decode json

// Just a example, please check more in there
header('Location: ' . $jsonResult['payUrl']);