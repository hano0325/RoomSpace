<?php
// WordPressの基本機能を有効化
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Functions
 */

/**
 * WordPress標準機能
 *
 * @codex https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/add_theme_support
 */
function custom_theme_support() {
	add_theme_support( 'post-thumbnails' ); /* アイキャッチ */
	add_theme_support( 'automatic-feed-links' ); /* RSSフィード */
	add_theme_support( 'title-tag' ); /* タイトルタグ自動生成 */
	add_theme_support(
		'html5',
		array( /* HTML5のタグで出力 */
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);
}
add_action( 'after_setup_theme', 'custom_theme_support' );



/**
 * CSSとJavaScriptの読み込み
 *
 * @codex https://wpdocs.osdn.jp/%E3%83%8A%E3%83%93%E3%82%B2%E3%83%BC%E3%82%B7%E3%83%A7%E3%83%B3%E3%83%A1%E3%83%8B%E3%83%A5%E3%83%BC
 */
function my_script_init()
{
// css
	wp_enqueue_style('swiper-css', '//cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css', array(), '8.4.7', 'all');
	wp_enqueue_style('style-css', get_template_directory_uri(). '/assets/css/style.css', array(), '1.0.1', 'all');
	wp_enqueue_style('google-font', '//fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Noto+Sans+JP:wght@400;700&family=Noto+Serif+JP:wght@300;400;500;700&display=swap');

  // js
	wp_enqueue_script('jquery-cdn', '//code.jquery.com/jquery-3.6.0.js', array (), '1.0.1', true );
	wp_enqueue_script('swiper-js', '//cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js', array( 'jquery' ), '8.4.7', true );
	wp_enqueue_script('script-js', get_template_directory_uri(). '/assets/js/script.js', array( 'jquery' ), '1.0.1', true );

}
add_action('wp_enqueue_scripts', 'my_script_init');

// campaignアーカイブページの投稿数を4件に設定
function set_campaign_posts_per_page($query) {
    // 管理画面ではなく、メインクエリが対象
    if (!is_admin() && $query->is_main_query()) {
        // カスタム投稿タイプ "campaign" のアーカイブページ
        if ($query->is_post_type_archive('campaign')) {
            $query->set('posts_per_page', 4); // 1ページあたり4件表示
        }
    }
}
// pre_get_posts フックを追加
add_action('pre_get_posts', 'set_campaign_posts_per_page');


// eventアーカイブページの投稿数を9件に設定
function set_event_posts_per_page($query) {
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_post_type_archive('event')) {
            $query->set('posts_per_page', 9);
        }
    }
}
add_action('pre_get_posts', 'set_event_posts_per_page');



function custom_pagination($query) {
    if (!is_admin() && $query->is_main_query() && is_home()) {
        $query->set('posts_per_page', 10); // 1ページあたりの投稿数を設定
    }
}
add_action('pre_get_posts', 'custom_pagination');



// 例）個別ページに付与される「blog」を削除
add_filter( 'body_class', function( $classes ){
  if ( in_array( 'blog', $classes, true ) ) {
    unset( $classes[ array_search( 'single', $classes ) ] );
  }
  return $classes;
} );

//ウィジェット
function theme_slug_widgets_init() {
	register_sidebar( array(
		'name' => 'サイドバー', //ウィジェットの名前を入力
		'id' => 'sidebar', //ウィジェットに付けるid名を入力
	) );
  }
  add_action( 'widgets_init', 'theme_slug_widgets_init' );



// Contact Form 7 セレクトボックスをカスタム投稿から自動生成（キャンペーン用）
function campaign_selectlist($tag, $unused)
{
    if ($tag['name'] != 'campaign-select') {
        return $tag;
    }

    $selected_campaign = isset($_GET['campaign_id']) ? intval($_GET['campaign_id']) : null;

    $args = array(
        'numberposts' => -1,
        'post_type'   => 'campaign',
        'orderby'     => 'ID',
        'order'       => 'ASC'
    );

    $job_posts = get_posts($args);

    $tag['raw_values'] = [];
    $tag['values'] = [];
    $tag['labels'] = [];

    $tag['raw_values'][] = 'キャンペーン内容を選択';
    $tag['values'][] = '';
    $tag['labels'][] = 'キャンペーン内容を選択';

    foreach ($job_posts as $job_post) {
        $tag['raw_values'][] = $job_post->post_title;
        $tag['values'][] = $job_post->post_title;
        $tag['labels'][] = $job_post->post_title;

        if ($selected_campaign && $job_post->ID === $selected_campaign) {
            $tag['default'][] = $job_post->post_title;
        }
    }

    return $tag;
}
add_filter('wpcf7_form_tag', 'campaign_selectlist', 10, 2);


// Contact Form 7 セレクトボックスをカスタム投稿から自動生成（イベント用）
function event_selectlist($tag, $unused)
{
    if ($tag['name'] != 'event-select') {
        return $tag;
    }

    $selected_event = isset($_GET['event_id']) ? intval($_GET['event_id']) : null;

    $args = array(
        'numberposts' => -1,
        'post_type'   => 'event',
        'orderby'     => 'ID',
        'order'       => 'ASC'
    );

    $event_posts = get_posts($args);

    $tag['raw_values'] = [];
    $tag['values'] = [];
    $tag['labels'] = [];

    $tag['raw_values'][] = 'イベント内容を選択';
    $tag['values'][] = '';
    $tag['labels'][] = 'イベント内容を選択';

    foreach ($event_posts as $event_post) {
        $tag['raw_values'][] = $event_post->post_title;
        $tag['values'][] = $event_post->post_title;
        $tag['labels'][] = $event_post->post_title;

        if ($selected_event && $event_post->ID === $selected_event) {
            $tag['default'][] = $event_post->post_title;
        }
    }

    return $tag;
}
add_filter('wpcf7_form_tag', 'event_selectlist', 10, 2);



// Contact Form 7 セレクトボックスの選択肢をカスタム投稿のタイトルから自動生成
function job_selectlist($tag, $unused)
{
    // セレクトボックスの名前が 'campaign-select' かどうか確認
    if ($tag['name'] != 'event-select') {
        return $tag;
    }

    // URLパラメータからキャンペーンIDを取得
    $selected_campaign = isset($_GET['event_id']) ? intval($_GET['event_id']) : null;

    // カスタム投稿タイプ 'campaign' から投稿を取得
    $args = array(
        'numberposts' => -1,
        'post_type'   => 'event',
        'orderby'     => 'ID',
        'order'       => 'ASC'
    );

    $job_posts = get_posts($args);

    // セレクトボックスの初期値を設定
    $tag['raw_values'] = [];
    $tag['values'] = [];
    $tag['labels'] = [];

    $tag['raw_values'][] = 'イベント内容を選択';
    $tag['values'][] = '';
    $tag['labels'][] = 'イベント内容を選択';

    // 投稿が存在する場合、セレクトボックスに追加
    foreach ($job_posts as $job_post) {
        $tag['raw_values'][] = $job_post->post_title;
        $tag['values'][] = $job_post->post_title;
        $tag['labels'][] = $job_post->post_title;

        // 選択されたイベントが一致する場合にデフォルト値を設定
        if ($selected_campaign && $job_post->ID === $selected_campaign) {
            $tag['default'][] = $job_post->post_title;
        }
    }

    return $tag;
}
add_filter('wpcf7_form_tag', 'job_selectlist', 10, 2);


// Contact Form 7の自動pタグ無効
add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');
function wpcf7_autop_return_false() {
  return false;
}

function get_anchor_link($anchor_id) {
    if (is_front_page()) {
        return '#' . $anchor_id;
    } else {
        return esc_url(home_url('/')) . '#' . $anchor_id;
    }
}

function my_enqueue_scripts(){
	wp_register_style(
		"swiper-css",
		"https://unpkg.com/swiper@8/swiper-bundle.min.css"
	);
	wp_enqueue_style( 'swiper-css' );

	wp_enqueue_script(
		"swiper-js",
		"https://unpkg.com/swiper@8/swiper-bundle.min.js",
		array(),
		false,
		true
	);

	//実際に動かすための設定ファイル
	wp_enqueue_script(
		"swiper-conf",
		get_theme_file_uri("js/swiper-conf.js"),
		array("swiper-js"),
		false,
		true
	);

	//style.cssでlightgallery.cssを上書きする場合は、第三引数に指定
	wp_enqueue_style(
		"style",
		get_stylesheet_uri(),
		array("swiper-css"),
		filemtime(get_stylesheet_directory())
	);
}
add_action( 'wp_enqueue_scripts', 'my_enqueue_scripts' );

function auto_post_slug( $slug, $post_ID, $post_status, $post_type ) {
    // スラッグがURLエンコードされた日本語の場合
    if ( preg_match( '/(%[0-9a-f]{2})+/', $slug ) ) {
        // 投稿タイトルを取得
        $post_title = get_post_field( 'post_title', $post_ID );

        // 日本語タイトルをローマ字（英語風）に変換
        if ( function_exists( 'transliterator_transliterate' ) ) {
            // ラテン文字に変換
            $slug = transliterator_transliterate( 'Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $post_title );
        } else {
            // transliterator_transliterateが使えない場合はsanitize_titleを使用
            $slug = sanitize_title( $post_title );
        }
    }

    // 新しいスラッグを返す
    return $slug;
}