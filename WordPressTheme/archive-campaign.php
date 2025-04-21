<?php get_header(); ?>
<div id="mv" class="mv-lower">
    <div class="mv-lower__inner">
        <div class="mv-lower__title">
            <h1 class="mv-lower__title-main"><span>Campaign</span></h1>
        </div>
        <div class="mv-lower__img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/mv-2.jpg" alt="明るく清潔なワークスペースの風景">
        </div>
    </div>
</div>
<?php get_template_part('parts/breadcrumb'); ?>
<main>
    <section class="campaign-lower campaign-lower-layout">
        <div class="campaign-lower__inner">
            <div class="campaign-lower__tab tab">
                <div class="tab__list">
                    <?php
                    $is_archive_page = is_post_type_archive('campaign');
                    $terms = get_terms(array(
                    'taxonomy' => 'campaign_category',
                    'hide_empty' => true,
                    ));
                    ?>
                    <a class="tab__button <?php echo $is_archive_page ? 'is-active' : ''; ?>"
                        href="<?php echo esc_url(get_post_type_archive_link('campaign')); ?>">ALL</a>
                    <?php if (!empty($terms)) : foreach ($terms as $term) : ?>
                    <a class="tab__button <?php echo is_tax('campaign_category', $term->slug) ? 'is-active' : ''; ?>"
                        href="<?php echo esc_url(get_term_link($term)); ?>">
                        <?php echo esc_html($term->name); ?>
                    </a>
                    <?php endforeach; endif; ?>
                </div>
                <div class="tab__campaign-contents">
                    <ul class="tab__campaign-contents-content">
                        <?php if (have_posts()) : while (have_posts()) : the_post();
                            $campaign_id = get_the_ID();
                            $terms = get_the_terms($campaign_id, 'campaign_category');
                            $campaign_category = $terms && !is_wp_error($terms) ? esc_html(implode(', ', wp_list_pluck($terms, 'name'))) : 'カテゴリーなし';
                            $campaign_cards = SCF::get('campaign_card', $campaign_id);
                            if (!empty($campaign_cards)) :
                            foreach ($campaign_cards as $card) :
                                $campaign_plan = $card['campaign_plan'];
                                $money_title = $card['money_title'];
                                $money_price = $card['money_price'];
                                $campaign_price = $card['campaign_price'];
                                $start_time = $card['start_time'];
                                $end_time = $card['end_time'];
                                $campaign_text = $card['campaign_text'];
                                ?>
                        <li class="tab__campaign-card">
                            <div class="tab__campaign-container">
                                <div class="tab__campaign-img">
                                    <?php if (has_post_thumbnail()) : the_post_thumbnail('full'); ?>
                                    <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/pc.jpg"
                                        alt="デフォルト画像" />
                                    <?php endif; ?>
                                </div>
                                <div class="tab__campaign-container-text">
                                    <div class="tab__campaign-text-box">
                                        <p class="tab__campaign-text-box-maintitle"><?php echo $campaign_category; ?>
                                        </p>
                                        <div class="tab__campaign-text-box-content">
                                            <p class="tab__campaign-text-box-plan">
                                                <?php echo esc_html($campaign_plan); ?></p>
                                            <p class="tab__campaign-text-box-description"><?php the_title(); ?></p>
                                        </div>
                                    </div>
                                    <div class="tab__campaign-money">
                                        <p class="tab__campaign-money-title"><?php echo esc_html($money_title); ?></p>
                                        <div class="tab__campaign-fee">
                                            <?php if ($money_price) : ?>
                                            <p class="tab__campaign-discount">
                                                <span
                                                    class="tab__campaign-discount-line">¥<?php echo esc_html(number_format($money_price)); ?></span>
                                            </p>
                                            <?php endif; ?>
                                            <p class="tab__campaign-main">
                                                <span
                                                    class="tab__campaign-main-yen">¥</span><?php echo esc_html(number_format($campaign_price)); ?>
                                            </p>
                                        </div>
                                        <p class="tab__campaign-text-main u-desktop">
                                            <?php echo esc_html($campaign_text); ?></p>
                                        <div class="tab__campaign-date-container u-desktop">
                                            <p class="tab__campaign-date-time">
                                                <?php echo esc_html($start_time); ?><?php echo esc_html($end_time); ?>
                                            </p>
                                            <p class="tab__campaign-date-text">ご予約・お問い合わせはコチラ</p>
                                            <div class="tab__campaign-form-button">
                                                <?php $contact_url = add_query_arg('campaign_id', $campaign_id, home_url('contact')); ?>
                                                <a href="<?php echo esc_url($contact_url); ?>" class="button">
                                                    <div class="button__container">
                                                        <p>Contact us</p>
                                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/Vector.png"
                                                            alt="矢印" class="button__arrow" />
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; endif; endwhile; endif; ?>
                    </ul>
                </div>
            </div>
            <div class="campaign-lower__pagenavi pagenavi">
                <?php wp_pagenavi(); ?>
            </div>
        </div>
    </section>

</main>
<?php get_footer(); ?>