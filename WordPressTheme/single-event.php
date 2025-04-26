<?php get_header(); ?>
<div id="mv" class="mv-lower">
    <div class="mv-lower__inner">
        <div class="mv-lower__title">
            <h1 class="mv-lower__title-main"><span>Event</span></h1>
        </div>
        <div class="mv-lower__img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/event-mv.jpg"
                alt="ガラス張りのモダンな会議室で行われるディスカッションイベントの様子">
        </div>
    </div>
</div>
<?php get_template_part('parts/breadcrumb'); ?>
<main>
    <section class="event-lower event-lower-layout">
        <div class="event-lower__inner inner">
            <div class="event-lower__section">
                <?php if (have_posts()) : while (have_posts()) : the_post();
                    $event_id = get_the_ID();
                    $event_terms = get_the_terms($event_id, 'event_category');
                    $event_category = $event_terms && !is_wp_error($event_terms)
                        ? esc_html(implode(', ', wp_list_pluck($event_terms, 'name')))
                        : 'カテゴリーなし';
                    $event_cards = SCF::get('event_cards', $event_id);
                    if (!empty($event_cards)) :
                        foreach ($event_cards as $card) :
                            $event_date = $card['event_date'];
                            $start_time = $card['start_time'];
                            $end_time = $card['end_time'];
                ?>
                <div class="event-lower__container">
                    <div class="event-lower__card-detail card-lower-detail">
                        <div class="card-lower-detail__content">
                            <div class="card-lower-detail__container">
                                <p class="card-lower-detail__category"><?php echo $event_category; ?></p>
                                <p class="card-lower-detail__dat">
                                    <?php echo date_i18n('Y年n月j日（D）', strtotime($event_date)); ?>
                                    <?php echo esc_html($start_time); ?>〜<?php echo esc_html($end_time); ?></p>
                                <h1 class="card-lower-detail__title"><?php the_title(); ?></h1>
                                <div class="card-lower-detail__img">
                                    <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('full'); ?>
                                    <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/cats.jpg"
                                        alt="デフォルト画像" />
                                    <?php endif; ?>
                                </div>
                                <div class="card-lower-detail__entry">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-lower-detail__button">
                            <?php $contact_url = add_query_arg('event_id', $event_id, home_url('contact')); ?>
                            <a href="<?php echo esc_url($contact_url); ?>" class="button">
                                <div class="button__container">
                                    <p>Contact us</p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/Vector.png"
                                        alt="矢印" class="button__arrow" />
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="event-lower__detail-pagenavi pagenavi">
                        <div class="pagenavi__inner">
                            <div class="wp-pagenavi">
                                <?php if (get_previous_post()) : ?>
                                <div class="previouspostslink-detail">
                                    <?php previous_post_link('%link', ''); ?>
                                </div>
                                <?php endif; ?>
                                <?php if (get_next_post()) : ?>
                                <div class="nextpostslink-detail">
                                    <?php next_post_link('%link', ''); ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; endif; endwhile; endif; ?>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>