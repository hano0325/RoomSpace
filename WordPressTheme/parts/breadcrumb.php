<div class="breadcrumb breadcrumb-layout
    <?php echo (is_404() ? ' breadcrumb--white' : ''); ?>">
    <div class="breadcrumb__inner">
        <div class="breadcrumb__container">
            <?php if (function_exists('bcn_display')) {
                bcn_display();
            } ?>
        </div>
    </div>
</div>