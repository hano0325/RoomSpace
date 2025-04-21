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

// voiceアーカイブページの投稿数を6件に設定
function set_voice_posts_per_page($query) {
    // 管理画面ではなく、メインクエリが対象
    if (!is_admin() && $query->is_main_query()) {
        // カスタム投稿タイプ "voice" のアーカイブページ
        if ($query->is_post_type_archive('voice')) {
            $query->set('posts_per_page', 4); // 1ページあたり6件表示
        }
    }
}
// pre_get_posts フックを追加
add_action('pre_get_posts', 'set_voice_posts_per_page');


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

// Contact Form 7 のセレクトボックスに 'event_category' タクソノミーのタームを自動で追加する処理です
function event_category_selectlist($tag, $unused)
{
    // セレクトボックスの name 属性が 'event-category-select' であるか確認します
    if ($tag['name'] != 'event-category-select') {
        return $tag;
    }

    // URLのパラメータから、選択されたカテゴリIDを取得します（例: ?category_id=3）
    $selected_category = isset($_GET['category_id']) ? intval($_GET['category_id']) : null;

    // タクソノミー 'event_category' からターム一覧を取得します
    $terms = get_terms(array(
        'taxonomy'   => 'event_category', // ※お使いのタクソノミースラッグに合わせて変更してくださいね
        'hide_empty' => false,
        'orderby'    => 'name',
        'order'      => 'ASC',
    ));

    // セレクトボックスの初期配列を準備します
    $tag['raw_values'] = [];
    $tag['values'] = [];
    $tag['labels'] = [];

    // デフォルトの選択肢（ガイド用）を追加します
    $tag['raw_values'][] = 'カテゴリーを選択';
    $tag['values'][] = '';
    $tag['labels'][] = 'カテゴリーを選択';

    // タームが存在する場合、それぞれの名称を選択肢として追加します
    foreach ($terms as $term) {
        $tag['raw_values'][] = $term->name;
        $tag['values'][] = $term->name;
        $tag['labels'][] = $term->name;

        // URLで指定されたカテゴリIDが一致する場合、そのタームを初期選択状態にします
        if ($selected_category && $term->term_id === $selected_category) {
            $tag['default'][] = $term->name;
        }
    }

    return $tag;
}
add_filter('wpcf7_form_tag', 'event_category_selectlist', 10, 2);


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