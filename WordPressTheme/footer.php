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

<?php if (!is_page(array('contact', 'thanks')) && !is_404()): ?>
<section class="contact contact-layout contact-mask">
    <div class="contact__inner">
        <div class="contact__title title">
            <p class="title__main title__main--big">Contact</p>
            <h2 class="title__sub title__sub--big">お問い合わせ</h2>
        </div>
        <div class="contact__container">
            <p class="contact__text">ご予約・お問い合わせはコチラ</p>
            <div class="contact__button">
                <a href="<?php echo $contact; ?>" class="button button--transparent">
                    <div class="button__container">
                        <p>Contact us</p>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/Vector.png" alt="矢印"
                            class="button-arrow" />
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<footer class="footer<?php if (is_404()): ?> footer-404--mt0<?php endif; ?> footer-layout">
    <div class="footer__nav-inner inner">
        <div class="footer__nav-container">
            <div class="footer__logo-container">
                <p class="footer__logo">
                    <a href="<?php echo $home; ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/logo.svg"
                            alt="LumeSpace" />
                    </a>
                </p>
                <ul class="footer__sns-button-items">
                    <li class="footer__sns-button-item">
                        <a href="https://www.facebook.com/ " target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/FacebookLogo.svg"
                                alt="facebookのアイコン" />
                        </a>
                    </li>
                    <li class="footer__sns-button-item">
                        <a href="https://www.instagram.com/ " target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/InstagramLogo.svg"
                                alt="Instagramのアイコン" />
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer__menu menu">
        <div class="menu__nav-inner">
            <div class="menu__nav-items">
                <div class="menu__nav-container-first">
                    <ul class="menu__nav-item">
                        <li class="menu__nav-item-main">
                            <a href="<?php echo $campaign_url; ?>">キャンペーン</a>
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
                        <li class="menu__nav-item-main">
                            <a href="<?php echo is_front_page() ? '#price' : esc_url( home_url( '/#price' ) ); ?>">料金一覧
                            </a>
                        </li>
                    </ul>
                    <ul class="menu__nav-item">
                        <li class="menu__nav-item-main">
                            <a href="<?php echo is_front_page() ? '#faq' : esc_url( home_url( '/#faq' ) ); ?>">
                                よくある質問
                            </a>
                        </li>
                        <li class="menu__nav-item-main">
                            <a href="<?php echo $privacy; ?>">プライバシー<br class="u-mobile" />ポリシー</a>
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
        <p class="footer__copyright">
            Copyright © 2021 - <?php echo date('Y'); ?> CodeUps LLC. All Rights Reserved.
        </p>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>