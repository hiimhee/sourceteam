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
  require "zalopay/helper.php";
  require "repository/order_repository.php";
  $order = NULL;
  $error = NULL;
  $dataZaloPay['description'] = 'Thanh toan don hang qua cong ZaloPay. Ma hoa don ' . $data_donhang['code'] . ' tri gia ' . $data_donhang['total_price'] . 'VND';
  $dataZaloPay['amount'] = $data_donhang['total_price'];
  if ($dataZaloPay) {
    $amount = (int)$dataZaloPay['amount'];
    if ($amount < 1000) {
      $func->transfer_api('Số tiền không hợp lệ', $configBase . 'gio-hang', false);
    } else {
      $orderData = ZaloPayHelper::newCreateOrderData($dataZaloPay);
      $order = ZaloPayHelper::createOrder($orderData);
      if ($order["returncode"] === 1) {
        return header('Location: ' . $order["orderurl"]);
        exit();
      } else {
        $func->transfer_api('Tạo đơn hàng thất bại', $configBase . 'gio-hang', false);
      }
    }
  }