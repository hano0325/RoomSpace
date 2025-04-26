<?php get_header(); ?>
<div id="mv" class="mv-lower">
    <div class="mv-lower__inner">
        <div class="mv-lower__title">
            <h1 class="mv-lower__title-main">Contact</h1>
        </div>
        <div class="mv-lower__img">
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/common/contact-mv.jpg"
                alt="レンガ壁とホワイトボードのあるモダンな会議室" />
        </div>
    </div>
</div>
<?php get_template_part('parts/breadcrumb'); ?>
<main>
    <div class="inquiry inquiry-layout">
        <div class="inquiry__inner">
            <?php echo do_shortcode('[contact-form-7 id="fa8ab8e" title="お問い合わせフォーム"]'); ?>
        </div>
    </div>
    <?php get_footer(); ?>