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
            <div class="event-lower__tab tab">
                <div class="tab__list">
                    <?php
                    $terms = get_terms(array(
                        'taxonomy' => 'event_category',
                        'hide_empty' => true,
                    ));
                    $current_term = get_queried_object();
                    ?>
                    <a class="tab__button <?php echo (!is_tax('event_category')) ? 'is-active' : ''; ?>"
                        href="<?php echo esc_url(get_post_type_archive_link('event')); ?>">
                        ALL
                    </a>
                    <?php
                    if (!empty($terms)) :
                        foreach ($terms as $term) : ?>
                    <a class="tab__button <?php echo ($current_term->slug === $term->slug) ? 'is-active' : ''; ?>"
                        href="<?php echo esc_url(get_term_link($term)); ?>">
                        <?php echo esc_html($term->name); ?>
                    </a>
                    <?php endforeach;
                    endif; ?>
                </div>
                <div class="tab__event-contents">
                    <ul class="tab__cards cards">
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
                        <li class="cards__card card">
                            <a href="<?php the_permalink(); ?>" class="card__link">
                                <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('full'); ?>
                                <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/pc.jpg"
                                    alt="イベントのデフォルト画像" />
                                <?php endif; ?>
                                <div class="card__box">
                                    <div class="card__label">
                                        <p class="card__label-text"><?php echo $event_category; ?></p>
                                    </div>
                                    <div class="card__text-box">
                                        <p class="card__date">
                                            <?php echo date_i18n('Y年n月j日（D）', strtotime($event_date)); ?>
                                            <?php echo esc_html($start_time); ?>~<?php echo esc_html($end_time); ?>
                                        </p>
                                        <p class="card__text"><?php the_title(); ?></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <?php endforeach; endif; endwhile; endif; ?>
                    </ul>
                </div>
            </div>
            <div class="event-lower__pagenavi pagenavi">
                <?php wp_pagenavi(); ?>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>