<?php get_header(); ?>
<main>
    <div class="error">
        <div class="error__breadcrumb">
            <?php get_template_part('parts/breadcrumb'); ?>
        </div>
        <div class="error__inner">
            <div class="error__text-container">
                <div class="error__container-sub">
                    <h1 class="error__text-main">404</h1>
                    <div class="error__text-sub">申し訳ありません。<br>お探しのページが見つかりません。</div>
                    <div class="error__button">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="button button--white">
                            <div class="button__container">
                                <p>Page TOP</p>
                                <img src="<?php echo get_template_directory_uri() ?>/assets/images/common/Vector-gord.svg"
                                    alt="矢印" class="button__arrow" />
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php get_footer(); ?>