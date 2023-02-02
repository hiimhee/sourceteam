<div class="header">
    <div class="header-top">
        <div class="wrap-content">
            <p class="info-header"><?= $slogan['name' . $lang] ?></p>
            <p class="info-header"><i class="fas fa-envelope"></i>Email: <?= $optsetting['email'] ?></p>
            <p class="info-header"><i class="fas fa-phone-square-alt"></i>Hotline: <?= ($optsetting['hotline']) ?></p>
            <?php /*
            <ul class="social social-header list-unstyled p-0 m-0">
                <?php foreach ($social as $k => $v) { ?>
                    <li class="d-inline-block align-top mr-1">
                        <a href="<?= $v['link'] ?>" target="_blank">
                            <?= $func->getImage(['sizes' => '30x30x2', 'upload' => UPLOAD_PHOTO_L, 'image' => $v['photo'], 'alt' => $v['name' . $lang]]) ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            */ ?>
            <?php /*
            <div class="lang-header">
                <a href="ngon-ngu/vi/"><?= $func->getImage(['size-error' => '35x25x1', 'upload' => 'assets/images/', 'image' => 'vi.jpg', 'alt' => 'Tiếng Việt']) ?></a>
                <a href="ngon-ngu/en/"><?= $func->getImage(['size-error' => '35x25x1', 'upload' => 'assets/images/', 'image' => 'en.jpg', 'alt' => 'Tiếng Anh']) ?></a>
            </div>
            */ ?>
            <?php /*
            <?php if (array_key_exists($loginMember, $_SESSION) && $_SESSION[$loginMember]['active'] == true) { ?>
                <div class="user-header">
                    <a href="account/thong-tin">
                        <span>Hi, <?= $_SESSION[$loginMember]['username'] ?></span>
                    </a>
                    <a href="account/dang-xuat">
                        <i class="fas fa-sign-out-alt"></i>
                        <span><?= dangxuat ?></span>
                    </a>
                </div>
            <?php } else { ?>
                <div class="user-header">
                    <a href="account/dang-nhap">
                        <i class="fas fa-sign-in-alt"></i>
                        <span><?= dangnhap ?></span>
                    </a>
                    <a href="account/dang-ky">
                        <i class="fas fa-user-plus"></i>
                        <span><?= dangky ?></span>
                    </a>
                </div>
            <?php } ?>
            */ ?>
        </div>
    </div>
    <div class="header-bottom">
        <div class="wrap-content">
            <a class="logo-header shiner" href="">
                <?= $func->getImage(['sizes' => '250x50x2', 'upload' => UPLOAD_PHOTO_L, 'image' => $logo['photo'], 'alt' => $setting['name' . $lang]]) ?>
            </a> 
            <?php /*
            <a class="banner-header" href="">
                <?= $func->getImage(['sizes' => '530x120x2', 'upload' => UPLOAD_PHOTO_L, 'image' => $banner['photo'], 'alt' => $setting['name' . $lang]]) ?>
            </a>            
            */ ?>
            <a class="hotline-header">
                <p>Hotline hỗ trợ:</p>
                <span><?=($optsetting['hotline']) ?></span>
            </a>
            <?php /*
            <a class="email-header">
                <p>Email:</p>
                <span><?=($optsetting['email']) ?></span>
            </a>
            */ ?>
        </div>
    </div>
</div>