    <?php
    $home = esc_url( home_url( '/' ) );
    $campaign_url = esc_url( home_url( '/campaign/' ) );
    $about = esc_url( home_url( '/about/' ) );
    $information = esc_url( home_url( '/information/' ) );
    $blog = esc_url( home_url( '/blog/' ) );
    $voice_url = esc_url( home_url( '/voice/' ) );
    $price_url = esc_url( home_url( '/price/' ) );
    $faq = esc_url( home_url( '/faq/' ) );
    $contact = esc_url( home_url( '/contact/' ) );
    ?>
    <?php get_header(); ?>
    <div id="mv" class="mv">
        <div class="mv__inner">
            <div class="mv__slider swiper js-mv-swiper">
                <div class="mv__wrapper swiper-wrapper">
                    <?php
                    $mv_slides = SCF::get('mv_slides');
                    if (!empty($mv_slides)) :
                    foreach ($mv_slides as $slide) :
                            $mv_slide= wp_get_attachment_image_url($slide['mv_slide'], 'full');
                    ?>
                    <div class="mv__slide swiper-slide">
                        <img src="<?php echo esc_url($mv_slide); ?>" alt="MV画像" />
                    </div>
                    <?php
                endforeach;
                endif;
                ?>
                </div>
                <div class=" mv__title move">
                    <h1 class="mv__title-main">
                        <span>使いやすい、</span><br>
                        <span>あなたの場所。</span>
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <main>
        <section class="campaign campaign-layout">
            <div class="campaign__inner inner">
                <div class="campaign__button-container">
                    <div class="campaign__button-next swiper-button-next"></div>
                    <div class="campaign__button-prev swiper-button-prev"></div>
                </div>
                <div class="campaign__title title">
                    <p class="title__main">Campaign</p>
                    <h2 class="title__sub">キャンペーン</h2>
                </div>
                <div class="campaign__container">
                    <div class="campaign__swiper swiper js-campaign-swiper">
                        <div class="campaign__wrapper swiper-wrapper">
                            <?php
                            $args = [
                                'post_type' => 'campaign',
                                'posts_per_page' => 4,
                            ];
                            $the_query = new WP_Query($args);
                            if ($the_query->have_posts()) :
                                while ($the_query->have_posts()) : $the_query->the_post();
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
                            <div class="campaign__slide swiper-slide">
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url() ?: get_template_directory_uri() . '/assets/images/common/pc.jpg'); ?>"
                                    alt="キャンペーン画像" />
                                <div class="campaign__container-text text-container">
                                    <div class="campaign__text-box text-box">
                                        <p class="campaign__text-box-maintitle text-box-maintitle">
                                            <?php echo $campaign_category; ?></p>
                                        <p class="campaign__text-box-plan text-box-plan">
                                            <?php echo esc_html($campaign_plan); ?></p>
                                        <p class="campaign__text-box-content text-box-content"><?php the_title(); ?></p>
                                    </div>
                                    <div class="campaign__money">
                                        <p class="campaign__money-title"><?php echo esc_html($money_title); ?></p>
                                        <div class="campaign__fee">
                                            <?php if ($money_price) : ?>
                                            <p class="campaign__discount">
                                                <span
                                                    class="campaign__discount-line">¥<?php echo number_format($money_price); ?></span>
                                            </p>
                                            <?php endif; ?>
                                            <p class="campaign__main">
                                                <span
                                                    class="campaign__main-yen">¥</span><?php echo number_format($campaign_price); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endforeach;
                    endif;
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
                        </div>
                    </div>
                </div>
                <div class="campaign__button">
                    <a href="<?php echo esc_url($campaign_url); ?>" class="button">
                        <div class="button__container">
                            <p>View more</p>
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/common/Vector.png"
                                alt="矢印" class="button__arrow" />
                        </div>
                    </a>
                </div>
            </div>
        </section>
        <section class="about about-layout">
            <div class="about__inner inner">
                <div class="scroll-up">
                    <div class="about__title-main title">
                        <p class="title__main">About us</p>
                        <h2 class="title__sub">私たちについて</h2>
                    </div>
                </div>
                <div class="scroll-up">
                    <div class="about__container">
                        <div class="about__img colorbox">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/common/People.jpg"
                                alt="" />
                        </div>
                        <div class="scroll-up">
                            <div class="about__text-container">
                                <p class="about__title-sub">働きやすさ<br class="u-mobile">を追求した空間</p>
                                <p class="about__text text">
                                    私たちのコワーキングスペースは、ただの作業場所ではなく、「働く・学ぶ・つながる」をコンセプトにしたコミュニティ空間です。フリーランス、スタートアップ、リモートワーカー、クリエイター、学生など、多様な人々が集い、それぞれの目標に向かって前進できる環境を提供します。
                                </p>
                                <div class="about__button">
                                    <a href="<?php echo home_url('/about/'); ?>" class="button">
                                        <div class="button__container">
                                            <p>View more</p>
                                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/common/Vector.png"
                                                alt="矢印" class="button__arrow" />
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="service" class="service service-layout">
            <div class="service__inner">
                <div class="service__title-main title">
                    <p class="title__main">Service</p>
                    <h2 class="title__sub">サービス</h2>
                </div>
                <ul class="service__list">
                    <li class="service__item scroll-up">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/common/icon-wifi.svg"
                            alt="Wi-Fiアイコン">
                        <h3 class="service__title">フリー<br />Wi-fi</h3>
                        <p class="service__text">高速インターネット完備で<br>快適な作業環境を提供</p>
                    </li>
                    <li class="service__item scroll-up">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/common/icon-drink.svg"
                            alt="ドリンクアイコン">
                        <h3 class="service__title">フリー<br>ドリンク</h3>
                        <p class="service__text">コーヒー・お茶など無料で<br />ご利用いただけます</p>
                    </li>
                    <li class="service__item scroll-up">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/common/icon-chair.svg"
                            alt="チェアアイコン">
                        <h3 class="service__title">快適な<br />ワークチェア</h3>
                        <p class="service__text">長時間でも疲れにくい<br />高機能チェアを採用</p>
                    </li>
                    <li class="service__item scroll-up">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/common/icon-meeting.svg"
                            alt="会議室アイコン">
                        <h3 class="service__title">会議室<br />利用可</h3>
                        <p class="service__text">予約制で会議室・個室も<br />ご利用いただけます</p>
                    </li>
                    <li class="service__item scroll-up">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/common/icon-24h.svg"
                            alt="24時間アイコン">
                        <h3 class="service__title">24時間<br />利用可</h3>
                        <p class="service__text">会員様はいつでも自由に<br />ご利用いただけます</p>
                    </li>
                    <li class="service__item scroll-up">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/common/icon-clean.svg"
                            alt="清掃アイコン">
                        <h3 class="service__title">清潔な<br>空間</h3>
                        <p class="service__text">毎日の清掃と空調管理で<br />安心・快適</p>
                    </li>
                </ul>
            </div>
        </section>
        <section class="news news-layout">
            <div class="news__inner">
                <div class="news__title-main title">
                    <p class="title__main">News</p>
                    <h2 class="title__sub">お知らせ</h2>
                </div>
                <ul class="news__list">
                    <?php
                        $news_args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 5
                        );
                        $news_query = new WP_Query($news_args);
                    ?>
                    <?php if ($news_query->have_posts()) : ?>
                    <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
                    <li class="news__item">
                        <a href="<?php the_permalink(); ?>" class="news__link">
                            <time class="news__date" datetime="<?php echo get_the_date('Y-m-d'); ?>">
                                <?php echo get_the_date('Y.m.d'); ?>
                            </time>
                            <p class="news__text"><?php the_title(); ?></p>
                        </a>
                    </li>
                    <?php endwhile; ?>
                    <?php else : ?>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </ul>
                <div class="news__button">
                    <a href="<?php echo home_url('/news/'); ?>" class="button">
                        <div class="button__container">
                            <p>View more</p>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/Vector.png"
                                alt="矢印" class="button__arrow" />
                        </div>
                    </a>
                </div>
            </div>
        </section>
        <section class="event event-layout">
            <div class="event__inner">
                <div class="event__title title">
                    <p class="title__main">Event</p>
                    <h2 class="title__sub">イベント</h2>
                </div>
                <div class="event__contents">
                    <ul class="event__cards cards">
                        <?php
                            $event_args = array(
                            'post_type' => 'event',
                            'posts_per_page' => 6,
                            );
                            $event_query = new WP_Query($event_args);
                        ?>
                        <?php if ($event_query->have_posts()) : ?>
                        <?php while ($event_query->have_posts()) : $event_query->the_post(); ?>
                        <?php
                            $event_id = get_the_ID();
                            $event_terms = get_the_terms($event_id, 'event_category');
                            $event_category = $event_terms && !is_wp_error($event_terms)
                            ? esc_html(implode(', ', wp_list_pluck($event_terms, 'name')))
                            : 'カテゴリーなし';
                            $event_cards = SCF::get('event_cards', $event_id);
                            $event_date = '';
                            $start_time = '';
                            $end_time = '';
                            if (!empty($event_cards)) {
                            $event_card = $event_cards[0];
                            $event_date = $event_card['event_date'];
                            $start_time = $event_card['start_time'];
                            $end_time = $event_card['end_time'];
                            }
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
                                            <?php if ($event_date) : ?>
                                            <?php echo date_i18n('Y年n月j日（D）', strtotime($event_date)); ?>
                                            <?php echo esc_html($start_time); ?>〜<?php echo esc_html($end_time); ?>
                                            <?php endif; ?>
                                        </p>
                                        <p class="card__text"><?php the_title(); ?></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <?php endwhile; ?>
                        <?php else : ?>
                        <?php endif; ?>
                        <?php wp_reset_postdata(); ?>
                    </ul>
                    <div class="event__button">
                        <a href="<?php echo home_url('/event/'); ?>" class="button">
                            <div class="button__container">
                                <p>View more</p>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/Vector.png"
                                    alt="矢印" class="button__arrow" />
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section id="price" class="price price-layout">
            <div class="price__inner">
                <div class="price__title-main title">
                    <p class="title__main">Price</p>
                    <h2 class="title__sub">料金一覧</h2>
                </div>
                <div class="price__table price__table--pc">
                    <table class="price__content">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="price__plan price__plan--light">ライトプラン</th>
                                <th class="price__plan price__plan--regular">レギュラープラン</th>
                                <th class="price__plan price__plan--premium">プレミアムプラン</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="price__side">月額料金</th>
                                <td class="price__money">
                                    <span class="price__unit">¥</span>10,000<span class="price__unit">/月</span>
                                </td>
                                <td class="price__money">
                                    <span class="price__unit">¥</span>20,000<span class="price__unit">/月</span>
                                </td>
                                <td class="price__money">
                                    <span class="price__unit">¥</span>35,000<span class="price__unit">/月</span>
                                </td>
                            </tr>
                            <tr>
                                <th class="price__side">利用可能時間</th>
                                <td class="price__time">平日<br>9時〜18時</td>
                                <td class="price__time">平日＋土曜日<br>9時〜18時</td>
                                <td class="price__time">365日<br>24時間</td>
                            </tr>
                            <tr>
                                <th class="price__side">フリードリンク</th>
                                <td class="price__answer"></td>
                                <td class="price__answer"></td>
                                <td class="price__answer"></td>
                            </tr>
                            <tr>
                                <th class="price__side">会議室利用</th>
                                <td class="price__usage">
                                    <span class="price__line"></span>
                                </td>
                                <td class="price__usage">1時間<span class="price__usage-unit">/月</span></td>
                                <td class="price__usage">5時間<span class="price__usage-unit">/月</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="price__table price__table--sp">
                    <table class="price__content">
                        <thead>
                            <tr>
                                <th colspan="2" class="price__plan price__plan--light">ライトプラン</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="price__side">月額料金</td>
                                <td class="price__money">
                                    <span class="price__unit">¥</span>10,000<span class="price__unit">/月</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="price__side">利用可能<br>時間</td>
                                <td class="price__time">平日<br>9時〜18時</td>
                            </tr>
                            <tr>
                                <td class="price__side">フリー<br>ドリンク</td>
                                <td class="price__answer"></td>
                            </tr>
                            <tr>
                                <td class="price__side">会議室<br>利用</td>
                                <td class="price__usage">
                                    <span class="price__line"></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="price__content">
                        <thead>
                            <tr>
                                <th colspan="2" class="price__plan price__plan--regular">レギュラープラン</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="price__side">月額料金</td>
                                <td class="price__money">
                                    <span class="price__unit">¥</span>20,000<span class="price__unit">/月</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="price__side">利用可能<br>時間</td>
                                <td class="price__time">平日＋土曜日<br>9時〜18時</td>
                            </tr>
                            <tr>
                                <td class="price__side">フリー<br>ドリンク</td>
                                <td class="price__answer"></td>
                            </tr>
                            <tr>
                                <td class="price__side">会議室<br>利用</td>
                                <td class="price__usage">1時間<span class="price__unit">/月</span></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="price__content">
                        <thead>
                            <tr>
                                <th colspan="2" class="price__plan price__plan--premium">プレミアムプラン</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="price__side">月額料金</td>
                                <td class="price__money">
                                    <span class="price__unit">¥</span>35,000<span class="price__unit">/月</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="price__side">利用可能<br>時間</td>
                                <td class="price__time">365日<br>24時間</td>
                            </tr>
                            <tr>
                                <td class="price__side">フリー<br>ドリンク</td>
                                <td class="price__answer"></td>
                            </tr>
                            <tr>
                                <td class="price__side">会議室<br>利用</td>
                                <td class="price__usage">5時間<span class="price__unit">/月</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="price__button">
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="button">
                    <div class="button__container">
                        <p>View more</p>
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/common/Vector.png" alt="矢印"
                            class="button__arrow" />
                    </div>
                </a>
            </div>
        </section>
        <section id="faq" class="faq faq-layout">
            <div class="faq__inner inner">
                <div class="faq__title title">
                    <p class="title__main">FAQ</p>
                    <h2 class="title__sub">よくある質問</h2>
                </div>
                <ul class="faq-list">
                    <li class="faq-list__item">
                        <p class="faq-list__item-question js-faq-question">LumeSpaceにはどのような作業スペースがありますか？</p>
                        <p class="faq-list__item-answer">
                            LumeSpaceにはオープンデスク、集中ブース、個室オフィス、会議室など多様な作業スペースがあります。用途に応じて、静かな集中環境や打ち合わせ向けの空間を選べるようになっています。
                        </p>
                    </li>
                    <li class="faq-list__item">
                        <p class="faq-list__item-question js-faq-question">会議室や個室は事前予約が必要ですか？</p>
                        <p class="faq-list__item-answer">
                            はい、会議室と個室ブースは事前予約制です。Web予約システムを通じて、利用希望日の前日までに予約可能です。空き状況はリアルタイムで確認できます。
                        </p>
                    </li>
                    <li class="faq-list__item">
                        <p class="faq-list__item-question js-faq-question">電源やWi-Fiの環境は整っていますか？</p>
                        <p class="faq-list__item-answer">
                            全席に電源が完備されており、安定した高速Wi-Fiが提供されています。オンライン会議やリモートワークにも支障のないネットワーク環境です。
                        </p>
                    </li>
                    <li class="faq-list__item">
                        <p class="faq-list__item-question js-faq-question">飲食は可能ですか？また、カフェスペースはありますか？</p>
                        <p class="faq-list__item-answer">
                            飲食は指定のラウンジエリアやカフェスペースで可能です。フリードリンクコーナーがあり、コーヒーやお茶のサービスも利用できます。軽食の持ち込みもOKです。
                        </p>
                    </li>
                    <li class="faq-list__item">
                        <p class="faq-list__item-question js-faq-question">セキュリティ対策はどのようになっていますか？</p>
                        <p class="faq-list__item-answer">
                            LumeSpaceでは入退室管理にICカード認証を採用しており、利用者のみが施設にアクセスできます。また、監視カメラの設置とスタッフによる定期巡回も行われており、安全性が保たれています。
                        </p>
                    </li>
                </ul>
            </div>
        </section>
        <?php get_footer(); ?>