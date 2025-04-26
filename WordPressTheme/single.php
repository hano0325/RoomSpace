<?php get_header(); ?>
<div id="mv" class="mv-lower">
    <div class="mv-lower__inner">
        <div class="mv-lower__title">
            <h1 class="mv-lower__title-main"><span>News</span></h1>
        </div>
        <div class="mv-lower__img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/workspace-tables.jpg"
                alt="明るく清潔なワークスペースの風景">
        </div>
    </div>
</div>
<?php get_template_part('parts/breadcrumb'); ?>
<main>
    <section class="news-detail news-detail-layout">
        <div class="news-detail__inner">
            <div class="news-detail__container">
                <div class="news-detail__img">
                    <?php if (has_post_thumbnail()) : the_post_thumbnail('full'); ?>
                    <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/pc.jpg" alt="デフォルト画像" />
                    <?php endif; ?>
                </div>
                <div class="news-detail__date">
                    <time datetime="<?php echo get_the_date('Y-m-d'); ?>T<?php echo get_the_time('H:i:s'); ?>+09:00"
                        class="news-detail__time">
                        <?php echo get_the_date('Y.m.d'); ?>
                    </time>
                    <h2 class="news-detail__title">
                        <?php the_title(); ?>
                    </h2>
                </div>
                <div class="news-detail__sns">
                    <a href="#" class="news-detail__sns-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/icon-facebook.svg"
                            alt="Facebook">
                    </a>
                    <a href="#" class="news-detail__sns-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/icon-instagram.svg"
                            alt="Instagram">
                    </a>
                </div>
                <div class="news-detail__body">
                    <p class="news-detail__text">
                        <?php the_content(); ?>
                    </p>
                </div>
                <div class="news-detail__button">
                    <a href="<?php echo esc_url(home_url('/news/')) ?>" class="button">
                        <div class="button__container">
                            <p>NEWS一覧</p>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/Vector.png"
                                alt="" class="button__arrow" />
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <?php get_footer(); ?>
</main>