<!-- Sản phẩm nổi bật -->
<div class="wrap-product wrap-content">
    <div class="title-main"><span>Sản phẩm nổi bật</span></div>
    <div class="page_noibat"></div>
</div>
<!-- Sản phẩm theo danh mục -->
<?php foreach ($splistmenu as $k => $v) { ?>
<div class="wrap-product wrap-content">
    <div class="title-main"><span><?=$v['name'.$lang]?></span></div>
    <div class="page_danhmuc page_danhmuc<?=$v['id']?>"></div>
</div>
<?php } ?>
<!-- Sản phẩm theo danh mục -->
<div class="wrap-product wrap-content">
    <div class="list_monnb list_sanpham mb-3 text-center text-2xl">
        <a class="font-weight-bold mx-2" role="button" data-id="0">Tất cả</a>
        <?php foreach ($splistmenu as $k => $v) { ?>
        <a class="font-weight-bold mx-2" role="button" data-id="<?=$v['id']?>"><?=$v['name'.$lang]?></a>
        <?php } ?>
    </div>
    <div class="page_sanpham"></div>
</div>
<!-- Sản phẩm theo tab cố định -->
<div class="wrap-product wrap-content">
    <div class="list_monnb list_tab mb-3 text-center text-2xl">
        <a class="font-weight-bold mx-2" data-id="find_in_set('noibat',status)">Nổi bật</a>
        <a class="font-weight-bold mx-2" data-id="find_in_set('moi',status)">Mới</a>
        <a class="font-weight-bold mx-2" data-id="find_in_set('banchay',status)">Bán chạy</a>
    </div>
    <div class="page_tabloai"></div>
</div>
<!-- Sản phẩm theo danh mục cấp 1 & 2 -->
<?php foreach ($splistmenu as $key => $value) {
    $spcatmenu = $d->rawQuery("select name$lang, slugvi, id from #_product_cat where type = ? and find_in_set('hienthi',status) and id_list = ? order by numb,id desc",array('san-pham', $value['id']));
?>
<div class="wrap-product wrap-content">
    <div class="d-flex align-items-center mb-3">
        <div class="title-main m-0"><span><?=$value['name'.$lang]?></span></div>        
        <a class="text-dark ml-auto" href="<?=$value[$sluglang]?>">
            Xem tất cả 
            <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.19751 10.62L5.00084 6.81667C5.45001 6.3675 5.45001 5.6325 5.00084 5.18334L1.19751 1.38" stroke="#4A4A4A" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
    </div>
    <div class="list_monnb banchay_list list_<?=$value['id']?> ml-3">
        <a class="mr-2 font-weight-bold" data-id="0">Tất cả</a>
        <?php foreach ($spcatmenu as $key2 => $value2) { ?>
        <a class="mr-2 font-weight-bold" data-id="<?=$value2['id']?>"><?=$value2['name'.$lang]?></a>
        <?php } ?>
    </div>
    <div class="page_danhmuc page_danhmuc_list<?=$value['id']?>"></div>
    <div class="clear"></div>
</div>
<?php } ?>
<!-- Sản phẩm nổi bật xem thêm -->
<div class="wrap-product wrap-content">
    <div class="title-main"><span>Sản phẩm nổi bật xem thêm</span></div>
    <div class="page_noibat_more"></div>
</div>
<!-- Sản phẩm theo danh mục xem thêm -->
<?php foreach ($splistmenu as $k => $v) { ?>
<div class="wrap-product wrap-content">
    <div class="title-main"><span><?=$v['name'.$lang]?></span></div>
    <div class="page_danhmuc_more<?=$v['id']?>"></div>
</div>
<?php } ?>
<!-- Sản phẩm theo tab danh mục xem thêm -->
<div class="wrap-product wrap-content">
    <div class="list_monnb list_sanpham_more mb-3 text-center text-2xl">
        <a class="font-weight-bold mx-2" role="button" data-id="0">Tất cả</a>
        <?php foreach ($splistmenu as $k => $v) { ?>
        <a class="font-weight-bold mx-2" role="button" data-id="<?=$v['id']?>"><?=$v['name'.$lang]?></a>
        <?php } ?>
    </div>
    <div class="page_sanpham_more"></div>
</div>
<!-- Sản phẩm theo tab cố định xem thêm -->
<div class="wrap-product wrap-content">
    <div class="list_monnb list_tab_more mb-3 text-center text-2xl">
        <a class="font-weight-bold mx-2" data-id="find_in_set('noibat',status)">Nổi bật</a>
        <a class="font-weight-bold mx-2" data-id="find_in_set('moi',status)">Mới</a>
        <a class="font-weight-bold mx-2" data-id="find_in_set('banchay',status)">Bán chạy</a>
    </div>
    <div class="page_tabloai_more"></div>
</div>
<!-- Sản phẩm theo danh mục cấp 1 & 2 -->
<?php foreach ($splistmenu as $key => $value) {
    $spcatmenu = $d->rawQuery("select name$lang, slugvi, id from #_product_cat where type = ? and find_in_set('hienthi',status) and id_list = ? order by numb,id desc",array('san-pham', $value['id']));
?>
<div class="wrap-product wrap-content">
    <div class="d-flex align-items-center mb-3">
        <div class="title-main m-0"><span><?=$value['name'.$lang]?></span></div>        
        <a class="text-dark ml-auto" href="<?=$value[$sluglang]?>">
            Xem tất cả 
            <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.19751 10.62L5.00084 6.81667C5.45001 6.3675 5.45001 5.6325 5.00084 5.18334L1.19751 1.38" stroke="#4A4A4A" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
    </div>
    <div class="list_monnb banchay_list list2_<?=$value['id']?> ml-3">
        <a class="mr-2 font-weight-bold" data-id="0">Tất cả</a>
        <?php foreach ($spcatmenu as $key2 => $value2) { ?>
        <a class="mr-2 font-weight-bold" data-id="<?=$value2['id']?>"><?=$value2['name'.$lang]?></a>
        <?php } ?>
    </div>
    <div class="page_danhmuc page_danhmuc_list2<?=$value['id']?>"></div>
    <div class="clear"></div>
</div>
<?php } ?>
<?php /*
<?php if (count($brand)) { ?>
    <div class="wrap-brand">
        <div class="wrap-content">
            <div class="owl-page owl-carousel owl-theme" data-items="screen:0|items:2|margin:10,screen:425|items:3|margin:10,screen:575|items:4|margin:10,screen:767|items:4|margin:10,screen:991|items:5|margin:10,screen:1199|items:7|margin:10" data-rewind="1" data-autoplay="1" data-loop="0" data-lazyload="0" data-mousedrag="1" data-touchdrag="1" data-smartspeed="500" data-autoplayspeed="3500" data-dots="0" data-nav="1" data-navcontainer=".control-brand">
                <?php foreach ($brand as $v) { ?>
                    <div>
                        <a class="brand text-decoration-none" href="<?= $v[$sluglang] ?>" title="<?= $v['name' . $lang] ?>">
                            <?= $func->getImage(['class' => 'lazy w-100', 'sizes' => '150x150x2', 'upload' => UPLOAD_PRODUCT_L, 'image' => $v['photo'], 'alt' => $v['name' . $lang]]) ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="control-brand control-owl transition"></div>
        </div>
    </div>
<?php } ?>
*/ ?>
<?php /*
<?php if (count($splistnb)) {
    foreach ($splistnb as $vlist) { ?>
        <div class="wrap-product wrap-content">
            <div class="title-main"><span><?= $vlist['name' . $lang] ?></span></div>
            <div class="paging-product-category paging-product-category-<?= $vlist['id'] ?>" data-list="<?= $vlist['id'] ?>"></div>
        </div>
<?php }
} ?>
*/ ?>
<?php if(count($newsnb) || count($videonb)) { ?>
<div class="box-tintuc-video">
    <div class="wap_1200">
        <div class="wap-tin-video">
            <div class="left-intro">
                <p class="title-intro"><span>Tin tức mới</span></p>
                <div class="newshome-intro w-clear">                
                    <a class="newshome-best text-decoration-none" href="<?=$newsnb[0][$sluglang]?>" title="<?=$newsnb[0]['name'.$lang]?>">
                        <p class="pic-newshome-best scale-img"><img onerror="this.src='<?=THUMBS?>/360x200x2/assets/images/noimage.png';" src="<?=THUMBS?>/360x200x1/<?=UPLOAD_NEWS_L.$newsnb[0]['photo']?>" alt="<?=$newsnb[0]['name'.$lang]?>" width="360" height="200"></p>
                        <h3 class="name-newshome text-split"><?=$newsnb[0]['name'.$lang]?></h3>
                        <p class="time-newshome">Ngày đăng: <?=date("d/m/Y",$newsnb[0]['date_created'])?></p>
                        <p class="desc-newshome text-split"><?=$newsnb[0]['desc'.$lang]?></p>
                        <span class="view-newshome transition"><?=xemthem?></span>
                        <?php // $optchinhanh = (isset($newsnb[0]['options']) && $newsnb[0]['options'] != '') ? json_decode($newsnb[0]['options'],true) : null;
                        //echo $optchinhanh["chucvu"]; ?>
                    </a>
                    <div class="newshome-scroll">
                        <div class="chay-tintuc-vertical">
                            <?php foreach($newsnb as $v) {?>                                
                                <a class="newshome-normal text-decoration-none w-clear" href="<?=$v[$sluglang]?>" title="<?=$v['name'.$lang]?>">
                                    <p class="pic-newshome-normal scale-img"><img onerror="this.src='<?=THUMBS?>/150x120x2/assets/images/noimage.png';" src="<?=THUMBS?>/150x120x1/<?=UPLOAD_NEWS_L.$v['photo']?>" alt="<?=$v['name'.$lang]?>" width="150" height="120"></p>
                                    <div class="info-newshome-normal">
                                        <h3 class="name-newshome text-split"><?=$v['name'.$lang]?></h3>
                                        <?php /*
                                        <p class="time-newshome"><?=ngaydang?>: <?=date("d/m/Y",$v['date_created'])?></p>
                                        */ ?>
                                        <p class="desc-newshome text-split"><?=$v['desc'.$lang]?></p>
                                    </div>
                                </a>                                
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-intro">
                <p class="title-intro"><span>Video clip</span></p>
                <div class="videohome-intro">
                    <?php /*echo $addons->set('video-fotorama', 'video-fotorama', 4);*/ ?>                    
                    <?php /*echo $addons->set('video-slick', 'video-slick', 4);*/ ?>
                    <?php /*echo $addons->set('video-img-slick', 'video-img-slick', 4);*/ ?>
                    <?php echo $addons->set('video-select', 'video-select', 4);  ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php /*
<?php if (count($partner)) { ?>
    <div class="wrap-partner">
        <div class="wrap-content">
            <div class="owl-page owl-carousel owl-theme" data-items="screen:0|items:2|margin:10,screen:425|items:3|margin:10,screen:575|items:4|margin:10,screen:767|items:4|margin:10,screen:991|items:5|margin:10,screen:1199|items:7|margin:10" data-rewind="1" data-autoplay="1" data-loop="0" data-lazyload="0" data-mousedrag="1" data-touchdrag="1" data-smartspeed="300" data-autoplayspeed="500" data-autoplaytimeout="3500" data-dots="0" data-nav="1" data-navcontainer=".control-partner">
                <?php foreach ($partner as $v) { ?>
                    <div>
                        <a class="partner" href="<?= $v['link'] ?>" target="_blank" title="<?= $v['name' . $lang] ?>">
                            <?= $func->getImage(['class' => 'lazy w-100', 'sizes' => '150x120x2', 'upload' => UPLOAD_PHOTO_L, 'image' => $v['photo'], 'alt' => $v['name' . $lang]]) ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="control-partner control-owl transition"></div>
        </div>
    </div>
<?php } ?>
*/ ?>
<?php /*
<div class="box-tintuc-video">
    <div class="wrap-content py-5">
        <div class="title-main"><span>Video clip - tin tức</span></div>
        <div class="wap-tin-video">
            <div class="left-intro">
                <?php if (!empty($newsnb)) { ?>
                    <div class="news-intro position-relative">
                        <span class="news-control position-absolute transition" id="up"><i class="fas fa-chevron-up"></i></span>
                        <span class="news-control position-absolute transition" id="down"><i class="fas fa-chevron-down"></i></span>
                        <div class="news-scroll position-relative">
                            <div class="chay-tintuc-vertical">
                                <?php foreach ($newsnb as $v) { ?>  
                                        <div class="news-shadow">
                                            <div class="news-item">
                                                <div class="news-shadow-time position-relative text-capitalize text-center">
                                                    <span class="d-block"><?= $func->makeDate($v['date_created']) ?></span>
                                                    <span class="d-block"><?= date("d/m/Y", $v['date_created']) ?></span>
                                                </div>
                                                <div class="news-shadow-article position-relative">
                                                    <a class="news-shadow-image rounded-circle scale-img" href="<?= $v[$sluglang] ?>" title="<?= $v['name' . $lang] ?>">
                                                        <?= $func->getImage(['class' => 'lazy w-100', 'sizes' => '90x90x1', 'upload' => UPLOAD_NEWS_L, 'image' => $v['photo'], 'alt' => $v['name' . $lang]]) ?>
                                                    </a>
                                                    <div class="news-shadow-info">
                                                        <h3 class="news-shadow-name">
                                                            <a class="text-decoration-none transition text-split" href="<?= $v[$sluglang] ?>" title="<?= $v['name' . $lang] ?>"><?= $v['name' . $lang] ?></a>
                                                        </h3>
                                                        <div class="news-shadow-desc text-split"><?= $v['desc' . $lang] ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                   
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="right-intro">
                <div class="video-intro">
                    <?php // $addons->set('video-fotorama', 'video-fotorama', 4); ?>
                </div>
            </div>
        </div>
    </div>
</div>
*/ ?>