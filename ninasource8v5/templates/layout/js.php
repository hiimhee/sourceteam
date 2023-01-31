<!-- Js Config -->
<script type="text/javascript">
    var NN_FRAMEWORK = NN_FRAMEWORK || {};
    var CONFIG_BASE = '<?= $configBase ?>';
    var JS_AUTOPLAY = <?= ($_SERVER["SERVER_NAME"]!="localhost")?'true':'false' ?>;
    var ASSET = '<?= ASSET ?>';
    var WEBSITE_NAME = '<?= (!empty($setting['name' . $lang])) ? addslashes($setting['name' . $lang]) : '' ?>';
    var TIMENOW = '<?= date("d/m/Y", time()) ?>';
    var SHIP_CART = <?= (!empty($config['order']['ship'])) ? 'true' : 'false' ?>;
    var RECAPTCHA_ACTIVE = <?= (!empty($config['googleAPI']['recaptcha']['active'])) ? 'true' : 'false' ?>;
    var RECAPTCHA_SITEKEY = '<?= $config['googleAPI']['recaptcha']['sitekey'] ?>';
    var GOTOP = ASSET + 'assets/images/top.png';
    var LANG = {
        'no_keywords': '<?= chuanhaptukhoatimkiem ?>',
        'delete_product_from_cart': '<?= banmuonxoasanphamnay ?>',
        'no_products_in_cart': '<?= khongtontaisanphamtronggiohang ?>',
        'ward': '<?= phuongxa ?>',
        'back_to_home': '<?= vetrangchu ?>',
    };
    var LIST_SAVED = '';
    var CARTSITE = '<?= (CARTSITE) ? 'true' : 'false' ?>';
</script>
<!-- Js Files -->
<?php
    $js->set("js/jquery.min.js");
    $js->set("js/lazyload.min.js");
    $js->set("js/pagingnation.js");
    $js->set("bootstrap/bootstrap.js");
    $js->set("js/wow.min.js");
    $js->set("confirm/confirm.js");
    $js->set("holdon/HoldOn.js");
    $js->set("mmenu/mmenu.js");
    //$js->set("easyticker/easy-ticker.js");
    $js->set("fotorama/fotorama.js");
    $js->set("owlcarousel2/owl.carousel.js");
    $js->set("magiczoomplus/magiczoomplus.js");
    $js->set("slick/slick.js");
    $js->set("fancybox3/jquery.fancybox.js");
    $js->set("photobox/photobox.js");
    // $js->set("simplenotify/simple-notify.js");
    // $js->set("fileuploader/jquery.fileuploader.min.js");
    //$js->set("datetimepicker/php-date-formatter.min.js");
    //$js->set("datetimepicker/jquery.mousewheel.js");
    //$js->set("datetimepicker/jquery.datetimepicker.js");
    $js->set("js/functions.js");
    $js->set("js/shiner.min.js");
    $js->set("js/placeholderTypewriter.js");
    //$js->set("js/comment.js");
    $js->set("js/apps.js");
    echo $js->get();
?>
<?php if($source=='index') { ?>
<script>
    $(document).ready(function() {
        $('.chay-tintuc-vertical').slick({
            lazyLoad: 'progressive', infinite: true, accessibility:true, vertical:true, slidesToShow: 3,  
            slidesToScroll: 1, autoplay:true,  autoplaySpeed:3000, speed:1000, arrows:true, 
            centerMode:false,  dots:false,  draggable:true,  responsive: [ 
            {  breakpoint: 800, settings: { slidesToShow: 3, slidesToScroll: 1,arrows:true ,vertical:true,} } ]
        });
    });
</script>
<!-- Demo sản phẩm nổi bật -->
<script>
    $(document).ready(function() {
        init_paging('', 'page_noibat', 4, 'product', 'san-pham', "and find_in_set('noibat',status)");
    });
</script>
<!-- Demo sản phẩm nổi bật theo từng danh mục cấp 1 -->
<?php foreach ($splistmenu as $k => $v) { ?>
<script>
    $(document).ready(function() {
        init_paging_category('<?=$v['id']?>', 'page_danhmuc<?=$v['id']?>', 4, 'product', 'san-pham', "and find_in_set('noibat',status)");
    });
</script>
<?php } ?>
<!-- Demo sản phẩm nổi bật theo tab danh mục cấp 1 -->
<script>
    $(document).ready(function() {
        $(document).on('click', '.list_sanpham a', function(event) {
            event.preventDefault();
            $(this).parent('.list_sanpham').find('a').removeClass('active');
            $(this).addClass('active');
            init_paging('list_sanpham', 'page_sanpham', 4, 'product', 'san-pham', "and find_in_set('noibat',status)");
        });
        init_paging('list_sanpham', 'page_sanpham', 4, 'product', 'san-pham', "and find_in_set('noibat',status)");
    });
</script>
<!-- Demo sản phẩm theo tab cố định -->
<script>
    $(document).ready(function() {
        $(document).on('click', '.list_tab a', function(event) {
            event.preventDefault();
            $(this).parent('.list_tab').find('a').removeClass('active');
            $(this).addClass('active');
            init_paging_loai('list_tab', 'page_tabloai', 4, 'product', 'san-pham');
        });
        init_paging_loai('list_tab', 'page_tabloai', 4, 'product', 'san-pham');
    });
</script>
<!-- Demo sản phẩm nổi bật theo từng danh mục cấp 1 & 2 -->
<?php foreach ($splistmenu as $key => $value) { ?>
<script>
    $(document).ready(function() {
        init_paging_category_list('<?=$value['id']?>', 'list_<?=$value['id']?>', 'page_danhmuc_list<?=$value['id']?>', 4, 'product', 'san-pham', "and find_in_set('noibat',status)");
    });
    $(document).on('click', '.list_<?=$value['id']?> a', function(event) {
        event.preventDefault();
        $(this).parent('.list_<?=$value['id']?>').find('a').removeClass('active');
        $(this).addClass('active');
        init_paging_category_list('<?=$value['id']?>', 'list_<?=$value['id']?>', 'page_danhmuc_list<?=$value['id']?>', 4, 'product', 'san-pham', "and find_in_set('noibat',status)");
    });
</script>
<?php } ?>
<!-- Demo sản phẩm nổi bật phân trang -->
<script>
    $(document).ready(function() {
        init_paging_more('', 'page_noibat_more', 4, 'product', 'san-pham', "and find_in_set('noibat',status)");
    });
</script>
<!-- Demo sản phẩm nổi bật theo từng danh mục cấp 1 xem thêm -->
<?php foreach ($splistmenu as $k => $v) { ?>
<script>
    $(document).ready(function() {
        init_paging_category_more('<?=$v['id']?>', 'page_danhmuc_more<?=$v['id']?>', 4, 'product', 'san-pham', "and find_in_set('noibat',status)");
    });
</script>
<?php } ?>
<!-- Demo sản phẩm nổi bật theo tab danh mục cấp 1 xem thêm -->
<script>
    $(document).ready(function() {
        $(document).on('click', '.list_sanpham_more a', function(event) {
            event.preventDefault();
            $(this).parent('.list_sanpham_more').find('a').removeClass('active');
            $(this).addClass('active');
            $('.page_sanpham_more').empty();
            init_paging_more('list_sanpham_more', 'page_sanpham_more', 4, 'product', 'san-pham', "and find_in_set('noibat',status)");
        });
        init_paging_more('list_sanpham_more', 'page_sanpham_more', 4, 'product', 'san-pham', "and find_in_set('noibat',status)");
    });
</script>
<!-- Demo sản phẩm theo tab cố định xem thêm -->
<script>
    $(document).ready(function() {
        $(document).on('click', '.list_tab_more a', function(event) {
            event.preventDefault();
            $(this).parent('.list_tab_more').find('a').removeClass('active');
            $(this).addClass('active');
            $('.page_tabloai_more').empty();
            init_paging_loai_more('list_tab_more', 'page_tabloai_more', 4, 'product', 'san-pham');
        });
        init_paging_loai_more('list_tab_more', 'page_tabloai_more', 4, 'product', 'san-pham');
    });
</script>
<?php } ?>
<?php if (!empty($config['googleAPI']['recaptcha']['active'])) { ?>
    <!-- Js Google Recaptcha V3 -->
    <script src="https://www.google.com/recaptcha/api.js?render=<?= $config['googleAPI']['recaptcha']['sitekey'] ?>"></script>
    <script type="text/javascript">
        grecaptcha.ready(function() {
            /* Newsletter */
            document.getElementById('form-newsletter').addEventListener("submit", function(event) {
                event.preventDefault();
                generateCaptcha('Newsletter', 'recaptchaResponseNewsletter', 'form-newsletter');
            }, false);
            <?php if ($source == 'contact') { ?>
                /* Contact */
                document.getElementById('form-contact').addEventListener("submit", function(event) {
                    event.preventDefault();
                    generateCaptcha('contact', 'recaptchaResponseContact', 'form-contact');
                }, false);
            <?php } ?>
        });
    </script>
<?php } ?>
<?php if (!empty($config['oneSignal']['active'])) { ?>
    <!-- Js OneSignal -->
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script type="text/javascript">
        var OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "<?= $config['oneSignal']['id'] ?>"
            });
        });
    </script>
<?php } ?>
<!-- Js Structdata -->
<?php include TEMPLATE . LAYOUT . "strucdata.php"; ?>
<!-- Js Addons -->
<?= $addons->set('script-main', 'script-main', 2); ?>
<?= $addons->get(); ?>
<!-- Js Body -->
<?= $func->decodeHtmlChars($setting['bodyjs']) ?>
<?php if(!COPYSITE) { ?>
<!-- Chống Copy -->
<script type="text/javascript">
    function clickIE() {
        if (document.all) {(message);return false;}
    }
    function clickNS(e) {
        if (document.layers||(document.getElementById&&!document.all)) {
            if (e.which==2||e.which==3) {
                return false; }
            }
        }
    if (document.layers) {
        document.captureEvents(Event.MOUSEDOWN);
        document.onmousedown=clickNS;
    } else {
        document.onmouseup=clickNS;
        document.oncontextmenu=clickIE;
        document.onselectstart=clickIE
    }
    document.oncontextmenu=new Function("return false")
</script>
<script type="text/javascript">
    function disableselect(e){
        return false
    }
    function reEnable(){
        return true
    }
    document.onselectstart=new Function ("return false")
    if (window.sidebar) {
        document.onmousedown=disableselect
        document.onclick=reEnable
    }
</script>
<script>
    $(document).keydown(function(event) {
        if(event.keyCode==123) {
            return false;
        }
        else if(event.ctrlKey && event.shiftKey && event.keyCode==73) {        
            return false;
        }
        else if(event.ctrlKey && event.keyCode==85) {        
            return false;
        }
    });
</script>
<?php } ?>
<!-- Sản phẩm yêu thích -->
<?php if(isset($_SESSION['list_saved']) and $_SESSION['list_saved']!='') { ?>
<script>
    var LIST_SAVED = <?php echo json_encode( array_column( json_decode($_SESSION['list_saved'], true), 'id' ) ) ?>;
    reloadLike(LIST_SAVED);
</script>
<?php } ?>