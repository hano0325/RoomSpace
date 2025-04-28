<?php get_header(); ?>
<div id="mv" class="mv-lower">
    <div class="mv-lower__inner">
        <div class="mv-lower__title">
            <h1 class="mv-lower__title-main"><span>Terms&emsp13;of&emsp13;Service</span></h1>
        </div>
        <div class="mv-lower__img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/site-mv.jpg"
                alt="大きな窓から自然光が差し込む、観葉植物のあるスタイリッシュな会議室">
        </div>
    </div>
</div>
<?php get_template_part('parts/breadcrumb'); ?>
<main>
    <div class="sentence sentence-layout">
        <div class="sentence__inner">
            <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
            <h2 class="sentence__title"><?php echo the_title(); ?></h2>
            <div class="sentence__items">
                <?php echo the_content(); ?>
            </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
    <?php get_footer(); ?>