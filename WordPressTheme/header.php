<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="google-site-verification" content="zh9Z_2dirLeMbHCXHbXISJ7jZzmpVpwteKe6UC6qtW8" />
    <?php wp_head(); ?>
</head>
<?php
$home = esc_url(home_url('/'));
$campaign = esc_url(home_url('/campaign/'));
$about = esc_url(home_url('/about/'));
$news = esc_url(home_url('/news/'));
$event = esc_url(home_url('/event/'));
$contact = esc_url(home_url('/contact/'));
$privacy = esc_url(home_url('/privacy/'));
$terms = esc_url(home_url('/terms/'));
?>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">
                <a href="<?php echo $home; ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/logo.png"
                        alt="LumeSpace" />
                </a>
            </div>
            <button class="header__hamburger hamburger js-hamburger">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <ul class="header__nav-items">
                <li class="header__nav-item">
                    <a href="<?php echo $campaign; ?>" class="header__nav-link">
                        <span>campaign</span>キャンペーン
                    </a>
                </li>
                <li class="header__nav-item">
                    <a href="<?php echo $about; ?>" class="header__nav-link">
                        <span>about us</span>会社概要
                    </a>
                </li>
                <li class="header__nav-item">
                    <a href="<?php echo get_anchor_link('service'); ?>" class="header__nav-link">
                        <span>service</span>サービス
                    </a>
                </li>
                <li class="header__nav-item">
                    <a href="<?php echo $news; ?>" class="header__nav-link">
                        <span>news</span>お知らせ
                    </a>
                </li>
                <li class="header__nav-item">
                    <a href="<?php echo $event; ?>" class="header__nav-link">
                        <span>event</span>イベント
                    </a>
                </li>
                <li class="header__nav-item">
                    <a href="<?php echo get_anchor_link('price'); ?>" class="header__nav-link">
                        <span>price</span>料金コース
                    </a>
                </li>
                <li class="header__nav-item">
                    <a href="<?php echo get_anchor_link('faq'); ?>" class="header__nav-link header__nav-link--large">
                        <span>faq</span>質問
                    </a>
                </li>
                <li class="header__nav-item">
                    <a href="<?php echo $contact; ?>" class="header__nav-link">
                        <span>contact</span>お問い合わせ
                    </a>
                </li>
            </ul>
            <nav class="header__drawer drawer js-drawer">
                <div class="drawer__inner">
                    <div class="drawer__logo">
                        <a href="<?php echo $home; ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/logo.png"
                                alt="LumeSpace" />
                        </a>
                    </div>
                    <button class="drawer__hamburger hamburger js-hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
                <div class="drawer__menu menu">
                    <div class="menu__nav-inner">
                        <div class="menu__nav-items">
                            <div class="menu__nav-container-first">
                                <ul class="menu__nav-item">
                                    <li class="menu__nav-item-main">
                                        <a href="<?php echo $campaign; ?>">キャンペーン</a>
                                    </li>
                                    <?php
                                        $campaign_terms = get_terms('campaign_category');
                                        if (!empty($campaign_terms) && !is_wp_error($campaign_terms)) :
                                        foreach ($campaign_terms as $term) :
                                        ?>
                                    <li class="menu__nav-item-sub">
                                        <a href="<?php echo esc_url(get_term_link($term)); ?>">
                                            <?php echo esc_html($term->name); ?>
                                        </a>
                                    </li>
                                    <?php endforeach; endif; ?>
                                    <li class="menu__nav-item-main">
                                        <a href="<?php echo $about; ?>">会社概要</a>
                                    </li>
                                </ul>
                                <ul class="menu__nav-item">
                                    <li class="menu__nav-item-main">
                                        <a href="<?php echo get_anchor_link('service'); ?>">サービス</a>
                                    </li>
                                    <li class="menu__nav-item-main">
                                        <a href="<?php echo $news; ?>">お知らせ</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="menu__nav-container-second">
                                <ul class="menu__nav-item">
                                    <li class="menu__nav-item-main">
                                        <a href="<?php echo $event; ?>">イベント</a>
                                    </li>
                                    <?php
                                        $event_terms = get_terms('event_category');
                                        if (!empty($event_terms) && !is_wp_error($event_terms)) :
                                        foreach ($event_terms as $term) :
                                        ?>
                                    <li class="menu__nav-item-sub">
                                        <a href="<?php echo esc_url(get_term_link($term)); ?>">
                                            <?php echo esc_html($term->name); ?>
                                        </a>
                                    </li>
                                    <?php endforeach; endif; ?>
                                </ul>
                                <ul class="menu__nav-item">
                                    <li class="menu__nav-item-main">
                                        <a href="<?php echo get_anchor_link('faq'); ?>">よくある質問</a>
                                    </li>
                                    <li class="menu__nav-item-main">
                                        <a href="<?php echo $privacy; ?>">プライバシーポリシー</a>
                                    </li>
                                    <li class="menu__nav-item-main">
                                        <a href="<?php echo $terms; ?>">利用規約</a>
                                    </li>
                                    <li class="menu__nav-item-main">
                                        <a href="<?php echo $contact; ?>">お問い合わせ</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>