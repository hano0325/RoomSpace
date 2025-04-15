
jQuery(function ($) { // この中であればWordpressでも「$」が使用可能になる
    $(".js-hamburger, .js-drawerClose").on("click", function () {
        if ($(".js-hamburger").hasClass("is-active")) {
        closeDrawer();
        } else {
        openDrawer();
        }
        });
      // ページ内スクロール
        $(function () {
        // ヘッダーの高さ取得
        var headerHeight = $(".header").outerHeight();
        if (headerHeight) {
        console.log("Header height: ".concat(headerHeight, "px"));
        } else {
        console.log("Header element does not exist or its height could not be retrieved.");
        }
        var hash = location.hash;
        if (hash) {
        $("html, body").stop().scrollTop(0);
        scroll(hash, headerHeight);
        }
        $('a[href*="#"]').click(function () {
          // ヘッダーの高さ分下げる
          $(".js-hamburger").removeClass("is-active"); // ハンバーガーボタンの状態をリセット
          $(".js-drawer").removeClass("is-active"); // メニューを非表示状態にする
          // メニューコンテナを非表示に設定
        $(".js-drawer").css("display", "none");
        var href = $(this).attr("href");
        scroll(href, headerHeight);
        return false;
        });
    });
    function scroll(href, headerHeight) {
        var speed = 600;
        href = "#" + href.split("#")[1];
        console.log(href);
        var target = $(href == "#" || href == "" ? "html" : href);
        var position = target.offset().top - headerHeight;
        $("body.html").animate({
        crollTop: position
        }, speed, "swing");
    }
    });
      // resizeイベント
        $(window).resize(function () {
        if (window.matchMedia("(min-width: 768px)").matches) {
        closeDrawer();
        }
        });

      // 新しい関数: openDrawer
        function openDrawer() {
        $(".js-drawer").fadeIn();
        $(".js-hamburger").addClass("is-active");
        $("body").addClass("no-scroll"); // スクロールを無効化
    }

      // 新しい関数: closeDrawer
    function closeDrawer() {
        $(".js-drawer").fadeOut();
        $(".js-hamburger").removeClass("is-active");
        $("body").removeClass("no-scroll"); // スクロールを無効化
    }

    // ページトップに戻るボタン
    $(function () {
      const pageTop = $(".js-page-top");
      pageTop.hide();
      $(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
          pageTop.fadeIn();
        } else {
          pageTop.fadeOut();
        }
      });
      pageTop.click(function () {
        $("body, html").animate(
          {
            scrollTop: 0,
          },
          300
        );
        return false;
      });
    });

// キャンペーンセクション用のSwiper
var campaignSwiper = new Swiper('.js-campaign-swiper', {
  loop: true, // 無限ループ
  slidesPerView: 'auto', // 一度に表示するスライド数
  slidesPerGroup: 1, // 一度に移動するスライド数
  initialSlide: 1, // 初期表示スライド
  spaceBetween: 24, // スライド間のスペース
  autoplay: {
    delay: 2000, // 2秒ごとに自動でスライド
    disableOnInteraction: false // ユーザーが操作しても自動再生を止めない
  },
  pagination: {
    el: '.swiper-pagination', // ページネーションの要素
    clickable: true, // ページネーションをクリック可能にする
  },
  navigation: {
    nextEl: '.swiper-button-next', // 次へボタン
    prevEl: '.swiper-button-prev', // 前へボタン
  },
  breakpoints: {

    // タブレットおよびPC用（768px以上）
    768: {
      slidesPerView: 'auto', // 一度に表示するスライド数
      slidesPerGroup: 1, // 一度に移動するスライド数
      initialSlide: 1, // 初期表示スライド
      spaceBetween: 40, // スライド間のスペース
    }
  }
});

  document.addEventListener('DOMContentLoaded', function () {
    const triggerMargin = 150;
  
    // 🔹 読み込み時に .scroll-onload のみに is-active を付与
    const onloadElements = document.querySelectorAll('.scroll-onload');
    onloadElements.forEach(function (elem) {
      setTimeout(() => {
        elem.classList.add('is-active');
      }, 200); // ふわっと演出用ディレイ（任意）
    });
  
    // 🔸 スクロールで登場する要素
    const scrollElements = document.querySelectorAll('.scroll-up, .scroll-left, .scroll-right');
  
    function activateOnScroll() {
      scrollElements.forEach(function (elem) {
        const elemTop = elem.getBoundingClientRect().top;
        const windowHeight = window.innerHeight;
  
        if (windowHeight > elemTop + triggerMargin) {
          elem.classList.add('is-active');
        }
      });
    }
  
    // 初期チェック＆スクロールイベント
    window.addEventListener('load', activateOnScroll);
    window.addEventListener('scroll', activateOnScroll);
  });

    
  $(document).ready(function () {
    // 初期状態で全ての答えを閉じる
    $('.js-faq-question').next().hide();
  
    // クリックイベントで開閉＆クラス切り替え
    $('.js-faq-question').on('click', function () {
      $(this).next().slideToggle(300); // 0.3秒でスライド
      $(this).toggleClass('is-active');
    });
  });


  // ローディングとMVアニメーション
  window.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('.header');
    const mv = document.querySelector('#mv');
    const title = document.querySelector('.mv__title-main');
    const spans = document.querySelectorAll('.mv__title-main span');
  
    // チラ見え防止：最初にすぐ空にする
    spans.forEach(span => {
      span.dataset.text = span.textContent;
      span.textContent = '';
    });
  
    // ヘッダーとMVを表示
    header.classList.add('show');
    mv.classList.add('show');
  
    // タイトル全体をフェードイン
    title.classList.add('is-visible');
  
    // 少し遅らせて文字アニメーション
    setTimeout(() => {
      spans.forEach((lineSpan, lineIndex) => {
        const text = lineSpan.dataset.text;
  
        text.split('').forEach((char, i) => {
          const charSpan = document.createElement('span');
          charSpan.textContent = char;
          charSpan.style.display = 'inline-block';
          lineSpan.appendChild(charSpan);
  
          setTimeout(() => {
            charSpan.classList.add('is-active');
          }, (i + lineIndex * 8) * 50);
        });
      });
    }, 400);
  });
  

