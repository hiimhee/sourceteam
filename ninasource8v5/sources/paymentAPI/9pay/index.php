<?php
    session_start();
    @define ( 'LIBRARIES' , '../../../libraries/');
    require_once LIBRARIES . "config.php";
    require_once LIBRARIES . "config-type.php";
    require_once LIBRARIES . 'autoload.php';
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
    require_once('lib/HMACSignature.php');
    require_once('lib/MessageBuilder.php');
    require_once('config.php');

    $invoiceNo = $data_donhang['code'];
    $amount = $data_donhang['total_price'];
    $description = 'Thanh toan don hang qua cong 9Pay. Ma hoa don ' . $data_donhang['code'] . ' tri gia ' . $data_donhang['total_price'] . 'VND';
    if (1) {
        $http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://';
        $backUrl = URL_DEMO;
        $returnUrl = URL_CALLBACK;
        $time = time();
        $data = array(
            'merchantKey' => MERCHANT_KEY,           
            'time' => $time,
            'invoice_no' => $invoiceNo,
            'amount' => $amount,
            'description' => $description,
            'back_url' => $backUrl,
            'return_url' => $returnUrl,
        );
        $message = MessageBuilder::instance()
            ->with($time, END_POINT . '/payments/create', 'POST')
            ->withParams($data)
            ->build();
        $hmacs = new HMACSignature();
        $signature = $hmacs->sign($message, MERCHANT_SECRET_KEY);
        $httpData = [
            'baseEncode' => base64_encode(json_encode($data, JSON_UNESCAPED_UNICODE)),
            'signature' => $signature,
        ];
        $redirectUrl = END_POINT . '/portal?' . http_build_query($httpData);
        return header('Location: ' . $redirectUrl);
        exit();
    }