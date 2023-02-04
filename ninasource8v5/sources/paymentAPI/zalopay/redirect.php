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
$lang = 'vi';
require_once "utils/json.php";
require_once "repository/order_repository.php";
require_once "zalopay/helper.php";
$data = $_GET;
# Kiểm tra xem redirect có hợp lệ hay không
$isValidRedirect = ZaloPayHelper::verifyRedirect($data);
if ($isValidRedirect) {
  /* Ship */
    if (!empty($config['order']['ship'])) {
        $ship_data = (!empty($data_donhang['ward'])) ? $func->getInfoDetail('ship_price', "ward", $data_donhang['ward']) : array();
        $ship_price = (!empty($ship_data['ship_price'])) ? $ship_data['ship_price'] : 0;
    } else {
        $ship_price = 0;
    }
    $temp_price = $cart->getOrderTotal();
    if(!empty($ship_price)) {
        $total_price = (!empty($ship_price)) ? $cart->getOrderTotal() + $ship_price : $cart->getOrderTotal();
    } else {
        if($endowType==1){
            $tiengiam = (($temp_price * $endow) / 100);
            $total_price = (!empty($ship_price)) ? $cart->getOrderTotal($type) + $ship_price - $tiengiam : $cart->getOrderTotal($type) - $tiengiam;
        }else{
            $total_price = (!empty($ship_price)) ? $cart->getOrderTotal($type) + $ship_price - $endow : $cart->getOrderTotal($type) - $endow;
        }
    }
    /* Details order */
    $max = count($_SESSION['cart']);
    for ($i = 0; $i < $max; $i++) {
      $pid = $_SESSION['cart'][$i]['productid'];
      $q = $_SESSION['cart'][$i]['qty'];
      $color = $_SESSION['cart'][$i]['color'];
      $size = $_SESSION['cart'][$i]['size'];
      $gia = ($_SESSION['cart'][$i]['gia'])?$_SESSION['cart'][$i]['gia']:0;
      $photo = ($_SESSION['cart'][$i]['photo'])?$_SESSION['cart'][$i]['photo']:0;
      $code_order = $_SESSION['cart'][$i]['code'];
      $proinfo = $cart->getProductInfo($pid);
      if($photo>0) {
          $proinfo['photo'] = $photo;
      }
      if($gia>0) {
          $proinfo['regular_price'] = $gia;
          $proinfo['sale_price'] = $gia;
      }
      $text_color = $cart->getProductColor($color);
      $text_size = $cart->getProductSize($size);
      $text_attr = '';
      if ($text_color != '' && $text_size != '') $text_attr = $text_color . " - " . $text_size;
      else if ($text_color != '') $text_attr = $text_color;
      else if ($text_size != '') $text_attr = $text_size;
      if ($q == 0) continue;
      /* Variables detail order */
      $orderDetailVars = array(
          '{productName}',
          '{productAttr}',
          '{productSalePrice}',
          '{productRegularPrice}',
          '{productQuantity}',
          '{productSaleTotalPrice}',
          '{productRegularTotalPrice}'
      );
      /* Values detail order */
      $orderDetailVals = array(
          $proinfo['name' . $lang],
          $text_attr,
          $func->formatMoney($proinfo['sale_price']),
          $func->formatMoney($proinfo['regular_price']),
          $q,
          $func->formatMoney($proinfo['sale_price'] * $q),
          $func->formatMoney($proinfo['regular_price'] * $q)
      );
      /* Get order details */
      $order_detail .= str_replace($orderDetailVars, $orderDetailVals, $emailer->markdown('order/details', ['productAttr' => $text_attr, 'salePrice' => $proinfo['sale_price']]));
  }
  $status = 0;
  $payment = [];
  if (isset($_GET['result'])) {
      $result = base64_decode($_GET['result']);
      $payment = json_decode($result);
      $status = $payment->status;
  }
  $statusLabel = statusLabel($status);
  if(isset($status) and $status == 5) {
    /* Total order */
    /* Variables total order */
    $orderTotalVars = array(
        '{orderTempPrice}',
        '{orderShipPrice}',
        '{orderTotalPrice}'
    );
    /* Values total order */
    $orderTotalVals = array(
        $func->formatMoney($temp_price),
        $func->formatMoney($ship_price),
        $func->formatMoney($total_price)
    );
    /* Get total order */
    $order_detail .= str_replace($orderTotalVars, $orderTotalVals, $emailer->markdown('order/total', ['shipPrice' => $ship_price]));
    /* lưu đơn hàng */
    $data_donhang['order_payment'] = 1003; // Phương thức ZaloPay
    $id_insert = $d->insert('order', $data_donhang);
    /* lưu đơn hàng chi tiết */
    if ($id_insert) {
      for ($i = 0; $i < $max; $i++) {
        $pid = $_SESSION['cart'][$i]['productid'];
        $q = $_SESSION['cart'][$i]['qty'];
        $gia = ($_SESSION['cart'][$i]['gia'])?$_SESSION['cart'][$i]['gia']:0;
        $photo = ($_SESSION['cart'][$i]['photo'])?$_SESSION['cart'][$i]['photo']:0;
        $proinfo = $cart->getProductInfo($pid);
        if($photo>0) {
            $proinfo['photo'] = $photo;
        }
        if($gia>0) {
            $proinfo['regular_price'] = $gia;
            $proinfo['sale_price'] = $gia;
        }
        $regular_price = $proinfo['regular_price'];
        $sale_price = $proinfo['sale_price'];
        $color = $cart->getProductColor($_SESSION['cart'][$i]['color']);
        $size = $cart->getProductSize($_SESSION['cart'][$i]['size']);
        $code_order = $_SESSION['cart'][$i]['code'];
        if ($q == 0) continue;
        $data_donhangchitiet = array();
        $data_donhangchitiet['id_product'] = $pid;
        $data_donhangchitiet['id_order'] = $id_insert;
        $data_donhangchitiet['photo'] = $proinfo['photo'];
        $data_donhangchitiet['name'] = $proinfo['name' . $lang];
        $data_donhangchitiet['code'] = $code;
        $data_donhangchitiet['color'] = $color;
        $data_donhangchitiet['size'] = $size;
        $data_donhangchitiet['regular_price'] = $regular_price;
        $data_donhangchitiet['sale_price'] = $sale_price;
        $data_donhangchitiet['quantity'] = $q;
        $d->insert('order_detail', $data_donhangchitiet);
      }
    }
    /* Defaults attributes email */
    $emailDefaultAttrs = $emailer->defaultAttrs();
    /* Variables email */
    $emailVars = array(
        '{emailOrderCode}',
        '{emailOrderInfoFullname}',
        '{emailOrderInfoEmail}',
        '{emailOrderInfoPhone}',
        '{emailOrderInfoAddress}',
        '{emailOrderPayment}',
        '{emailOrderShipPrice}',
        '{emailOrderInfoRequirements}',
        '{emailOrderDetails}'
    );
    $emailVars = $emailer->addAttrs($emailVars, $emailDefaultAttrs['vars']);
    /* Values email */
    $emailVals = array(
        $code,
        $fullname,
        $email,
        $phone,
        $address,
        $order_payment_text,
        $ship_price,
        $requirements,
        $order_detail
    );
    $emailVals = $emailer->addAttrs($emailVals, $emailDefaultAttrs['vals']);
    /* Send email admin */
    $arrayEmail = null;
    $subject = "Thông tin đơn hàng từ " . $setting['name' . $lang];
    $message = str_replace($emailVars, $emailVals, $emailer->markdown('order/admin', ['shipPrice' => $ship_price]));
    $file = '';
    // $emailer->send("admin", $arrayEmail, $subject, $message, $file);
    /* Send email customer */
    $arrayEmail = array(
        "dataEmail" => array(
            "name" => $fullname,
            "email" => $email
        )
    );
    $subject = "Thông tin đơn hàng từ " . $setting['name' . $lang];
    $message = str_replace($emailVars, $emailVals, $emailer->markdown('order/customer', ['shipPrice' => $ship_price]));
    $file = '';
    // $emailer->send("customer", $arrayEmail, $subject, $message, $file);
    /* Xóa giỏ hàng */
    unset($_SESSION['cart']);
    unset($_SESSION['ALEPAY']);
    unset($data_donhang);
    $func->transfer_api("Thông tin đơn hàng đã được gửi thành công.", $configBase);
  }
  else {
      $func->transfer_api('Thanh toán không thành công. Vui lòng thử lại sau ít phút.', $configBase, false);
  }
  exit;
}
else {
      $func->transfer_api('Thanh toán không thành công. Vui lòng thử lại sau ít phút.', $configBase, false);
  }