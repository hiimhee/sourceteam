<?php
	session_start();
	define('LIBRARIES', './libraries/');
	define('SOURCES', './sources/');
	define('LAYOUT', 'layout/');
	define('THUMBS', 'thumbs');
	define('WATERMARK', 'watermark');
	/* Config */
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
	/* Newsletter */
	if (isset($_POST['submit-newsletter'])) {
	    $responseCaptcha = $_POST['recaptcha_response_newsletter'];
	    $resultCaptcha = $func->checkRecaptcha($responseCaptcha);
	    $scoreCaptcha = (!empty($resultCaptcha['score'])) ? $resultCaptcha['score'] : 0;
	    $actionCaptcha = (!empty($resultCaptcha['action'])) ? $resultCaptcha['action'] : '';
	    $testCaptcha = (!empty($resultCaptcha['test'])) ? $resultCaptcha['test'] : false;
	    $dataNewsletter = (!empty($_POST['dataNewsletter'])) ? $_POST['dataNewsletter'] : null;
	    /* Valid data */
	    if (empty($dataNewsletter['email'])) {
	        $flash->set('error', 'Email không được trống');
	    }
	    if (!empty($dataNewsletter['email']) && !$func->isEmail($dataNewsletter['email'])) {
	        $flash->set('error', 'Email không hợp lệ');
	    }
	    $error = $flash->get('error');
	    if (!empty($error)) {
	        $func->transfer($error, $configBase, false);
	    }
	    /* Save data */
	    if (($scoreCaptcha >= 0.5 && $actionCaptcha == 'Newsletter') || $testCaptcha == true) {
	        $data = array();
	        $data['email'] = htmlspecialchars($dataNewsletter['email']);
	        $data['date_created'] = time();
	        $data['type'] = 'dangkynhantin';
	        if ($d->insert('newsletter', $data)) {
	            $func->transfer("Đăng ký nhận tin thành công. Chúng tôi sẽ liên hệ với bạn sớm.", $configBase);
	        } else {
	            $func->transfer("Đăng ký nhận tin thất bại. Vui lòng thử lại sau.", $configBase, false);
	        }
	    } else {
	        $func->transfer("Đăng ký nhận tin thất bại. Vui lòng thử lại sau.", $configBase, false);
	    }
	}
?>
<!DOCTYPE HTML><html><head><meta charset="UTF-8"><title>Comingsoon</title><meta name="robots" content="noindex,nofollow"><meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"><meta http-equiv="X-UA-Compatible" content="IE=edge"><link href="assets/coming/css/style.css" rel="stylesheet" type="text/css" media="all"><script src="assets/js/jquery.min.js?v=<?=time()?>"></script><script>$(document).on("click","a.kuTaGy.zKbzSQ.wixui-button__label.custom",function(n){n.preventDefault(),$("#POPUP_CONTAINER").fadeIn()}),$(document).on("click","div#comp-iw0k2lds",function(n){n.preventDefault(),$("#POPUP_CONTAINER").fadeOut()})</script></head><body><div id="POPUP_CONTAINER"><div id="comp-iw0k2lds" class="lNTcDh comp-iw0k2lds wixui-lightbox__close-button" data-testid="popupCloseIconButtonRoot"><div tabindex="0" role="button" title="Back to site" aria-label="Back to site" class="UFLd32"><svg preserveAspectRatio="xMidYMid meet" data-bbox="29.6 26 148 148" xmlns="http://www.w3.org/2000/svg" viewBox="29.6 26 148 148" role="presentation" aria-hidden="true"><g><path d="M177.6 147.3L130.3 100l47.3-47.3L150.9 26l-47.3 47.3L56.3 26 29.6 52.7 76.9 100l-47.3 47.3L56.3 174l47.3-47.3 47.3 47.3 26.7-26.7z"></path></g></svg></div></div><form action="" method="post" autocomplete="off" enctype="multipart/form-data"><section><h2 class="font_4" style="line-height:1.1em;text-align:center;font-size:34px"><span style="letter-spacing:.2em">ĐĂNG KÝ NGAY!</span></h2><p class="font_8" style="line-height:1.4em;text-align:center;font-size:15px"><span style="letter-spacing:normal">để nhận thông tin khi chúng tôi ra mắt trang web mới:</span></p><input id="input_comp-jtws8shs" name="dataNewsletter[email]" class="KvoMHf has-custom-focus wixui-text-input__input" type="email" placeholder="Nhập email của bạn ở đây*" required="" aria-required="true" pattern="^.+@.+\.[a-zA-Z]{2,63}$" maxlength="250" aria-label="Nhập email của bạn ở đây*" value=""><div class="comp-jtws8shw wixui-button R6ex7N" id="comp-jtws8shw" aria-disabled="false"><button type="submit" name="submit-newsletter" aria-disabled="false" data-testid="buttonElement" class="kuTaGy zKbzSQ wixui-button__label"><span class="M3I7Z2">Đăng ký ngay</span></button></div></section></form></div><div id="SITE_CONTAINER"><div id="main_MF" class="main_MF"><div id="BACKGROUND_GROUP" class="BACKGROUND_GROUP"><div id="BACKGROUND_GROUP_TRANSITION_GROUP"><div id="pageBackground_c1dmp" data-media-height-override-type="" data-media-position-override="false" class="pageBackground_c1dmp BmZ5pC"><div id="bgLayers_pageBackground_c1dmp" data-hook="bgLayers" class="MW5IWV"><div data-testid="colorUnderlay" class="LWbAav Kv1aVt"></div><div id="bgMedia_pageBackground_c1dmp" class="VgO9Yg"><wix-bg-image id="bgImg_pageBackground_c1dmp" class="Kv1aVt dLPlxY mNGsUM bgImage" style="background-image:url(assets/coming/images/45d10e_8b6ac011530347fbbb1ed0d0d1d4fb24_mv2.png);background-size:auto;background-repeat:repeat;background-position:center top;transform:translate3d(0,0,0)"></wix-bg-image></div></div></div></div></div><div id="site-root" class="site-root"><div id="masterPage" class="mesh-layout masterPage"><main id="PAGES_CONTAINER" class="PAGES_CONTAINER" tabindex="-1" data-main-content="true"><div id="SITE_PAGES" class="JshATs SITE_PAGES"><div id="SITE_PAGES_TRANSITION_GROUP" class="fcNEqv"><div id="c1dmp" class="dBAkHi c1dmp wixui-page"><div class="HT5ybB"><div id="Containerc1dmp" class="Containerc1dmp SPY_vo"><div data-mesh-id="Containerc1dmpinlineContent" data-testid="inline-content" class=""><div data-mesh-id="Containerc1dmpinlineContent-gridContainer" data-testid="mesh-container-content"><section id="comp-lfdhs6bt" tabindex="-1" class="Oqnisf comp-lfdhs6bt wixui-section"><div data-mesh-id="comp-lfdhs6btinlineContent" data-testid="inline-content" class=""><div data-mesh-id="comp-lfdhs6btinlineContent-gridContainer" data-testid="mesh-container-content"><div id="comp-iwomwwtm" class="MazNVa comp-iwomwwtm wixui-image"><div data-testid="linkElement" class="j7pOnl"><wow-image id="img_comp-iwomwwtm" class="HlRz5e BI8PVQ" data-image-info='{"containerId":"comp-iwomwwtm","displayMode":"full","targetWidth":69,"targetHeight":65,"isLQIP":false,"imageData":{"width":400,"height":400,"uri":"45d10e_cbb051ec97bc4427a44a66d0f9a8147e_mv2.gif","name":"","displayMode":"full"}}' data-bg-effect-name="" data-has-ssr-src="" style="--wix-img-max-width:max(400px, 100%)" data-src="assets/coming/images/45d10e_cbb051ec97bc4427a44a66d0f9a8147e_mv2.gif"><img src="assets/coming/images/45d10e_cbb051ec97bc4427a44a66d0f9a8147e_mv2.gif" alt="" style="width:69px;height:65px;object-fit:contain;object-position:center center" fetchpriority="high"></wow-image></div></div><div id="comp-iwomrt0e" class="MazNVa comp-iwomrt0e wixui-image"><div data-testid="linkElement" class="j7pOnl"><wow-image id="img_comp-iwomrt0e" class="HlRz5e BI8PVQ" data-image-info='{"containerId":"comp-iwomrt0e","displayMode":"full","targetWidth":68,"targetHeight":63,"isLQIP":false,"imageData":{"width":400,"height":400,"uri":"45d10e_74dd03e6ebde46ad8d20a9c8b222f870_mv2.gif","name":"","displayMode":"full"}}' data-bg-effect-name="" data-has-ssr-src="" style="--wix-img-max-width:max(400px, 100%)" data-src="assets/coming/images/45d10e_74dd03e6ebde46ad8d20a9c8b222f870_mv2.gif"><img src="assets/coming/images/45d10e_74dd03e6ebde46ad8d20a9c8b222f870_mv2.gif" alt="" style="width:68px;height:63px;object-fit:contain;object-position:center center" fetchpriority="high"></wow-image></div></div><div id="comp-iu2jv6bz" class="KcpHeO tz5f0K comp-iu2jv6bz wixui-text" data-testid="richTextElement"><h1 class="font_0" style="line-height:1.3em;text-align:center;font-size:95px"><span style="letter-spacing:normal">SẮP<br>RA MẮT</span></h1></div><div id="comp-iu2kmn72" class="KcpHeO tz5f0K comp-iu2kmn72 wixui-text" data-testid="richTextElement"><h6 class="font_6" style="line-height:1.6em;text-align:center;font-size:24px"><span style="letter-spacing:.1em">Chúng tôi sẽ sớm<br>ra mắt trang web hoàn toàn mới!</span></h6></div><div class="comp-iu2kym86 wixui-button R6ex7N" id="comp-iu2kym86" aria-disabled="false"><a rel="nofollow" href="index.php" data-testid="linkElement" data-popupid="dta5d" target="_self" role="button" class="kuTaGy zKbzSQ wixui-button__label" aria-disabled="false" tabindex="0"><span class="M3I7Z2">Xem trang chủ</span></a><a rel="nofollow" role="button" data-testid="linkElement" data-popupid="dta5d" target="_self" role="button" class="kuTaGy zKbzSQ wixui-button__label custom" aria-disabled="false" tabindex="0"><span class="M3I7Z2">Báo cho tôi!</span></a></div><div id="comp-iwomzupb" class="MazNVa comp-iwomzupb wixui-image"><div data-testid="linkElement" class="j7pOnl"><wow-image id="img_comp-iwomzupb" class="HlRz5e BI8PVQ" data-image-info='{"containerId":"comp-iwomzupb","displayMode":"full","targetWidth":68,"targetHeight":65,"isLQIP":false,"imageData":{"width":400,"height":400,"uri":"45d10e_2e61ebde4b4b4fa2b9f09e10add2698d_mv2.gif","name":"","displayMode":"full"}}' data-bg-effect-name="" data-has-ssr-src="" style="--wix-img-max-width:max(400px, 100%)" data-src="assets/coming/images/45d10e_2e61ebde4b4b4fa2b9f09e10add2698d_mv2.gif"><img src="assets/coming/images/45d10e_2e61ebde4b4b4fa2b9f09e10add2698d_mv2.gif" alt="" style="width:68px;height:65px;object-fit:contain;object-position:center center" fetchpriority="high"></wow-image></div></div><div id="comp-iwomn5ul" class="MazNVa comp-iwomn5ul wixui-image"><div data-testid="linkElement" class="j7pOnl"><wow-image id="img_comp-iwomn5ul" class="HlRz5e BI8PVQ" data-image-info='{"containerId":"comp-iwomn5ul","displayMode":"full","targetWidth":70,"targetHeight":68,"isLQIP":false,"imageData":{"width":400,"height":400,"uri":"45d10e_9c2e49ec2160415e9d13d5dd1c0a31f9_mv2.gif","name":"","displayMode":"full"}}' data-bg-effect-name="" data-has-ssr-src="" style="--wix-img-max-width:max(400px, 100%)" data-src="assets/coming/images/45d10e_9c2e49ec2160415e9d13d5dd1c0a31f9_mv2.gif"><img src="assets/coming/images/45d10e_9c2e49ec2160415e9d13d5dd1c0a31f9_mv2.gif" alt="" style="width:70px;height:68px;object-fit:contain;object-position:center center" fetchpriority="high"></wow-image></div></div></div></div></section></div></div></div></div></div></div></div></main><footer class="SITE_FOOTER_WRAPPER" tabindex="-1" id="SITE_FOOTER_WRAPPER"><div id="SITE_FOOTER" class="xU8fqS SITE_FOOTER wixui-footer" tabindex="-1"><div class="_C0cVf"><div class="_4XcTfy" data-testid="screenWidthContainerBg"></div></div><div class="U4Bvut"><div class="G5K6X8"><div class="gUbusX" data-testid="screenWidthContainerBgCenter"></div></div><div class="CJF7A2"><div data-mesh-id="SITE_FOOTERinlineContent" data-testid="inline-content" class=""><div data-mesh-id="SITE_FOOTERinlineContent-gridContainer" data-testid="mesh-container-content"><div id="comp-l2puvdws" class="KcpHeO tz5f0K comp-l2puvdws wixui-text" data-testid="richTextElement"><p class="font_8" style="line-height:normal;text-align:center;font-size:15px"><span style="letter-spacing:.05em">© <?=date('Y')?> bản quyền của Sắp ra mắt.</span></p></div></div></div></div></div></div></footer></div></div></div></div></body></html>