<?php
    session_start();
    @define ( 'LIBRARIES' , '../../../libraries/');
    require_once LIBRARIES . "config.php";
    require_once LIBRARIES . "config-type.php";
    require_once LIBRARIES . 'autoload.php';
    require_once('config.php');
    require_once('Lib/Alepay.php');
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
    $alepay = new Alepay($configAlepay);
    $data = array();
    parse_str(file_get_contents('php://input'), $params); // Lấy thông tin dữ liệu bắn vào
    $data['cancelUrl'] = URL_DEMO;
    $data['amount'] = intval($data_donhang['total_price']);
    $data['orderCode'] = $data_donhang['code'] . '_' . uniqid();
    $data['currency'] = 'VND';
    $data['orderDescription'] = 'Thanh toan don hang ' . $data['orderCode'] . ' tri gia ' . $data['amount'] . $data['currency'];
    $data['totalItem'] = 1;
    $data['checkoutType'] = 3;
    $data['allowDomestic'] = true;
    $data['buyerName'] = trim($data_donhang['fullname']);
    $data['buyerEmail'] = trim($data_donhang['email']);
    $data['buyerPhone'] = trim($data_donhang['phone']);
    $data['buyerAddress'] = trim($data_donhang['address']);
    $data['buyerCity'] = 'Thành Phố Hồ Chí Minh';
    $data['buyerCountry'] = 'Việt Nam';
    // $data['month'] = 3; Thông tin chu kỳ trả góp : 3,6,9,12,24 tháng
    $data['paymentHours'] = 48; // 48 tiếng :  Thời gian cho phép thanh toán (tính bằng giờ)
    foreach ($data as $k => $v) {
        if (empty($v)) {
            /* Errors */
            $response['messages'][] = 'Bắt buộc phải nhập/chọn tham số. Vui lòng thử lại sau.';
            $response['status'] = 'danger';
            $message = base64_encode(json_encode($response));
            $flash->set("message", $message);
            $func->redirect($configBase . "gio-hang");
            // $alepay->return_json("NOK", "Bắt buộc phải nhập/chọn tham số [ " . $k . " ]");
            // die();
        }
    }
    //$baseUrlV3 = 'https://alepay-v3-sandbox.nganluong.vn/api/v3/checkout/';
    $result = $alepay->sendOrderV3($data);
    if (!empty($result->code)) {
        if ($result->code == '000') {
            echo '<meta http-equiv="refresh" content="0;url=' . $result->checkoutUrl . '">'; die;
        } else {
            /* Errors */
            $response['messages'][] = $result->message;
            $response['status'] = 'danger';
            $message = base64_encode(json_encode($response));
            $flash->set("message", $message);
            $func->redirect($configBase . "gio-hang");
        }
    }