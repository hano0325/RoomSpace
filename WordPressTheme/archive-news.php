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
    <section class="news-lower news-lower-layout">
        <div class="news-lower__inner">
            <div class="news-lower__title title-lower">
                <h2 class="title-lower__main">お知らせ</h2>
            </div>
            <ul class="news-lower__list">
                <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                <li class="news-lower__item">
                    <a href="<?php the_permalink(); ?>" class="news-lower__link">
                        <time datetime="<?php echo get_the_date('Y-m-d'); ?>T<?php echo get_the_time('H:i:s'); ?>+09:00"
                            class="news-lower__date">
                            <?php echo get_the_date('Y.m.d'); ?>
                        </time>
                        <p class="news-lower__text"><?php the_title(); ?></p>
                    </a>
                </li>
                <?php endwhile; ?>
                <?php endif; ?>
            </ul>
        </div>
    </section>
    <?php get_footer(); ?>
</main>